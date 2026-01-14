<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\Fortify;
use App\Services\TenantManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Fortify::ignoreRoutes();

        $this->app->singleton(TenantManager::class, function ($app) {
            return new TenantManager();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', 'on');
            
            // Fix APP_URL in config if it is HTTP
            if (str_contains(config('app.url'), 'http://')) {
                config(['app.url' => str_replace('http://', 'https://', config('app.url'))]);
            }

            // Fix for Basset/Storage creating http links if APP_URL is http
            $publicUrl = config('filesystems.disks.public.url');
            if ($publicUrl && str_contains($publicUrl, 'http://')) {
                config(['filesystems.disks.public.url' => str_replace('http://', 'https://', $publicUrl)]);
            }
        }
    }
}
