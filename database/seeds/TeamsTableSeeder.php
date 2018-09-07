<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $teams = ['49ers', 'bears', 'bengals', 'bills', 'broncos', 'browns', 'buccaneers', 'cardinals', 'chargers', 'chiefs', 'colts', 'cowboys', 'dolphins', 'eagles', 'falcons', 'giants', 'jaguars', 'jets', 'lions', 'packers', 'panthers', 'patriots', 'raiders', 'rams', 'ravens', 'redskins', 'saints', 'seahawks', 'steelers', 'texans', 'titans', 'vikings'];
        $shorts = ['SF', 'CHI', 'CIN', 'BUF', 'DEN', 'CLE', 'TB', 'ARI', 'LAC', 'KC', 'IND', 'DAL', 'MIA', 'PHI', 'ATL', 'NYG', 'JAX', 'NYJ', 'DET', 'GB', 'CAR', 'NE', 'OAK', 'LA', 'BAL', 'WAS', 'NO', 'SEA', 'PIT', 'HOU', 'TEN', 'MIN'];

        foreach ($teams as $k => $team) {
            $newTeam = [];
            $newTeam['name'] = $team;
            $newTeam['short'] = $shorts[$k];
            $data[] = $newTeam;
        }

        DB::table('teams')->insert($data);
    }
}
