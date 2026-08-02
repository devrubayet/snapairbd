<?php

namespace App\Providers;

use App\Models\SiteInfo;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
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
        // ১. প্রজেক্ট যদি টার্মিনালে/কমান্ডলাইনে চলে (যেমন php artisan migrate), তবে এটি স্কিপ করবে
        if (App::runningInConsole()) {
            return;
        }
        // ২. যদি ডাটাবেজে 'site_infos' বা 'cache' টেবিলটি আসলেই থাকে, কেবল তখনই রান করবে
        if (Schema::hasTable('site_infos') && Schema::hasTable('cache')) {
            $settings = Cache::rememberForever('site_settings', function () {
                return SiteInfo::first();
            });

            View::share('settings', $settings);
        }
    }
}
