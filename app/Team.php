<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {
    public function getNameAttribute($value) {
        return ucfirst($value);
    }
}
