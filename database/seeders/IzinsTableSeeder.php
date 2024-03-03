<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Izin;

class IzinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Izin::create([
            'data_students_id' => '1',
            'classstudents_id' => '1',
            'tanggal' => '02 maret 2024',
            'subjects_id' => '1',
            'description' => 'Beli motor'
        ]);
    }
}
