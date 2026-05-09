<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shipment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tracking_number',
        'user_id',
        'status',
        'service_level',
        'sender_name',
        'sender_address',
        'sender_phone',
        'sender_email',
        'receiver_name',
        'receiver_address',
        'receiver_phone',
        'receiver_email',
        'package_type',
        'weight_kg',
        'dimensions',
        'content_description',
        'estimated_delivery_date',
        'actual_delivery_date',
        'delivered_at',
        'created_by',
        'assigned_driver_id',
        'branch_id',
        'proof_of_delivery',
        'label_pdf_path',
    ];

    protected $casts = [
        'dimensions' => 'array',
        'estimated_delivery_date' => 'date',
        'actual_delivery_date' => 'date',
        'delivered_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedDriver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_driver_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function statusUpdates(): HasMany
    {
        return $this->hasMany(StatusUpdate::class)->orderBy('created_at', 'desc');
    }
}
