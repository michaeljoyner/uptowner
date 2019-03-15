<?php

namespace App\Providers;

use App\Menu\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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

        Blade::directive('activeclass', function ($path_fragment) {
            return "<?php echo starts_with(Request::path(), app()->getLocale() . $path_fragment) ? 'active' : app()->getLocale(); ?>";
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
    }
}
