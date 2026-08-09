<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'service_id',
        'visa_id',
        'description',
        'quantity',
        'unit_price',
        'total',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * Invoice item belongs to an invoice.
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Invoice item belongs to a service.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Invoice item can optionally belong to a visa.
     */
    public function visa(): BelongsTo
    {
        return $this->belongsTo(Visa::class);
    }

    /**
     * An invoice item can have multiple payment allocations.
     */
    public function paymentAllocations(): HasMany
    {
        return $this->hasMany(PaymentAllocation::class);
    }
}