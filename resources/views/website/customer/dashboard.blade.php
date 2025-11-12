<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- FAVICON AND TOUCH ICONS -->
    <link rel="shortcut icon" href="{{ asset($website_settings->website_favicon ?? '') }}" type="image/x-icon">

    <title>{{ Auth::user()->name }} - Dashboard</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('frontend') }}/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/customer-dashboard.css') }}">
</head>

<body>

    <!-- Mobile Offcanvas Sidebar -->
    <div class="offcanvas offcanvas-start offcanvas-lg" tabindex="-1" id="mobileSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title d-flex align-items-center gap-2">
                <span class="logo">
                    <img class="rounded-4" id="mobileProfileImage" src="{{ asset(Auth::user()->image) }}" alt="Profile"
                        class="profile-image" width="50" height="50">
                </span>
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

                <a class="nav-link logout-button" href="#"
                    onclick="event.preventDefault(); document.getElementById('customer-logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>

                <form id="customer-logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </div>
    </div>

    <div class="app-wrap d-grid" style="grid-template-columns:260px 1fr; min-height:100vh;">
        <!-- Sidebar (desktop) -->
        @include('website.customer.inc.sidebar')

        <!-- Main -->
        <main class="d-flex flex-column min-vh-100">
            <!-- Topbar -->
            @include('website.customer.inc.header')

            <!-- Content -->
            <div class="container-fluid py-4 px-3 px-lg-4 flex-grow-1">
                <!-- KPI Row -->
                <div class="row g-3 g-lg-4 row-cols-2 row-cols-md-3">
                    <div class="col">
                        <div class="card card-modern h-100">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-secondary small">Total Orders</div>
                                    <div class="fs-3 fw-bold">{{ $orderCount }}</div>
                                    <div class="small text-success"><i class="bi bi-arrow-up-right"></i>
                                        {{ $percentageChange }}% this
                                        month</div>
                                </div>
                                <div class="rounded-3 p-3 bg-primary-subtle text-primary"><i class="bi bi-bag fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-modern h-100">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-secondary small">Pending</div>
                                    <div class="fs-3 fw-bold">{{ $pendingOrderCount }}</div>
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
                                    <div class="text-secondary small">Received</div>
                                    <div class="fs-3 fw-bold">{{ $receivedOrderCount }}</div>
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
                                    <div class="text-secondary small">Completed</div>
                                    <div class="fs-3 fw-bold">{{ $completedOrderCount }}</div>
                                    <div class="small text-warning"><i class="bi bi-clock"></i> Done</div>
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
                                    <div class="text-secondary small">Cancelled</div>
                                    <div class="fs-3 fw-bold">{{ $cancelledOrderCount }}</div>
                                    <div class="small text-warning"><i class="bi bi-clock"></i> Cancel</div>
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
                                    <div class="text-secondary small">Spent (USD)</div>
                                    <div class="fs-3 fw-bold">$ {{ $totalAmount }}</div>
                                    <div class="small text-secondary">Incl. NO VAT</div>
                                </div>
                                <div class="rounded-3 p-3 bg-success-subtle text-success"><i
                                        class="bi bi-cash-coin fs-4"></i></div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col">
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
                    </div> --}}
                </div>




                <!-- Charts & Activity -->
                {{-- <div class="row g-3 g-lg-4 mt-1">
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
                </div> --}}

                <!-- Orders & Profile -->
                <div class="row g-3 g-lg-4 mt-1">
                    @include('website.customer.inc.recent-order')

                    @include('website.customer.inc.profile-setting')
                </div>

                <!-- Settings -->
                @include('website.customer.inc.account-setting')

            </div>


            <!-- Change Password Modal -->
            @include('website.customer.change-password')



            <!-- Footer -->
            <footer class="app-footer py-3 text-center">
                <div>© <span id="year"></span> {{ $website_settings->footer_copyright_text ?? '' }}</div>
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
    <script src="{{ asset('backend') }}/assets/js/sweetalert2.js"></script>
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
        $(document).ready(function() {
            $(document).on('click', '.deleteBtn', function() {
                let button = $(this);
                let form = button.closest('form');
                let rowId = button.data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>



    <script>
        // Demo: set welcome name if available from your backend
        // document.getElementById('welcomeName').textContent = 'Customer';
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

    <script>
        $(document).ready(function() {

            // when click on camera icon → open file picker
            $('#cameraBtn').on('click', function() {
                $('#profileFile').trigger('click');
            });

            // when a file is chosen → upload
            $('#profileFile').on('change', function() {
                const file = this.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('image', file);
                formData.append('_method', 'PUT'); // spoof PUT request

                $('#cameraBtn').prop('disabled', true);

                $.ajax({
                    url: "{{ route('customer.profile.image.update') }}",
                    type: "POST", // POST + _method=PUT
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // ✅ main fix
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        // instantly update profile image
                        $('#profileImage').attr('src', response.image_url + '?t=' + Date.now());

                        $('#topHeaderImage').attr('src', response.image_url + '?t=' + Date
                            .now());

                        $('#customerpanelprofileImage').attr('src', response.image_url + '?t=' +
                            Date.now());

                        $('#mobileProfileImage').attr('src', response.image_url + '?t=' + Date
                            .now());
                    },
                    error: function(xhr) {
                        toastr.error('Image upload failed!');
                    },
                    complete: function() {
                        $('#cameraBtn').prop('disabled', false);
                        $('#profileFile').val('');
                    }
                });
            });

        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', function() {
                    const target = document.getElementById(this.dataset.target);
                    const icon = this.querySelector('i');

                    if (target.type === 'password') {
                        target.type = 'text';
                        icon.classList.remove('bi-eye');
                        icon.classList.add('bi-eye-slash');
                    } else {
                        target.type = 'password';
                        icon.classList.remove('bi-eye-slash');
                        icon.classList.add('bi-eye');
                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            // click handler for any .openOrderModal button
            $(document).on('click', '.openOrderModal', function(e) {
                e.preventDefault();
                let url = $(this).data('url');

                // show modal and loader
                $('#orderModalContent').hide().empty();
                $('#orderModalLoading').show();
                var myModal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
                myModal.show();

                // fetch partial via AJAX
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'html',
                    success: function(html) {
                        $('#orderModalLoading').hide();
                        $('#orderModalContent').html(html).show();
                    },
                    error: function(xhr, status, err) {
                        $('#orderModalLoading').hide();
                        $('#orderModalContent').html(
                            '<div class="alert alert-danger">Unable to load order details. Please try again.</div>'
                            ).show();
                        console.error(err);
                    }
                });
            });
        });
    </script>



</body>

</html>
