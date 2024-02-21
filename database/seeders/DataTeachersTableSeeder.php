<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\DataTeacher;

class DataTeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Datateacher::create([
            'name' => 'Lismah',
            'nip' => '0909090',
            'gender' => 'p',
            'subject' => 'Bahasa Indonesia',
        ]);
    }
}