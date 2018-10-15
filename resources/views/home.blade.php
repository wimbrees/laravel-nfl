@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="main-page">
        <games inline-template :initial-games="{{ $games }}" :week-is-playing="{{ json_encode($weekIsPlaying) }}" v-cloak>
            <div class="col-md-8">
                <div v-for="(game, index) in games" class="card game" :class="{ 'mt-2': index !== 0 }">
                    <div class="card-header align-items-center text-center d-flex justify-content-center bg-white">
                        <div class="text-center">
                            <img :src="`/images/${game.away.name.toLowerCase()}.gif`">
                        </div>
                        <h1 class="ml-4 mr-4 teams-playing">@{{ _.capitalize(game.away.name) }} @ @{{ _.capitalize(game.home.name) }}</h1>
                        <div class="text-center">
                            <img :src="`/images/${game.home.name.toLowerCase()}.gif`">
                        </div>
                    </div>

                    <div class="card-body d-flex odds">
                        <div class="d-flex flex-column align-items-center odds-type money-line">
                            <button type="button"
                                class="btn btn-outline-success"
                                @click="addBet(game.id, game.teams, `MoneyLine`, 'away', `${game.away.short} @ ${game.money_line.away}`)"
                                :class="{ active: hasPlacedBet(game.id, 'MoneyLine', 'away'), added: hasAddedBet(game.id, 'MoneyLine', 'away'), 'c-default': weekIsPlaying }">
                                @{{ game.away.short }} @ @{{ game.money_line.away  }}
                            </button>
                            <button type="button"
                                class="btn btn-outline-success"
                                @click="addBet(game.id, game.teams, `MoneyLine`, 'home', `${game.home.short} @ ${game.money_line.home}`)"
                                :class="{ active: hasPlacedBet(game.id, 'MoneyLine', 'home'), added: hasAddedBet(game.id, 'MoneyLine', 'home'), 'c-default': weekIsPlaying }">
                                @{{ game.home.short }} @ @{{ game.money_line.home  }}
                            </button>
                        </div>

                        <div class="d-flex flex-column align-items-center odds-type spread">
                            <button type="button"
                                class="btn btn-outline-success"
                                @click="addBet(game.id, game.teams, `Spread`, 'away', `${game.away.short} @ ${game.spread.away}`)"
                                :class="{ active: hasPlacedBet(game.id, 'Spread', 'away'), added: hasAddedBet(game.id, 'Spread', 'away'), 'c-default': weekIsPlaying }">
                                @{{ game.away.short }} @{{ game.spread.away }} @ 1.90
                            </button>
                            <button type="button"
                                class="btn btn-outline-success"
                                @click="addBet(game.id, game.teams, `Spread`, 'home', `${game.home.short} @ ${game.spread.home}`)"
                                :class="{ active: hasPlacedBet(game.id, 'Spread', 'home'), added: hasAddedBet(game.id, 'Spread', 'home'), 'c-default': weekIsPlaying }">
                                @{{ game.home.short }} @{{ game.spread.home }} @ 1.90
                            </button>
                        </div>

                        <div class="d-flex flex-column align-items-center odds-type over-under">
                            <button type="button"
                                class="btn btn-outline-success"
                                @click="addBet(game.id, game.teams, `OverUnder`, 'over', `O ${game.over_under.line} @ 1.90`)"
                                :class="{ active: hasPlacedBet(game.id, 'OverUnder', 'over'), added: hasAddedBet(game.id, 'OverUnder', 'over'), 'c-default': weekIsPlaying }">
                                O @{{ game.over_under.line }} @ 1.90
                            </button>
                            <button type="button"
                                class="btn btn-outline-success"
                                @click="addBet(game.id, game.teams, `OverUnder`, 'under', `U ${game.over_under.line} @ 1.90`)"
                                :class="{ active: hasPlacedBet(game.id, 'OverUnder', 'under'), added: hasAddedBet(game.id, 'OverUnder', 'under'), 'c-default': weekIsPlaying }">
                                U @{{ game.over_under.line }} @ 1.90
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </games>

        <user-bets :week="{{ $week }}" :initial-bets="{{ $bets }}" :all-bets="{{ $allBets }}" :week-is-playing="{{ json_encode($weekIsPlaying) }}" :initial-my-info="{{ $myInfo }}"></user-bets>
    </div>
</div>
@endsection
