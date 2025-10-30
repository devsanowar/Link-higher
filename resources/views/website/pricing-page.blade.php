@extends('website.layouts.app')
@section('title', 'Package Plan')
@push('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Small visual tweaks */
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(12, 15, 25, 0.06);
        }

        .muted {
            color: #6b7280;
        }

        /* gray-500 */
        /* keep focus ring subtle */
        .input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
            border-color: #6366f1;
        }
    </style>
@endpush
@section('website_content')

    <section id="service-page-breadcrumb">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title"> Package Plan Page</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li class="active">Pricing Plan</li>
            </ul>
        </div>
    </section>

    <!-- PRICING-1 -->
    <section id="pricing-1"
        class="pb--40 pb-[40px] inner-page-hero pricing-section pt-[0px] lg:max-xl:pt-[0px] md:max-lg:!mt-[0px] md:max-lg:pt-[0px]">
        <div class="container">
            <!-- SECTION TITLE -->
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <div
                    class="md:w-10/12 lg:max-xl:w-8/12 xl:w-8/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                    <div class="section-title !text-center mb--70 mb-[70px] lg:max-xl:!mb-[60px] md:max-lg:!mb-[50px]">
                        <!-- Title -->
                        <h2
                            class="s-52 w--700 xl:!text-[3.25rem] lg:max-xl:!text-[3rem] md:max-lg:!text-[2.79411rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold !tracking-[-0.5px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                            Simple, Flexible Pricing</h2>
                        <!-- TOGGLE BUTTON -->
                        <div class="toggle-btn ext-toggle-btn !text-center toggle-btn-md mt--30 mt-[30px]">
                            <span
                                class="toggler-txt xl:!text-[1.1rem] !font-normal leading-9 lg:max-xl:!text-[1.0625rem] lg:max-xl:leading-8 md:max-lg:!text-[1rem] md:max-lg:leading-8 sm:max-md:!text-[1.15rem] xsm:max-sm:!text-[1.15rem]">Billed
                                monthly</span>
                            <label
                                class="switch-wrap min-w-[65px] xl:!h-[36px] mx-[8px] my-0 lg:max-xl:mx-1.5 lg:max-xl:my-0 md:max-lg:mx-1.5 md:max-lg:my-0 relative inline-block align-middle lg:max-xl:min-w-[50px] lg:max-xl:!h-[30px] md:max-lg:min-w-[50px] md:max-lg:!h-[30px]">
                                <input class="hidden" type="checkbox" id="checbox" onclick="check()">
                                <span
                                    class="switcher bg--grey switcher--theme bg-[#ccc] border-2 border-solid border-[#ccc] before:bg-white before:shadow-[0_1px_1px_0_#aaa] before:left-[4px] before:bottom-[3.5px] xl:!h-[36px] xl:!pl-[40px] xl:!pr-[20px] py-0 rounded-[36px] xl:before:!w-[26px] xl:before:!h-[26px] lg:max-xl:!pl-[30px] lg:max-xl:pr-[10px] lg:max-xl:py-0 lg:max-xl:rounded-[32px] md:max-lg:!h-[32px] md:max-lg:!pl-[30px] md:max-lg:pr-[10px] md:max-lg:py-0 block cursor-pointer !text-white xl:!text-[0.925rem] font-medium relative [transition:all_150ms_ease-in-out] before:absolute before:content-['_'] before:[transition:all_450ms_ease-in-out] before:rounded-[50%] lg:max-xl:!text-[0.9rem] lg:max-xl:!h-[32px] lg:max-xl:before:!w-[22px] lg:max-xl:before:!h-[22px] lg:max-xl:before:left-[4px] lg:max-xl:before:bottom-[3px] md:max-lg:before:!w-[22px] md:max-lg:before:!h-[22px] md:max-lg:before:left-[4px] md:max-lg:before:bottom-[3px] md:max-lg:!text-[0.85rem]">
                                    <span
                                        class="show-annual hidden leading-9 lg:max-xl:leading-8 md:max-lg:leading-8"></span>
                                    <span
                                        class="show-monthly block leading-9 lg:max-xl:leading-8 md:max-lg:leading-8"></span>
                                </span>
                            </label>
                            <span
                                class="toggler-txt xl:!text-[1.1rem] !font-normal leading-9 lg:max-xl:!text-[1.0625rem] lg:max-xl:leading-8 md:max-lg:!text-[1rem] md:max-lg:leading-8 sm:max-md:!text-[1.15rem] xsm:max-sm:!text-[1.15rem]">Billed
                                yearly</span>
                            <!-- Text -->
                            <p class="color--theme tracking-[-0.25px] !mt-[10px] !mb-0">Save up to 35% with yearly billing
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SECTION TITLE -->

            <!-- PRICING TABLES -->
            <div class="pricing-1-wrapper">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  row-cols-1 row-cols-md-3">

                    {{-- Loop through packages --}}
                    @forelse($packages as $package)
                        <div
                            class="col md:max-lg:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div id="pt--{{ $package->id }}"
                                class="p-table pricing-1-table xl:!pt-[50px] xl:!pb-[45px] xl:!px-[38px] lg:max-xl:pt-[40px] lg:max-xl:!pb-[35px] lg:max-xl:px-[25px] md:max-lg:pt-[30px] md:max-lg:!pb-[25px] md:max-lg:px-[25px] sm:max-md:pt-[35px] sm:max-md:!pb-[40px] sm:max-md:px-[30px] xsm:max-sm:px-[40px] xsm:max-sm:py-[35px] bg--white-100 block-shadow rounded-[12px] wow fadeInUp xl:!mb-[50px] lg:max-xl:!mb-[40px] md:max-lg:!mb-[35px] sm:max-md:!mb-[40px] xsm:max-sm:!mb-[40px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">


                                {{-- Yearly save ribbon if present --}}
                                {{-- @if ($package->yearly_save_percent && $package->yearly_save_text)
                                <div
                                    class="pricing-discount bg--yellow-400 color--black rounded-[36px] !absolute right-[-5px] px-[13px] py-[7px] -top-[2px] lg:max-xl:px-[13px] lg:max-xl:py-[7px] lg:max-xl:right-0 lg:max-xl:-top-[2px] md:max-lg:right-[-3px] md:max-lg:px-[9px] md:max-lg:py-[5px] md:max-lg:-top-3 xsm:max-sm:px-[13px] xsm:max-sm:py-[7px] xsm:max-sm:right-0 xsm:max-sm:-top-1">
                                    <h6 class="s-17 xl:!text-[0.915rem] !leading-none !mb-0 md:max-lg:!text-[0.8rem] xsm:max-sm:!text-[0.9375rem] font-Jakarta">
                                        {{ $package->yearly_save_text }}
                                    </h6>
                                </div>
                            @endif --}}

                                <!-- TABLE HEADER -->
                                <div class="pricing-table-header relative">
                                    <!-- Title -->
                                    <h5
                                        class="s-24 xl:!text-[1.5rem] mb--30 !mb-[30px] lg:max-xl:!mb-[25px] md:max-lg:!mb-[20px] sm:max-md:!text-[1.6875rem] xsm:max-sm:!text-[1.5625rem] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        {{ $package->name }}</h5>
                                    <!-- Price -->
                                    <div class="price">
                                        <!-- Monthly Price (visible by default) -->
                                        <div class="price2 price-month" data-package-id="{{ $package->id }}">
                                            <sup
                                                class="color--black xl:!text-[2.05rem] font-semibold top-[-5px] tracking-[-1px] right-[2px] font-Jakarta lg:max-xl:!text-[2rem] lg:max-xl:right-[2px] lg:max-xl:-top-1 md:max-lg:!text-[2.125rem] md:max-lg:-top-[2px] sm:max-md:!text-[2.15rem] sm:max-md:-top-1 xsm:max-sm:!text-[2rem] xsm:max-sm:top-[-5px]">
                                                {{ $package->currency === 'USD' ? '$' : $package->currency }}
                                            </sup>
                                            <span
                                                class="color--black xl:!text-[3rem] leading-none font-semibold tracking-[-2px] font-Jakarta lg:max-xl:!text-[2.85rem] lg:max-xl:tracking-[-1.5px] md:max-lg:!text-[2.45rem] md:max-lg:tracking-[-1.5px] sm:max-md:!text-[2.875rem] sm:max-md:tracking-[-1.5px] xsm:max-sm:!text-[2.75rem]">
                                                {{ number_format($package->monthly_amount, 2) }}
                                            </span>
                                            <sup
                                                class="validity color--grey tracking-[-1px] right-[2px] xl:!text-[1.4rem] !font-normal left-0 -top-[2px] font-Jakarta lg:max-xl:!text-[1.45rem] md:max-lg:!text-[1.2rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem]">
                                                &nbsp;/&ensp;{{ $package->monthly_label ?? 'mo' }}
                                            </sup>
                                        </div>
                                        <!-- Yearly Price (hidden by default) -->
                                        <div class="price1 price-year hidden" data-package-id="{{ $package->id }}">
                                            <sup
                                                class="color--black xl:!text-[2.05rem] font-semibold top-[-5px] tracking-[-1px] right-[2px] font-Jakarta lg:max-xl:!text-[2rem] lg:max-xl:right-[2px] lg:max-xl:-top-1 md:max-lg:!text-[2.125rem] md:max-lg:-top-[2px] sm:max-md:!text-[2.15rem] sm:max-md:-top-1 xsm:max-sm:!text-[2rem] xsm:max-sm:top-[-5px]">
                                                {{ $package->currency === 'USD' ? '$' : $package->currency }}
                                            </sup>
                                            <span
                                                class="color--black xl:!text-[3rem] leading-none font-semibold tracking-[-2px] font-Jakarta lg:max-xl:!text-[2.85rem] lg:max-xl:tracking-[-1.5px] md:max-lg:!text-[2.45rem] md:max-lg:tracking-[-1.5px] sm:max-md:!text-[2.875rem] sm:max-md:tracking-[-1.5px] xsm:max-sm:!text-[2.75rem]">
                                                {{ number_format($package->yearly_amount, 2) }}
                                            </span>
                                            <sup
                                                class="validity color--grey tracking-[-1px] right-[2px] xl:!text-[1.4rem] !font-normal left-0 -top-[2px] font-Jakarta lg:max-xl:!text-[1.45rem] md:max-lg:!text-[1.2rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem]">
                                                &nbsp;/&ensp;{{ $package->yearly_label ?? 'yr' }}
                                            </sup>
                                        </div>

                                        <!-- Short subtitle text -->
                                        @if ($package->subtitle)
                                            <p
                                                class="color--grey my-[25px] lg:max-xl:!mt-[20px] lg:max-xl:!mb-[15px] md:max-lg:!text-[0.9075rem] md:max-lg:my-[14px]">
                                                {{ $package->subtitle }}
                                            </p>
                                        @endif
                                    </div>
                                    <!-- End Price -->

                                    <!-- Button -->
                                    <a href="{{ route('checkout.page') }}"
                                        class="pt--btn btn  !rounded-[4px]  btn--theme hover--theme">
                                        {{ $package->cta_text ?? ($package->is_free ? 'Get Started' : 'Start ' . ($package->trial_days ? $package->trial_days . '-day trial' : 'Free Trial')) }}
                                    </a>

                                    <p
                                        class="p-sm btn-txt xl:!m-[14px_0_0_0] md:max-lg:!text-sm sm:max-md:!mt-3 sm:max-md:!mb-0 sm:max-md:mx-0 xsm:max-sm:!mt-3 xsm:max-sm:!mb-0 xsm:max-sm:mx-0 !text-center color--grey">
                                        @if ($package->trial_days)
                                            {{ $package->trial_days }}-Day Free Trial
                                        @endif

                                        @if ($package->money_back_days)
                                            @if ($package->trial_days)
                                                ·
                                            @endif
                                            {{ $package->money_back_days }}-Day Money Back Guarantee
                                        @endif
                                    </p>
                                </div>
                                <!-- END TABLE HEADER -->

                                <!-- PRICING FEATURES -->
                                <ul class="pricing-features color--black ico-10 ico--green mt--25 mt-[25px]">
                                    @php
                                        $features = json_decode($package->features, true) ?? [];
                                    @endphp

                                    @if (count($features) > 0)
                                        @foreach ($features as $feat)
                                            <li
                                                class=" px-[8px] py-[11px] md:max-lg:px-0 md:max-lg:py-1.5 sm:max-md:px-[8px] sm:max-md:py-[10px] xsm:max-sm:px-[8px] xsm:max-sm:py-[10px]">
                                                <p><span class="flaticon-check"></span> {!! e($feat) !!}</p>
                                            </li>
                                        @endforeach
                                    @else
                                        {{-- fallback sample features (keeps design identical) --}}
                                        <li
                                            class=" px-[8px] py-[11px] md:max-lg:px-0 md:max-lg:py-1.5 sm:max-md:px-[8px] sm:max-md:py-[10px] xsm:max-sm:px-[8px] xsm:max-sm:py-[10px]">
                                            <p><span class="flaticon-check"></span> Core features included</p>
                                        </li>
                                        <li
                                            class=" px-[8px] py-[11px] md:max-lg:px-0 md:max-lg:py-1.5 sm:max-md:px-[8px] sm:max-md:py-[10px] xsm:max-sm:px-[8px] xsm:max-sm:py-[10px]">
                                            <p><span class="flaticon-check"></span> Email support</p>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @empty
                        {{-- If no packages: show a friendly fallback card keeping design --}}
                        <div
                            class="col md:max-lg:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div class="p-table pricing-1-table bg--white-100 block-shadow rounded-[12px] p-6">
                                <h5 class="s-24 mb-4 font-Jakarta">No Plans Yet</h5>
                                <p class="color--grey">There are currently no pricing plans. Please add packages from admin.
                                </p>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
            <!-- PRICING TABLES -->
        </div>
        <!-- End container -->
    </section>

    <!-- BRANDS-1
                                 ============================================= -->
    <div id="brands-1" class="py-[80px] lg:max-xl:py-[60px] md:max-lg:py-[50px] brands-section">
        <div class="container">
            <!-- BRANDS TITLE -->
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <div
                    class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                    <div
                        class="brands-title mb--50 xl:!mb-[50px] lg:max-xl:!mb-[45px] md:max-lg:!mb-[30px] !text-center px-[5%] py-0 sm:max-md:!mb-[30px] sm:max-md:!p-0 xsm:max-sm:px-[4%] xsm:max-sm:py-0 xsm:max-sm:!mb-[25px]">
                        <h5
                            class="s-20 w--700 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                            Trusted and used by over 3,400 companies</h5>
                    </div>
                </div>
            </div>
            <!-- BRANDS CAROUSEL -->
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                <div class="col !text-center w-full flex-[1_0_0%] px-[calc(0.5*_1.5rem)] max-w-full">
                    <div class="owl-carousel brands-carousel-6">

                        <!-- BRAND LOGO IMAGE -->
                        @foreach ($clients as $client)
                            <div
                                class="brand-logo p-[0_20px] lg:max-xl:px-3 lg:max-xl:py-0 md:max-lg:px-[10px] md:max-lg:py-0 xsm:max-sm:px-[25px] xsm:max-sm:py-0 overflow-hidden relative transition-all duration-[400ms] ease-[ease-in-out] top-0 hover:-top-1.5">
                                <a href="#">
                                    @if (empty($client->company_image))
                                        <img class="img-fluid light-theme-img"
                                            src="{{ asset('frontend') }}/images/brand-6.png" alt="brand-logo">
                                    @else
                                        <img class="img-fluid light-theme-img" src="{{ asset($client->company_image) }}"
                                            alt="brand-logo">
                                    @endif
                                </a>

                                <a href="#">
                                    <img class="img-fluid dark-theme-img hidden absolute" src="images/brand-6-white.png"
                                        alt="brand-logo">
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <!-- END BRANDS CAROUSEL -->
        </div>
        <!-- End container -->
    </div>

    <!-- START FAQs -->
    <section id="faqs-3" class="py--100 py-[100px] lg:max-xl:py-[80px] md:max-lg:py-[70px] faqs-section">
        <div class="container">
            <!-- SECTION TITLE -->
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <div class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                    <div
                        class="section-title !text-center mb--70 xl:!mb-[70px] lg:max-xl:!mb-[55px] md:max-lg:!mb-[45px] sm:max-md:!mb-[40px] xsm:max-sm:!mb-[40px]">
                        <!-- Title -->
                        <h2
                            class="s-50 w--700 xl:!text-[3.125rem] lg:max-xl:!text-[2.875rem] md:max-lg:!text-[2.64705rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold !tracking-[-0.5px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                            Questions & Answers</h2>
                        <!-- Text -->
                        <p
                            class="s-21 color--grey xl:!text-[1.3125rem] xl:!mt-[18px] !mb-0 lg:max-xl:!mt-[15px] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.32352rem] md:max-lg:!mt-3 sm:max-md:!text-[1.21875rem] sm:max-md:!mt-3 xsm:max-sm:!text-[1.1875rem] xsm:max-sm:!mt-3 xsm:max-sm:px-[3%] xsm:max-sm:py-0">
                            Ligula risus auctor tempus magna feugiat lacinia.</p>
                    </div>
                </div>
            </div>
            <!-- FAQs-3 QUESTIONS -->
            @php
                use Illuminate\Support\Str;
            @endphp

            {{-- প্রতি রোতে ১০টা করে (বাম ৫ + ডান ৫) --}}
            @foreach ($faqs->chunk(10) as $chunkIndex => $chunk)
                <div class="faqs-3-questions">
                    <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">

                        {{-- LEFT COLUMN (১ম ৫টি) --}}
                        <div class="xl:w-6/12 lg:max-xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                            <div class="questions-holder px-[10px] py-0 lg:max-xl:!p-0 md:max-lg:!p-0">
                                @foreach ($chunk->slice(0, 5)->values() as $i => $faq)
                                    <div class="question mb--35 !mb-[35px] wow fadeInUp">
                                        <h5
                                            class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[15px] md:max-lg:!mb-[12px] sm:max-md:!mb-[15px] xsm:max-sm:!mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                            <span class="mr-[5px]">{{ $chunkIndex * 10 + $i + 1 }}.</span>
                                            {{ $faq->question ?? 'Question' }}
                                        </h5>

                                        {{-- উত্তর HTML হলে 그대로 দেখাবে; না হলে <p> হিসেবে --}}
                                        @if (!empty($faq->answer) && Str::startsWith(trim($faq->answer), ['<p', '<ul', '<ol', '<div']))
                                            {!! $faq->answer !!}
                                        @else
                                            <p class="color--grey">{!! nl2br(e($faq->answer ?? 'Answer')) !!}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- RIGHT COLUMN (পরের ৫টি) --}}
                        <div class="xl:w-6/12 lg:max-xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                            <div class="questions-holder px-[10px] py-0 lg:max-xl:!p-0 md:max-lg:!p-0">
                                @foreach ($chunk->slice(5, 5)->values() as $j => $faq)
                                    <div class="question mb--35 !mb-[35px] wow fadeInUp">
                                        <h5
                                            class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[15px] md:max-lg:!mb-[12px] sm=max-md:!mb-[15px] xsm:max-sm:!mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                            <span class="mr-[5px]">{{ $chunkIndex * 10 + 5 + $j + 1 }}.</span>
                                            {{ $faq->question ?? 'Question' }}
                                        </h5>

                                        @if (!empty($faq->answer) && Str::startsWith(trim($faq->answer), ['<p', '<ul', '<ol', '<div']))
                                            {!! $faq->answer !!}
                                        @else
                                            <p class="color--grey">{!! nl2br(e($faq->answer ?? 'Answer')) !!}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

            <!-- MORE QUESTIONS LINK -->
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                <div class="flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                    <div class="more-questions !text-center mt--40 mt-[40px] lg:max-xl:!mt-[30px] md:max-lg:!mt-[30px] ">
                        <div
                            class="more-questions-txt bg--white-400 rounded-[100px] inline-block px-[46px] py-[22px] lg:max-xl:px-11 lg:max-xl:py-[18px] md:max-lg:px-[42px] md:max-lg:py-[18px] sm:max-md:px-[42px] sm:max-md:py-[18px] xsm:max-sm:px-9 xsm:max-sm:py-[18px]">
                            <p
                                class="p-lg leading-none !mb-0 lg:max-xl:!text-[1.125rem] md:max-lg:!text-[1.125rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem]">
                                Have any questions?
                                <a href="{{ route('contact.page') }}"
                                    class="color--theme font-medium !underline hover:text-[#353f4f] hover:!underline">Get
                                    in Touch</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End container -->
    </section>

    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
@endsection

@push('scripts')
    <script>
        (function() {
            const checkbox = document.getElementById('checbox');

            function showEl(el) {
                if (!el) return;
                el.classList.remove('hidden');
                el.style.display = '';
            }

            function hideEl(el) {
                if (!el) return;
                el.classList.add('hidden');
                el.style.display = 'none';
            }

            function updatePrices() {
                const showYearly = !!(checkbox && checkbox.checked);

                document.querySelectorAll('.price-month').forEach(el => {
                    if (showYearly) hideEl(el);
                    else showEl(el);
                });

                document.querySelectorAll('.price-year').forEach(el => {
                    if (showYearly) showEl(el);
                    else hideEl(el);
                });
            }

            if (checkbox) checkbox.addEventListener('change', updatePrices);
            document.querySelectorAll('.switch-wrap').forEach(lbl => {
                lbl.addEventListener('click', function() {
                    setTimeout(updatePrices, 10);
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(updatePrices, 20);
            });
            setTimeout(updatePrices, 50);
        })();
    </script>
@endpush
