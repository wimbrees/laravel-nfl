<template>
</template>

<script>
export default {
    props: ['initialGames', 'weekIsPlaying'],

    data() {
        return {
            games: this.initialGames,
            placedBets: [],
            addedBets: []
        };
    },

    methods: {
        addBet(odds_id, teams, odds_type, selection, description) {
            let betData = {
                odds_id,
                teams,
                odds_type,
                selection,
                description
            };

            window.events.$emit('addBet', betData);
        },

        hasPlacedBet(gameId, betType, selection) {
            return !!this.placedBets.find(
                bet =>
                    bet.odds_id == gameId &&
                    bet.odds_type.substr(4) == betType &&
                    bet.selection == selection
            );
        },

        hasAddedBet(gameId, betType, selection) {
            return !!this.addedBets.find(
                bet =>
                    bet.odds_id == gameId &&
                    bet.odds_type == betType &&
                    bet.selection == selection
            );
        }
    },

    created() {
        window.events.$on('placedBetsUpdated', bets => {
            this.placedBets = bets;
            this.$forceUpdate();
        });

        window.events.$on('addedBetsUpdated', bets => {
            this.addedBets = bets;
            this.$forceUpdate();
        });
    }
};
</script>
