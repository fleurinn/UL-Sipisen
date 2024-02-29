<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major; // Tambahkan ini untuk memuat model Major

class MajorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Major::create([
            'name' => 'Teknik Otomotif',
        ]);
    }
}

