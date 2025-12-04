<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Frontend\LegalController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Admin\CaseStudyController;
use App\Http\Controllers\Frontend\ChatbotController;
use App\Http\Controllers\Frontend\EmployeController;
use App\Http\Controllers\Frontend\FaqPageController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Frontend\SupportController;
use App\Http\Controllers\Frontend\BlogPageController;
use App\Http\Controllers\Frontend\CartPageController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\SitePageController;
use App\Http\Controllers\Frontend\AboutPageController;
use App\Http\Controllers\Frontend\CaseStudiesController;
use App\Http\Controllers\Frontend\PartnerSiteController;
use App\Http\Controllers\Frontend\PricingPageController;
use App\Http\Controllers\Frontend\ServicePageController;
use App\Http\Controllers\Frontend\ServicePlanController;
use App\Http\Controllers\Frontend\ContactUsPageController;

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

// Employee Controller route
Route::get('/team', [EmployeController::class, 'employePage'])->name('employe.page');

// Service plan route
Route::get('service-plan/{id}/details', [ServicePlanController::class, 'servicePlanDetails'])->name('service.plan.details.page');

// Cart page route
Route::get('cart-page', [CartPageController::class, 'index'])->name('cart.page');
Route::post('/cart/add-plan/{plan}', [CartPageController::class, 'addPlan'])->name('cart.addPlan');
Route::post('/cart/update-qty/{key}', [CartPageController::class, 'updateQty'])->name('cart.updateQty');
Route::post('/cart/remove/{key}', [CartPageController::class, 'remove'])->name('cart.remove');

// Site page controller
Route::get('site-page', [SitePageController::class, 'index'])->name('site.page');


// Checkout route
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.page');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('order.process');
Route::get('order/confirmation/{id}', [CheckoutController::class, 'showOrderConfirmation'])->name('order.success');

// PayPal routes
Route::get('/paypal/redirect/{order}', [CheckoutController::class, 'paypalRedirect'])->name('paypal.redirect');
Route::get('/paypal/callback', [CheckoutController::class, 'paypalCallback'])->name('paypal.callback');

// Paddle routes (if you want server-side redirect)
Route::get('/paddle/redirect/{order}', [CheckoutController::class, 'paddleRedirect'])->name('paddle.redirect');
Route::post('/paddle/webhook', [CheckoutController::class, 'paddleWebhook'])->name('paddle.webhook'); // webhook endpoint
Route::get('order/confirmation/{id}', [CheckoutController::class, 'showOrderConfirmation'])->name('order.success');



Route::get('faq-page', [FaqPageController::class, 'index'])->name('faq.page');
Route::get('contact-page', [ContactUsPageController::class, 'index'])->name('contact.page');
Route::post('contact-form/submit', [ContactUsPageController::class, 'submit'])->name('contact.form.submit');

// PricingPage Route
Route::get('/pricing-page', [PricingPageController::class, 'index'])->name('pricing.page');

// Case studdy controller
Route::get('case/study', [CaseStudiesController::class, 'index'])->name('case.study.page');
Route::get('case/study/{id}', [CaseStudiesController::class, 'caseDetails'])->name('case.study.details');


Route::get('/partner-site', [PartnerSiteController::class, 'index']);



// Legal page route
Route::get('/privacy-plicy/page', [LegalController::class, 'privacyPolicy'])->name('privacy.policy.page');
Route::get('/terms-and-condition/page', [LegalController::class, 'termsAndCondition'])->name('terms.condition.page');
Route::get('/return-refund/page', [LegalController::class, 'returnRefund'])->name('return.refund.page');


// Route::get('/chat', function () {
//     return view('website.chat');
// })->name('chat.page');

// Route::post('/chatbot/send', [ChatbotController::class, 'send'])->name('chatbot.send');
// Route::post('/support/request', [SupportController::class, 'store'])->name('support.request');


Route::post('/chatbot/send', [ChatbotController::class, 'send'])->name('chatbot.send');

Route::post('/support/request', [SupportController::class, 'store'])->name('support.request');


// redirect to Google
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');

// callback from Google
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
