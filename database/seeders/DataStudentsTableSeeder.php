<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataStudent;

class DataStudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DataStudent::create([
            'name' => 'Lismah',
            'nisn' => '1234555',
            'no_hp' => '0896115583',
            'alamat' => 'JLN. Raya Jembatan Cinangneng',
        ]);
    }
}
