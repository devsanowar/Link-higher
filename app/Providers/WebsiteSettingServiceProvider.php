<?php

namespace App\Providers;

use App\Models\AdminPanel;
use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class WebsiteSettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $website_settings = WebsiteSetting::first();
        View::share("website_settings", $website_settings);

        $login_settings = AdminPanel::first();
        View::share("login_settings", $login_settings);

    }
}
