<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SocialIconController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    // Dashboard route here
    Route::group(['prefix'=> 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    });

    Route::prefix('Website-settings')->group(function () {
        Route::get('/', [WebsiteSettingController::class,'index'])->name('website_settings.index');
        Route::put('/update', [WebsiteSettingController::class,'update'])->name('website.settings.update');
    });

    Route::prefix('social-icon')->group(function () {
        Route::get('/', [SocialIconController::class,'index'])->name('social.icon.index');
        Route::put('/update', [SocialIconController::class,'update'])->name('social.icon.update');
    });




});
