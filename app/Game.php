<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {
    protected $with = ['away', 'home', 'moneyLine', 'spread', 'overUnder'];

    protected $appends = ['teams'];

    protected $fillable = ['week_id', 'away_id', 'home_id', 'away_score', 'home_score', 'scored'];

    public function away() {
        return $this->belongsTo('App\Team', 'away_id');
    }

    public function home() {
        return $this->belongsTo('App\Team', 'home_id');
    }

    public function moneyLine() {
        return $this->hasOne('App\MoneyLine', 'id');
    }

    public function spread() {
        return $this->hasOne('App\Spread', 'id');
    }

    public function overUnder() {
        return $this->hasOne('App\OverUnder', 'id');
    }

    public function bets() {
        return $this->hasMany('App\Bet', 'odds_id');
    }

    public function getTeamsAttribute() {
        return ucfirst($this->away->name) . " @ " . ucfirst($this->home->name);
    }

    public function scopeCurrentWeek($query) {
        $currentWeek = optional(Week::current())->week;

        return $query->where('week_id', $currentWeek);
    }

    public function scopeUnscored($query) {
        return $query->where('scored', false);
    }
}
