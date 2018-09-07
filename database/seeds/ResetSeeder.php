<?php

use Illuminate\Database\Seeder;

class ResetSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('weeks')->truncate();
        DB::table('teams')->truncate();
        DB::table('games')->truncate();
        DB::table('users')->truncate();
        DB::table('money_line')->truncate();
        DB::table('spread')->truncate();
        DB::table('over_under')->truncate();
        DB::table('bets')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
