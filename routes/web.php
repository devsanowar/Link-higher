<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\LegalController;
use App\Http\Controllers\Frontend\FaqPageController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Frontend\CartPageController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\AboutPageController;
use App\Http\Controllers\Frontend\BlogPageController;
use App\Http\Controllers\Frontend\PricingPageController;
use App\Http\Controllers\Frontend\ServicePageController;
use App\Http\Controllers\Frontend\ServicePlanController;
use App\Http\Controllers\Frontend\ContactUsPageController;
use App\Http\Controllers\Frontend\OrderController;

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/about-page', [AboutPageController::class, 'index'])->name('about.page');
Route::get('/portfolio-page', [ProjectController::class, 'index'])->name('portfolio.page');
Route::get('/portfolio/{id}/details', [ProjectController::class, 'projectDetails'])->name('portfolio.details');

// Service Page route
Route::get('service-page', [ServicePageController::class, 'index'])->name('service.page');
Route::get('service-page/{id}/details', [ServicePageController::class, 'serviceDetails'])->name('service.details.page');

// Post page route
Route::get('blog-page', [BlogPageController::class, 'index'])->name('blog.page');
Route::get('blog-details/{slug}', [BlogPageController::class, 'blogDetails'])->name('blog.details');

// Service plan route
Route::get('service-plan/{id}/details', [ServicePlanController::class, 'servicePlanDetails'])->name('service.plan.details.page');

// Cart page route
Route::get('cart-page', [CartPageController::class, 'index'])->name('cart.page');
Route::post('/cart/add-plan/{plan}', [CartPageController::class, 'addPlan'])->name('cart.addPlan');
Route::post('/cart/update-qty/{key}', [CartPageController::class, 'updateQty'])->name('cart.updateQty');
Route::post('/cart/remove/{key}', [CartPageController::class, 'remove'])->name('cart.remove');


// Checkout route
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.page');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('order.process');
Route::get('order/confirmation/{id}', [CheckoutController::class, 'showOrderConfirmation'])->name('order.success');



Route::get('faq-page', [FaqPageController::class, 'index'])->name('faq.page');
Route::get('contact-page', [ContactUsPageController::class, 'index'])->name('contact.page');
Route::post('contact-form/submit', [ContactUsPageController::class, 'submit'])->name('contact.form.submit');

// PricingPage Route
Route::get('/pricing-page', [PricingPageController::class, 'index'])->name('pricing.page');




// Legal page route
Route::get('/privacy-policy/page', [LegalController::class, 'privacyPolicy'])->name('privacy.policy.page');
Route::get('/terms-and-condition/page', [LegalController::class, 'termsAndCondition'])->name('terms.condition.page');
Route::get('/return-refund/page', [LegalController::class, 'returnRefund'])->name('return.refund.page');




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
