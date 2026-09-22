<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/classes', [SchoolClassController::class, 'index'])->name('classes.index');
Route::get('/classes/create', [SchoolClassController::class, 'create']);
Route::get('/classes/{class}', [SchoolClassController::class, 'show']);
Route::post('/classes', [SchoolClassController::class, 'store']);
Route::get('/classes/{class}/students', [SchoolClassController::class, 'students']);

Route::get('/classes/{class}/edit', [SchoolClassController::class, 'edit'])
    ->name('classes.edit');
Route::put('/classes/{class}', [SchoolClassController::class, 'update'])
    ->name('classes.update');
Route::delete('/classes/{class}', [SchoolClassController::class, 'destroy'])->name('classes.destroy');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create']);
Route::get('/students/{student}', [StudentController::class, 'show']);
Route::post('/students', [StudentController::class, 'store'])
    ->name('students.store');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentController::class, 'update'])
    ->name('students.update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');



Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');

