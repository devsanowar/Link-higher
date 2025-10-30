@extends('website.layouts.app')
@section('title', 'Terms And Condition')
@section('website_content')

    <section id="service-page-breadcrumb">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title">Terms And Condition Page</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li class="active">Terms And Condition</li>
            </ul>
        </div>
    </section>

    <section id="terms-page"
        class="pb--80 xl:!pb-[80px] lg:max-xl:!pb-[60px] md:max-lg:!pb-[50px] inner-page-hero division pt-[10px] lg:max-xl:pt-[10px] md:max-lg:!mt-[0px] md:max-lg:pt-[0px]">
        <div class="container">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <div class="xl:w-10/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                    <!-- INNER PAGE TITLE -->
                    {{-- <div
                        class="inner-page-title !text-center xl:!mb-[80px] lg:max-xl:!mb-[60px] md:max-lg:!mb-[45px] sm:max-md:!mb-[50px] xsm:max-sm:!mb-[50px]">
                        <h2
                            class="s-52 w--700 xl:!text-[3.25rem] lg:max-xl:!text-[3rem] md:max-lg:!text-[2.79411rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold !mb-0 md:max-lg:!mb-0 sm:max-md:!mb-0 xsm:max-sm:!mb-0 leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                            Terms of Service</h2>

                    </div> --}}
                    <!-- TEXT BLOCK -->
                    <div class="txt-block legal-info">

                        <!-- Text -->
                        <p>
                            {!! $termsAndCondition->terms_and_conditions !!}
                        </p>

                    </div>
                    <!-- END TEXT BLOCK -->
                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </section>
    <!-- END SINGLE PROJECT-1 -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">

@endsection
