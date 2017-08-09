<?php

namespace App\Providers;

use App\Instagram\GuzzleInstagramClient;
use App\Instagram\Instagram;
use App\Instagram\InstagramClient;
use App\Menu\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('password', function($attribute, $value, $parameters, $validator) {
            return Hash::check($value, Auth::user()->password);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('menu', function() {
            return new Menu;
        });

        $this->app->bind(InstagramClient::class, function() {
           return new GuzzleInstagramClient();
        });

        $this->app->bind('instagram', function() {
            $client = $this->app->make(InstagramClient::class);
            return new Instagram($client);
        });
    }
}
