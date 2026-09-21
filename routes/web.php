<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/classes', [SchoolClassController::class, 'index']);
Route::get('/classes/create', [SchoolClassController::class, 'create']);
Route::get('/classes/{class}',[SchoolClassController::class,'show']);
Route::post('/classes', [SchoolClassController::class, 'store']);

Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/create', [StudentController::class, 'create']);