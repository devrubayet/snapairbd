<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'default_price',
        'status',
    ];

    protected $casts = [
        'default_price' => 'decimal:2',
    ];

    /**
     * A service can be used in many invoice items.
     */
    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }
    public function clientServices()
{
    return $this->hasMany(ClientService::class);
}
}