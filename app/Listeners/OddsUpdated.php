<?php

namespace App\Listeners;

use App\Events\OddsUpdated as OddsUpdatedEvent;
use App\Game;

class OddsUpdated {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OddsUpdatedEvent $event) {
        $odds = $event->odds;
        $oddsClass = get_class($odds);

        // If 'won' field has not been changed
        if ($odds->won === $odds->getOriginal('won')) {
            return;
        }

        $game = Game::find($odds->id);

        $game->bets->where('odds_type', $oddsClass)->each(function ($bet) use ($oddsClass, $game) {
            preg_match('/App\\\(.+)/', $oddsClass, $matches);
            $oddsProperty = $matches[1];

            $selectionWon = $game->{$oddsProperty}->won === $bet->selection;

            if ($selectionWon) {
                $bet->user->stats->increment('bets_won');
                $bet->user->stats->increment('units', $bet->to_win);
                $bet->user->stats->increment(snake_case($oddsProperty) . '_won');
            } else {
                $bet->user->stats->increment('bets_lost');
                $bet->user->stats->increment(snake_case($oddsProperty) . '_lost');
            }
        });
    }
}
