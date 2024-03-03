<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalPiket;

class JadwalPiketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JadwalPiket::create([
            'hari' => 'Senin',
            'nip' => '098999777',
            'name' => 'Delika Pratiwi S.Kom'
        ]);
    }
}
