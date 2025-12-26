<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\URL;
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
        if ($this->app->environment('production')) {
            // Paksa semua URL menggunakan HTTPS
            URL::forceScheme('https');

            // Jalankan storage:link jika belum ada symlink
            $publicStoragePath = public_path('storage');
            if (!is_link($publicStoragePath)) {
                try {
                    Artisan::call('storage:link');
                } catch (\Exception $e) {
                    // Supaya tidak error saat deploy
                }
            }
        }
    }
}
