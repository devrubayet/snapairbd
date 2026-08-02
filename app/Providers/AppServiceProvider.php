<?php

namespace App\Providers;

use App\Models\SiteInfo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         $settings = Cache::rememberForever('site_settings', function () {
        return SiteInfo::first(); // ekta row dhorlam
    });

    View::share('settings', $settings);
    }
}
