<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientService extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'service_id',
        'visa_id',
        'price',
        'quantity',
        'service_date',
        'notes',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'service_date' => 'date',
    ];

    /**
     * Client who purchased this service.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Master service.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Optional related visa.
     */
    public function visa()
    {
        return $this->belongsTo(Visa::class);
    }
}