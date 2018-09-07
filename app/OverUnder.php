<?php

namespace App;

use App\Events\OddsUpdated;
use App\Odds;
use Illuminate\Database\Eloquent\Model;

class OverUnder extends Model implements Odds {
    protected $table = 'over_under';

    protected $fillable = ['id', 'line', 'won'];

    protected $dispatchesEvents = [
        'updated' => OddsUpdated::class,
    ];

    public function bets() {
        return $this->morphMany('App\Bet', 'odds');
    }
}
