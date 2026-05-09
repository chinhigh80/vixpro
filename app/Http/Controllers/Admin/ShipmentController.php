<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Shipment::with(['user', 'createdBy', 'assignedDriver', 'branch'])
            ->when($request->filled('tracking_number'), function ($query, $tracking_number) {
                return $query->where('tracking_number', 'like', "%{$tracking_number}%");
            })
            ->when($request->filled('status'), function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->filled('start_date'), function ($query, $start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($request->filled('end_date'), function ($query, $end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->orderBy('created_at', 'desc');

        $shipments = $query->paginate(25)->withQueryString();

        return inertia('Admin/Shipment/Index', [
            'shipments' => $shipments,
            'filters' => $request->only(['tracking_number', 'status', 'start_date', 'end_date']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Shipment/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tracking_number' => ['required', 'string', 'max:255', 'unique:shipments'],
            'user_id' => ['nullable', 'exists:users,id'],
            'status' => ['required', 'string', 'in:pending,picked up,in transit,customs,out for delivery,delivered,exception'],
            'service_level' => ['required', 'string', 'in:standard,express,overnight,same_day'],
            'sender_name' => ['required', 'string', 'max:255'],
            'sender_address' => ['required', 'string'],
            'sender_phone' => ['required', 'string', 'max:20'],
            'sender_email' => ['required', 'email', 'max:255'],
            'receiver_name' => ['required', 'string', 'max:255'],
            'receiver_address' => ['required', 'string'],
            'receiver_phone' => ['required', 'string', 'max:20'],
            'receiver_email' => ['required', 'email', 'max:255'],
            'package_type' => ['required', 'string', 'max:100'],
            'weight_kg' => ['required', 'numeric', 'min:0.01'],
            'dimensions' => ['nullable', 'array'],
            'dimensions.length' => ['nullable', 'numeric', 'min:0'],
            'dimensions.width' => ['nullable', 'numeric', 'min:0'],
            'dimensions.height' => ['nullable', 'numeric', 'min:0'],
            'content_description' => ['required', 'string'],
            'estimated_delivery_date' => ['nullable', 'date', 'after_or_equal:today'],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'assigned_driver_id' => ['nullable', 'exists:users,id'],
            'created_by' => ['required', 'exists:users,id'],
        ]);

        $shipment = Shipment::create($validated);

        // Create initial status update
        $shipment->statusUpdates()->create([
            'status' => $validated['status'],
            'note' => 'Shipment created',
            'updated_by' => $validated['created_by'],
        ]);

        return redirect()
            ->route('admin.shipments.show', $shipment->id)
            ->with('success', 'Shipment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        $shipment->load(['user', 'createdBy', 'assignedDriver', 'branch', 'statusUpdates.user']);

        return inertia('Admin/Shipment/Show', [
            'shipment' => $shipment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        $shipment->load(['user', 'createdBy', 'assignedDriver', 'branch']);

        return inertia('Admin/Shipment/Edit', [
            'shipment' => $shipment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipment)
    {
        $validated = $request->validate([
            'tracking_number' => ['required', 'string', 'max:255', Rule::unique('shipments')->ignore($shipment->id)],
            'user_id' => ['nullable', 'exists:users,id'],
            'status' => ['required', 'string', 'in:pending,picked up,in transit,customs,out for delivery,delivered,exception'],
            'service_level' => ['required', 'string', 'in:standard,express,overnight,same_day'],
            'sender_name' => ['required', 'string', 'max:255'],
            'sender_address' => ['required', 'string'],
            'sender_phone' => ['required', 'string', 'max:20'],
            'sender_email' => ['required', 'email', 'max:255'],
            'receiver_name' => ['required', 'string', 'max:255'],
            'receiver_address' => ['required', 'string'],
            'receiver_phone' => ['required', 'string', 'max:20'],
            'receiver_email' => ['required', 'email', 'max:255'],
            'package_type' => ['required', 'string', 'max:100'],
            'weight_kg' => ['required', 'numeric', 'min:0.01'],
            'dimensions' => ['nullable', 'array'],
            'dimensions.length' => ['nullable', 'numeric', 'min:0'],
            'dimensions.width' => ['nullable', 'numeric', 'min:0'],
            'dimensions.height' => ['nullable', 'numeric', 'min:0'],
            'content_description' => ['required', 'string'],
            'estimated_delivery_date' => ['nullable', 'date', 'after_or_equal:today'],
            'actual_delivery_date' => ['nullable', 'date'],
            'delivered_at' => ['nullable', 'date'],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'assigned_driver_id' => ['nullable', 'exists:users,id'],
            'proof_of_delivery' => ['nullable', 'string', 'max:255'],
            'label_pdf_path' => ['nullable', 'string', 'max:255'],
        ]);

        $shipment->update($validated);

        // If status changed, create a status update
        if ($request->has('status') && $request->input('status') !== $shipment->getOriginal('status')) {
            $shipment->statusUpdates()->create([
                'status' => $validated['status'],
                'note' => 'Status updated via edit form',
                'updated_by' => $request->user()->id,
            ]);
        }

        return redirect()
            ->route('admin.shipments.show', $shipment->id)
            ->with('success', 'Shipment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();

        return redirect()
            ->route('admin.shipments.index')
            ->with('success', 'Shipment deleted successfully.');
    }
}
