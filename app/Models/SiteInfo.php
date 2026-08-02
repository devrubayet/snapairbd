<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    protected $fillable = [
        'site_name','site_tagline','logo','favicon','footer_logo',
        'phone_primary','phone_secondary','whatsapp_number','email','support_email',
        'address_line','city','country','google_map_embed',
        'facebook','instagram','youtube','tiktok','linkedin',
        'trade_license','iata_number','tagline_travel','about_short','about_full',
        'meta_title','meta_description','meta_keywords','og_image','civil_no'
    ];
    protected $guarded = [];
}
