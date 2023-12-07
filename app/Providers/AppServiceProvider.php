<?php

namespace App\Providers;

use App\Models\category;
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
        view()->composer('layouts/frontendlayouts', function($view){
            $view->with('categories', category::with('subCategory')->latest()->get());
        });
    }
}
