<section id="features-6" class="pb--100 features-section division">
    <div class="container">
        <!-- FEATURES-6 WRAPPER -->
        <div class="fbox-wrapper !text-center">
            <div class="header">
                <div class="title">Services</div>

            </div>

            <div style="margin-bottom: 20px"
                class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  row-cols-1 row-cols-md-2 row-cols-lg-4">
                <!-- FEATURE BOX #1 -->
                @foreach ($services as $key => $service)
                    <div
                        class="col md:max-lg:w-6/12 lg:max-xl:w-3/12 xl:w-3/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                        <div class="service-custom-design fbox-6 fb-1 wow fadeInUp md:max-lg:!mb-[35px]">
                            <!-- Icon -->
                            <div class="fbox-ico ico-55 xsm:max-sm:!mb-[0px] service-image">
                                <a href="{{ route('service.details.page', $service->id) }}" class="service-title">
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
                                        {{ $service->service_title ?? '' }}</h6>
                                </a>
                                <p class="!mb-0">{!! Str::limit($service->service_short_description, 50, '...') !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- END FEATURE BOX #1 -->

            </div>
            <!-- End row -->


            <span class="input-group-btn form-btn">
                <a href="{{ route('service.page') }}"
                    class="custom-button btn r-06 rounded-[6px] hover--theme submit !h-[58px] !text-[1rem] xl:ml-[14px] xl:px-[40px] xl:py-[13px] lg:max-xl:!h-[54px] lg:max-xl:!text-[0.985rem] lg:max-xl:ml-[10px] lg:max-xl:px-[40px] lg:max-xl:py-[13px] md:max-lg:!h-[48px] md:max-lg:!text-[1rem] md:max-lg:ml-[10px] md:max-lg:px-[22px] md:max-lg:py-[13px] xsm:max-sm:!h-[58px] xsm:max-sm:!text-[1.15rem]">
                    More services
                </a>
            </span>

        </div>
        <!-- END FEATURES-6 WRAPPER -->
    </div>
    <!-- End container -->
</section>
<!-- END FEATURES-6 -->
