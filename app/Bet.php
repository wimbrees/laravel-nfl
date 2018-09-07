<?php

namespace App;

use App\Game;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model {
    protected $fillable = ['user_id', 'odds_id', 'odds_type', 'selection', 'units', 'description', 'to_win'];

    protected $appends = ['teams', 'won'];

    public function odds() {
        return $this->morphTo();
    }

    public function game() {
        return $this->belongsTo('App\Game', 'odds_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function setOddsTypeAttribute($value) {
        $this->attributes['odds_type'] = "App\\{$value}";
    }

    public function getTeamsAttribute() {
        return $this->game->teams;
    }

    public function getWonAttribute() {
        if (is_null($this->odds->won)) {
            return -1;
        }

        return $this->selection == $this->odds->won ? 1 : 0;
    }

    public function setDescriptionAttribute($value) {
        switch ($value) {
        case 'MoneyLine':
            $team = Game::find($this->odds_id)->{$this->selection}->short;

            $odds = $this->odds->{$this->selection};

            $this->attributes['description'] = "{$team} @ {$odds}";
            break;

        case 'Spread':
            $team = Game::find($this->odds_id)->{$this->selection}->short;

            $line = $this->odds->{$this->selection};

            $this->attributes['description'] = "{$team} {$line} @ 1.90";
            break;

        case 'OverUnder':
            $selection = $this->selection === 'over' ? 'O' : 'U';

            $line = $this->odds->line;

            $this->attributes['description'] = "{$selection} {$line} @ 1.90";
            break;
        }
    }
}
