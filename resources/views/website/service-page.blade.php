@extends('website.layouts.app')
@section('title', 'Service Page')
@section('website_content')
<section id="service-page-breadcrumb">
    <div class="breadcrumb-container">
        <h2 class="breadcrumb-title">Our Services</h2>
        <ul class="breadcrumb-list">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><span>›</span></li>
            <li class="active">Services</li>
        </ul>
    </div>
</section>

<section id="features-6" class="pb--100 !pb-[100px] lg:max-xl:!pb-[80px] md:max-lg:!pb-[70px]  features-section division">
    <div class="container">
        <!-- FEATURES-6 WRAPPER -->
        <div class="fbox-wrapper !text-center">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  row-cols-1 row-cols-md-2 row-cols-lg-4">
                <!-- FEATURE BOX #1 -->
                @foreach ($services as $key => $service)
                    <div
                        class="col md:max-lg:w-6/12 lg:max-xl:w-3/12 xl:w-3/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                        <div class="service-custom-design fbox-6 fb-1 wow fadeInUp md:max-lg:!mb-[35px]">
                            <!-- Icon -->
                            <div class="fbox-ico ico-55 !mb-[20px] xsm:max-sm:!mb-[20px]">
                                <div class="shape-ico relative inline-block m-0 icon-card">
                                        <img src="{{ asset($service->image) }}"
                                            alt="{{ $service->service_title ?? 'Service' }}"
                                            class="relative z-[2] w-16 h-16 object-contain mx-auto" />
                                    </div>
                            </div>
                            <!-- End Icon -->
                            <!-- Text -->
                            <div class="fbox-txt">
                                <a href="{{ route('service.details.page', $service->id) }}" class="service-title">
                                    <h6
                                        class="s-20 w--700 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[10px] lg:max-xl:!mb-[12px] md:max-lg:!mb-[12px] xsm:max-sm:!mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        {{ $service->service_title ?? '' }}</h6>
                                </a>
                                <p class="!mb-0">{!! Str::limit($service->service_short_description, 50, '...') !!} <a class="custom-service-button" href="{{ route('service.details.page', $service->id) }}">Read More</a></p>
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

