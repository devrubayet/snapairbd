<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VisaType extends Model
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
     * A visa type can have many visas.
     */
    public function visas(): HasMany
    {
        return $this->hasMany(Visa::class);
    }
}