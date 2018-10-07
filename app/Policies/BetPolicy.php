<?php

namespace App\Policies;

use App\Bet;
use App\Game;
use App\User;
use App\Week;
use Illuminate\Auth\Access\HandlesAuthorization;

class BetPolicy {
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function destroy(User $user, Bet $bet) {
        $currentWeek = Week::current();

        if (!$currentWeek || $currentWeek->isPlaying()) {return false;}

        $betWeek = Game::find($bet->odds_id)->week_id;

        return $bet->user_id == $user->id && $betWeek == $currentWeek->id;
    }
}
