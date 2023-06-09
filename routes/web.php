<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DisplayUnitController;
use App\Http\Controllers\UnitController;
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

Route::get('/dashboard/communication',function(){
    return view ('admin/assets/communication');
});


// CRUD User
Route::resource('/dashboard/user_management', UserController::class)->names([
    'index' => 'users.index',
    'create' => 'users.create',
    'store' => 'users.store',
    'show' => 'users.show',
    'edit' => 'users.edit',
    'update' => 'users.update',
    'destroy' => 'users.destroy',
]);

// CRUD Course
Route::resource('/dashboard/course_management', CourseController::class)->names([
    'index' => 'courses.index',
    'create' => 'courses.create',
    'store' => 'courses.store',
    'show' => 'courses.show',
    'edit' => 'courses.edit',
    'update' => 'courses.update',
    'destroy' => 'courses.destroy',
]);


Route::get('/dashboard/teacher/courses', [DisplayUnitController::class, 'index'])->name('units.index');



// CRUD Unit
Route::resource('/dashboard/course/units', UnitController::class)->names([
    'index' => 'units.index',
    'create' => 'units.create',
    'store' => 'units.store',
    'show' => 'units.show',
    'edit' => 'units.edit',
    'update' => 'units.update',
    'destroy' => 'units.destroy',
]);