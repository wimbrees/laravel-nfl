<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \App\User::create([
            'username' => 'favre',
            'password' => bcrypt('123456'),
        ]);

        \App\User::create([
            'username' => 'test',
            'password' => bcrypt('123456'),
        ]);
    }
}
