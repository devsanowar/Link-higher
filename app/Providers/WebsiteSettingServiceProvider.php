<?php
namespace App\Providers;

use App\Models\AdminPanel;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
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
        // 1) Website settings cache + view share
        $website_settings = Cache::rememberForever('website_settings_model', function () {
            return WebsiteSetting::first();
        });
        View::share('website_settings', $website_settings);

        // 2) Admin panel / login settings cache + view share
        $login_settings = Cache::rememberForever('login_settings_model', function () {
            return AdminPanel::first();
        });
        View::share('login_settings', $login_settings);

        // 3) Determine app name from website_settings
        // Adjust these checks depending on your table structure:
        // - if website_settings has column 'website_name' use that
        // - if it's key/value rows, use where('key','website_name')->value('value')
        $appName = config('app.name'); // fallback

        if ($website_settings) {
            // case A: table has dedicated column 'website_name'
            if (isset($website_settings->website_title) && !empty($website_settings->website_title)) {
                $appName = $website_settings->website_title;
            }
            // case B: if your table is key/value stored in columns 'key' and 'value'
            elseif (isset($website_settings->key) && $website_settings->key === 'website_name' && isset($website_settings->value)) {
                $appName = $website_settings->value;
            }
        } else {
            // if you don't store in first row but in separate key/value rows:
            $kv = Cache::rememberForever('website_title_kv', function () {
                return WebsiteSetting::where('key', 'website_title')->value('value');
            });
            if ($kv) {
                $appName = $kv;
            }
        }

        // 4) Set Laravel config runtime value so everywhere config('app.name') কাজে লাগবে
        config(['app.name' => $appName]);
    }
}
