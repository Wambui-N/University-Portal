<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

Route::get('/dashboard', [DashboardController::class, 'redirect'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/dashboard/{slug}', [AdminViewController::class, 'display'])->name('admin_display');

//CRUD Teacher
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/user_management', [TeacherController::class, 'index'])->name('teacher_management');
    Route::post('/dashboard/user_management', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/dashboard/user_management/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::get('/dashboard/user_management/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');
    Route::get('/dashboard/user_management/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/dashboard/user_management/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/dashboard/user_management/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
});
