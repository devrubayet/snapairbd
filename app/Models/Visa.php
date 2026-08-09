<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visa extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'visa_type_id',
        'visa_status_id',
        'country',
        'application_no',
        'application_date',
        'submission_date',
        'approval_date',
        'expiry_date',
        'notes',
    ];

    protected $casts = [
        'application_date' => 'date',
        'submission_date' => 'date',
        'approval_date' => 'date',
        'expiry_date' => 'date',
    ];

    /**
     * Visa belongs to a client.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Visa belongs to a visa type.
     */
    public function visaType(): BelongsTo
    {
        return $this->belongsTo(VisaType::class);
    }

    /**
     * Visa belongs to a visa status.
     */
    public function visaStatus(): BelongsTo
    {
        return $this->belongsTo(VisaStatus::class);
    }

    /**
     * A visa can be included in many invoice items.
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