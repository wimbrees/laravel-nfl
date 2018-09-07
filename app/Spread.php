<?php

namespace App;

use App\Events\OddsUpdated;
use App\Odds;
use Illuminate\Database\Eloquent\Model;

class Spread extends Model implements Odds {
    protected $table = 'spread';

    protected $fillable = ['id', 'home', 'away', 'won'];

    protected $dispatchesEvents = [
        'updated' => OddsUpdated::class,
    ];

    public function bets() {
        return $this->morphMany('App\Bet', 'odds');
    }

    public function getHomeAttribute($val) {
        return ($val < 0) ? $val : ('+' . $val);
    }

    public function getAwayAttribute($val) {
        return ($val < 0) ? $val : ('+' . $val);
    }
}
