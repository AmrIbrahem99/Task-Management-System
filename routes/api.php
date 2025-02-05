<?php

use App\Http\Controllers\Auth\EnableAndDisableUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Task\AssignTaskController;
use App\Http\Controllers\Task\AssignTaskDependenciesController;
use App\Http\Controllers\Task\CreateTaskController;
use App\Http\Controllers\Task\DeleteDependencyFromTaskController;
use App\Http\Controllers\Task\DeleteTaskController;
use App\Http\Controllers\Task\GetAllTasksController;
use App\Http\Controllers\Task\GetSingleTaskController;
use App\Http\Controllers\Task\UpdateAssignedTaskController;
use App\Http\Controllers\Task\UpdateTaskController;
use Illuminate\Support\Facades\Route;


//Authentication routes
Route::middleware('is_active')->group(function () {
Route::post('/login', LoginController::class);
Route::middleware('auth:sanctum')->post('/logout', LogoutController::class);

// Admins only
Route::middleware(['role:admin', 'auth:sanctum'])->group(function () {
    Route::patch('/users/{user}/toggle-status', EnableAndDisableUserController::class);
    Route::post('/tasks', CreateTaskController::class);
    Route::put('/tasks/{id}', UpdateTaskController::class);
    Route::patch('/tasks/{id}/assign', AssignTaskController::class);
    Route::post('/tasks/{id}/dependencies', AssignTaskDependenciesController::class);
    Route::delete('/tasks/{id}/dependencies', DeleteDependencyFromTaskController::class);
    Route::delete('/tasks/{id}', DeleteTaskController::class);
});

// Users only
Route::middleware(['role:user', 'auth:sanctum'])->group(function () {
    Route::patch('/tasks/{id}/status', UpdateAssignedTaskController::class);
});

// All authenticated users
Route::get('/tasks', GetAllTasksController::class)->middleware('auth:sanctum');
Route::get('/tasks/{id}', GetSingleTaskController::class)->middleware('auth:sanctum');
});

