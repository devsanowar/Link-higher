<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    // Dashboard route here
    Route::group(['prefix'=> 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    });

    Route::prefix('Website-settings')->group(function () {
        Route::get('/', [WebsiteSettingController::class,'index'])->name('website_settings.index');
        Route::put('/website-settings', [WebsiteSettingController::class,'update'])->name('website.settings.update');


    });




});
