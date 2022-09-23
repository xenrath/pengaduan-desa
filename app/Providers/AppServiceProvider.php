<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        URL::forceRootUrl(Config::get('app.url'));
        if (str_contains(Config::get('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        $isColExists = Schema::connection(env('DB_CONNECTION'))->hasColumn('users', 'in_active');
        if ($isColExists) {
            $user = User::where('in_active', false)->get();
            View::share('user', $user);
        }
    }
}
