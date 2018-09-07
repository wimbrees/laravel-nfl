<?php

namespace App\Http\Controllers;

use App\Game;
use App\User;
use App\UserStats;
use App\Week;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $week = Week::current()->week;

        $games = Game::currentWeek()->get();

        // TODO: with query scopes on Bet model
        $bets = User::getCurrentWeekBets();

        $weekIsPlaying = Week::current()->isPlaying();

        $allBets = $weekIsPlaying ? User::getAllCurrentWeekBets() : '[]';

        return view('home', compact('week', 'games', 'bets', 'weekIsPlaying', 'allBets'));
    }

    public function standings() {
        $stats = UserStats::select(['user_stats.*', 'users.username'])->join('users', 'users.id', '=', 'user_stats.user_id')->get()->toArray();

        if (!Week::current()->isPlaying()) {
            $unitsBetByUser = DB::table('bets')
                ->select('user_id', 'units')
                ->whereIn('odds_id', Week::current()->games->pluck('id'))
                ->get()
                ->groupBy('user_id')
                ->map(function ($user) {
                    return $user->sum('units');
                });

            foreach ($stats as &$user) {
                $userId = $user['id'];
                if (!empty($unitsBetByUser[$userId])) {
                    $user['units'] += $unitsBetByUser[$userId];
                    $user['units'] = number_format($user['units'], 2, '.', ',');
                }
            }
        }

        uasort($stats, function ($a, $b) {
            return $b['units'] - $a['units'];
        });

        return view('standings')->with(compact('stats'));
    }

    public function myAchievements() {
        $achievements = auth()->user()->achievements;

        return view('my-achievements')->with(compact('achievements'));
    }
}
