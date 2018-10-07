<?php

namespace App\Providers;

use App\Team;
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

        \View::composer('auth.register', function ($view) {
            $view->with('teams', Team::all());
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
