<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
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
Route::post('/teachers', [TeacherController::class, 'store'])
    ->name('teachers.store');
Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])
    ->name('teachers.edit');
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])
    ->name('teachers.update');
Route::get('/teachers/{teacher}',[TeacherController::class,'show'])->name('teachers.show');
Route::delete('/teachers/{teacher}',[TeacherController::class,'destroy'])->name('teachers.destroy');



Route::get('/subjects', [SubjectController::class, 'index'])
    ->name('subjects.index');

Route::get('/subjects/create', [SubjectController::class, 'create'])
    ->name('subjects.create');

Route::post('/subjects', [SubjectController::class, 'store'])
    ->name('subjects.store');

Route::get('/subjects/{subject}', [SubjectController::class, 'show'])
    ->name('subjects.show');

Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])
    ->name('subjects.edit');

Route::put('/subjects/{subject}', [SubjectController::class, 'update'])
    ->name('subjects.update');

Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])
    ->name('subjects.destroy');




    use App\Http\Controllers\ClassSubjectTeacherController;

Route::get('/assignments', [ClassSubjectTeacherController::class, 'index'])
    ->name('assignments.index');

Route::get('/assignments/create', [ClassSubjectTeacherController::class, 'create'])
    ->name('assignments.create');

Route::post('/assignments', [ClassSubjectTeacherController::class, 'store'])
    ->name('assignments.store');
    
    Route::get('/assignments/{assignment}/edit', [ClassSubjectTeacherController::class, 'edit'])
    ->name('assignments.edit');

Route::put('/assignments/{assignment}', [ClassSubjectTeacherController::class, 'update'])
    ->name('assignments.update');

Route::delete('/assignments/{assignment}', [ClassSubjectTeacherController::class, 'destroy'])
    ->name('assignments.destroy');