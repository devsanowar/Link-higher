<div id="brands-1" class="brands-section" style="padding-top: 40px">
        <div class="container">

            <div class="header">
                <div class="title">Our Trusted Clients</div>
            </div>
            <!-- BRANDS TITLE -->
            {{-- <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <div
                    class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                    <div
                        class="brands-title mb--50 xl:!mb-[50px] lg:max-xl:!mb-[45px] md:max-lg:!mb-[30px] !text-center px-[5%] py-0 sm:max-md:!mb-[30px] sm:max-md:!p-0 xsm:max-sm:px-[4%] xsm:max-sm:py-0 xsm:max-sm:!mb-[25px]">
                        <h5
                            class="s-20 w--700 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                            Trusted and used by over 3,400 companies</h5>
                    </div>
                </div>
            </div> --}}
            <!-- BRANDS CAROUSEL -->
            <div id="brand-slider" class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                <div class="col !text-center w-full flex-[1_0_0%] px-[calc(0.5*_1.5rem)] max-w-full">
                    <div class="brand-logo owl-carousel brands-carousel-6">

                        <!-- BRAND LOGO IMAGE -->
                        @foreach ($clients as $client)

                        <div
                            class="brand-logo p-[0_20px] lg:max-xl:px-3 lg:max-xl:py-0 md:max-lg:px-[10px] md:max-lg:py-0 xsm:max-sm:px-[25px] xsm:max-sm:py-0 overflow-hidden relative transition-all duration-[400ms] ease-[ease-in-out] top-0 hover:-top-1.5">
                            <a href="#">
                                @if(empty($client->company_image))
                                <img class="img-fluid light-theme-img" src="{{ asset('frontend') }}/images/brand-6.png"
                                    alt="brand-logo">
                                @else
                                <img class="img-fluid light-theme-img" src="{{ asset($client->company_image) }}"
                                    alt="brand-logo">
                                @endif
                            </a>

                            <a href="#">
                                <img class="img-fluid dark-theme-img hidden absolute"
                                    src="images/brand-6-white.png" alt="brand-logo">
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
