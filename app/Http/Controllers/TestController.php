<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Week;

class TestController extends Controller {
    public function test(Bet $bet) {
        $units = Week::current()->games->each->first()->bets->groupBy('user_id')->map(function ($user) {
            $unitsArray = array_map(function ($bet) {
                return $bet['units'];
            }, $user->toArray());

            return array_reduce($unitsArray, function ($p, $c) {
                return $p + $c;
            }, 0);
        });

        dd($units);
    }
}
