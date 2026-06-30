<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\HolidayController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

// 1. Public Routes (Bisa diakses tanpa token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 2. Protected Routes (Wajib menyertakan token kustom melalui AuthMiddleware)
// Kita gunakan alias 'auth.custom' yang sudah didaftarkan di Kernel.php
Route::middleware(['auth.custom'])->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);

    // Fitur Tasks
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

    // Fitur Schedules
    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::post('/schedules', [ScheduleController::class, 'store']);
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy']);

    // Fitur Dashboard & Holidays
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/holidays', [HolidayController::class, 'index']);
});