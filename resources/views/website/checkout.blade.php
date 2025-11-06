@extends('website.layouts.app')
@section('title', 'Checkout Page')
@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/checkout-page.css') }}">
@endpush
@section('website_content')
    <div id="plan-details-page">
        <section id="service-page-breadcrumb">
            <div class="breadcrumb-container">
                <h2 class="breadcrumb-title">Checkout Page</h2>
                <ul class="breadcrumb-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>›</span></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </section>



        <div class="ck-container">
            <div class="grid">
                <div class="ck-card">
                    <h2 class="custom-section-title" style="margin-bottom: 10px; text-transform: uppercase; font-size: 24px;">Checkout</h2>

                    <p class="lead">Secure payment — protected by TLS. Fill in your details to complete the order.</p>

                    <div class="checkout">
                        <!-- left: form -->
                        <div>
                            <form id="checkout-form" class="ck-card" novalidate>
                                <h2 style="margin-top:0; font-size:15px">Billing details</h2>

                                <div class="row">
                                    <div>
                                        <label for="fname">First name</label>
                                        <input id="fname" name="fname" class="ck-input" placeholder="John" required>
                                    </div>
                                    <div>
                                        <label for="lname">Last name</label>
                                        <input id="lname" name="lname" class="ck-input" placeholder="Doe" required>
                                    </div>
                                </div>

                                <div>
                                    <label for="email">Email</label>
                                    <input id="email" type="email" name="email" class="ck-input"
                                        placeholder="you@example.com" required>
                                </div>

                                <div>
                                    <label for="email">Country</label>
                                    <select name="country" id="country" class="form-control ck-input">
                                        <option value="">Bangladesh</option>
                                        <option value="">England</option>
                                        <option value="">United States</option>
                                        <option value="">Australia</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div>
                                        <label for="city">City</label>
                                        <input id="city" name="city" class="ck-input" placeholder="Dhaka" required>
                                    </div>
                                    <div>
                                        <label for="zip">ZIP / Postal</label>
                                        <input id="zip" name="zip" class="ck-input" placeholder="1000" required>
                                    </div>
                                </div>

                                <div>
                                    <label for="address">Address</label>
                                    <input id="address" name="address" class="ck-input" placeholder="Street address, city"
                                        required>
                                </div>

                                <p class="small muted" style="margin-top:10px">By continuing you agree to our <a
                                        href="#">Terms</a> & <a href="#">Privacy</a>.</p>

                                <div id="form-msg" aria-live="polite" style="margin-top:8px"></div>
                            </form>
                        </div>

                        <!-- right: order summary -->
                        <aside class="ck-card summary">
                            <div style="display:flex; justify-content:space-between; align-items:center">
                                <div>
                                    <div class="small muted">Order #</div>
                                    <div style="font-weight:700">#A98B3</div>
                                </div>
                                <div class="text-right">
                                    <div class="small muted">Items</div>
                                    <div class="price">3</div>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="product">
                                <div class="meta">
                                    <div class="title">Minimal Desk Lamp</div>
                                    <div class="muted small">Black • Qty 1</div>
                                </div>
                                <div style="margin-left:auto" class="price">৳3,200</div>
                            </div>


                            <div class="divider"></div>

                            <div class="totals" style="font-size:16px">
                                <div>Total</div>
                                <div>৳12,350</div>
                            </div>

                            <div style="display:flex; gap:8px; margin-top:12px">
                                <button class="ck-btn btn-primary checkout-button" style="flex:1">Checkout</button>
                            </div>

                            <p class="muted small" style="margin-top:10px">Shipping to: Dhaka, Bangladesh</p>
                        </aside>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
