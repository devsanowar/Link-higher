<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CtaController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ReasonController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\WebsiteColorController;
use App\Http\Controllers\Admin\EmployeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\CaseStudyController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\SocialIconController;
use App\Http\Controllers\Admin\WhyChoseUsController;
use App\Http\Controllers\Admin\About\AboutController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\PackagePlanController;
use App\Http\Controllers\Admin\GoalProgressController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\SmartStrategyController;
use App\Http\Controllers\Admin\TrustedClientController;
use App\Http\Controllers\Admin\About\WhoWeAreController;
use App\Http\Controllers\Admin\ProfileSettingController;
use App\Http\Controllers\Admin\SmartSolutionsController;
use App\Http\Controllers\Admin\UserManageMentController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProjectCategoryController;
use App\Http\Controllers\Admin\ReturnAndRefundController;
use App\Http\Controllers\Admin\SmarterWorkflowsController;
use App\Http\Controllers\Admin\TermsAndConditonController;
use App\Http\Controllers\Admin\CaseStudyCategoryController;
use App\Http\Controllers\Admin\CustomerFocusToneController;
use App\Http\Controllers\Admin\SmartSolutionFeatureController;
use App\Http\Controllers\Admin\About\MissionAndVissionController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ServiceCategoryController;

Route::prefix('admin')->middleware(['auth', 'role:admin', 'verified'])->group(function () {

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

        // Customer focus tone route here
        Route::get('customer-focus-tone', [CustomerFocusToneController::class,'index'])->name('customer-focus-tone.index');
        Route::put('customer-focus-tone/update', [CustomerFocusToneController::class,'update'])->name('customer-focus-tone.update');

        // CTA route
        Route::get('CTA', [CtaController::class, 'index'])->name('cta.index');
        Route::put('cta/update', [CtaController::class, 'update'])->name('cta.update');


    });

    Route::prefix('about-page')->name('about-page.')->group(function () {
        Route::get('about-us', [AboutController::class, 'index'])->name('about-us.index');
        Route::put('about-us/update', [AboutController::class, 'update'])->name('about-us.update');

        // Mission and Vision route
        Route::get('mission-vision', [MissionAndVissionController::class, 'index'])->name('mission-vision.index');
        Route::put('mission-vision/update', [MissionAndVissionController::class, 'update'])->name('mission-vision.update');

        // Who we are route
        Route::get('who-we-are', [WhoWeAreController::class, 'index'])->name('who-we-are.index');
        Route::put('who-we-are/update', [WhoWeAreController::class, 'update'])->name('who-we-are.update');
    });

    // Product category resource route
    Route::resource('product-category', ProductCategoryController::class);
    // Product resource route
    Route::resource('products', ProductController::class);
    // Soft Delete
    Route::get('/product/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
    Route::get('/products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('products.force.delete');

    // Service category resouce route
    Route::resource('service-category', ServiceCategoryController::class);
    // Services resource route
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

    // Employee route
    Route::resource('employe', EmployeController::class);

    // Faq resource route
    Route::resource('faqs', FaqController::class);

    // Review resource route
    Route::resource('reviews', ReviewController::class);

    // Trusted Client resource route
    Route::resource('clients', TrustedClientController::class);

    // Package plan route here
    Route::resource('package_plans', PackagePlanController::class);

    //Project category resource route
    Route::resource('project-category', ProjectCategoryController::class);

    // Project resource route
    Route::resource('project', ProjectController::class);

    // Country route here
    Route::get('country', [CountryController::class, 'index'])->name('country.index');
    Route::post('country/store', [CountryController::class, 'store'])->name('country.store');
    Route::put('country/update/{id}', [CountryController::class, 'update'])->name('country.update');
    Route::delete('country/destroy/{id}', [CountryController::class, 'destroy'])->name('country.destroy');

    // Soft Delete

    Route::get('/trashed', [ProjectController::class, 'trashed'])->name('project.trashed');
    Route::get('/restore/{id}', [ProjectController::class, 'restore'])->name('project.restore');
    Route::delete('/force-delete/{id}', [ProjectController::class, 'forceDelete'])->name('project.force.delete');

    // Contact Message route here
    Route::get('/contact-messages', [ContactUsController::class, 'index'])->name(name: 'contact.messages.index');
    Route::delete('contact-messages/{id}', [ContactUsController::class, 'destroy'])->name('contact.destroy');

    // PPrivacy Policy route here
    Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy.policy.index');
    Route::put('/privacy-policy/update', [PrivacyPolicyController::class, 'update'])->name('privacy.policy.update');

    // Terms and Conditions route here
    Route::get('/terms-and-conditions', [TermsAndConditonController::class, 'index'])->name('terms.and.conditions.index');
    Route::put('/terms-and-conditions/update', [TermsAndConditonController::class, 'update'])->name('terms.and.conditions.update');

    // Return & Refund Policy route here
    Route::get('/return-refund-policy', [ReturnAndRefundController::class, 'index'])->name('return.refund.policy.index');
    Route::put('/return-refund-policy/update', [ReturnAndRefundController::class, 'update'])->name('return.refund.policy.update');

});
