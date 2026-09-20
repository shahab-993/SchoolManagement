<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolClassController;
use Illuminate\Support\Facades\Route;

Route::get('/',[DashboardController::class,'index']);
Route::get('/classes',[SchoolClassController::class,'index']);