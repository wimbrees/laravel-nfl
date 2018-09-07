<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model {
    protected $fillable = ['week', 'starts'];

    public static function current() {
        return Week::where('starts', '>', \Carbon\Carbon::now()->subDays(5))->first();
    }

    public function games() {
        return $this->hasMany('App\Game');
    }

    public function isPlaying() {
        return $this->starts < \Carbon\Carbon::now();
    }
}
