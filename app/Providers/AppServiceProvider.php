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
        // Force HTTPS in production or staging (any non-local environment)
        if (! $this->app->environment('local')) {
            URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', 'on');

            // Fix APP_URL in config if it is HTTP
            if (str_contains(config('app.url'), 'http://')) {
                config(['app.url' => str_replace('http://', 'https://', config('app.url'))]);
            }
            config(['backpack.basset.cache_map' => storage_path('app/public/basset/.basset')]);

            // Garante que o disco seja o S3 (R2) em produção
            if (!$this->app->environment('local')) {
                config(['backpack.basset.disk' => 's3']);
            }
            // Fix ASSET_URL in config if it is HTTP
            if (config('app.asset_url') && str_contains(config('app.asset_url'), 'http://')) {
                config(['app.asset_url' => str_replace('http://', 'https://', config('app.asset_url'))]);
            }

            // Fix for Basset/Storage creating http links if APP_URL is http
            $publicUrl = config('filesystems.disks.public.url');
            if ($publicUrl && str_contains($publicUrl, 'http://')) {
                config(['filesystems.disks.public.url' => str_replace('http://', 'https://', $publicUrl)]);
            }
        }
    }
}
