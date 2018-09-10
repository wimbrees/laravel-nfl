<?php

namespace App;

use App\Events\UserCreated;
use App\Game;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'units',
    ];

    protected $appends = ['units'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];

    public function bets() {
        return $this->hasMany('App\Bet');
    }

    public function stats() {
        return $this->hasOne('App\UserStats');
    }

    public function achievements() {
        return $this->hasOne('App\Achievements');
    }

    public static function getCurrentWeekBets() {
        $gameIds = Game::currentWeek()->get()->pluck('id')->toArray();

        // $betOrder = ['App\MoneyLine', 'App\Spread', 'App\OverUnder'];

        return auth()->user()
            ->bets
            ->whereIn('odds_id', $gameIds)
        // ->sortBy(function ($bet, $key) use ($betOrder) {
        //     return array_search($bet->odds_type, $betOrder);
        // })
            ->sortBy('odds_id')
            ->sortByDesc('units')
            ->values();
    }

    public static function getAllCurrentWeekBets() {
        $gameIds = Game::currentWeek()->get()->pluck('id')->toArray();

        return Game::currentWeek()
            ->get()
            ->map
            ->bets
            ->flatten()
            ->sortBy('odds_id')
            ->sortByDesc('units')
            ->groupBy(function ($bet) {
                return "{$bet->user->username} ({$bet->user->units})";}
            )
            ->sortByDesc(function ($group) {
                return $group[0]->user->units;
            });
    }

    public function getUnitsAttribute() {
        return $this->stats->units;
    }
}
