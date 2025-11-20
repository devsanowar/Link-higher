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

            <li
                class="menu-item {{ request()->routeIs('home.*', 'home.smart-strategy.*', 'home.smarter-workflows.*', 'home.goal-progress-insight.*', 'home.smart-solution.*', 'home.count-down.*', 'home.why-chose-us.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-home"></i><span>Home</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('home.hero.section.*') ? 'active' : '' }}">
                        <a href="{{ route('home.hero.section.index') }}">Hero Section</a>
                    </li>

                    <li class="{{ request()->routeIs('home.smart-strategy.*') ? 'active' : '' }}">
                        <a href="{{ route('home.smart-strategy.index') }}">Smart Strategy</a>
                    </li>

                    {{-- <li class="{{ request()->routeIs('home.smarter-workflows.*') ? 'active' : '' }}">
                        <a href="{{ route('home.smarter-workflows.index') }}">Smarter Workflows</a>
                    </li> --}}

                    {{-- <li class="{{ request()->routeIs('home.goal-progress-insight.*') ? 'active' : '' }}">
                        <a href="{{ route('home.goal-progress-insight.index') }}">Goal Progress Insights</a>
                    </li> --}}

                    {{-- <li
                        class="{{ request()->routeIs('home.smart-solution.*', 'home.smart-solution-features.*') ? 'active' : '' }}">
                        <a href="{{ route('home.smart-solution.index') }}">Smart Solution</a>
                    </li> --}}

                    <li class="{{ request()->routeIs('home.achievements.*') ? 'active' : '' }}">
                        <a href="{{ route('home.achievements.index') }}">Achievements</a>
                    </li>



                    <li class="{{ request()->routeIs('home.why-chose-us.*', 'home.reason.*') ? 'active' : '' }}">
                        <a href="{{ route('home.why-chose-us.index') }}">Why chose us</a>
                    </li>

                    {{-- <li class="{{ request()->routeIs('home.customer-focus-tone.*') ? 'active' : '' }}">
                        <a href="{{ route('home.customer-focus-tone.index') }}">Customer focus tone</a>
                    </li> --}}

                    <li class="{{ request()->routeIs('home.cta.*') ? 'active' : '' }}">
                        <a href="{{ route('home.cta.index') }}">CTA</a>
                    </li>

                </ul>
            </li>


            <li
                class="menu-item {{ request()->routeIs('about-page.*', 'about-page.mission-vision.*', 'about-page.who-we-are.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-view-list"></i><span>About Page</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('about-page.about-us.*') ? 'active' : '' }}">
                        <a href="{{ route('about-page.about-us.index') }}">About Us</a>
                    </li>

                    <li class="{{ request()->routeIs('about-page.mission-vision.*') ? 'active' : '' }}">
                        <a href="{{ route('about-page.mission-vision.index') }}">Mission & Vision</a>
                    </li>

                    <li class="{{ request()->routeIs('about-page.who-we-are.*') ? 'active' : '' }}">
                        <a href="{{ route('about-page.who-we-are.index') }}">Who We Are</a>
                    </li>

                </ul>
            </li>


            <!--Post with category Menu-->
            <li class="menu-item {{ request()->routeIs(['post-category.*', 'post.*']) ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-edit"></i><span>Post</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('post-category.*') ? 'active' : '' }}">
                        <a href="{{ route('post-category.index') }}">Category</a>
                    </li>

                    <li class="{{ request()->routeIs('post.*') ? 'active' : '' }}">
                        <a href="{{ route('post.index') }}">Posts</a>
                    </li>

                </ul>
            </li>


            <li class="menu-item {{ request()->routeIs('product-category.*', 'products.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-shopping-cart"></i><span>Product</span>
                </a>
                <ul class="ml-menu">
                    {{-- <li class="{{ request()->routeIs('product-category.*') ? 'active' : '' }}">
                        <a href="{{ route('product-category.index') }}">Category</a>
                    </li> --}}

                    <li class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                        <a href="{{ route('products.index') }}">Sites</a>
                    </li>
                </ul>
            </li>

            <!--Services Menu-->
            <li
                class="menu-item {{ request()->routeIs('service-category.*', 'services.*', 'package_plans.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-collection-plus"></i><span>Services</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('service-category.*') ? 'active' : '' }}">
                        <a href="{{ route('service-category.index') }}">Category</a>
                    </li>

                    <li class="{{ request()->routeIs('services.*') ? 'active' : '' }}">
                        <a href="{{ route('services.index') }}">Services</a>
                    </li>

                    <li class="{{ request()->routeIs('package_plans.*') ? 'active' : '' }}">
                        <a href="{{ route('package_plans.index') }}">Package Plan</a>
                    </li>
                </ul>
            </li>

            <!--Services Menu-->
            <li class="menu-item {{ request()->routeIs('order.*', 'invoice.page.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">


                    <i class="zmdi zmdi-shopping-basket"></i>

                    <span>Orders</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('order.*') ? 'active' : '' }}">
                        <a href="{{ route('order.index') }}">All Order</a>
                    </li>

                    <li class="{{ request()->routeIs('invoice.page.*') ? 'active' : '' }}">
                        <a href="{{ route('invoice.page.index') }}">Invoice</a>
                    </li>
                </ul>
            </li>



            <!--Employe Menu-->
            <li class="{{ request()->routeIs(['country.*']) ? 'active open' : '' }}">
                <a href="{{ route('country.index') }}"><i class="zmdi zmdi-flag"></i><span>Country</span>
                </a>
            </li>



            <!--Project with category Menu-->
            {{-- <li class="menu-item {{ request()->routeIs(['project-category.*', 'project.*']) ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-case"></i><span>Portfolio</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('project-category.*') ? 'active' : '' }}">
                        <a href="{{ route('project-category.index') }}">Category</a>
                    </li>

                    <li class="{{ request()->routeIs('project.*') ? 'active' : '' }}">
                        <a href="{{ route('project.index') }}">Projects</a>
                    </li>

                </ul>
            </li> --}}

            <!--Employe Menu-->
            <li class="{{ request()->routeIs(['employe.*']) ? 'active open' : '' }}">
                <a href="{{ route('employe.index') }}"><i class="zmdi zmdi-accounts"></i><span>Employes</span>
                </a>
            </li>



            <!--FAQ Menu-->
            <li class="{{ request()->routeIs(['faqs.*']) ? 'active open' : '' }}"><a
                    href="{{ route('faqs.index') }}"><i class="zmdi zmdi-collection-plus"></i><span>FAQs</span> </a>
            </li>

            <!--Review Menu-->
            <li class="{{ request()->routeIs(['reviews.*']) ? 'active open' : '' }}"><a
                    href="{{ route('reviews.index') }}"><i class="zmdi zmdi-ticket-star"></i><span>Rivews</span> </a>
            </li>

            <!--Trusted Menu-->
            <li class="{{ request()->routeIs(['clients.*']) ? 'active open' : '' }}"><a
                    href="{{ route('clients.index') }}"><i class="zmdi zmdi-accounts"></i><span>Trusted Client</span>
                </a></li>


            <li class="menu-item {{ request()->routeIs(['category.*', 'case.study.*']) ? 'active open' : '' }}">

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

            <!--Contact message Menu-->
            <li class="{{ request()->routeIs(['contact.messages.*']) ? 'active open' : '' }}">
                <a href="{{ route('contact.messages.index') }}"><i class="zmdi zmdi-email"></i><span>Message</span>
                </a>
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

            <li class="header">LEGAL PAGE</li>

            <li class="menu-item {{ request()->routeIs(['privacy.policy.*']) ? 'active open' : '' }}">
                <a href="{{ route('privacy.policy.index') }}">
                    <i class="zmdi zmdi-comment-list"></i>
                    <span>Privacy Policy</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs(['terms.and.conditions.*']) ? 'active open' : '' }}">
                <a href="{{ route('terms.and.conditions.index') }}">
                    <i class="zmdi zmdi-comment-list"></i>
                    <span>Terms & Conditions</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs(['return.refund.policy.*']) ? 'active open' : '' }}">
                <a href="{{ route('return.refund.policy.index') }}">
                    <i class="zmdi zmdi-comment-list"></i>
                    <span>Return & Refund</span>
                </a>
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
