<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::create([
            'majors_id' => '1',
            'classstudents_id' => '1',
            'schedule_mondays_id' => '1',
            'schedule_tuesdays_id' => '1',
            'schedule_wednesdays_id' => '1',
            'schedule_thursdays_id' => '1',
            'schedule_fridays_id' => '1',
        ]);
    }
}
