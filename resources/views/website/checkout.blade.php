@extends('website.layouts.app')
@section('title', 'Checkout Page')
@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/checkout-page.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container .select2-selection--single { height: 50px; padding: 10px; }
        .select2-container--default .select2-selection--single .select2-selection__arrow { top: 14px; right: 4px; }
        .select2-container--default .select2-selection--single .select2-selection__rendered { font-size: 16px; }
        .select2-results__option { padding: 4px; font-size: 16px; }
        .select2-container--default .select2-selection--single { border: 1px solid #aaaaaa63; }
        .product .thumb { width:56px; height:56px; object-fit:cover; border-radius:6px; margin-right:12px; }
        .product { display:flex; align-items:center; gap:12px; padding:8px 0; }
    </style>
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
                        <!-- NOTE: update the action route name to your actual order/place route -->
                        <form id="checkout-form" class="ck-card" action="{{ route('order.process') }}" method="POST" novalidate>
                            @csrf
                            <h2 style="margin-top:0; font-size:15px">Billing details</h2>

                            <div>
                                <div>
                                    <label for="fname">Full Name</label>
                                    <input id="fname" name="fname" class="ck-input" placeholder="John" value="{{ old('fname', auth()->user()->name ?? '') }}" required>
                                </div>
                            </div>

                            <div>
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" class="ck-input" placeholder="you@example.com" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                            </div>

                            <div>
                                <label for="country">Country</label>
                                <select name="country_name" id="countrySelect" class="form-control ck-input">
                                    @forelse ($countries as $country)
                                        <option value="{{ $country->country_name }}" {{ old('country_name') == $country->country_name ? 'selected' : '' }}>
                                            {{ $country->country_name }}
                                        </option>
                                    @empty
                                        <option value="">Country not found</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="row">
                                <div>
                                    <label for="city">City</label>
                                    <input id="city" name="city" class="ck-input" placeholder="Enter City" value="{{ old('city') }}" required>
                                </div>
                                <div>
                                    <label for="zip">ZIP / Postal</label>
                                    <input id="zip" name="zip" class="ck-input" placeholder="1000" value="{{ old('zip') }}" required>
                                </div>
                            </div>

                            <div>
                                <label for="address">Address</label>
                                <input id="address" name="address" class="ck-input" placeholder="Street address, city" value="{{ old('address') }}" required>
                            </div>

                            <p class="small muted" style="margin-top:10px">By continuing you agree to our <a href="#">Terms</a> & <a href="#">Privacy</a>.</p>

                            <div id="form-msg" aria-live="polite" style="margin-top:8px"></div>

                            <!-- mobile view: show order summary under the form when screen is small -->
                            <div class="d-md-none mt-3">
                                <div class="divider"></div>
                                <div style="font-weight:700; display:flex; justify-content:space-between;">
                                    <div>Items ({{ $itemsCount }})</div>
                                    <div>৳{{ number_format($totalAmount, 2) }}</div>
                                </div>
                            </div>
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
                                <div class="price">{{ $itemsCount }}</div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        @foreach ($cartContents as $key => $item)
                            @php
                                // defensive defaults
                                $name = $item['plan_name'] ?? ($item['name'] ?? 'Unnamed');
                                $price = isset($item['price']) ? (float)$item['price'] : 0;
                                $qty = isset($item['quantity']) ? (int)$item['quantity'] : 1;
                                $lineTotal = $price * $qty;
                                $imagePath = $item['image'] ?? null;
                            @endphp

                            <div class="product">
                                @if($imagePath)
                                    {{-- adjust path according to your storage setup --}}
                                    <img src="{{ asset('storage/' . ltrim($imagePath, '/')) }}" alt="{{ $name }}" class="thumb">
                                @else
                                    <img src="{{ asset('frontend/images/placeholder.png') }}" alt="placeholder" class="thumb">
                                @endif

                                <div class="meta" style="flex:1; min-width:0">
                                    <div class="title" style="font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                        {{ $name }}
                                    </div>
                                    <div class="muted small">
                                        @if(!empty($item['service_title'])) {{ $item['service_title'] }} @endif
                                        @if(!empty($item['service_category'])) • {{ $item['service_category'] }} @endif
                                        • Qty {{ $qty }}
                                    </div>
                                </div>

                                <div style="margin-left:auto; text-align:right" class="price">
                                    ৳{{ number_format($lineTotal, 2) }}
                                </div>
                            </div>
                        @endforeach

                        <div class="divider"></div>

                        <div class="totals" style="font-size:16px; display:flex; justify-content:space-between; align-items:center;">
                            <div>Total</div>
                            <div>৳{{ number_format($totalAmount, 2) }}</div>
                        </div>

                        <div style="display:flex; gap:8px; margin-top:12px">
                            {{-- NOTE: the checkout button submits the checkout form on left.
                                 Make sure route('checkout.process') exists and handles order placement. --}}
                            <button form="checkout-form" class="ck-btn btn-primary checkout-button" style="flex:1; border:0; padding:12px 14px;">
                                Checkout
                            </button>
                        </div>
                    </aside>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            let $select = $('#countrySelect');

            // options are already A-Z from controller, but sort in frontend as well just in case
            let options = $select.find('option').sort(function(a, b) {
                return a.text.localeCompare(b.text);
            });
            $select.html(options);

            // initialize select2 (search-inside-select)
            $select.select2({
                placeholder: "Search country...",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush
