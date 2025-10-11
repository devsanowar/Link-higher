<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteColorController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\SocialIconController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\ProfileSettingController;
use App\Http\Controllers\Admin\UserManageMentController;
use App\Http\Controllers\Admin\WebsiteSettingController;


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


    Route::prefix('website-color')->group(function () {
        Route::get('/', [WebsiteColorController::class,'index'])->name('website.color.index');
        Route::put('/update', [WebsiteColorController::class,'update'])->name('website.color.update');
    });

    Route::prefix('profile-setting')->group(function () {
        Route::get('/', [ProfileSettingController::class,'index'])->name('profile.setting.index');
        Route::put('/profile/image/update', [ProfileSettingController::class,'updateImage'])->name('profile.image.update');
        Route::put('/profile/info/update', [ProfileSettingController::class,'profileInfoUpdate'])->name('profile.info.update');
        Route::put('/profile/password/update', [ProfileSettingController::class,'passwordUpdate'])
            ->name('profile.password.update');

    });

    Route::prefix('admin-login-page')->group(function () {
        Route::get('/', [AdminPanelController::class,'index'])->name('login.page.index');
        Route::put('/bg-image/update', [AdminPanelController::class,'update'])->name('login.page.update');
    });

    Route::prefix('User-management')->group(function () {
        Route::get('/', [UserManageMentController::class,'index'])->name('user.management.index');
        Route::post('/store', [UserManageMentController::class,'store'])->name('users.store');
        Route::get('/edit/{id}', [UserManageMentController::class,'edit'])->name('user.management.edit');
        Route::put('/update/{id}', [UserManageMentController::class,'update'])->name('users.update');
        Route::delete('/delete/{id}', [UserManageMentController::class,'destroy'])->name('users.destroy');
    });

    Route::prefix('home')->name('home.')->group(function () {
        Route::get('/hero-section', [HeroSectionController::class, 'index'])->name('hero.section.index');
        Route::put('/hero-section/update', [HeroSectionController::class,'update'])->name('hero.section.update');
    });


    Route::prefix('services')->name('services.')->group(function () {
        Route::resource('/', ServicesController::class);
    });



});
