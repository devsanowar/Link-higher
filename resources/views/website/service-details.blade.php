@extends('website.layouts.app')
@section('title', 'Service Details Page')

@section('website_content')
    <section id="service-page-breadcrumb" class="container">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title"> Service Details page</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li>Services</li>
                <li><span>›</span></li>
                <li class="active">{{ $service->service_title ?? '' }}</li>
            </ul>
        </div>
    </section>

    <section id="role-page" class="inner-page-hero">
        <div class="container">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <div class="xl:w-10/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                    <!-- INNER PAGE TITLE -->
                    <div class="inner-page-title !text-left">

                        <h2 class="s-52 w--700">
                            {{ $service->service_title ?? '' }}</h2>

                    </div>
                    <!-- TEXT BLOCK -->
                    <div class="txt-block role-info">
                        <!-- Text -->
                        <p>
                            {!! $service->service_long_description ?? '' !!}
                        </p>


                        <div class="service-feature">
                            @php
                                $features = json_decode($service->service_features ?? '[]', true) ?: [];
                            @endphp

                            <h2>Features</h2>

                            <!-- List -->
                            @if (!empty($features))
                                <ul class="simple-list long-list">
                                    @foreach ($features as $item)
                                        <li class="list-item">
                                            <p><span class="flaticon-check"></span>{{ $item }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>


                    </div>
                    <!-- END TEXT BLOCK -->
                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </section>
    <!-- END CAREER ROLE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">


    <section class="products-section">
        <h2 class="custom-section-title">Packages</h2>
        <div class="product-grid">

            <!-- Product 1 -->
            @foreach ($service->PackagePlans as $plan)
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset($service->image) }}" alt="Product Image">
                        <span class="category-label">{{ $service->service_title ?? '' }}</span>
                    </div>
                    <div class="product-content">
                        <h3>{{ $plan->name ?? 'Basic' }}</h3>
                        <p>
                            @if ($plan->discount && $plan->discount_type)
                                <span style="color: red; text-decoration: line-through; margin-right: 10px;">
                                    ${{ number_format($plan->price, 2) }}
                                </span>
                                <span style="font-weight: bold;">
                                    ${{ number_format($plan->final_price, 2) }}
                                </span>
                            @else
                                <span style="color: #111; font-weight: 600;">
                                    ${{ number_format($plan->price, 2) }}
                                </span>
                            @endif
                        </p>
                        <div class="product-buttons">
                            <a href="{{ route('service.plan.details.page', $plan->id) }}" class="add-to-cart">
                                <button class="add-to-cart">View Details</button>
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </section>




    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">

    <section id="features-6"
        class="other-services features-section division">
        <div class="container">

            <h2 class="custom-section-title">Other Services</h2>


            <!-- FEATURES-6 WRAPPER -->
            <div class="fbox-wrapper !text-center">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  row-cols-1 row-cols-md-2 row-cols-lg-4">
                    <!-- FEATURE BOX #1 -->
                    @foreach ($otherServices as $key => $service)
                        <div
                            class="col md:max-lg:w-6/12 lg:max-xl:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div class="service-custom-design fbox-6 fb-1 wow fadeInUp md:max-lg:!mb-[35px]">
                                <!-- Icon -->
                                <div class="fbox-ico ico-55 service-image">
                                    <a class="custom-service-button"
                                        href="{{ route('service.details.page', $service->id) }}">
                                        <div class="shape-ico relative inline-block m-0 icon-card">
                                            <img src="{{ asset($service->image) }}"
                                                alt="{{ $service->service_title ?? 'Service' }}"
                                                class="relative z-[2] w-16 h-16 object-contain mx-auto" />
                                        </div>
                                    </a>
                                </div>
                                <!-- End Icon -->

                                <!-- Text -->
                                <div class="fbox-txt service-text">
                                    <a href="{{ route('service.details.page', $service->id) }}" class="service-title">
                                        <h6
                                            class="s-20 w--700 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[10px] lg:max-xl:!mb-[12px] md:max-lg:!mb-[12px] xsm:max-sm:!mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                            {{ $service->service_title ?? '' }}
                                        </h6>
                                    </a>
                                    <p class="!mb-0">
                                        {!! Str::limit($service->service_short_description, 50, '...') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- END FEATURE BOX #1 -->

                </div>
                <!-- End row -->
            </div>
            <!-- END FEATURES-6 WRAPPER -->
        </div>
        <!-- End container -->
    </section>
    <!-- END FEATURES-6 -->

    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">

@endsection
