<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserStats extends Model {
    protected $table = 'user_stats';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
