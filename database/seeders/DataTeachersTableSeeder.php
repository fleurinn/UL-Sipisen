<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DataTeacher;

class DataTeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataTeacher::create([
            'name' => 'Lismah',
            'nip' => '0909090',
            'gender' => 'p',
            'subject' => 'Bahasa Indonesia',
        ]);
    }
}