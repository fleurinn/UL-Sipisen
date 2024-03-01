<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentAttendance;

class StudentAttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        StudentAttendance::create([
            'data_students_id' => 1,
            'majors_id' => 1,
            'classstudents_id' => 1,
            'description' => 'HADIR',
        ]);
    }
}
