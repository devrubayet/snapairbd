<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'amount',
        'payment_method',
        'transaction_id',
        'reference',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    /**
     * Payment belongs to a client.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * A payment can be allocated to multiple invoices/items.
     */
    public function allocations(): HasMany
    {
        return $this->hasMany(PaymentAllocation::class);
    }
}