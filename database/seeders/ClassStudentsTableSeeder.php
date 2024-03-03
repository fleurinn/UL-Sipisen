<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassStudent;

class ClassStudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ClassStudent::create([
            'majors_id' => 1,
            'name' => 'XI PPLG 1',
        ]);
    }
}

