<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\instituteController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('main')->middleware('auth');

Route::get('/home', function () {
    return view('master.dashboard');
})->name('home')->middleware('auth', 'Admin');

Route::get('/export-absen', [AttendanceController::class, 'exportAbsen'])->name('export.absen');

// profile
Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    // student
    Route::get('/student', [StudentController::class, 'profile'])->name('student')->middleware('auth', 'Student');
    Route::get('/student/edit/{id}', [StudentController::class, 'profileEdit'])->name('student.edit')->middleware('auth', 'Student');
    Route::put('/student/update/{id}', [StudentController::class, 'profileUpdate'])->name('student.update')->middleware('auth', 'Student');
    Route::post('/student/clockin', [StudentController::class, 'clockin'])->name('student.put.clockin')->middleware('auth', 'Student');
    Route::put('/student/clockout/{id}', [StudentController::class, 'clockout'])->name('student.put.clockout')->middleware('auth', 'Student');
    Route::post('/student/cv/{id}', [StudentController::class, 'updateCV'])->name('student.put.cv')->middleware('auth', 'Student');
    Route::put('/student/cv/{id}/del', [StudentController::class, 'deleteCV'])->name('student.del.cv')->middleware('auth', 'Student');

    // supervisor
    Route::get('/supervisor', [SupervisorController::class, 'profile'])->name('supervisor')->middleware('auth', 'Supervisor');
    Route::put('/supervisor/attendance/approve/{id}', [AttendanceController::class, 'approveattendance'])->name('supervisor.approve.attendance.student')->middleware('auth', 'Supervisor');
    Route::put('/supervisor/attendance/reject/{id}', [AttendanceController::class, 'rejectattendance'])->name('supervisor.reject.attendance.student')->middleware('auth', 'Supervisor');
});

// Attendance
Route::group(['prefix' => 'attendance', 'as' => 'attendance.'], function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('get.index')->middleware('auth', 'Admin');
    Route::get('/create', [AttendanceController::class, 'create'])->name('create')->middleware('auth', 'Admin');
    Route::post('/store', [AttendanceController::class, 'clockIn'])->name('post.store')->middleware('auth', 'Student');
    Route::get('/edit/{id}', [AttendanceController::class, 'edit'])->name('edit')->middleware('auth', 'Admin');
    Route::put('/update/{id}', [AttendanceController::class, 'update'])->name('put.update')->middleware('auth', 'Admin');
    Route::put('/deactive/{id}', [AttendanceController::class, 'status'])->name('put.status')->middleware('auth', 'Admin');
});

// Student
Route::group(['prefix' => 'student', 'as' => 'student.'], function () {
    Route::get('/', [StudentController::class, 'index'])->name('get.index')->middleware('auth', 'Admin');
    Route::get('/create', [StudentController::class, 'create'])->name('create')->middleware('auth', 'Admin');
    Route::get('/{id}', [StudentController::class, 'detail'])->name('get.detail')->middleware('auth', 'Supervisor');
    Route::get('/{id}/scoring', [ScoreController::class, 'create'])->name('get.create.score')->middleware('auth', 'Supervisor');
    Route::post('/store', [StudentController::class, 'store'])->name('post.store')->middleware('auth');
    Route::post('/store/doc', [StudentController::class, 'storeDoc'])->name('post.doc')->middleware('auth');
    Route::delete('/delete/doc/{id}', [StudentController::class, 'destroyDoc'])->name('destroy.doc')->middleware('auth', 'Student');
    Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit')->middleware('auth', 'Admin');
    Route::put('/update/{id}', [StudentController::class, 'update'])->name('put.update')->middleware('auth', 'Admin');
    Route::put('/deactive/{id}', [StudentController::class, 'status'])->name('put.status')->middleware('auth', 'Admin');
});

// Supervisor
Route::group(['prefix' => 'supervisor', 'as' => 'supervisor.'], function () {
    Route::get('/', [SupervisorController::class, 'index'])->name('get.index')->middleware('auth', 'Admin');
    Route::get('/create', [SupervisorController::class, 'create'])->name('create')->middleware('auth', 'Admin');
    Route::get('/{id}', [SupervisorController::class, 'detail'])->name('get.detail')->middleware('auth', 'Admin');
    Route::post('/store', [SupervisorController::class, 'store'])->name('post.store')->middleware('auth', 'Admin');
    Route::get('/edit/{id}', [SupervisorController::class, 'edit'])->name('edit')->middleware('auth', 'Admin');
    Route::put('/update/{id}', [SupervisorController::class, 'update'])->name('put.update')->middleware('auth', 'Admin');
    Route::put('/deactive/{id}', [SupervisorController::class, 'status'])->name('put.status')->middleware('auth', 'Admin');
});

// Score
Route::group(['prefix' => 'score', 'as' => 'score.'], function () {
    Route::get('/', [ScoreController::class, 'index'])->name('get.index')->middleware('auth', 'Supervisor');
    Route::get('/create', [ScoreController::class, 'create'])->name('create')->middleware('auth', 'Supervisor');
    Route::post('/store', [ScoreController::class, 'store'])->name('post.store')->middleware('auth', 'Supervisor');
    Route::get('/edit/{id}', [ScoreController::class, 'edit'])->name('edit')->middleware('auth', 'Admin');
    Route::put('/update/{id}', [ScoreController::class, 'update'])->name('put.update')->middleware('auth', 'Admin');
    Route::put('/deactive/{id}', [ScoreController::class, 'status'])->name('put.status')->middleware('auth', 'Admin');
});

// institute
Route::group(['prefix' => 'institute', 'as' => 'institute.', 'middleware' => ['auth', 'Admin']], function(){
    Route::get('/', [InstituteController::class, 'index'])->name('get.index');
    Route::get('/create', [InstituteController::class, 'create'])->name('create');
    Route::post('/store', [InstituteController::class, 'store'])->name('post.store');
    Route::get('/{id}', [InstituteController::class, 'detail'])->name('get.detail');
    Route::get('/edit/{id}', [InstituteController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [InstituteController::class, 'update'])->name('put.update');
});

Route::get('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
Route::post('/change-password', [HomeController::class, 'updatePassword'])->name('update-password');
Route::get('/edit', [HomeController::class, 'editProfile'])->name('admin.get.edit')->middleware('auth', 'Admin');
Route::put('/edit/{id}', [HomeController::class, 'updateProfile'])->name('admin.put.edit')->middleware('auth', 'Admin');
Route::put('/edit/{id}', [HomeController::class, 'updateProfile'])->name('admin.put.edit')->middleware('auth', 'Admin');
Route::put('/image/{id}', [HomeController::class, 'image'])->name('profile.delete.image')->middleware('auth');