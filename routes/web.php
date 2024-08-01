<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('projects/create',[ProjectController::class,'create'])->name('projects.create');

Route::post('projects',[ProjectController::class,'store'])->name('projects.store');

Route::get('projects',[ProjectController::class,'index'])->name('projects.index');

Route::get('projects/{id}/edit',[ProjectController::class,'edit'])->name('projects.edit');

Route::put('projects/{id}',[ProjectController::class,'update'])->name('projects.update');
Route::delete('projects/{id}',[ProjectController::class,'destroy'])->name('projects.destroy');

//Route pour les tasks
Route::get('tasks/create',[TaskController::class,'create'])->name('tasks.create');
Route::post('tasks',[TaskController::class,'store'])->name('tasks.store');
Route::get('tasks',[TaskController::class,'index'])->name('tasks.index');
Route::get('tasks/{id}/edit',[TaskController::class,'edit'])->name('tasks.edit');
Route::put('tasks/{id}',[TaskController::class,'update'])->name('tasks.update');
Route::delete('tasks/{id}',[TaskController::class,'destroy'])->name('tasks.destroy');

Route::get('/tasks/status/{status}', [TaskController::class, 'bystatus'])->name('tasks.bystatus');
Route::get('projects/{project}/tasks', [ProjectController::class, 'showTasks'])->name('projects.showTasks');


