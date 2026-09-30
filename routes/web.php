<?php

use App\Http\Controllers\ClassSubjectTeacherController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('permission:view_students');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware('permission:view_users');


    /*
    |--------------------------------------------------------------------------
    | Classes
    |--------------------------------------------------------------------------
    */

    Route::get('/classes', [SchoolClassController::class, 'index'])
        ->name('classes.index')
        ->middleware('permission:view_classes');

    Route::get('/classes/create', [SchoolClassController::class, 'create'])
        ->name('classes.create')
        ->middleware('permission:create_classes');

    Route::get('/classes/{class}', [SchoolClassController::class, 'show'])
        ->name('classes.show')
        ->middleware('permission:view_classes');

    Route::post('/classes', [SchoolClassController::class, 'store'])
        ->name('classes.store')
        ->middleware('permission:create_classes');

    Route::get('/classes/{class}/students', [SchoolClassController::class, 'students'])
        ->name('classes.students')
        ->middleware('permission:view_classes');

    Route::get('/classes/{class}/edit', [SchoolClassController::class, 'edit'])
        ->name('classes.edit')
        ->middleware('permission:edit_classes');

    Route::put('/classes/{class}', [SchoolClassController::class, 'update'])
        ->name('classes.update')
        ->middleware('permission:edit_classes');

    Route::delete('/classes/{class}', [SchoolClassController::class, 'destroy'])
        ->name('classes.destroy')
        ->middleware('permission:delete_classes');


    /*
    |--------------------------------------------------------------------------
    | Students
    |--------------------------------------------------------------------------
    */

    Route::get('/students', [StudentController::class, 'index'])
        ->name('students.index')
        ->middleware('permission:view_students');

    Route::get('/students/create', [StudentController::class, 'create'])
        ->name('students.create')
        ->middleware('permission:create_students');

    Route::get('/students/{student}', [StudentController::class, 'show'])
        ->name('students.show')
        ->middleware('permission:view_students');

    Route::post('/students', [StudentController::class, 'store'])
        ->name('students.store')
        ->middleware('permission:create_students');

    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])
        ->name('students.edit')
        ->middleware('permission:edit_students');

    Route::put('/students/{student}', [StudentController::class, 'update'])
        ->name('students.update')
        ->middleware('permission:edit_students');

    Route::delete('/students/{student}', [StudentController::class, 'destroy'])
        ->name('students.destroy')
        ->middleware('permission:delete_students');


    /*
    |--------------------------------------------------------------------------
    | Teachers
    |--------------------------------------------------------------------------
    */

    Route::get('/teachers', [TeacherController::class, 'index'])
        ->name('teachers.index')
        ->middleware('permission:view_teachers');

    Route::get('/teachers/create', [TeacherController::class, 'create'])
        ->name('teachers.create')
        ->middleware('permission:create_teachers');

    Route::post('/teachers', [TeacherController::class, 'store'])
        ->name('teachers.store')
        ->middleware('permission:create_teachers');

    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])
        ->name('teachers.edit')
        ->middleware('permission:edit_teachers');

    Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])
        ->name('teachers.update')
        ->middleware('permission:edit_teachers');

    Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])
        ->name('teachers.show')
        ->middleware('permission:view_teachers');

    Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])
        ->name('teachers.destroy')
        ->middleware('permission:delete_teachers');


    /*
    |--------------------------------------------------------------------------
    | Subjects
    |--------------------------------------------------------------------------
    */

    Route::get('/subjects', [SubjectController::class, 'index'])
        ->name('subjects.index')
        ->middleware('permission:view_subjects');

    Route::get('/subjects/create', [SubjectController::class, 'create'])
        ->name('subjects.create')
        ->middleware('permission:create_subjects');

    Route::post('/subjects', [SubjectController::class, 'store'])
        ->name('subjects.store')
        ->middleware('permission:create_subjects');

    Route::get('/subjects/{subject}', [SubjectController::class, 'show'])
        ->name('subjects.show')
        ->middleware('permission:view_subjects');

    Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])
        ->name('subjects.edit')
        ->middleware('permission:edit_subjects');

    Route::put('/subjects/{subject}', [SubjectController::class, 'update'])
        ->name('subjects.update')
        ->middleware('permission:edit_subjects');

    Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])
        ->name('subjects.destroy')
        ->middleware('permission:delete_subjects');


    /*
    |--------------------------------------------------------------------------
    | Assignments
    |--------------------------------------------------------------------------
    */

    Route::get('/assignments', [ClassSubjectTeacherController::class, 'index'])
        ->name('assignments.index')
        ->middleware('permission:view_subjects');

    Route::get('/assignments/create', [ClassSubjectTeacherController::class, 'create'])
        ->name('assignments.create')
        ->middleware('permission:create_subjects');

    Route::post('/assignments', [ClassSubjectTeacherController::class, 'store'])
        ->name('assignments.store')
        ->middleware('permission:create_subjects');

    Route::get('/assignments/{assignment}/edit', [ClassSubjectTeacherController::class, 'edit'])
        ->name('assignments.edit')
        ->middleware('permission:edit_subjects');

    Route::put('/assignments/{assignment}', [ClassSubjectTeacherController::class, 'update'])
        ->name('assignments.update')
        ->middleware('permission:edit_subjects');

    Route::delete('/assignments/{assignment}', [ClassSubjectTeacherController::class, 'destroy'])
        ->name('assignments.destroy')
        ->middleware('permission:delete_subjects');

    Route::get(
        '/classes/{schoolClass}/subjects',
        [ClassSubjectTeacherController::class, 'subjects']
    )
        ->name('classes.subjects')
        ->middleware('permission:view_subjects');

    Route::get(
        '/classes/{schoolClass}/assigned-subjects',
        [ClassSubjectTeacherController::class, 'getSubjects']
    )
        ->name('classes.assignedSubjects')
        ->middleware('permission:view_subjects');


    /*
    |--------------------------------------------------------------------------
    | Marks
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/classes/{schoolClass}/subjects/{subject}/marks',
        [MarkController::class, 'index']
    )
        ->name('marks.index')
        ->middleware('permission:view_marks');

    Route::post(
        '/classes/{schoolClass}/subjects/{subject}/marks',
        [MarkController::class, 'store']
    )
        ->name('marks.store')
        ->middleware('permission:create_marks');


    /*
    |--------------------------------------------------------------------------
    | Results
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/classes/{schoolClass}/results',
        [ResultController::class, 'index']
    )
        ->name('results.index')
        ->middleware('permission:view_results');


    // Display Users
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware('permission:view_users');

    // Show Create User Form
    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create')
        ->middleware('permission:create_users');

    // Store New User
    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store')
        ->middleware('permission:create_users');

    // Show Edit User Form
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit')
        ->middleware('permission:edit_users');

    // Update User
    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update')
        ->middleware('permission:edit_users');

    // Delete User
    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('permission:delete_users');

});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
