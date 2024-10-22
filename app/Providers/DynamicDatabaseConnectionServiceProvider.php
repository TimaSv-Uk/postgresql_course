<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

class DynamicDatabaseConnectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        if (Auth::check()) {
            Config::set('database.connections.pgsql_dinamic', [
                'driver' => 'pgsql',
                'url' => env('DB_URL'),
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '5432'),
                'database' => env('DB_DATABASE', 'laravel'),
                'username' => Auth::user()->name,
                'password' => Auth::user()->password,
                'charset' => env('DB_CHARSET', 'utf8'),
                'prefix' => '',
                'prefix_indexes' => true,
                'search_path' => 'public',
                'sslmode' => 'prefer',
            ]);
        }
    }
}
