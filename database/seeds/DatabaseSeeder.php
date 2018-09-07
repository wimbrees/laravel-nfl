<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(ResetSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(WeeksTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(GamesTableSeeder::class);
        $this->call(OddsTableSeeder::class);
    }
}
