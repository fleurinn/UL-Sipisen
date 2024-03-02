<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ScheduleMonday; // Pastikan untuk mengimpor model ScheduleMonday

class ScheduleMondaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat data untuk ScheduleMonday
        ScheduleMonday::create([
            'subjects_id' => '1',
            'data_teachers_id' => '1',
            'start_time' => '07.30',
            'end_time' => '09.30'
        ]);

    }
}
