<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WeeksTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $weeks = range(1, 16);

        foreach ($weeks as $k => $week) {
            $newWeek = [];
            $newWeek['week'] = $k + 1;
            $newWeek['starts'] = Carbon::now()->addYear();
            $data[] = $newWeek;
        }

        DB::table('weeks')->insert($data);
    }
}
