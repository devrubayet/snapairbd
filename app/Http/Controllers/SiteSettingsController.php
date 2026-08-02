<?php

namespace App\Http\Controllers;

use App\Models\SiteInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SiteSettingsController extends Controller
{
    function update(Request $request ){
        $siteInfo = SiteInfo::first();

        if(!$siteInfo){
            $siteInfo = new SiteInfo();



        }

        

        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,ico|max:1024',
            'footer_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            
            'phone_primary' => 'nullable|string|max:50',
            'phone_secondary' => 'nullable|string|max:50',
            'whatsapp_number' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'civil_no' => 'nullable|string|max:500',
            'support_email' => 'nullable|email|max:255',

            'address_line' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'google_map_embed' => 'nullable',

            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'linkedin' => 'nullable|url',

            'trade_license' => 'nullable|string|max:100',
            'iata_number' => 'nullable|string|max:100',
            'tagline_travel' => 'nullable|string|max:255',
            'about_short' => 'nullable|string',
            'about_full' => 'nullable|string',

           

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
         

            'primary_color' => 'nullable|string|max:20',
            'secondary_color' => 'nullable|string|max:20',
            'footer_text' => 'nullable|string',
            'copyright_text' => 'nullable|string|max:255',
        ]);

        $siteInfo->fill($validated);

        // image uploads
        if ($request->hasFile('logo')) {
            $siteInfo->logo = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            $siteInfo->favicon = $request->file('favicon')->store('settings', 'public');
        }

        if ($request->hasFile('footer_logo')) {
            $siteInfo->footer_logo = $request->file('footer_logo')->store('settings', 'public');
        }

        if ($request->hasFile('og_image')) {
            $siteInfo->og_image = $request->file('og_image')->store('settings', 'public');
        }

        $siteInfo->save();
        // 🔥 VERY IMPORTANT
    Cache::forget('site_settings');
    

        flash()->success('Settings updated successfully!');
        return redirect()->back();
    }

    function edit()
{
    $siteInfo = Cache::remember('site_settings', 60 * 60, function () {
        return SiteInfo::first();
    });

    return view('admin.pages.siteinfo', compact('siteInfo'));
}
}
