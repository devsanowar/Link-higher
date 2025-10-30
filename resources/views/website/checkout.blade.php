<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Minimal Checkout — Bootstrap 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @include('website.inc.style')
</head>

<body>

    @include('website.inc.header')

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

    <div class="container">
        <div class="checkout-wrap">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h1 class="h-title">Checkout</h1>
                    {{-- <p class="h-sub">Simple, clear, and fast — review and place your order.</p> --}}
                </div>
                {{-- <div class="text-end text-muted small">
                    <div>Order #<strong>4579</strong></div>
                    <div class="mt-1">Estimated delivery: <strong>3–5 business days</strong></div>
                </div> --}}
            </div>

            <div class="row g-4">
                <!-- LEFT: billing & shipping form -->
                <div class="col-lg-7">
                    <div class="card-form">
                        <h5 class="mb-3">Billing details</h5>
                        <form id="checkoutForm" novalidate>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label required">Full name</label>
                                    <input type="text" class="form-control" placeholder="John Doe" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">Email</label>
                                    <input type="email" class="form-control" placeholder="john@example.com" required>
                                </div>

                                

                                <div class="col-12">
                                    <label class="form-label required">Country</label>
                                    <input type="text" class="form-control"
                                        placeholder="Country" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">City</label>
                                    <input type="text" class="form-control" placeholder="Enter city" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label required">State</label>
                                    <input type="text" class="form-control" placeholder="State" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label required">ZIP</label>
                                    <input type="text" class="form-control" placeholder="1207" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Phone</label>
                                    <input type="tel" class="form-control" placeholder="(+880) 1XXXXXXXXX">
                                </div>



                                <div id="shippingSection" class="col-12" style="display:none">
                                    <hr>
                                    <h6 class="mb-3">Shipping address</h6>
                                    <div class="row g-3">
                                        <div class="col-12"><input class="form-control" placeholder="Shipping address">
                                        </div>
                                        <div class="col-md-6"><input class="form-control" placeholder="City"></div>
                                        <div class="col-md-3"><input class="form-control" placeholder="State"></div>
                                        <div class="col-md-3"><input class="form-control" placeholder="ZIP"></div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3 mb-3">
                                    <h6 class="mb-2">Payment</h6>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <label class="btn btn-outline-secondary btn-sm active">
                                            <input type="radio" class="btn-check" name="payment" autocomplete="off"
                                                checked> <i class="bi bi-credit-card me-1"></i> Card
                                        </label>
                                        <label class="btn btn-outline-secondary btn-sm">
                                            <input type="radio" class="btn-check" name="payment" autocomplete="off">
                                            <i class="bi bi-bank me-1"></i> Bank Transfer
                                        </label>
                                        <label class="btn btn-outline-secondary btn-sm">
                                            <input type="radio" class="btn-check" name="payment"
                                                autocomplete="off">
                                            <i class="bi bi-wallet2 me-1"></i> Mobile Wallet
                                        </label>
                                    </div>


                                </div>

                                <div class="col-12 mt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">By placing the order you agree to our <a
                                                href="{{ route('terms.condition.page') }}" class="text-danger">terms & conditions</a>.</small>
                                        <button type="submit" class="btn btn-primary custom-submit-button">Place
                                            order</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <!-- RIGHT: Order summary -->
                <div class="col-lg-5">
                    <div class="summary">
                        <h4 class="mb-2">Order summary</h4>
                        <p style="border-bottom:1px solid #cccccca6"></p>

                        <div class="mb-3 product-line">

                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div style="font-weight:600">Yamaha MT-15 — Matte</div>

                                    </div>
                                    <div class="text-end">
                                        <div style="font-weight:600">৳3,200</div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-2">
                            <div class="text-muted">Subtotal</div>
                            <div>৳3,200</div>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <div class="text-muted">Shipping</div>
                            <div>৳150</div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="text-muted">VAT</div>
                            <div>৳100</div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center"
                            style="font-size:1.05rem;font-weight:700">
                            <div>Total</div>
                            <div>৳3,450</div>
                        </div>

                        <div class="mt-3">
                            <small class="text-muted">Need help? <a href="{{ route('contact.page') }}">Contact support</a></small>
                        </div>
                    </div>

                    <div class="mt-3 text-center small text-muted">Secure payments • SSL encrypted • 30-day returns
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('website.inc.footer')

    @include('website.inc.script')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        // basic validation
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                this.classList.add('was-validated');
                window.scrollTo({
                    top: 100,
                    behavior: 'smooth'
                });
            } else {
                e.preventDefault();
                // show lightweight success action (in real app, submit to server)
                const btn = this.querySelector('button[type="submit"]');
                btn.innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
                btn.disabled = true;
                setTimeout(() => {
                    btn.innerHTML = 'Order placed ✓';
                    btn.classList.remove('btn-primary-strong');
                    btn.classList.add('btn-success');
                }, 900);
            }
        });
    </script>
</body>

</html>
