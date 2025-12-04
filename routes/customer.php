<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Frontend\CustomerDashboardController;
use App\Http\Controllers\Frontend\Auth\CustomerLoginController;
use App\Http\Controllers\Frontend\Auth\CustomerProfileController;
use App\Http\Controllers\Frontend\Auth\CustomerRegisterController;
use App\Http\Controllers\Frontend\Auth\CustomerResetPasswordController;
use App\Http\Controllers\Frontend\Auth\CustomerForgotPasswordController;

Route::prefix("customer")->group(function () {
    Route::get("signup", [CustomerRegisterController::class, "register"])->name("customer.register");
    Route::post('/signup', [CustomerRegisterController::class, 'store'])->name('signup.store');

    Route::get("sign-in", [CustomerLoginController::class, "signIn"])->name("customer.signin");
    Route::post('/sign-in', [CustomerLoginController::class, 'login'])->name('login.store');

    // Forgot password form
    Route::get('customer/password/forgot', [CustomerForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('customer.password.request');
    // Send reset link
    Route::post('customer/password/email', [CustomerForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('customer.password.email');

    // Show reset form (with token)
    Route::get('customer/password/reset/{token}', [CustomerResetPasswordController::class, 'showResetForm'])
        ->name('customer.password.reset');

    Route::post('customer/password/reset', [CustomerResetPasswordController::class, 'reset'])
        ->name('customer.password.update');

    // redirect to Google
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');

// callback from Google
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

    Route::middleware(['role:customer'])->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'dashboard'])->name('customer.dashboard');
        Route::post('/logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');
        Route::put('/profile/info/update', [CustomerProfileController::class, 'update'])->name('customer.profile.update');
        Route::put('/profile/image/update', [CustomerProfileController::class, 'profileImageUpdate'])->name('customer.profile.image.update');
        Route::post('/customer/change-password', [CustomerProfileController::class, 'changePassword'])->name('customer.change.password');
        Route::delete('/customer/delete/account/{id}', [CustomerProfileController::class, 'destroy'])->name('customer.destroy');

        Route::get('/order/{id}/invoice', [CustomerDashboardController::class, 'invoiceShow'])->name('order.invoice.show');

    });

});
