<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // This is for the user dashboard (after login) - we can redirect to admin or customer portal based on role
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->isDriver()) {
            // TODO: Driver dashboard
            return redirect()->route('dashboard'); // placeholder
        } else {
            // Customer dashboard
            return redirect()->route('dashboard'); // placeholder
        }
    }

    public function adminDashboard()
    {
        $totalShipments = Shipment::count();
        $pendingShipments = Shipment::where('status', 'pending')->count();
        $inTransitShipments = Shipment::whereIn('status', ['picked up', 'in transit', 'customs'])->count();
        $deliveredShipments = Shipment::where('status', 'delivered')->count();
        $exceptionShipments = Shipment::where('status', 'exception')->count();

        // Revenue (assuming we have a cost field, but we don't in the current schema)
        // We'll skip revenue for now or calculate based on service level? Not implemented.
        $revenue = 0; // placeholder

        // Shipments by status for the chart
        $shipmentsByStatus = Shipment::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        return inertia('Admin/Dashboard', [
            'totalShipments' => $totalShipments,
            'pendingShipments' => $pendingShipments,
            'inTransitShipments' => $inTransitShipments,
            'deliveredShipments' => $deliveredShipments,
            'exceptionShipments' => $exceptionShipments,
            'revenue' => $revenue,
            'shipmentsByStatus' => $shipmentsByStatus,
        ]);
    }
}
