@extends('website.layouts.app')
@section('title', 'Home Page')
@section('website_content')

@include('website.layouts.pages.home.hero-section')
    <!-- END HERO-7 -->
    <!-- FEATURES-6
                         ============================================= -->
    @include('website.layouts.pages.home.feature-section')
    <!-- END FEATURES-6 -->
    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
    <!-- TEXT CONTENT
                         ============================================= -->
    @include('website.layouts.pages.home.smart-strategy-section')
    <!-- END TEXT CONTENT -->
    <!-- TEXT CONTENT
                         ============================================= -->
    @include('website.layouts.pages.home.smart-work-flow-section')
    <!-- END TEXT CONTENT -->
    <!-- FEATURES-2
                         ============================================= -->
    @include('website.layouts.pages.home.goal-progress-section')
    <!-- END FEATURES-2 -->
    <!-- BOX CONTENT
                         ============================================= -->
    @include('website.layouts.pages.home.smart-solution-section')
    <!-- END BOX CONTENT -->
    <!-- TEXT CONTENT
                         ============================================= -->

    <!-- END TEXT CONTENT -->
    <!-- STATISTIC-1
                         ============================================= -->
    {{-- @include('website.layouts.pages.home.achievement-section') --}}
    <!-- END STATISTIC-1 -->
    <!-- DIVIDER LINE -->

    <!-- FEATURES-13
                         ============================================= -->
    @include('website.layouts.pages.home.why-chose-us-section')
    <!-- END FEATURES-13 -->
    <!-- TEXT CONTENT
                         ============================================= -->
    {{-- <section class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  ct-01 content-section division">
        <div class="container">
            <!-- SECTION CONTENT (ROW) -->
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                <!-- TEXT BLOCK -->
                <div
                    class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-last order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                    <div class="txt-block left-column wow fadeInRight">
                        <!-- Section ID -->
                        <span
                            class="section-id block !text-[0.85rem] leading-none !font-bold !tracking-[0.5px] uppercase xl:!mb-[35px] lg:max-xl:!mb-[30px] md:max-lg:!mb-[25px] sm:max-md:!mb-[25px] font-Jakarta">Easy
                            Integration</span>
                        <!-- Title -->
                        <h2
                            class="s-46 w--700 xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] !font-bold leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] xl:!mb-[26px] lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px]">
                            Plug your essential tools in few clicks</h2>
                        <!-- List -->
                        <ul class="simple-list">
                            <li class="list-item">
                                <p>Cursus purus suscipit vitae cubilia magnis volute egestas vitae sapien turpis
                                    sodales magna undo aoreet primis
                                </p>
                            </li>
                            <li class="list-item">
                                <p class="!mb-0">Tempor sapien quaerat an ipsum laoreet purus and sapien dolor an
                                    ultrice ipsum aliquam undo congue dolor cursus purus congue and ipsum purus
                                    sapien
                                    a blandit
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END TEXT BLOCK -->
                <!-- IMAGE BLOCK -->
                <div
                    class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-first order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                    <div
                        class="img-block !text-center right-column wow fadeInLeft ml-[30px] lg:max-xl:ml-[5px] md:max-lg:ml-0 sm:max-md:!mx-[3%] xsm:max-sm:!m-[0_2%_35px]">
                        <img class="img-fluid" src="images/img-02.png" alt="content-image">
                    </div>
                </div>
            </div>
            <!-- END SECTION CONTENT (ROW) -->
        </div>
        <!-- End container -->
    </section> --}}
    <!-- END TEXT CONTENT -->
    <!-- BOX CONTENT
                         ============================================= -->
