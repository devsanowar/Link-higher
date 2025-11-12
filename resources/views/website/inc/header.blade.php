        <header id="header" class="tra-menu navbar-dark inner-page-header white-scroll w-full block !pt-0">
            <div class="header-wrapper fixed z-[1030] top-0 inset-x-0">
                <!-- MOBILE HEADER -->
                <div class="wsmobileheader clearfix">
                    <span
                        class="smllogo md:max-lg:!block md:max-lg:!mt-[22px] md:max-lg:!pl-[22px] sm:max-md:!block sm:max-md:!mt-[23px] sm:max-md:!pl-[18px] xsm:max-sm:!block xsm:max-sm:!mt-[23px] xsm:max-sm:!pl-[16px]">
                        @if ($website_settings->website_logo)
                            <img class="md:w-auto  md:max-lg:!max-w-[inherit] md:max-lg:!max-h-[34px] sm:max-md:!w-auto sm:max-md:!max-w-[inherit] sm:max-md:!max-h-[34px] xsm:max-sm:!w-auto xsm:max-sm:!max-w-[inherit] xsm:max-sm:!max-h-[34px]"
                                src="{{ $website_settings->website_logo }}" alt="mobile-logo">
                        @else
                            <img class="md:w-auto  md:max-lg:!max-w-[inherit] md:max-lg:!max-h-[34px] sm:max-md:!w-auto sm:max-md:!max-w-[inherit] sm:max-md:!max-h-[34px] xsm:max-sm:!w-auto xsm:max-sm:!max-w-[inherit] xsm:max-sm:!max-h-[34px]"
                                src="{{ asset('frontend') }}/images/logo-purple.png" alt="mobile-logo">
                        @endif

                    </span>
                    <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
                </div>
                <!-- NAVIGATION MENU -->
                <div
                    class="wsmainfull menu clearfix !text-[#b1b7cd] p-[15px_0] w-full h-auto z-[1031] [transition:all_450ms_ease-in-out]">
                    <div class="wsmainwp clearfix">
                        <!-- HEADER BLACK LOGO -->
                        <div class="desktoplogo">
                            <a href="{{ route('home') }}" class="logo-black">
                                @if ($website_settings->website_logo)
                                    <img class="light-theme-img w-auto max-w-[inherit] !max-h-[38px] lg:max-xl:!max-h-[34px] inline-block"
                                        src="{{ asset($website_settings->website_logo) }}" alt="logo">
                                @else
                                    <img class="light-theme-img w-auto max-w-[inherit] !max-h-[38px] lg:max-xl:!max-h-[34px] inline-block"
                                        src="{{ asset('frontend') }}/images/logo-purple.png" alt="logo">
                                @endif
                            </a>
                        </div>
                        <!-- HEADER WHITE LOGO -->
                        <div class="desktoplogo">
                            <a href="{{ route('home') }}" class="logo-white">
                                @if ($website_settings->website_logo)
                                    <img class=" w-auto max-w-[inherit] !max-h-[38px] lg:max-xl:!max-h-[34px] inline-block"
                                        src="{{ asset($website_settings->website_logo) }}" alt="logo">
                                @else
                                    <img class=" w-auto max-w-[inherit] !max-h-[38px] lg:max-xl:!max-h-[34px] inline-block"
                                        src="{{ asset('frontend') }}/images/logo-white.png" alt="logo">
                                @endif
                            </a>
                        </div>
                        <!-- MAIN MENU -->
                        <nav class="wsmenu clearfix">
                            <div class="overlapblackbg"></div>
                            <ul class="wsmenu-list nav-theme">
                                <li class="nl-simple" aria-haspopup="true"><a href="{{ route('home') }}"
                                        class="h-link">Home</a>
                                </li>


                                <!-- MEGAMENU -->
                                <li aria-haspopup="true" class="mg_link">
                                    <a href="{{ route('service.page') }}" class="h-link">Services <span
                                            class="wsarrow"></span></a>
                                    @php
                                        use App\Models\ServiceCategory;

                                        $categories = ServiceCategory::with([
                                            'services' => function ($q) {
                                                $q->where('status', 1)->orderBy('service_title');
                                            },
                                        ])
                                            ->where('status', 1)
                                            ->orderBy('category_name')
                                            ->get()
                                            ->filter(function ($category) {
                                                // শুধু সেই ক্যাটাগরিগুলো রাখবো যেগুলোর services আছে
                                                return $category->services->isNotEmpty();
                                            });
                                    @endphp

                                    <div class="wsmegamenu w-75 clearfix">
                                        <div class="container">
                                            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                                                <!-- MEGAMENU LINKS -->
                                                @foreach ($categories as $category)
                                                    <ul id="menu-items"
                                                        class="lg:w-3/12 xl:w-3/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full link-list">
                                                        <div id="service-category">
                                                            <h4>{{ $category->category_name }}</h4>
                                                        </div>

                                                        <!-- CATEGORY WISE SERVICES -->
                                                        @foreach ($category->services as $service)
                                                            <li class="fst-li">
                                                                <a
                                                                    href="{{ route('service.details.page', $service->id) }}">
                                                                    {{ $service->service_title }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endforeach
                                            </div>
                                            <!-- End row -->
                                        </div>
                                        <!-- End container -->
                                    </div>

                                    <!-- End wsmegamenu -->
                                </li>
                                <!-- END MEGAMENU -->
                                <!-- SIMPLE NAVIGATION LINK -->
                                <li class="nl-simple" aria-haspopup="true"><a href="{{ route('blog.page') }}"
                                        class="h-link">Blog</a></li>


                                <li aria-haspopup="true">
                                    <a href="#" class="h-link">Company <span class="wsarrow"></span></a>
                                    <ul class="sub-menu">
                                        <li class="nl-simple" aria-haspopup="true"><a href="{{ route('about.page') }}"
                                                class="h-link">About</a>
                                        </li>

                                        <li class="nl-simple" aria-haspopup="true"><a
                                                href="{{ route('portfolio.page') }}" class="h-link">Portfolio</a>
                                        </li>

                                        <li class="nl-simple" aria-haspopup="true"><a href="{{ route('faq.page') }}"
                                                class="h-link">FAQs</a>
                                        </li>

                                        <li class="nl-simple" aria-haspopup="true"><a
                                                href="{{ route('contact.page') }}" class="h-link">Contact Us</a>
                                        </li>


                                    </ul>
                                </li>

                                <!-- If user is logged in -->
                                @auth

                                    <li aria-haspopup="true">
                                        <a href="#" class="h-link"><span class="profile-image"><img src="{{ asset('frontend/images/profile.png') }}" alt=""></span> <span class="wsarrow"></span></a>
                                        <ul class="sub-menu">
                                            <li class="nl-simple reg-fst-link mobile-last-link" aria-haspopup="true">
                                                <a href="{{ route('customer.dashboard') }}" class="h-link">Dashboard</a>
                                            </li>
                                            <li aria-haspopup="true">
                                                <a href="{{ route('cart.page') }}">Cart Page</a>
                                            </li>
                                            <li aria-haspopup="true">
                                                <a href="{{ route('checkout.page') }}">Checkout</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- DASHBOARD LINK -->


                                    <!-- LOGOUT BUTTON -->
                                    <li class="nl-simple" aria-haspopup="true">
                                        <form action="{{ route('customer.logout') }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit"
                                                class="btn r-04 !rounded-[4px] btn--theme hover--theme last-link custom-logout-button">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                @endauth

                                <!-- If user is not logged in -->
                                @guest
                                    <!-- SIGN IN LINK -->
                                    <li class="nl-simple reg-fst-link mobile-last-link" aria-haspopup="true">
                                        <a href="{{ route('customer.signin') }}" class="h-link">Sign In</a>
                                    </li>

                                    <!-- SIGN UP BUTTON -->
                                    <li class="nl-simple" aria-haspopup="true">
                                        <a href="{{ route('customer.register') }}"
                                            class="btn r-04 !rounded-[4px] btn--theme hover--theme last-link">
                                            Sign Up
                                        </a>
                                    </li>
                                @endguest

                            </ul>
                        </nav>
                        <!-- END MAIN MENU -->
                    </div>
                </div>
                <!-- END NAVIGATION MENU -->
            </div>
            <!-- End header-wrapper -->
        </header>
