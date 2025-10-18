<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\WebsiteColorController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\CaseStudyController;
use App\Http\Controllers\Admin\CountdownController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\SocialIconController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\GoalProgressController;
use App\Http\Controllers\Admin\SmartStrategyController;
use App\Http\Controllers\Admin\TrustedClientController;
use App\Http\Controllers\Admin\ProfileSettingController;
use App\Http\Controllers\Admin\SmartSolutionsController;
use App\Http\Controllers\Admin\UserManageMentController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\SmarterWorkflowsController;
use App\Http\Controllers\Admin\CaseStudyCategoryController;
use App\Http\Controllers\Admin\ReasonController;
use App\Http\Controllers\Admin\SmartSolutionFeatureController;
use App\Http\Controllers\Admin\WhyChoseUsController;

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    // Dashboard route here
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    });

    Route::prefix('Website-settings')->group(function () {
        Route::get('/', [WebsiteSettingController::class, 'index'])->name('website_settings.index');
        Route::put('/update', [WebsiteSettingController::class, 'update'])->name('website.settings.update');
    });

    Route::prefix('social-icon')->group(function () {
        Route::get('/', [SocialIconController::class, 'index'])->name('social.icon.index');
        Route::put('/update', [SocialIconController::class, 'update'])->name('social.icon.update');
    });

    Route::prefix('website-color')->group(function () {
        Route::get('/', [WebsiteColorController::class, 'index'])->name('website.color.index');
        Route::put('/update', [WebsiteColorController::class, 'update'])->name('website.color.update');
    });

    Route::prefix('profile-setting')->group(function () {
        Route::get('/', [ProfileSettingController::class, 'index'])->name('profile.setting.index');
        Route::put('/profile/image/update', [ProfileSettingController::class, 'updateImage'])->name('profile.image.update');
        Route::put('/profile/info/update', [ProfileSettingController::class, 'profileInfoUpdate'])->name('profile.info.update');
        Route::put('/profile/password/update', [ProfileSettingController::class, 'passwordUpdate'])
            ->name('profile.password.update');

    });

    Route::prefix('admin-login-page')->group(function () {
        Route::get('/', [AdminPanelController::class, 'index'])->name('login.page.index');
        Route::put('/bg-image/update', [AdminPanelController::class, 'update'])->name('login.page.update');
    });

    Route::prefix('User-management')->group(function () {
        Route::get('/', [UserManageMentController::class, 'index'])->name('user.management.index');
        Route::post('/store', [UserManageMentController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [UserManageMentController::class, 'edit'])->name('user.management.edit');
        Route::put('/update/{id}', [UserManageMentController::class, 'update'])->name('users.update');
        Route::delete('/delete/{id}', [UserManageMentController::class, 'destroy'])->name('users.destroy');
    });

    Route::prefix('home')->name('home.')->group(function () {
        Route::get('/hero-section', [HeroSectionController::class, 'index'])->name('hero.section.index');
        Route::put('/hero-section/update', [HeroSectionController::class, 'update'])->name('hero.section.update');

        // Smart Strategy route
        Route::get('/smart-strategy', [SmartStrategyController::class, 'index'])->name('smart-strategy.index');
        Route::put('/smart-strategy/update', [SmartStrategyController::class, 'update'])->name('smart-strategy.update');

        // Smarter workflows resource route
        Route::resource('smarter-workflows', SmarterWorkflowsController::class);

        Route::put('/smarter-workflow/image/update', [SmarterWorkflowsController::class, 'imageUpdate'])
            ->name('smarter-workflow-image.update');

        // Goal progress insight resource route
        Route::resource('goal-progress-insight', GoalProgressController::class);

        Route::put('goal-progress-section-title/update', [GoalProgressController::class, 'updateTitle'])->name('goal-progress-section-title.update');

        // Smart solution
        Route::get('smart-solution', [SmartSolutionsController::class,'index'])->name('smart-solution.index');
        Route::put('smart-solution/update', [SmartSolutionsController::class,'update'])->name('smart-solution.update');

        // smart solution feature resource route
        Route::resource('smart-solution-features', SmartSolutionFeatureController::class);

        // Count down resource route
        Route::resource('achievements', AchievementController::class);

        // Why Chose us route
        Route::get('why-chose-us', [WhyChoseUsController::class, 'index'])->name('why-chose-us.index');
        Route::put('why-chose-us/update', [WhyChoseUsController::class, 'update'])->name('why-chose-us.update');

        // Why chose us reason route here
        Route::resource('why-chose-us/reason', ReasonController::class);

    });

    Route::resource('services', ServicesController::class);

    Route::prefix('case-study')->group(function () {
        Route::resource('category', CaseStudyCategoryController::class);

        // Case Study
        Route::get('/', [CaseStudyController::class, 'index'])->name('case.study.index');
        Route::get('/create', [CaseStudyController::class, 'create'])->name('case.study.create');
        Route::post('/store', [CaseStudyController::class, 'store'])->name('case.study.store');
        Route::get('/edit/{id}', [CaseStudyController::class, 'edit'])->name('case.study.edit');
        Route::put('/edit/{id}', [CaseStudyController::class, 'update'])->name('case.study.update');
        Route::delete('/delete/{id}', [CaseStudyController::class, 'destroy'])->name('case.study.destroy');

        // Soft Delete

        Route::get('/trashed', [CaseStudyController::class, 'trashed'])->name('case.study.trashed');
        Route::get('/restore/{id}', [CaseStudyController::class, 'restore'])->name('case.study.restore');
        Route::delete('/force-delete/{id}', [CaseStudyController::class, 'forceDelete'])->name('case.study.force.delete');
    });

    // Faq resource route
    Route::resource('faqs', FaqController::class);

    // Review resource route
    Route::resource('reviews', ReviewController::class);

    // Trusted Client resource route
    Route::resource('clients', TrustedClientController::class);

});
