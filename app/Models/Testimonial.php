<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name','avatar','bio','message'];
    public function getImageUrlAttribute()
{
    if ($this->avatar === 'img/avatars/avatar.png') {
        return asset($this->avatar);
    }

    return asset('storage/' . $this->avatar);
}

}
