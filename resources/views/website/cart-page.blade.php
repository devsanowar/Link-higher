@extends('website.layouts.app')
@section('title', 'Cart Page')
@section('page_id', 'cart-page')
@section('website_content')

    <section id="service-page-breadcrumb" class="container">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title">Cart Page</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li class="active">Cart</li>
            </ul>
        </div>
    </section>

    <div id="plan-details-page" style="margin-top: 40px; margin-bottom: 40px;">
        <div class="container">
            <div class="wrap">
                <div class="card">

                    <div class="top">
                        <div>
                            <h2 class="custom-section-title"
                                style="margin-bottom: 10px; text-transform: uppercase; font-size: 24px;">Cart Items</h2>
                        </div>
                        <div class="muted small">{{ $itemCount ?? 0 }} items</div>
                    </div>

                    @if (session('success'))
                        <div style="padding:12px;margin-bottom:12px;border-radius:8px;background:#ecfdf5;color:#065f46">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div style="padding:12px;margin-bottom:12px;border-radius:8px;background:#fff1f2;color:#9f1239">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-wrap">
                        <table class="cart" role="table" aria-label="Shopping cart">
                            <thead>
                                <tr>
                                    <th style="min-width:200px">Package Name</th>
                                    <th style="width:140px">Price</th>
                                    <th style="width:250px">Quantity</th>
                                    <th style="width:120px">Subtotal</th>
                                    <th style="width:90px">Action</th>
                                </tr>
                            </thead>

                            <tbody id="cartBody">
                                @forelse($cartContents as $key => $item)
                                    @php
                                        $qty = isset($item['quantity']) ? (int) $item['quantity'] : 1;
                                        $price = isset($item['price']) ? (float) $item['price'] : 0;
                                        $subtotal = $price * $qty;
                                        // image resolution: prefer service_image (if present), then thumbnail fields, otherwise placeholder
                                        $img = $item['image'] ?? ($item['thumbnail'] ?? null);
                                        $imgUrl = $img ? asset($img) : 'https://via.placeholder.com/160';
                                        // title
                                        $title =
                                            $item['plan_name'] ??
                                            ($item['name'] ?? ($item['service_title'] ?? 'Untitled'));
                                        $sku = $item['plan_id'] ?? ($item['id'] ?? '');
                                    @endphp

                                    <tr data-id="{{ $key }}">
                                        <td>
                                            <div class="product-cell">
                                                <div>
                                                    <div class="p-title">{{ $title }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="price">${{ number_format($price, 2) }}</td>

                                        <td>
                                            <div class="qty" data-id="{{ $key }}">
                                                <!-- quantity update form (non-AJAX) -->
                                                <form action="{{ route('cart.updateQty', $key) }}" method="POST"
                                                    style="display:flex;gap:8px;align-items:center;">
                                                    @csrf
                                                    <input type="number" min="1" name="quantity"
                                                        value="{{ $qty }}" class="qty-input"
                                                        style="width:80px;padding:8px;border-radius:8px;border:1px solid #e6e6e6;text-align:center;">
                                                    <button type="submit"
                                                        style="padding:8px 10px;border-radius:8px;background:#111;color:#fff;border:0;cursor:pointer;font-weight:700">Update</button>
                                                </form>
                                            </div>
                                        </td>

                                        <td class="subtotal">${{ number_format($subtotal, 2) }}</td>

                                        <td>
                                            <form action="{{ route('cart.remove', $key) }}" method="POST"
                                                onsubmit="return confirm('Remove this item?');">
                                                @csrf
                                                <button type="submit" class="remove"
                                                    style="background:transparent;border:0;color:#ef4444;cursor:pointer;font-weight:600">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="empty">
                                                Your cart is empty. <a href="{{ route('home') }}">Continue shopping</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="totals">
                        <div class="panel">
                            <div class="line total">
                                <div>Total</div>
                                <div id="totalVal">${{ number_format($totalAmount ?? 0, 2) }}</div>
                            </div>

                            <a href="{{ route('checkout.page') }}" class="checkout-button">Proceed to Checkout</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
