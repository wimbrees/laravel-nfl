<?php

namespace App\Providers;

use App\Week;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Bet' => 'App\Policies\BetPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        Gate::define('create-bets', function ($user) {
            $userAvailableUnits = $user->units;

            $bets = collect(request()->all());

            $totalUnits = $bets->map(function ($bet) {
                return $bet['units'];
            })->reduce(function ($prev, $curr) {
                return intval($prev) + intval($curr);
            });

            $weekIsPlaying = Week::current()->isPlaying();

            return $userAvailableUnits >= $totalUnits && !$weekIsPlaying;
        });
    }
}
