<?php

use App\Http\Controllers\Frontend\Auth\CustomerLoginController;
use App\Http\Controllers\Frontend\Auth\CustomerProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CustomerDashboardController;
use App\Http\Controllers\Frontend\Auth\CustomerRegisterController;



Route::prefix("customer")->group(function(){
    Route::get("signup", [CustomerRegisterController::class, "register"])->name("customer.register");
    Route::post('/signup', [CustomerRegisterController::class, 'store'])->name('signup.store');

    Route::get("sign-in", [CustomerLoginController::class, "signIn"])->name("customer.signin");
    Route::post('/sign-in', [CustomerLoginController::class, 'login'])->name('login.store');


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
