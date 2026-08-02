<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{

    protected $fillable = ['name','img', 'details'];  
    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('airlines/avatar.png'); // fallback
    }
}
