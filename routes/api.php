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

        //data student all
        Route::get('/datastudents/all', [\App\Http\Controllers\Api\Admin\DataStudentController::class, 'all'])
        ->middleware('permission:datastudents.index');

        //jurusan
        Route::apiResource('/majors', App\Http\Controllers\Api\Admin\MajorController::class)
        ->middleware('permission:majors.index|majors.store|majors.update|majors.delete');

        //kelas
        Route::apiResource('/classstudents', App\Http\Controllers\Api\Admin\StudentAttendanceController::class)
        ->middleware('permission:classstudents.index|classstudents.store|classstudents.update|classstudents.delete');

        //absensi
        Route::apiResource('/studentattendances', App\Http\Controllers\Api\Admin\StudentAttendanceController::class)
        ->middleware('permission:studentattendances.index|studentattendances.store|studentattendances.update|studentattendances.delete');

    });
});