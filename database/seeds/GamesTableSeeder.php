<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $data = [
            [
                'week_id' => 1,
                'away_id' => 1,
                'home_id' => 2,
            ],
            [
                'week_id' => 1,
                'away_id' => 3,
                'home_id' => 4,
            ],
            [
                'week_id' => 1,
                'away_id' => 5,
                'home_id' => 6,
            ],
        ];

        DB::table('games')->insert($data);
    }
}
