<section id="banner-7" class="cta-section" style="background-image: url({{ asset('/frontend/images/01.jpg') }});">
        <div class="banner-overlay">
            <div class="container">
                <!-- BANNER-7 WRAPPER -->
                <div class="banner-7-wrapper">
                    <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                        <!-- BANNER-7 TEXT -->
                        <div
                            class="md:w-8/12 lg:max-xl:w-8/12 xl:w-8/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                            <div class="banner-7-txt !text-center">
                                <!-- Title -->

                                <h2
                                    class="s-48 w--700 xl:!text-[3rem] lg:max-xl:!text-[2.75rem] md:max-lg:!text-[2.5rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.9375rem] !font-bold !tracking-[-0.5px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] xl:!mb-[35px] lg:max-xl:!mb-[30px] md:max-lg:!mb-[25px] sm:max-md:!mb-[25px] xsm:max-sm:!mb-[25px] xsm:max-sm:px-[4%] xsm:max-sm:py-0">
                                    {{ $cta->title ?? '' }}</h2>
                                <!-- Buttons -->
                                <div class="btns-group inline-block">
                                    <a href="{{ $cta->button_one_url ?? '#' }}"
                                        class="btn !rounded-[4px]  btn--theme hover--theme mr-[15px] lg:max-xl:mr-[12px] md:max-lg:mr-[10px] xsm:max-sm:!mb-[15px] xsm:max-sm:mx-[8px]">{{ $cta->button_one_name }}
                                    </a>
                                    <a href="{{ $cta->button_two_url ?? '#' }}" class="btn  !rounded-[4px]  btn--tra-black hover--theme">{{ $cta->button_two_name }}</a>
                                </div>
                                <!-- Button Text -->
                                <p
                                    class="btn-txt ico-15 pl-0 !m-[20px_0_0_0] lg:max-xl:!mt-[15px] lg:max-xl:!mb-0 lg:max-xl:mx-0 md:max-lg:!mt-[13px] md:max-lg:!mb-0 md:max-lg:mx-0 xsm:max-sm:!mt-[18px] xsm:max-sm:!mb-0 sm:max-md:!mt-[15px] sm:max-md:!mb-0 sm:max-md:mx-0">
                                    {!! $cta->description ?? '' !!}</p>
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
                </div>
                <!-- END BANNER-7 WRAPPER -->
            </div>
            <!-- End container -->
        </div>
        <!-- End banner overlay -->
    </section>
