<?php

use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Frontend\AboutPageController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/about-page', [AboutPageController::class, 'index'])->name('about.page');
Route::get('/portfolio-page', [ProjectController::class, 'index'])->name('portfolio.page');
Route::get('/portfolio/{id}/details', [ProjectController::class, 'projectDetails'])->name('portfolio.details');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
