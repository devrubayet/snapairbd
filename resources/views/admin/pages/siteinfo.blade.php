@extends('admin.base')

@section('title', ($siteInfo->site_name ?? 'Settings') . ' | Site Settings')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('settings-update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            {{-- ========== BASIC INFO ========== --}}
            <h4 class="mb-3">Basic Information</h4>

            <div class="form-group">
                <label>Site Name</label>
                <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $settings->site_name) }}">
            </div>

            <div class="form-group">
                <label>Tagline</label>
                <input type="text" name="site_tagline" class="form-control" value="{{ old('site_tagline', $settings->site_tagline) }}">
            </div>

            <div class="form-group">
                <label>Travel Tagline</label>
                <input type="text" name="tagline_travel" class="form-control" value="{{ old('tagline_travel', $settings->tagline_travel) }}">
            </div>

            {{-- ========== LOGOS ========== --}}
            <h4 class="mt-4 mb-3">Logos</h4>

            <div class="form-group">
                <label>Main Logo</label>
                <input type="file" name="logo" class="form-control-file">
            </div>

            <div class="form-group">
                <label>Footer Logo</label>
                <input type="file" name="footer_logo" class="form-control-file">
            </div>

            <div class="form-group">
                <label>Favicon</label>
                <input type="file" name="favicon" class="form-control-file">
            </div>

            <div class="form-group">
                <label>OG Image</label>
                <input type="file" name="og_image" class="form-control-file">
            </div>

            {{-- ========== CONTACT ========== --}}
            <h4 class="mt-4 mb-3">Contact Info</h4>

            <div class="form-group">
                <label>Primary Phone</label>
                <input type="text" name="phone_primary" class="form-control" value="{{ old('phone_primary', $settings->phone_primary) }}">
            </div>

            <div class="form-group">
                <label>Secondary Phone</label>
                <input type="text" name="phone_secondary" class="form-control" value="{{ old('phone_secondary', $settings->phone_secondary) }}">
            </div>

            <div class="form-group">
                <label>WhatsApp Number</label>
                <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $settings->whatsapp_number) }}">
            </div>

            <div class="form-group">
                <label>Main Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $settings->email) }}">
            </div>

            <div class="form-group">
                <label>Support Email</label>
                <input type="email" name="support_email" class="form-control" value="{{ old('support_email', $settings->support_email) }}">
            </div>

            {{-- ========== ADDRESS ========== --}}
            <h4 class="mt-4 mb-3">Address</h4>

            <div class="form-group">
                <label>Address Line</label>
                <input type="text" name="address_line" class="form-control" value="{{ old('address_line', $settings->address_line) }}">
            </div>

            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control" value="{{ old('city', $settings->city) }}">
            </div>

            <div class="form-group">
                <label>Country</label>
                <input type="text" name="country" class="form-control" value="{{ old('country', $settings->country) }}">
            </div>

            <div class="form-group">
                <label>Google Map Embed</label>
                <textarea name="google_map_embed" class="form-control">{{ old('google_map_embed', $settings->google_map_embed) }}</textarea>
            </div>

            {{-- ========== SOCIAL ========== --}}
            <h4 class="mt-4 mb-3">Social Links</h4>

            <input type="text" name="facebook" class="form-control mb-2" placeholder="Facebook" value="{{ old('facebook', $settings->facebook) }}">
            <input type="text" name="instagram" class="form-control mb-2" placeholder="Instagram" value="{{ old('instagram', $settings->instagram) }}">
            <input type="text" name="youtube" class="form-control mb-2" placeholder="YouTube" value="{{ old('youtube', $settings->youtube) }}">
            <input type="text" name="tiktok" class="form-control mb-2" placeholder="TikTok" value="{{ old('tiktok', $settings->tiktok) }}">
            <input type="text" name="linkedin" class="form-control mb-2" placeholder="LinkedIn" value="{{ old('linkedin', $settings->linkedin) }}">

            {{-- ========== BUSINESS INFO ========== --}}
            <h4 class="mt-4 mb-3">Business Info</h4>

            <input type="text" name="trade_license" class="form-control mb-2" placeholder="Trade License" value="{{ old('trade_license', $settings->trade_license) }}">
            <input type="text" name="iata_number" class="form-control mb-2" placeholder="IATA Number" value="{{ old('iata_number', $settings->iata_number) }}">
            <input type="text" name="civil_no" class="form-control mb-2" placeholder="Civil No" value="{{ old('civil_no', $settings->civil_no) }}">

            {{-- ========== ABOUT ========== --}}
            <h4 class="mt-4 mb-3">About</h4>

            <textarea name="about_short" class="form-control mb-2" rows="2" placeholder="Short About">{{ old('about_short', $settings->about_short) }}</textarea>

            <textarea name="about_full" class="form-control mb-2" rows="4" placeholder="Full About">{{ old('about_full', $settings->about_full) }}</textarea>

            {{-- ========== SEO ========== --}}
            <h4 class="mt-4 mb-3">SEO Settings</h4>

            <input type="text" name="meta_title" class="form-control mb-2" placeholder="Meta Title" value="{{ old('meta_title', $settings->meta_title) }}">

            <textarea name="meta_description" class="form-control mb-2" rows="2" placeholder="Meta Description">{{ old('meta_description', $settings->meta_description) }}</textarea>

            <input type="text" name="meta_keywords" class="form-control mb-2" placeholder="Meta Keywords" value="{{ old('meta_keywords', $settings->meta_keywords) }}">

            <button type="submit" class="btn btn-primary mt-3">Update Settings</button>
        </form>
    </div>
</div>
@endsection