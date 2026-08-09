<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VisaStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * A status can belong to many visas.
     */
    public function visas(): HasMany
    {
        return $this->hasMany(Visa::class);
    }
}