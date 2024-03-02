<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ScheduleTuesday;

class ScheduleTuesdaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ScheduleTuesday::create([
            'subjects_id' => '1',
            'data_teachers_id' => '1',
            'start_time' => '07.30',
            'end_time' => '09.30'
        ]);
    }
}
