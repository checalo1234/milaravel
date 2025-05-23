<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\AreaController;
use App\Http\Controllers\TaskController;

Route::get('/', [AreaController::class, 'index'])->name('areas.index');
Route::get('/areas/create', [AreaController::class, 'create'])->name('areas.create');
Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');
Route::get('/areas/{area}', [AreaController::class, 'show'])->name('areas.show');
Route::post('/tasks/{area}', [TaskController::class, 'store'])->name('tasks.store');
Route::put('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
Route::post('/tasks/{task}/comment', [TaskController::class, 'addComment'])->name('tasks.comment');
Route::get('/tasks/pdf/{area}', [TaskController::class, 'generatePdf'])->name('tasks.pdf');
