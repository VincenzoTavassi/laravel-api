<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\GuestProjectsController;
use App\Http\Controllers\ProfileController;
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

// Guest views
Route::get('/', [GuestProjectsController::class, 'index'])->name('guest.index');
Route::get('/project/{project}', [GuestProjectsController::class, 'show'])->name('guest.show');

// Resources
Route::resource('types', TypeController::class)->except('show')->middleware('auth');
Route::resource('technologies', TechnologyController::class)->except('show')->middleware('auth');
Route::resource('projects', ProjectController::class)->middleware('auth');

// Dashboard
// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth'])->name('dashboard');

// Authentication
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
