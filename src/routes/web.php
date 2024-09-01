<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('auth', 'verified')->group(function () {
    Route::get('/', [AttendanceController::class, 'index']);
    Route::post('/work/start', [AttendanceController::class, 'startWork']);
    Route::post('/work/end', [AttendanceController::class, 'endWork']);
    Route::post('/rest/start', [AttendanceController::class, 'startRest']);
    Route::post('/rest/end', [AttendanceController::class, 'endRest']);
    Route::get('/attendance', [AttendanceController::class, 'getAttendance']);
    Route::post('/attendance', [AttendanceController::class, 'postAttendance']);
    Route::get('/user', [AttendanceController::class, 'user']);
    Route::get('/users/data/{id}', [AttendanceController::class, 'userData']);
    Route::post('/users/data/{id}', [AttendanceController::class, 'userDataPer']);
});
