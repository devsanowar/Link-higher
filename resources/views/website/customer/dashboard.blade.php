<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Customer Dashboard</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend') }}/css/toastr.min.css">
    <style>
        :root {
            --brand: #2563eb;
            --bg-soft: #f6f8fb;
        }

        body {
            background: var(--bg-soft);
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #fff;
            border-right: 1px solid rgba(0, 0, 0, .06);
        }

        .sidebar .brand {
            padding: 18px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, .06);
        }

        .sidebar .brand .logo {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            background: var(--brand);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: .6rem;
            color: #475569;
            border-radius: 12px;
            padding: .65rem .9rem;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #eef2ff;
            color: #1f2937;
        }

        /* Topbar */
        .topbar {
            height: 64px;
            background: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, .06);
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        /* Cards */
        .card-modern {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .06);
        }

        /* Table */
        .table-modern> :not(caption)>*>* {
            padding: 1rem 1rem;
        }

        /* Footer */
        .app-footer {
            color: #64748b;
            font-size: .9rem;
        }

        /* Mobile tab bar */
        .mobile-tabbar {
            height: 58px;
        }

        .mobile-tabbar .nav-link {
            flex: 1 1 0;
            text-align: center;
            padding: .5rem 0;
            color: #64748b;
        }

        .mobile-tabbar .nav-link.active {
            color: #111827;
        }

        /* Responsive layout */
        @media (max-width: 992px) {
            .app-wrap {
                grid-template-columns: 1fr !important;
            }

            .sidebar {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .topbar {
                height: 56px;
            }

            .card-modern {
                border-radius: .9rem;
            }

            .table-modern> :not(caption)>*>* {
                padding: .8rem .8rem;
            }

            .search-mobile {
                display: block !important;
            }
        }

        @media (min-width: 993px) {
            .offcanvas-lg {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Mobile Offcanvas Sidebar -->
    <div class="offcanvas offcanvas-start offcanvas-lg" tabindex="-1" id="mobileSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title d-flex align-items-center gap-2">
                <span class="logo">C</span>
                <span class="fw-semibold">Customer Panel</span>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-2">
            <nav class="px-2">
                <a class="nav-link active" href="#"><i class="bi bi-grid-1x2"></i> Dashboard</a>
                <a class="nav-link" href="#orders"><i class="bi bi-bag"></i> Orders</a>
                <a class="nav-link" href="#profile"><i class="bi bi-person"></i> Profile</a>
                <a class="nav-link" href="#settings"><i class="bi bi-gear"></i> Settings</a>
                <hr>
                <a class="nav-link" href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </nav>
        </div>
    </div>

    <div class="app-wrap d-grid" style="grid-template-columns:260px 1fr; min-height:100vh;">
        <!-- Sidebar (desktop) -->
        <aside class="sidebar d-none d-lg-flex flex-column">
            <div class="brand d-flex align-items-center gap-3">
                <div class="logo">C</div>
                <div class="d-flex flex-column">
                    <span class="fw-semibold">Customer Panel</span>
                    <small class="text-secondary">Welcome, <span id="welcomeName">Customer</span></small>
                </div>
            </div>
            <div class="p-2">
                <nav class="nav flex-column">
                    <a class="nav-link active" href="#"><i class="bi bi-grid-1x2"></i> Dashboard</a>
                    <a class="nav-link" href="#orders"><i class="bi bi-bag"></i> Orders</a>
                    <a class="nav-link" href="#wishlist"><i class="bi bi-heart"></i> Wishlist</a>
                    <a class="nav-link" href="#addresses"><i class="bi bi-geo-alt"></i> Addresses</a>
                    <a class="nav-link" href="#profile"><i class="bi bi-person"></i> Profile</a>
                    <a class="nav-link" href="#settings"><i class="bi bi-gear"></i> Settings</a>
                    <hr class="my-2">
                    <a class="nav-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('customer-logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>

                    <form id="customer-logout-form" action="{{ route('customer.logout') }}" method="POST"
                        class="d-none">
                        @csrf
                    </form>

                </nav>
            </div>
            <div class="mt-auto p-3 small text-secondary">
                <div class="d-flex align-items-center gap-2"><i class="bi bi-shield-check"></i> Secure Account</div>
                <div class="d-flex align-items-center gap-2 mt-2"><i class="bi bi-headset"></i> 24/7 Support</div>
            </div>
        </aside>

        <!-- Main -->
        <main class="d-flex flex-column min-vh-100">
            <!-- Topbar -->
            <header class="topbar d-flex align-items-center px-3 px-lg-4">
                <div class="d-flex align-items-center gap-2 w-100">
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-link d-lg-none" data-bs-toggle="offcanvas"
                            data-bs-target="#mobileSidebar"><i class="bi bi-list fs-4"></i></button>
                        <span class="fw-semibold">Dashboard</span>
                    </div>
                    <!-- Mobile search (shown < md) -->
                    <div class="ms-auto flex-grow-1 d-md-none search-mobile" style="display:none;">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control border-start-0"
                                placeholder="Search orders, products...">
                        </div>
                    </div>
                    <!-- Desktop search (>= md) -->
                    <div class="ms-auto d-none d-md-block">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control border-start-0"
                                placeholder="Search orders, products...">
                        </div>
                    </div>
                    <button id="themeToggle" class="btn btn-outline-secondary ms-2 d-none d-md-inline-flex"
                        title="Toggle theme"><i class="bi bi-moon-stars"></i></button>
                    <div class="dropdown ms-1">
                        <button class="btn btn-light border-0 d-flex align-items-center gap-2"
                            data-bs-toggle="dropdown">
                            <img src="https://i.pravatar.cc/40?img=12" class="rounded-circle" width="32"
                                height="32" alt="avatar">
                            <span class="d-none d-sm-inline fw-medium">{{ Auth::user()->system_admin ?? '' }} h</span>
                            <i class="bi bi-chevron-down small"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end shadow">
                            <h6 class="dropdown-header">Signed in as</h6>
                            <div class="px-3 pb-2 small text-secondary">{{ Auth::user()->email ?? '' }}</div>
                            <a class="dropdown-item" href="#profile"><i class="bi bi-person me-2"></i>Profile</a>
                            <a class="dropdown-item" href="#settings"><i class="bi bi-gear me-2"></i>Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('customer-logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>

                            <form id="customer-logout-form" action="{{ route('customer.logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>

                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="container-fluid py-4 px-3 px-lg-4 flex-grow-1">
                <!-- KPI Row -->
                <div class="row g-3 g-lg-4 row-cols-2 row-cols-md-4">
                    <div class="col">
                        <div class="card card-modern h-100">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-secondary small">Total Orders</div>
                                    <div class="fs-3 fw-bold">128</div>
                                    <div class="small text-success"><i class="bi bi-arrow-up-right"></i> 4.5% this
                                        month</div>
                                </div>
                                <div class="rounded-3 p-3 bg-primary-subtle text-primary"><i
                                        class="bi bi-bag fs-4"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-modern h-100">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-secondary small">Pending</div>
                                    <div class="fs-3 fw-bold">6</div>
                                    <div class="small text-warning"><i class="bi bi-clock"></i> Processing</div>
                                </div>
                                <div class="rounded-3 p-3 bg-warning-subtle text-warning"><i
                                        class="bi bi-hourglass-split fs-4"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-modern h-100">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-secondary small">Spent (BDT)</div>
                                    <div class="fs-3 fw-bold">৳ 58,420</div>
                                    <div class="small text-secondary">Incl. VAT</div>
                                </div>
                                <div class="rounded-3 p-3 bg-success-subtle text-success"><i
                                        class="bi bi-cash-coin fs-4"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-modern h-100">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-secondary small">Rewards</div>
                                    <div class="fs-3 fw-bold">1,240 pts</div>
                                    <div class="small text-success">+120 this month</div>
                                </div>
                                <div class="rounded-3 p-3 bg-info-subtle text-info"><i class="bi bi-gift fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts & Activity -->
                <div class="row g-3 g-lg-4 mt-1">
                    <div class="col-12 col-xl-7">
                        <div class="card card-modern h-100">
                            <div
                                class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Orders Overview</h5>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Range">
                                    <button class="btn btn-outline-secondary active">30d</button>
                                    <button class="btn btn-outline-secondary">90d</button>
                                    <button class="btn btn-outline-secondary">1y</button>
                                </div>
                            </div>
                            <div class="card-body" style="min-height:220px;">
                                <canvas id="ordersChart" height="120"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-5">
                        <div class="card card-modern h-100">
                            <div class="card-header bg-transparent border-0">
                                <h5 class="mb-0">Recent Activity</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex align-items-start gap-3">
                                        <i class="bi bi-check2-circle text-success fs-5"></i>
                                        <div>
                                            <div class="fw-semibold">Order #INV-1098 delivered</div>
                                            <small class="text-secondary">Today at 14:21</small>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-start gap-3">
                                        <i class="bi bi-truck text-primary fs-5"></i>
                                        <div>
                                            <div class="fw-semibold">Order #INV-1120 shipped</div>
                                            <small class="text-secondary">Yesterday</small>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-start gap-3">
                                        <i class="bi bi-chat-dots text-info fs-5"></i>
                                        <div>
                                            <div class="fw-semibold">Support replied to your ticket</div>
                                            <small class="text-secondary">2 days ago</small>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders & Profile -->
                <div class="row g-3 g-lg-4 mt-1">
                    <div class="col-12 col-xxl-7" id="orders">
                        <div class="card card-modern">
                            <div
                                class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Recent Orders</h5>
                                <a href="#" class="btn btn-sm btn-primary">View all</a>
                            </div>
                            <div class="table-responsive d-none d-sm-block">
                                <table class="table table-modern align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-medium">#INV-1123</td>
                                            <td>Oct 26, 2025</td>
                                            <td><span
                                                    class="badge bg-success-subtle text-success border border-success-subtle">Delivered</span>
                                            </td>
                                            <td>৳ 2,980</td>
                                            <td><button class="btn btn-sm btn-outline-secondary">Details</button></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">#INV-1122</td>
                                            <td>Oct 24, 2025</td>
                                            <td><span
                                                    class="badge bg-warning-subtle text-warning border border-warning-subtle">Processing</span>
                                            </td>
                                            <td>৳ 4,250</td>
                                            <td><button class="btn btn-sm btn-outline-secondary">Details</button></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">#INV-1121</td>
                                            <td>Oct 22, 2025</td>
                                            <td><span
                                                    class="badge bg-info-subtle text-info border border-info-subtle">Shipped</span>
                                            </td>
                                            <td>৳ 1,750</td>
                                            <td><button class="btn btn-sm btn-outline-secondary">Details</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Mobile order cards -->
                            <div class="d-sm-none p-2">
                                <div class="card mb-2 border-0 shadow-sm">
                                    <div class="card-body d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fw-semibold">#INV-1123</div>
                                            <small class="text-secondary">Oct 26, 2025</small>
                                            <div class="mt-1"><span
                                                    class="badge bg-success-subtle text-success border border-success-subtle">Delivered</span>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-semibold">৳ 2,980</div>
                                            <button class="btn btn-sm btn-outline-secondary mt-2">Details</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-2 border-0 shadow-sm">
                                    <div class="card-body d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fw-semibold">#INV-1122</div>
                                            <small class="text-secondary">Oct 24, 2025</small>
                                            <div class="mt-1"><span
                                                    class="badge bg-warning-subtle text-warning border border-warning-subtle">Processing</span>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-semibold">৳ 4,250</div>
                                            <button class="btn btn-sm btn-outline-secondary mt-2">Details</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-2 border-0 shadow-sm">
                                    <div class="card-body d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fw-semibold">#INV-1121</div>
                                            <small class="text-secondary">Oct 22, 2025</small>
                                            <div class="mt-1"><span
                                                    class="badge bg-info-subtle text-info border border-info-subtle">Shipped</span>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-semibold">৳ 1,750</div>
                                            <button class="btn btn-sm btn-outline-secondary mt-2">Details</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xxl-5" id="profile">
                        <div class="card card-modern h-100">
                            <div class="card-header bg-transparent border-0">
                                <h5 class="mb-0">Profile</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <img src="https://i.pravatar.cc/72?img=12" class="rounded-4" width="72"
                                        height="72" alt="avatar">
                                    <div>
                                        <div class="fw-bold fs-5">Jabir IT</div>
                                        <div class="text-secondary small">customer@example.com</div>
                                    </div>
                                </div>
                                <form id="customerProfileUpdate" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Full Name</label>
                                            <input type="name" class="form-control" name="name"
                                                placeholder="Your name" value="{{ Auth::user()->name ?? '' }}" />
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" placeholder="01XXXXXXXXX"
                                                name="phone" value="{{ Auth::user()->phone ?? '' }}" />
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control"
                                                placeholder="example@gmail.com" name="email"
                                                value="{{ Auth::user()->email ?? '' }}" />
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Address</label>
                                            <input type="address" class="form-control" name="address"
                                                placeholder="House, Road, City"
                                                value="{{ Auth::user()->address ?? '' }}" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">About Customer</label>
                                            <textarea name="about" id="about" class="form-control" rows="4">{!! Auth::user()->about ?? '' !!}</textarea>
                                        </div>
                                        <div class="col-12 d-grid d-sm-flex gap-2">
                                            <button type="submit" class="btn btn-primary px-3 rounded-0"
                                                id="submitBtn">
                                                <span id="btnText">UPDATE PROFILE</span>
                                                <span id="btnSpinner"
                                                    class="spinner-border spinner-border-sm d-none ms-2"></span>
                                            </button>
                                            <a href="#settings" class="btn btn-outline-secondary">Account Settings</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings -->
                <div class="row g-3 g-lg-4 mt-1" id="settings">
                    <div class="col-12">
                        <div class="card card-modern">
                            <div class="card-header bg-transparent border-0">
                                <h5 class="mb-0">Account Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-12 col-lg-4">
                                        <h6 class="fw-semibold">Security</h6>
                                        <p class="text-secondary small mb-3">Manage password and 2‑factor
                                            authentication to keep your account secure.</p>
                                        <button class="btn btn-outline-primary w-100 mb-2"><i
                                                class="bi bi-key me-2"></i>Change Password</button>
                                        <button class="btn btn-outline-secondary w-100"><i
                                                class="bi bi-shield-lock me-2"></i>Enable 2FA</button>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <h6 class="fw-semibold">Preferences</h6>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked id="emailSwitch">
                                            <label class="form-check-label" for="emailSwitch">Email
                                                notifications</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="smsSwitch">
                                            <label class="form-check-label" for="smsSwitch">SMS alerts</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <h6 class="fw-semibold">Danger Zone</h6>
                                        <p class="text-secondary small mb-2">Delete your account and all associated
                                            data.</p>
                                        <button class="btn btn-outline-danger w-100"
                                            onclick="confirm('Are you sure?') && alert('Account deleted (demo).');"><i
                                                class="bi bi-trash me-2"></i>Delete Account</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <footer class="app-footer py-3 text-center">
                <div>© <span id="year"></span> Your Brand. All rights reserved.</div>
            </footer>

            <!-- Bottom mobile tab bar -->
            <nav class="mobile-tabbar d-lg-none fixed-bottom bg-white border-top">
                <div class="container-fluid px-0">
                    <div class="d-flex">
                        <a class="nav-link active" href="#"><i class="bi bi-grid-1x2"></i>
                            <div class="small">Home</div>
                        </a>
                        <a class="nav-link" href="#orders"><i class="bi bi-bag"></i>
                            <div class="small">Orders</div>
                        </a>
                        <a class="nav-link" href="#profile"><i class="bi bi-person"></i>
                            <div class="small">Profile</div>
                        </a>
                        <a class="nav-link" href="#settings"><i class="bi bi-gear"></i>
                            <div class="small">Settings</div>
                        </a>
                    </div>
                </div>
            </nav>
        </main>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Toastr JS -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js for demo chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <script src="{{ asset('frontend') }}/js/toastr.min.js"></script>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    </script>



    <script>
        // Demo: set welcome name if available from your backend
        document.getElementById('welcomeName').textContent = 'Customer';
        document.getElementById('year').textContent = new Date().getFullYear();

        // Theme toggle (light/dark)
        const themeToggle = document.getElementById('themeToggle');
        themeToggle?.addEventListener('click', () => {
            const html = document.documentElement;
            const current = html.getAttribute('data-bs-theme') || 'light';
            const next = current === 'light' ? 'dark' : 'light';
            html.setAttribute('data-bs-theme', next);
        });

        // Orders chart (dummy data)
        const ctx = document.getElementById('ordersChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                    datasets: [{
                        label: 'Orders',
                        data: [10, 18, 14, 22, 28, 21, 30],
                        tension: .35,
                        fill: true,
                        borderWidth: 2,
                        pointRadius: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    </script>



    <script>
        $(document).ready(function() {

            $("#customerProfileUpdate").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                    url: "{{ route('customer.profile.update') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message || 'Profile updated successfully.');
                        } else {
                            toastr.error(response.message ?? 'Something went wrong!');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            toastr.error('An unexpected error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        $('#btnText').text('UPDATED');
                        $('#btnSpinner').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            });
        });
    </script>

</body>

</html>
