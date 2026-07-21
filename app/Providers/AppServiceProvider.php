<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use BezhanSalleh\LanguageSwitch\Enums\DisplayMode;


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
        // Register policies for Spatie Permission models (outside App\Models namespace)
        // \Illuminate\Support\Facades\Gate::policy(
        //     \Spatie\Permission\Models\Role::class,
        //     \App\Policies\RolePolicy::class
        // );
        // \Illuminate\Support\Facades\Gate::policy(
        //     \Spatie\Permission\Models\Permission::class,
        //     \App\Policies\PermissionPolicy::class
        // );

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch->locales(['en', 'id']);
            // ->displayMode(DisplayMode::Modal);
        });
    }
}
