<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            @if (Auth::user()->image)
                <img src="{{ asset(Auth::user()->image) }}" width="48" height="48" alt="User" />
            @else
                <img src="{{ asset('backend') }}/assets/images/xs/avatar1.jpg" width="48" height="48"
                    alt="User" />
            @endif

        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown">{{ Auth::user()->name }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                    role="button"> keyboard_arrow_down </i>
                <ul class="dropdown-menu slideUp">
                    <li>
                        <a href="{{ route('profile.setting.index') }}">
                            <i class="material-icons">person</i>Profile
                        </a>
                    </li>

                    <li class="divider"></li>

                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>Sign Out
                        </a>
                    </li>
                </ul>

                <!-- Hidden form (UL-এর বাইরে) -->
                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                    @csrf
                </form>

            </div>
            @php
                $email = Auth::user()->email ?? '';
                if (str_contains($email, '@')) {
                    [$local, $domain] = explode('@', $email, 2);
                    $prefix = mb_substr($local, 0, 6); // প্রথম ৬ অক্ষর
                    $masked = $prefix . '***' . '@' . $domain;
                } else {
                    $masked = $email; // fallback
                }
            @endphp

            <div class="email">{{ $masked }}</div>

        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="zmdi zmdi-home"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('home.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-home"></i><span>Home</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('home.hero.section.*') ? 'active' : '' }}">
                        <a href="{{ route('home.hero.section.index') }}">Hero Section</a>
                    </li>
                </ul>
            </li>



            <li class="{{ request()->routeIs(['services.*']) ? 'active open' : '' }}"><a href="{{ route('services.index') }}"><i class="zmdi zmdi-collection-plus"></i><span>Services</span> </a></li>


            <li
                class="menu-item {{ request()->routeIs(['category.*', 'case.study.*']) ? 'active open' : '' }}">

                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-case"></i><span>Case Studies</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('category.*') ? 'active' : '' }}">
                        <a href="{{ route('category.index') }}">Category</a>
                    </li>

                    <li class="{{ request()->routeIs('case.study.*') ? 'active' : '' }}">
                        <a href="{{ route('case.study.index') }}">Case Study</a>
                    </li>

                </ul>
            </li>


            <li class="menu-item {{ request()->routeIs(['user.management.*']) ? 'active open' : '' }}">
                <a href="{{ route('user.management.index') }}">
                    <i class="zmdi zmdi-accounts"></i><span>Users</span>
                </a>
            </li>


            <li
                class="menu-item {{ request()->routeIs(['website_settings.*', 'social.icon.*', 'website.color.*', 'login.page.*']) ? 'active open' : '' }}">

                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-settings"></i><span>Settings</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('website_settings.*') ? 'active' : '' }}">
                        <a href="{{ route('website_settings.index') }}">Website Settings</a>
                    </li>
                    <li class="{{ request()->routeIs('social.icon.*') ? 'active' : '' }}">
                        <a href="{{ route('social.icon.index') }}">Social Icon</a>
                    </li>
                    <li class="{{ request()->routeIs('website.color.*') ? 'active' : '' }}">
                        <a href="{{ route('website.color.index') }}">Website Color Settings</a>
                    </li>
                    <li class="{{ request()->routeIs('login.page.*') ? 'active' : '' }}">
                        <a href="{{ route('login.page.index') }}">Login Page Settings</a>
                    </li>
                </ul>
            </li>


            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();"><i
                            class="zmdi zmdi-chart-donut col-red"></i><span>Logout</span>
                    </a>
                </li>
            </form>

        </ul>
    </div>
    <!-- #Menu -->
</aside>
