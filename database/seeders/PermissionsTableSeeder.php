<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //permission for roles
        Permission::create(['name' => 'roles.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'roles.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'roles.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'roles.delete', 'guard_name' => 'api']);

        //permission for permissions
        
        Permission::create(['name' => 'permissions.index', 'guard_name' => 'api']);

        //permission for users
        Permission::create(['name' => 'users.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'users.delete', 'guard_name' => 'api']);

        //permission for data teacher
        Permission::create(['name' => 'datateachers.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'datateachers.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'datateachers.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'datateachers.delete', 'guard_name' => 'api']);

        //permission for data student
        Permission::create(['name' => 'datastudents.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'datastudents.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'datastudents.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'datastudents.delete', 'guard_name' => 'api']);

        //permission for majors
        Permission::create(['name' => 'majors.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'majors.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'majors.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'majors.delete', 'guard_name' => 'api']);

        //permission for classstudents
        Permission::create(['name' => 'classstudents.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'classstudents.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'classstudents.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'classstudents.delete', 'guard_name' => 'api']);

        //permission for studentattendances
        Permission::create(['name' => 'studentattendances.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'studentattendances.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'studentattendances.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'studentattendances.delete', 'guard_name' => 'api']);
        
        //permission for subjects
        Permission::create(['name' => 'subjects.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'subjects.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'subjects.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'subjects.delete', 'guard_name' => 'api']);
 
        //permission for schedulemondays
        Permission::create(['name' => 'schedulemondays.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedulemondays.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedulemondays.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedulemondays.delete', 'guard_name' => 'api']);

        //permission for scheduletuesdays
        Permission::create(['name' => 'scheduletuesdays.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'scheduletuesdays.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'scheduletuesdays.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'scheduletuesdays.delete', 'guard_name' => 'api']);

        //permission for schedulewednesdays
        Permission::create(['name' => 'schedulewednesdays.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedulewednesdays.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedulewednesdays.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedulewednesdays.delete', 'guard_name' => 'api']);

        //permission for schedulethursdays
        Permission::create(['name' => 'schedulethursdays.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedulethursdays.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedulethursdays.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedulethursdays.delete', 'guard_name' => 'api']);

        //permission for schedulefridays
        Permission::create(['name' => 'schedulefridays.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedulefridays.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedulefridays.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedulefridays.delete', 'guard_name' => 'api']);

        //permission for schedules
        Permission::create(['name' => 'schedules.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedules.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedules.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'schedules.delete', 'guard_name' => 'api']);

        //permission for izins
        Permission::create(['name' => 'izins.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'izins.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'izins.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'izins.delete', 'guard_name' => 'api']);
        
        //permission for teacherattendances
        Permission::create(['name' => 'teacherattendances.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'teacherattendances.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'teacherattendances.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'teacherattendances.delete', 'guard_name' => 'api']);
        
        //permission for jadwalpikets
        Permission::create(['name' => 'jadwalpikets.index', 'guard_name' => 'api']);
        Permission::create(['name' => 'jadwalpikets.create', 'guard_name' => 'api']);
        Permission::create(['name' => 'jadwalpikets.edit', 'guard_name' => 'api']);
        Permission::create(['name' => 'jadwalpikets.delete', 'guard_name' => 'api']);
        
    }
}
