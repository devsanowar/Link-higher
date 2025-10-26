@extends('website.layouts.app')
@section('title', 'FAQ page')
@section('website_content')
    <section id="service-page-breadcrumb">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title">FAQ Page</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li class="active">FAQs</li>
            </ul>
        </div>
    </section>



    <!-- FAQs-2
                                 ============================================= -->
    <section id="faqs-2"
        class="xl:!pb-[30px] lg:max-xl:!pb-[20px] md:max-lg:!pb-[10px] inner-page-hero faqs-section division pt-[0px] lg:max-xl:pt-[0px] md:max-lg:!mt-[80px] md:max-lg:pt-[70px]">
        <div class="container">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] justify-center">
                <div class="lg:w-11/12 xl:w-10/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                    <!-- INNER PAGE TITLE -->
                    <div
                        class="inner-page-title !text-center xl:!mb-[55px] lg:max-xl:!mb-[38px] md:max-lg:!mb-[25px] sm:max-md:!mb-[30px] xsm:max-sm:!mb-[30px]">
                        <h2
                            class="s-52 w--700 xl:!text-[3.25rem] lg:max-xl:!text-[3rem] md:max-lg:!text-[2.79411rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold tracking-[0] !mb-0 xsm:max-sm:px-[1%] xsm:max-sm:py-0 leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                            Questions & Answers</h2>
                        <p
                            class="p-lg xl:!text-[1.1875rem] leading-none xl:!mt-[20px] !mb-0 lg:max-xl:!text-[1.15rem] lg:max-xl:!mt-[18px] md:max-lg:!text-[1.15rem] md:max-lg:!mt-[14px] sm:max-md:!text-[1.15rem] sm:max-md:!mt-[10px] xsm:max-sm:!text-[1.15rem] xsm:max-sm:!leading-[1.6666] xsm:max-sm:!mt-[10px] xsm:max-sm:px-[5%] xsm:max-sm:py-0">
                            Some common questions we get about Martex</p>
                    </div>
                    <!-- QUESTIONS ACCORDION -->
                    <div class="accordion-wrapper">
                        <ul class="accordion">
                            @foreach ($faqs as $faq)
<li class="accordion-item [border-bottom:1px_solid_#ddd] !bg-transparent border-[none]">
                                <!-- CATEGORY HEADER -->
                                <div
                                    class="accordion-thumb p-[25px_0_30px] lg:max-xl:pt-[22px] lg:max-xl:!pb-7 lg:max-xl:px-0 md:max-lg:pt-[20px]  md:max-lg:!pb-[25px] md:max-lg:px-0 sm:max-md:pt-[20px] sm:max-md:!pb-[25px] sm:max-md:px-0 xsm:max-sm:pt-[20px] xsm:max-sm:!pb-[25px] xsm:max-sm:px-0 cursor-pointer relative !m-0 after:!text-[1rem] after:right-[2px] after:top-[26px] lg:max-xl:after:!text-[1rem] lg:max-xl:after:right-[2px] lg:max-xl:after:!top-[23px] md:max-lg:after:!text-[0.935rem] md:max-lg:after:right-[2px] md:max-lg:after:!top-[23px] sm:max-md:after:!text-[0.9rem] sm:max-md:after:right-[2px] sm:max-md:after:!top-[22px] xsm:max-sm:after:!text-[0.9rem] xsm:max-sm:after:right-[2px] xsm:max-sm:after:!top-[22px] after:font-light after:content-['\f11a'] after:absolute after:font-Flaticon">
                                    <h4
                                        class="s-28 w--700 xl:!text-[1.75rem] lg:max-xl:!text-[1.625rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold font-Jakarta !leading-none !mb-0">
                                        {{ $faq->question ?? '' }}</h4>
                                </div>
                                <!-- CATEGORY ANSWERS -->
                                <div
                                    class="accordion-panel p-[45px_0_15px_0] lg:max-xl:pt-[35px] lg:max-xl:!pb-[20px] lg:max-xl:px-0 md:max-lg:pt-[25px] md:max-lg:!pb-[10px] md:max-lg:px-0 sm:max-md:pt-[30px] sm:max-md:!pb-[15px] sm:max-md:px-0 xsm:max-sm:pt-[30px] xsm:max-sm:!pb-[15px] xsm:max-sm:px-0 !m-0">

                                    <!-- QUESTION #2 -->
                                    <div class="accordion-panel-item  !mb-[35px] ">
                                        <!-- Answer -->
                                        <div class="faqs-2-answer color--grey">
                                            <!-- Text -->
                                            <p>
                                                {!! $faq->answer ?? '' !!}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- END QUESTION #2 -->

                                </div>
                                <!-- END CATEGORY ANSWERS -->
                            </li>
                            @endforeach
                            <!-- QUESTIONS CATEGORY #2 -->
                        </ul>
                    </div>
                    <!-- END QUESTIONS ACCORDION -->
                    <!-- MORE QUESTIONS LINK -->
                    <div class="more-questions !text-center mt--40 mt-[40px] lg:max-xl:!mt-[30px] md:max-lg:!mt-[30px] ">
                        <div
                            class="more-questions-txt bg--white-400 rounded-[100px] inline-block px-[46px] py-[22px] lg:max-xl:px-11 lg:max-xl:py-[18px] md:max-lg:px-[42px] md:max-lg:py-[18px] sm:max-md:px-[42px] sm:max-md:py-[18px] xsm:max-sm:px-9 xsm:max-sm:py-[18px]">
                            <p
                                class="p-lg leading-none !mb-0 lg:max-xl:!text-[1.125rem] md:max-lg:!text-[1.125rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem]">
                                Have any questions?
                                <a href="contacts.html"
                                    class="color--theme font-medium !underline hover:text-[#353f4f] hover:!underline">Get
                                    in Touch</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </section>
    <!-- END FAQs-2 -->


    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
@endsection
