<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShipmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return inertia('Frontend/Home');
})->name('home');

Route::get('/about', function () {
    return inertia('Frontend/About');
})->name('about');

Route::get('/services', function () {
    return inertia('Frontend/Services');
})->name('services');

Route::get('/tracking', function () {
    return inertia('Frontend/Tracking');
})->name('tracking');

Route::post('/tracking/results', function () {
    request()->validate([
        'tracking_number' => 'required|string|max:255',
    ]);

    request()->session()->put('tracking_number', request()->input('tracking_number'));

    return redirect()->route('tracking.results');
})->name('tracking.submit');

Route::get('/tracking/results', function () {
    $trackingNumber = request()->session()->get('tracking_number');

    if (!$trackingNumber) {
        return redirect()->route('tracking')->with('error', 'No tracking number provided.');
    }

    $shipment = \App\Models\Shipment::where('tracking_number', $trackingNumber)->first();

    if (!$shipment) {
        return redirect()->route('tracking')->with('error', 'Tracking number not found.');
    }

    // Load the status updates for the shipment
    $shipment->load('status_updates');

    return inertia('Frontend/TrackingResults', [
        'shipment' => $shipment
    ]);
})->name('tracking.results');

Route::get('/contact', function () {
    return inertia('Frontend/Contact');
})->name('contact');

// Admin routes (protected by Jetstream authentication)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/shipments', [ShipmentController::class, 'index'])
        ->name('admin.shipments.index');
    Route::get('/admin/shipments/create', [ShipmentController::class, 'create'])
        ->name('admin.shipments.create');
    Route::post('/admin/shipments', [ShipmentController::class, 'store'])
        ->name('admin.shipments.store');
    Route::get('/admin/shipments/{shipment}', [ShipmentController::class, 'show'])
        ->name('admin.shipments.show');
    Route::get('/admin/shipments/{shipment}/edit', [ShipmentController::class, 'edit'])
        ->name('admin.shipments.edit');
    Route::put('/admin/shipments/{shipment}', [ShipmentController::class, 'update'])
        ->name('admin.shipments.update');
    Route::delete('/admin/shipments/{shipment}', [ShipmentController::class, 'destroy'])
        ->name('admin.shipments.destroy');
});
