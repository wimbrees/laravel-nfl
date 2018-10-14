<template>
    <div :class="{ 'fixed-on-scroll': !weekIsPlaying }" class="col-md-4">
        <div class="card" v-if="! weekIsPlaying">
            <div class="card-header d-flex align-items-center">
                <h3 class="grow mb-0">Add Bets</h3>
                <button @click="save" :disabled="! userBets.newBets.length" class="btn btn-success">Save</button>
            </div>
            <ul class="list-group list-group-flush">
                <li :key="index" v-for="(bet, index) in userBets.newBets" class="d-flex list-group-item align-items-center">
                    <p class="mb-0 grow">{{ bet.description }}&nbsp;&nbsp;&nbsp;<span class="text-muted">({{ bet.teams }})</span>
                    </p>
                    <input :class="{'border-danger' : ![1,2,3,4,5].includes(+bet.units)}" class="form-control w-auto ml-2" v-model="bet.units" type="number" min="1" max="5" step="1">
                    <button @click="removeNewBet(index)" type="button" class="close ml-3 text-danger" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </li>
            </ul>
        </div>

        <div class="card mt-3" v-if="!weekIsPlaying">
            <div class="card-header">
                <h3 class="mb-0">My Bets</h3>
            </div>
            <ul class="list-group list-group-flush">
                <li :key="index" v-for="(bet, index) in userBets.betsPlaced" class="d-flex align-items-center list-group-item">
                    <p class="mb-0 grow">{{ bet.description }}&nbsp;&nbsp;&nbsp;<span class="text-muted">({{ bet.teams }})</span>&nbsp;&nbsp;&nbsp;<span class="text-success">({{ bet.units + (bet.units > 1 ? ' units' : ' unit') }})</span>
                    </p>
                    <button @click="removePlacedBet(bet.id)" type="button" class="close ml-3 text-danger" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </li>
            </ul>
        </div>

        <div id="weekly-bets" v-if="weekIsPlaying">
            <h1 class="mb-3">Week {{ week }} Bets</h1>
            <div v-for="(userBets, key) in allBets" :key="key" class="card mt-4 mb-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ key }} ({{ unitsPlaced(key)}} played, {{ benefits(key) }})</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li v-for="(bet, index) in userBets" class="d-flex align-items-center list-group-item">
                        <p :key="index" class="mb-0 grow">{{ bet.description }}&nbsp;&nbsp;&nbsp;<span class="text-muted">({{ bet.teams }})</span>&nbsp;&nbsp;&nbsp;<span class="text-success">({{ bet.units + (bet.units > 1 ? ' units' : ' unit') }})</span>
                        </p>
                        <span v-html="betWon(bet.won)"></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['initialBets', 'allBets', 'weekIsPlaying', 'week', 'initialMyInfo'],

    data() {
        return {
            userBets: {
                betsPlaced: this.initialBets,
                newBets: []
            },
            myInfo: this.initialMyInfo
        };
    },

    methods: {
        add({ odds_id, teams, odds_type, selection, description }) {
            if (
                this.userBets.betsPlaced.find(
                    userBet =>
                        userBet.odds_id == odds_id &&
                        userBet.odds_type.substr(4) == odds_type
                )
            ) {
                return;
            }

            if (
                this.userBets.newBets.find(
                    userBet =>
                        userBet.odds_id == odds_id &&
                        userBet.odds_type == odds_type
                )
            ) {
                return;
            }

            this.userBets.newBets.push({
                odds_id,
                teams,
                odds_type,
                selection,
                description,
                units: 1
            });

            window.events.$emit('addedBetsUpdated', this.userBets.newBets);
        },

        save() {
            axios.post(`/bets`, this.userBets.newBets).then(({ data }) => {
                this.userBets.betsPlaced = data.userBets;
                this.userBets.newBets = [];

                window.events.$emit(
                    'placedBetsUpdated',
                    this.userBets.betsPlaced
                );

                window.events.$emit('addedBetsUpdated', []);
                window.events.$emit('unitsUpdated', data.userUnits);
            });
        },

        removeNewBet(id) {
            this.userBets.newBets.splice(id, 1);

            window.events.$emit('addedBetsUpdated', this.userBets.newBets);
        },

        removePlacedBet(id) {
            axios.delete(`/bets/${id}`).then(({ data }) => {
                _.remove(this.userBets.betsPlaced, { id });
                this.$forceUpdate();

                window.events.$emit(
                    'placedBetsUpdated',
                    this.userBets.betsPlaced
                );
                window.events.$emit('unitsUpdated', data.userUnits);
            });
        },

        betWon(won) {
            if (won == 1) {
                return '<span class="text-success">&#10004;</span>';
            }

            if (won == 0) {
                return '<span class="text-danger">&times</span>';
            }

            return '';
        },

        unitsPlaced(user) {
            return this.allBets[user]
                .map(bet => bet.units)
                .reduce((p, c) => p + c, 0);
        },

        benefits(user) {
            let total = 0;

            this.allBets[user].forEach(bet => {
                if (bet.won == 1) {
                    total += Number(bet.to_win) - Number(bet.units);
                } else {
                    total -= Number(bet.units);
                }
            });

            return total >= 0 ? `+${total}` : `${total}`;
        }
    },

    created() {
        window.events.$emit('placedBetsUpdated', this.userBets.betsPlaced);
        window.events.$on('addBet', this.add);
    }
};
</script>
