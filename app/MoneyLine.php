<?php

namespace App;

use App\Events\OddsUpdated;
use App\Odds;
use Illuminate\Database\Eloquent\Model;

class MoneyLine extends Model implements Odds {
    protected $table = 'money_line';

    protected $fillable = ['id', 'home', 'away', 'won'];

    protected $dispatchesEvents = [
        'updated' => OddsUpdated::class,
    ];

    public function bets() {
        return $this->morphMany('App\Bet', 'odds');
    }
}
