<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        \View::composer('*', function ($view) {
            if (auth()->check()) {
                $view->with(
                    'myInfo',
                    collect(auth()->user()->only(['username', 'units']))
                );
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