@include('website.layouts.pages.home.customer-focus-tone-section')
    <!-- END BOX CONTENT -->
    <!-- TESTIMONIALS-2
                         ============================================= -->
   @include('website.layouts.pages.home.review-section')
    <!-- END TESTIMONIALS-2 -->
    <!-- BRANDS-1
                         ============================================= -->
    @include('website.layouts.pages.home.trusted-client-section')
    <!-- END BRANDS-1 -->
    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
    <!-- IMAGE CONTENT
                         ============================================= -->
    {{-- <section class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  ct-08 content-section division">
        <div class="container">
            <!-- SECTION TITLE -->
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <div
                    class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                    <div class="section-title mb--70 xl:!mb-[70px] lg:max-xl:!mb-[60px] md:max-lg:!mb-[50px] !text-center">
                        <!-- Title -->
                        <h2
                            class="s-50 w--700 xl:!text-[3.125rem] lg:max-xl:!text-[2.875rem] md:max-lg:!text-[2.64705rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px] xl:!mb-[26px] xl:!leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] !tracking-[-0.5px]">
                            Discover insights across all your data with Martex</h2>
                        <!-- Text -->
                        <p
                            class="s-21 xl:!text-[1.3125rem] mt-[18px] !mb-0 lg:max-xl:!mt-[15px] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.32352rem] md:max-lg:!mt-[12px] sm:max-md:!text-[1.21875rem] sm:max-md:!mt-[12px] xsm:max-sm:!text-[1.1875rem] xsm:max-sm:!mt-[12px] xsm:max-sm:px-[3%] xsm:max-sm:py-0">
                            Ligula risus auctor tempus magna feugiat lacinia.</p>
                    </div>
                </div>
            </div>
            <!-- IMAGE BLOCK -->
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] ">
                <div class="flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                    <div class="img-block !text-center wow fadeInUp">
                        <img class="img-fluid inline-block" src="images/img-19.png" alt="video-preview">
                    </div>
                </div>
            </div>
            <!-- ACTION BUTTON -->
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] ">
                <div class="flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                    <div class="img-block-btn !text-center wow fadeInUp">
                        <!-- Button -->
                        <a href="#integrations-2" class="btn  !rounded-[4px]  btn--tra-black hover--theme">Monitor
                            your
                            activity</a>
                        <!-- Advantages List -->
                        <ul
                            class="advantages ico-15 clearfix xl:!mt-[20px] lg:max-xl:!mt-[15px] md:max-lg:!mt-[15px] sm:max-md:!mt-[15px] xsm:max-sm:!mt-[15px]">
                            <li class=" w-auto inline-block align-top clear-none xsm:max-sm:!block xsm:max-sm:!mt-[4px]">
                                <p class=" inline-block float-left !mb-0 xsm:max-sm:block xsm:max-sm:float-none">
                                    Free 14 days trial</p>
                            </li>
                            <li
                                class="advantages-links-divider w-auto inline-block align-top clear-none xsm:max-sm:!hidden">
                                <p class=" inline-block float-left !mb-0 xsm:max-sm:block xsm:max-sm:float-none">
                                    <span class="flaticon-minus"></span>
                                </p>
                            </li>
                            <li class=" w-auto inline-block align-top clear-none xsm:max-sm:!block xsm:max-sm:!mt-[4px]">
                                <p class=" inline-block float-left !mb-0 xsm:max-sm:block xsm:max-sm:float-none">
                                    Exclusive Support</p>
                            </li>
                            <li
                                class="advantages-links-divider w-auto inline-block align-top clear-none xsm:max-sm:!hidden">
                                <p class=" inline-block float-left !mb-0 xsm:max-sm:block xsm:max-sm:float-none">
                                    <span class="flaticon-minus"></span>
                                </p>
                            </li>
                            <li class=" w-auto inline-block align-top clear-none xsm:max-sm:!block xsm:max-sm:!mt-[4px]">
                                <p class=" inline-block float-left !mb-0 xsm:max-sm:block xsm:max-sm:float-none">No
                                    Fees</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End container -->
    </section> --}}
    <!-- END IMAGE CONTENT -->
    <!-- TEXT CONTENT
                         ============================================= -->
    {{-- <section class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  ct-02 content-section division">
        <div class="container">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                <!-- IMAGE BLOCK -->
                <div
                    class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                    <div
                        class="img-block !text-center left-column wow fadeInRight mr-[30px] lg:max-xl:mr-[5px] md:max-lg:mr-0 sm:max-md:mx-[3%] xsm:max-sm:m-[0_2%_35px]">
                        <img class="img-fluid" src="images/img-03.png" alt="content-image">
                    </div>
                </div>
                <!-- TEXT BLOCK -->
                <div
                    class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                    <div class="txt-block right-column wow fadeInLeft">
                        <!-- TEXT BOX -->
                        <div class="txt-box !mb-[20px] md:max-lg:!mb-[5px] last:!mb-0">
                            <!-- Title -->
                            <h5
                                class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4] xl:!mb-[20px] lg:max-xl:!mb-[18px] md:max-lg:!mb-[18px] sm:max-md:!mb-[18px]">
                                Advanced Analytics Review</h5>
                            <!-- Text -->
                            <p>Sodales tempor sapien quaerat ipsum undo congue laoreet turpis neque auctor turpis
                                vitae dolor luctus placerat magna and ligula cursus purus vitae purus an ipsum
                                suscipit
                            </p>
                        </div>
                        <!-- END TEXT BOX -->
                        <!-- TEXT BOX -->
                        <div class="txt-box  !mb-0 ">
                            <!-- Title -->
                            <h5
                                class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4] xl:!mb-[20px] lg:max-xl:!mb-[18px] md:max-lg:!mb-[18px] sm:max-md:!mb-[18px]">
                                Email Marketing Campaigns</h5>
                            <!-- Text -->
                            <p>Tempor sapien sodales quaerat ipsum undo congue laoreet turpis neque auctor turpis
                                vitae dolor luctus placerat magna and ligula cursus purus an ipsum vitae suscipit
                                purus
                            </p>
                            <!-- List -->
                            <ul class="simple-list">
                                <li class="list-item">
                                    <p>Tempor sapien quaerat an ipsum laoreet purus and sapien dolor an ultrice
                                        ipsum
                                        aliquam undo congue dolor cursus
                                    </p>
                                </li>
                                <li class="list-item">
                                    <p class="!mb-0">Cursus purus suscipit vitae cubilia magnis volute egestas
                                        vitae
                                        sapien turpis ultrice auctor congue magna placerat
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <!-- END TEXT BOX -->
                    </div>
                </div>
                <!-- END TEXT BLOCK -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </section> --}}
    <!-- END TEXT CONTENT -->
    <!-- INTEGRATIONS-2
                         ============================================= -->
    {{-- <section id="integrations-2" class="pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px] integrations-section">
        <div class="container">
            <!-- INTEGRATIONS-2 WRAPPER -->
            <div
                class="integrations-2-wrapper bg--white-400 r-12 rounded-[12px] !text-center p-[80px_70px] lg:max-xl:px-[60px] lg:max-xl:py-[80px] md:max-lg:px-[40px] md:max-lg:py-[60px] xsm:max-sm:mr-[-15px] xsm:max-sm:ml-[-15px] xsm:max-sm:my-0 xsm:max-sm:px-[20px] xsm:max-sm:py-[70px] xsm:max-sm:rounded-[0_0]">
                <!-- SECTION TITLE -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                    <div
                        class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div class="section-title mb--60 !mb-[60px] lg:max-xl:!mb-[50px] md:max-lg:!mb-[50px]">
                            <!-- Title -->
                            <h2
                                class="s-50 w--700 xl:!text-[3.125rem] lg:max-xl:!text-[2.875rem] md:max-lg:!text-[2.64705rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold !mb-0 xsm:max-sm:px-[1%] xsm:max-sm:py-0 leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] !tracking-[-0.5px]">
                                Easy integrate all your essential tools</h2>
                            <!-- Text -->
                            <p
                                class="s-21 color--grey xl:!text-[1.3125rem] xl:!mt-[18px] !mb-0 lg:max-xl:!mt-[15px] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.32352rem] md:max-lg:!mt-[12px] sm:max-md:!text-[1.21875rem] sm:max-md:!mt-[12px] xsm:max-sm:!text-[1.1875rem] xsm:max-sm:!mt-[12px] xsm:max-sm:px-[3%] xsm:max-sm:py-0">
                                Ligula risus auctor tempus magna feugiat lacinia.</p>
                        </div>
                    </div>
                </div>
                <!-- TOOLS ROW -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  row-cols-1 row-cols-sm-3 row-cols-md-5">
                    <!-- TOOL #1 -->
                    <div
                        class="col md:max-lg:w-1/5 lg:max-xl:w-1/5 xl:w-1/5 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                        <a href="#"
                            class="in_tool it-1 rounded-[12px] sm:max-md:block xsm:max-sm:block wow fadeInUp">
                            <!-- Logo -->
                            <div
                                class="in_tool_logo ico-65 bg--white-100 block-shadow rounded-[12px] transition-all duration-[400ms] ease-[ease-in-out] xl:!mb-[25px] px-[30px] py-[50px] lg:max-xl:!mb-[25px] lg:max-xl:px-[30px] lg:max-xl:py-[40px] md:max-lg:!mb-[25px] md:max-lg:!p-[30px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                <img class="img-fluid w-[65px] h-[65px] inline-block" src="images/png_icons/tool-1.png"
                                    alt="brand-logo">
                            </div>
                            <!-- Title -->
                            <h6
                                class="s-17 w--700 xl:!text-[1.0625rem] lg:max-xl:!text-[1.0625rem] md:max-lg:!text-[1.066176rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem] !font-bold !mb-0 md:max-lg:!leading-[1.3] font-Jakarta leading-none sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                Zapier</h6>
                        </a>
                    </div>
                    <!-- END TOOL #1 -->
                    <!-- TOOL #2 -->
                    <div
                        class="col md:max-lg:w-1/5 lg:max-xl:w-1/5 xl:w-1/5 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                        <a href="#"
                            class="in_tool it-2 rounded-[12px] sm:max-md:block xsm:max-sm:block wow fadeInUp">
                            <!-- Logo -->
                            <div
                                class="in_tool_logo ico-65 bg--white-100 block-shadow rounded-[12px] transition-all duration-[400ms] ease-[ease-in-out] xl:!mb-[25px] px-[30px] py-[50px] lg:max-xl:!mb-[25px] lg:max-xl:px-[30px] lg:max-xl:py-[40px] md:max-lg:!mb-[25px] md:max-lg:!p-[30px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                <img class="img-fluid w-[65px] h-[65px] inline-block" src="images/png_icons/tool-2.png"
                                    alt="brand-logo">
                            </div>
                            <!-- Title -->
                            <h6
                                class="s-17 w--700 xl:!text-[1.0625rem] lg:max-xl:!text-[1.0625rem] md:max-lg:!text-[1.066176rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem] !font-bold !mb-0 md:max-lg:!leading-[1.3] font-Jakarta leading-none sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                Google Analytics</h6>
                        </a>
                    </div>
                    <!-- END TOOL #2 -->
                    <!-- TOOL #3 -->
                    <div
                        class="col md:max-lg:w-1/5 lg:max-xl:w-1/5 xl:w-1/5 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                        <a href="#"
                            class="in_tool it-3 rounded-[12px] sm:max-md:block xsm:max-sm:block wow fadeInUp">
                            <!-- Logo -->
                            <div
                                class="in_tool_logo ico-65 bg--white-100 block-shadow rounded-[12px] transition-all duration-[400ms] ease-[ease-in-out] xl:!mb-[25px] px-[30px] py-[50px] lg:max-xl:!mb-[25px] lg:max-xl:px-[30px] lg:max-xl:py-[40px] md:max-lg:!mb-[25px] md:max-lg:!p-[30px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                <img class="img-fluid w-[65px] h-[65px] inline-block" src="images/png_icons/tool-3.png"
                                    alt="brand-logo">
                            </div>
                            <!-- Title -->
                            <h6
                                class="s-17 w--700 xl:!text-[1.0625rem] lg:max-xl:!text-[1.0625rem] md:max-lg:!text-[1.066176rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem] !font-bold !mb-0 md:max-lg:!leading-[1.3] font-Jakarta leading-none sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                Amplitude</h6>
                        </a>
                    </div>
                    <!-- END TOOL #3 -->
                    <!-- TOOL #4 -->
                    <div
                        class="col md:max-lg:w-1/5 lg:max-xl:w-1/5 xl:w-1/5 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                        <a href="#"
                            class="in_tool it-4 rounded-[12px] sm:max-md:block xsm:max-sm:block wow fadeInUp">
                            <!-- Logo -->
                            <div
                                class="in_tool_logo ico-65 bg--white-100 block-shadow rounded-[12px] transition-all duration-[400ms] ease-[ease-in-out] xl:!mb-[25px] px-[30px] py-[50px] lg:max-xl:!mb-[25px] lg:max-xl:px-[30px] lg:max-xl:py-[40px] md:max-lg:!mb-[25px] md:max-lg:!p-[30px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                <img class="img-fluid w-[65px] h-[65px] inline-block" src="images/png_icons/tool-4.png"
                                    alt="brand-logo">
                            </div>
                            <!-- Title -->
                            <h6
                                class="s-17 w--700 xl:!text-[1.0625rem] lg:max-xl:!text-[1.0625rem] md:max-lg:!text-[1.066176rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem] !font-bold !mb-0 md:max-lg:!leading-[1.3] font-Jakarta leading-none sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                Hubspot</h6>
                        </a>
                    </div>
                    <!-- END TOOL #4 -->
                    <!-- TOOL #5 -->
                    <div
                        class="col md:max-lg:w-1/5 lg:max-xl:w-1/5 xl:w-1/5 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                        <a href="#"
                            class="in_tool it-5 rounded-[12px] sm:max-md:block xsm:max-sm:block wow fadeInUp">
                            <!-- Logo -->
                            <div
                                class="in_tool_logo ico-65 bg--white-100 block-shadow rounded-[12px] transition-all duration-[400ms] ease-[ease-in-out] xl:!mb-[25px] px-[30px] py-[50px] lg:max-xl:!mb-[25px] lg:max-xl:px-[30px] lg:max-xl:py-[40px] md:max-lg:!mb-[25px] md:max-lg:!p-[30px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                <img class="img-fluid w-[65px] h-[65px] inline-block" src="images/png_icons/tool-5.png"
                                    alt="brand-logo">
                            </div>
                            <!-- Title -->
                            <h6
                                class="s-17 w--700 xl:!text-[1.0625rem] lg:max-xl:!text-[1.0625rem] md:max-lg:!text-[1.066176rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem] !font-bold !mb-0 md:max-lg:!leading-[1.3] font-Jakarta leading-none sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                MailChimp</h6>
                        </a>
                    </div>
                    <!-- END TOOL #5 -->
                </div>
                <!-- END TOOLS ROW -->
                <!-- MORE BUTTON -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] ">
                    <div class="flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                        <div
                            class="more-btn !text-center  mt--60 mt-[60px] lg:max-xl:!mt-[50px] md:max-lg:!mt-[50px]  wow fadeInUp">
                            <a href="integrations.html" class="btn btn--tra-black hover--theme">View all
                                integrations</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END INTEGRATIONS-2 WRAPPER -->
        </div>
        <!-- End container -->
    </section> --}}
    <!-- END INTEGRATIONS-2 -->
    <!-- FAQs-3
                         ============================================= -->
    @include('website.layouts.pages.home.faq-section')
    <!-- END FAQs-3 -->
    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
    <!-- BANNER-7
                         ============================================= -->
    @include('website.layouts.pages.home.cta-section')
    <!-- END BANNER-7 -->

@endsection
