<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
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
    // Se estivermos em produção (Railway)
    if ($this->app->environment('production')) {
        // 1. Força os links gerados a serem https://
        URL::forceScheme('https');

        // 2. Força a URL raiz a ser a que você definiu no .env
        // Isso impede que o Laravel use "http://localhost" ou o IP interno
        if (config('app.url')) {
            URL::forceRootUrl(config('app.url'));
        }
    }
}
}
