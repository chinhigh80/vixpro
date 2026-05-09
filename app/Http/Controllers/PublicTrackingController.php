<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PublicTrackingController extends Controller
{
    public function index()
    {
        return inertia('Public/Track');
    }

    public function track(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tracking_number' => 'required|string|max:255',
            // We can add a captcha validation here if we integrate a captcha service
            // For now, we'll skip captcha as per the requirement (optional but available)
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $trackingNumber = $request->input('tracking_number');
        $shipment = Shipment::where('tracking_number', $trackingNumber)->first();

        if (!$shipment) {
            return redirect()->back()->with('error', 'Tracking number not found.')->withInput();
        }

        return redirect()->route('track.show', ['trackingNumber' => $shipment->tracking_number]);
    }

    public function show($trackingNumber)
    {
        $shipment = Shipment::with(['statusUpdates', 'user', 'createdBy', 'assignedDriver', 'branch'])
            ->where('tracking_number', $trackingNumber)
            ->firstOrFail();

        // Mask sender and receiver info for privacy (show only first letter and last name, etc.)
        // We'll create a masked version for the view
        $maskedShipment = $shipment->toArray();
        $maskedShipment['sender_name'] = $this->maskName($shipment->sender_name);
        $maskedShipment['receiver_name'] = $this->maskName($shipment->receiver_name);
        $maskedShipment['sender_phone'] = $this->maskPhone($shipment->sender_phone);
        $maskedShipment['receiver_phone'] = $this->maskPhone($shipment->receiver_phone);
        $maskedShipment['sender_email'] = $this->maskEmail($shipment->sender_email);
        $maskedShipment['receiver_email'] = $this->maskEmail($shipment->receiver_email);

        return inertia('Public/Show', [
            'shipment' => $maskedShipment,
            'statusUpdates' => $shipment->statusUpdates,
        ]);
    }

    private function maskName($name)
    {
        if (empty($name)) {
            return $name;
        }
        $parts = explode(' ', $name);
        $maskedParts = array_map(function ($part) {
            if (strlen($part) > 1) {
                return substr($part, 0, 1) . str_repeat('*', strlen($part) - 1);
            }
            return $part;
        }, $parts);
        return implode(' ', $maskedParts);
    }

    private function maskPhone($phone)
    {
        if (empty($phone)) {
            return $phone;
        }
        // Show only last 4 digits
        return str_repeat('*', max(0, strlen($phone) - 4)) . substr($phone, -4);
    }

    private function maskEmail($email)
    {
        if (empty($email)) {
            return $email;
        }
        $parts = explode('@', $email);
        if (count($parts) !== 2) {
            return $email;
        }
        $local = $parts[0];
        $domain = $parts[1];
        if (strlen($local) > 2) {
            $local = substr($local, 0, 2) . str_repeat('*', strlen($local) - 2);
        } else {
            $local = str_repeat('*', strlen($local));
        }
        return $local . '@' . $domain;
    }
}
