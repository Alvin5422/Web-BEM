<?php

namespace App\Providers;

use App\Models\Period;
use App\Models\SiteSetting;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();

        if (! app()->runningInConsole() && Schema::hasTable('site_settings')) {
            $settingsList = SiteSetting::all()->pluck('value', 'key')->toArray();
            $activePeriod = Schema::hasTable('periods') ? Period::getActive() : null;

            View::share('siteSettings', $settingsList);
            View::share('globalActivePeriod', $activePeriod);
        } else {
            View::share('siteSettings', []);
            View::share('globalActivePeriod', null);
        }
    }
}
