<aside class="sidebar d-none d-lg-flex flex-column">
            <div class="brand d-flex align-items-center gap-3">
                <div class="logo">
                    <img class="rounded-4" id="customerpanelprofileImage" src="{{ asset(Auth::user()->image) }}"
                        alt="Profile" class="profile-image" width="50" height="50">
                </div>
                <div class="d-flex flex-column">
                    <span class="fw-semibold">Customer Panel</span>
                    <small class="text-secondary">Welcome, <span id="welcomeName">
                            {{ Auth::user()->name ?? 'Customer' }}

                        </span>
                    </small>
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
