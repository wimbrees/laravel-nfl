<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Game;
use App\MoneyLine;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Validator;

class BetsController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function store() {
        // TODO (validate current week, odds_type + selection, check if bet already exists)
        $this->validateBets();

        if (Gate::allows('create-bets')) {
            $this->saveBets();
        } else {
            return response('Not enough units available', 403);
        }

        return [
            'userBets' => User::getCurrentWeekBets(),
            'userUnits' => auth()->user()->fresh()->units,
        ];
    }

    public function destroy(Bet $bet) {
        $this->authorize('destroy', $bet);

        $bet->delete();

        auth()->user()->stats()->increment('units', $bet->units);

        return response(
            ['userUnits' => auth()->user()->fresh()->units],
            200
        );
    }

    public function validateBets() {
        $bets = ['data' => request()->all()];

        $gameIds = optional(Game::currentWeek()->get())->pluck('id')->all();

        // TODO
        Validator::make($bets, [
            'data.*.selection' => ['required', Rule::in(['over', 'under', 'home', 'away'])],
            'data.*.odds_type' => ['required', Rule::in(['MoneyLine', 'Spread', 'OverUnder'])],
            'data.*.odds_id' => ['required', 'integer', Rule::in($gameIds)],
            'data.*.units' => 'required|in:1,2,3,4,5',
        ])->validate();
    }

    public function saveBets() {
        foreach (request()->all() as $bet) {
            extract($bet);

            switch ($odds_type) {
            case 'MoneyLine':
                $toWin = $units * MoneyLine::find($odds_id)->{$selection};
                break;
            default:
                $toWin = $units * 1.90;
            }

            $data = compact('odds_id', 'odds_type', 'selection', 'units') +
                [
                'user_id' => auth()->id(),
                'description' => $bet['odds_type'],
                'to_win' => $toWin,
            ];

            if (Bet::where('odds_id', $bet['odds_id'])
                ->where('odds_type', 'LIKE', "%{$bet['odds_type']}")
                ->where('user_id', auth()->id())
                ->exists()) {
                continue;
            }

            Bet::create($data);
            auth()->user()->stats()->decrement('units', intval($bet['units']));
        }
    }
}
