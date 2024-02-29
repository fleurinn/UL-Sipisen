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
        StudentAttendance::factory()->create([
            'data_students_id' => 1,
            'description' => 'HADIR',
        ]);
    }
}
