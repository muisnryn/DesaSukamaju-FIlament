<?php

namespace App\Providers;

use App\Models\ContactSetting;
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
        config(['app.locale' => 'id']);
        \Carbon\Carbon::setLocale('id');

        View::composer(['partials._footer', 'profil'], function ($view): void {
            $view->with('contactSettings', ContactSetting::query()->find(1));
        });
    }
}
