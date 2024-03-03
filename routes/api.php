<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//route login
Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'index']);

//group route with middleware "auth"
Route::group(['middleware' => 'auth:api'], function() {

    //logout
    Route::post('/logout',
    [App\Http\Controllers\Api\Auth\LoginController::class, 'logout']);

});


//group route with prefix "admin"
Route::prefix('admin')->group(function () {
    //group route with middleware "auth:api"
    Route::group(['middleware' => 'auth:api'], function () {
        //dashboard
        Route::get('/dashboard',
        App\Http\Controllers\Api\Admin\DashboardController::class);

        //permissions
        Route::get('/permissions', [\App\Http\Controllers\Api\Admin\PermissionController::class, 'index'])
        ->middleware('permission:permissions.index');

        //permissions all
        Route::get('/permissions/all', [\App\Http\Controllers\Api\Admin\PermissionController::class, 'all'])
        ->middleware('permission:permissions.index');

        //roles all
        Route::get('/roles/all', [\App\Http\Controllers\Api\Admin\RoleController::class, 'all'])
        ->middleware('permission:roles.index');

        //roles
        Route::apiResource('/roles', App\Http\Controllers\Api\Admin\RoleController::class)
        ->middleware('permission:roles.index|roles.store|roles.update|roles.delete');

        //users
        Route::apiResource('/users', App\Http\Controllers\Api\Admin\UserController::class)
        ->middleware('permission:users.index|users.store|users.update|users.delete');

        //data guru
        Route::apiResource('/datateachers', App\Http\Controllers\Api\Admin\DataTeacherController::class)
        ->middleware('permission:datateachers.index|datateachers.store|datateachers.update|datateachers.delete');

        //data siswa
        Route::apiResource('/datastudents', App\Http\Controllers\Api\Admin\DataStudentController::class)
        ->middleware('permission:datastudents.index|datastudents.store|datastudents.update|datastudents.delete');

        //jurusan
        Route::apiResource('/majors', App\Http\Controllers\Api\Admin\MajorController::class)
        ->middleware('permission:majors.index|majors.store|majors.update|majors.delete');

        //kelas
        Route::apiResource('/classstudents', App\Http\Controllers\Api\Admin\ClassStudentController::class)
        ->middleware('permission:classstudents.index|classstudents.store|classstudents.update|classstudents.delete');

        //absensi
        Route::apiResource('/studentattendances', App\Http\Controllers\Api\Admin\StudentAttendanceController::class)
        ->middleware('permission:studentattendances.index|studentattendances.store|studentattendances.update|studentattendances.delete');

        //subjects
        Route::apiResource('/subjects', App\Http\Controllers\Api\Admin\SubjectController::class)
        ->middleware('permission:subjects.index|subjects.store|subjects.update|subjects.delete');

        //schedule mondays
        Route::apiResource('/schedulemondays', App\Http\Controllers\Api\Admin\ScheduleMondayController::class)
        ->middleware('permission:schedulemondays.index|schedulemondays.store|schedulemondays.update|schedulemondays.delete');

        //schedule tuesdays
        Route::apiResource('/scheduletuesdays', App\Http\Controllers\Api\Admin\ScheduleTuesdayController::class)
        ->middleware('permission:scheduletuesdays.index|scheduletuesdays.store|scheduletuesdays.update|scheduletuesdays.delete');

        //schedule wednesdays
        Route::apiResource('/schedulewednesdays', App\Http\Controllers\Api\Admin\ScheduleWednesdayController::class)
        ->middleware('permission:schedulewednesdays.index|schedulewednesdays.store|schedulewednesdays.update|schedulewednesdays.delete');

        //schedule thursdays
        Route::apiResource('/schedulethursdays', App\Http\Controllers\Api\Admin\ScheduleThursdayController::class)
        ->middleware('permission:schedulethursdays.index|schedulethursdays.store|schedulethursdays.update|schedulethursdays.delete');

        //schedule fridays
        Route::apiResource('/schedulefridays', App\Http\Controllers\Api\Admin\ScheduleFridayController::class)
        ->middleware('permission:schedulefridays.index|schedulefridays.store|schedulefridays.update|schedulefridays.delete');

        //schedule 
        Route::apiResource('/schedules', App\Http\Controllers\Api\Admin\ScheduleController::class)
        ->middleware('permission:schedules.index|schedules.store|schedules.update|schedules.delete');

        //izin 
        Route::apiResource('/izins', App\Http\Controllers\Api\Admin\IzinController::class)
        ->middleware('permission:izins.index|izins.store|izins.update|izins.delete');
   
        //teacherattendance 
        Route::apiResource('/teacherattendances', App\Http\Controllers\Api\Admin\TeacherAttendanceController::class)
        ->middleware('permission:teacherattendances.index|teacherattendances.store|teacherattendances.update|teacherattendances.delete');
   
         //jadwalpikets 
         Route::apiResource('/jadwalpikets', App\Http\Controllers\Api\Admin\JadwalPiketController::class)
        ->middleware('permission:jadwalpikets.index|jadwalpikets.store|jadwalpikets.update|jadwalpikets.delete');
    
    });
});