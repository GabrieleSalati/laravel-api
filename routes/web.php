<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\MockObject\Rule\Parameters;

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

Route::get('/', [GuestController::class, 'index']);

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')
    ->prefix('/admin')
    ->name('admin.')
    ->group(function () {
        route::resource('projects', ProjectController::class)
            ->parameters(['projects' => 'project:slug']);
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
