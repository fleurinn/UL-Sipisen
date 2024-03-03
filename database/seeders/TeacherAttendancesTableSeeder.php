<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeacherAttendance;

class TeacherAttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        TeacherAttendance::create([
            'data_teachers_id' => 1,
            'tanggal' => '20 maret 2024',
            'description' => 'IZIN',
        ]);
    }
}
