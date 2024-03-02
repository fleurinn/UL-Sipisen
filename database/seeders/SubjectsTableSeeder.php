<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject; 

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Subject::create([
            'name' => 'Matematika'
        ]);
    }
}

