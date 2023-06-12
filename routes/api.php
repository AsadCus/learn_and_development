<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SupervisorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/get', [UserController::class, 'getAllUserApi']);
    Route::get('/get-hierarchy', [UserController::class, 'getHierarchyApi']);
});

Route::group(['prefix' => 'student'], function () {
    Route::get('/', [StudentController::class, 'getAllStudentApi']);
    Route::post('/store', [StudentController::class, 'postStoreStudentApi']);
    Route::put('/update/{id}', [StudentController::class, 'putUpdateStudentApi']);
    Route::put('/deactive/{id}', [StudentController::class, 'putStatusStudentApi']);
});

Route::group(['prefix' => 'supervisor'], function () {
    Route::get('/', [SupervisorController::class, 'getAllSupervisorApi']);
    Route::post('/store', [SupervisorController::class, 'postStoreSupervisorApi']);
    Route::put('/update/{id}', [SupervisorController::class, 'putUpdateSupervisorApi']);
    Route::put('/deactive/{id}', [SupervisorController::class, 'putStatusSupervisorApi']);
});

Route::group(['prefix' => 'score'], function () {
    Route::get('/', [ScoreController::class, 'getAllScoreApi']);
    Route::post('/store', [ScoreController::class, 'postStoreScoreApi']);
    Route::put('/update/{id}', [ScoreController::class, 'putUpdateScoreApi']);
});

Route::group(['prefix' => 'attendance'], function () {
    Route::get('/', [AttendanceController::class, 'getAllAttendanceApi']);
    Route::post('/store', [AttendanceController::class, 'postStoreAttendanceApi']);
    Route::put('/update/{id}', [AttendanceController::class, 'putUpdateAttendanceApi']);
    Route::put('/deactive/{id}', [AttendanceController::class, 'putStatusAttendanceApi']);
});
