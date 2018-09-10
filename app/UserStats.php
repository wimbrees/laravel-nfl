<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserStats extends Model {
    protected $table = 'user_stats';

    protected $fillable = 'units';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
