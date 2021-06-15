<?php

namespace App\Providers;

use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
        Voyager::addAction(\App\Actions\SubadminBlockUnBlockActions::class);

        View::share('ASSET' ,  asset('public/assets'));
        View::share('ASSETS' ,  asset('public'));
        View::share('STORAGEASSET' ,  asset('public/storage'));
            Schema::defaultStringLength(191);
            \Blade::directive('var' , function($param){
                return "<?php $param ?>";
            });
    }
}
