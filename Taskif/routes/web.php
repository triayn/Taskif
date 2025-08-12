<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

# Fitur Tugas
Route::prefix('/tugas')->group(function() {
    Route::get('/index', [TaskController::class, 'index'])->name('task.index');
});

# Manajemen Tugas
Route::prefix('/manajemen')->group(function() {
    Route::get('/list', [TaskController::class, 'list'])->name('manajemen.list');
});

Route::prefix('/kategori')->group(function() {
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
});