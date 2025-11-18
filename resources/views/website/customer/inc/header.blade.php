 <header class="topbar d-flex align-items-center px-3 px-lg-4">
     <div class="d-flex align-items-center gap-2 w-100">
         <div class="d-flex align-items-center gap-2">
             <button class="btn btn-link d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar"><i
                     class="bi bi-list fs-4"></i></button>
             <span class="fw-semibold">Dashboard</span>
         </div>
         <!-- Mobile search (shown < md) -->
         <div class="ms-auto flex-grow-1 d-md-none search-mobile">
             <a class="btn btn-outline-primary btn-sm" href="{{ route('home') }}">Visit Website</a>
             {{-- <div class="input-group" style="display:none">
                            <span class="input-group-text bg-transparent"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control border-start-0"
                                placeholder="Search orders, products...">
                        </div> --}}
         </div>
         <!-- Desktop search (>= md) -->
         <div class="ms-auto d-none d-md-block">
             <a class="btn btn-outline-primary" href="{{ route('home') }}" target="_blank">Visit Website</a>
             {{-- <div class="input-group" style="display:none">
                            <span class="input-group-text bg-transparent"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control border-start-0"
                                placeholder="Search orders, products...">
                        </div> --}}
         </div>
         <button id="themeToggle" class="btn btn-outline-secondary ms-2 d-none d-md-inline-flex" title="Toggle theme"><i
                 class="bi bi-moon-stars"></i></button>
         <div class="dropdown ms-1">
             <button class="btn btn-light border-0 d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                 @if (Auth::user()->image)
                     <img id="topHeaderImage" src="{{ asset(Auth::user()->image) }}" class="rounded-circle"
                         width="32" height="32" alt="avatar">
                 @else
                     <img id="topHeaderImage" src="https://i.pravatar.cc/40?img=12" class="rounded-circle"
                         width="32" height="32" alt="avatar">
                 @endif

                 <span class="d-none d-sm-inline fw-medium">{{ Auth::user()->name ?? '' }}</span>
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

                 <form id="customer-logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>

             </div>
         </div>
     </div>
 </header>
