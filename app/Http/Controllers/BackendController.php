<?php

namespace App\Http\Controllers;

use App\Game;
use App\MoneyLine;
use App\OverUnder;
use App\Spread;
use App\Team;
use App\User;
use App\Week;
use Carbon\Carbon;

class BackendController extends Controller {
    public function odds() {
        $teams = Team::all();

        return view('odds')->with(compact('teams'));
    }

    public function oddsStore() {
        list('week' => $week, 'starts' => $starts, 'games' => $games) = request()->all();

        try {
            $weekId = $this->saveWeek($week, $starts);
        } catch (\Exception $e) {
            return response('This week already exists.', 403);
        }
        $this->saveGames($games, $weekId);

        return response('Odds created', 200);
    }

    public function scores() {
        $games = Week::current()->games()->unscored()->get();

        return view('scores')->with(compact('games'));
    }

    public function scoresStore() {
        foreach (request()->games as $key => $game) {
            if (is_null($game['away_score'])) {continue;}

            $awayScore = $game['away_score'];
            $homeScore = $game['home_score'];

            $game = Game::find($key);
            $game->update([
                'away_score' => $awayScore,
                'home_score' => $homeScore,
                'scored' => true,
            ]);

            if ($awayScore !== $homeScore) {
                $game->moneyLine->update([
                    'won' => ($game['away_score'] > $game['home_score']) ? 'away' : 'home',
                ]);
            }

            $game->spread->update([
                'won' => ($awayScore - $homeScore + $game->spread->away > 0) ? 'away' : 'home',
            ]);

            $game->overUnder->update([
                'won' => ($awayScore + $homeScore > $game->overUnder->line) ? 'over' : 'under',
            ]);
        }

        return response('Games scored', 200);
    }

    protected function saveWeek($week, $starts) {
        $nextSunday = Carbon::parse('next sunday');
        $starts = Carbon::create($nextSunday->year, $nextSunday->month, $nextSunday->day, $starts, 0, 0);

        return Week::create(compact('week', 'starts'))->id;
    }

    protected function saveGames($games, $weekId) {
        $games = array_filter($games, function ($game) {
            return $game['home_id'] !== $game['away_id'];
        });

        foreach ($games as $game) {
            $id = Game::create([
                'week_id' => $weekId,
                'away_id' => $game['away_id'],
                'home_id' => $game['home_id'],
            ])->id;

            MoneyLine::create([
                'id' => $id,
                'away' => $game['ml_away'],
                'home' => $game['ml_home'],
            ]);

            Spread::create([
                'id' => $id,
                'away' => floatval($game['spread_home']) * -1,
                'home' => $game['spread_home'],
            ]);

            OverUnder::create([
                'id' => $id,
                'line' => $game['total'],
            ]);
        }
    }

    public function achievements() {
        $users = User::select(['username', 'users.id', 'achievements.mourinhista', 'achievements.hat-trick', 'achievements.pana', 'achievements.underdog', 'achievements.elefantes'])->join('achievements', 'users.id', '=', 'achievements.user_id')->get();

        return view('achievements')->with(compact('users'));
    }

    public function achievementsStore() {
        extract(request()->all());

        $user = User::find($userId);

        if ($user->achievements->$achievement) {return response('Already achieved');}

        $user->achievements->update([$achievement => true]);
        $user->stats->increment('units', 5);
        $user->stats->increment('achievements');

        return response('Achievement updated');
    }

    public function autoscores() {
        return view('autoscores');
    }
}
