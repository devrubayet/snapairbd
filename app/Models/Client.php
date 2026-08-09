<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
     use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'date_of_birth',
        'gender',
        'nationality',
        'passport_no',
        'passport_expiry',
        'address',
        'city',
        'country',
        'emergency_contact',
        'emergency_phone',
        'notes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'passport_expiry' => 'date',
    ];

    /**
     * A client can have many visas.
     */
    public function visas(): HasMany
    {
        return $this->hasMany(Visa::class);
    }

    /**
     * A client can have many invoices.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * A client can make many payments.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    public function services()
{
    return $this->hasMany(ClientService::class);
}
}
