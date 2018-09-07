<?php

use Illuminate\Database\Seeder;

class OddsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('money_line')->insert([
            [
                'id' => 1,
                'home' => 12,
                'away' => 1.25,
            ],
            [
                'id' => 2,
                'home' => 5,
                'away' => 1.80,
            ],
            [
                'id' => 3,
                'home' => 1.90,
                'away' => 1.90,
            ],
        ]);

        DB::table('spread')->insert([
            [
                'id' => 1,
                'home' => 6.5,
                'away' => -6.5,
            ],
            [
                'id' => 2,
                'home' => -2.5,
                'away' => 2.5,
            ],
            [
                'id' => 3,
                'home' => -10,
                'away' => 10,
            ],
        ]);

        DB::table('over_under')->insert([
            [
                'id' => 1,
                'line' => 45.5,
            ],
            [
                'id' => 2,
                'line' => 28.5,
            ],
            [
                'id' => 3,
                'line' => 62.5,
            ],
        ]);
    }
}
