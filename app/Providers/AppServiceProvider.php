<?php

namespace App\Providers;

use App\Country;
use App\Locale;
use Illuminate\Support\ServiceProvider;

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
//        dd(session()->get('country'));
        view()->composer(['pages.inc.navMenu', 'pages.inc.footer'], function ($view) {
            $view->with('locales',  Locale::where('status', '1')->pluck('name')->toArray());
            $view->with('countries',  Country::all());

        });
    }
}
