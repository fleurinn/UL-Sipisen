<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(DataTeachersTableSeeder::class);
        $this->call(MajorsTableSeeder::class);
        $this->call(ClassStudentsTableSeeder::class);
        $this->call(DataStudentsTableSeeder::class);
        $this->call(StudentAttendancesTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(IzinsTableSeeder::class);
        $this->call(JadwalPiketsTableSeeder::class);
        $this->call(TeacherAttendancesTableSeeder::class);
    }
}
