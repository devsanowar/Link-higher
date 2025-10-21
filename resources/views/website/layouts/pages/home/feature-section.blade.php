    <section id="features-6"
        class="pb--100 !pb-[100px] lg:max-xl:!pb-[80px] md:max-lg:!pb-[70px]  features-section division">
        <div class="container">
            <!-- FEATURES-6 WRAPPER -->
            <div class="fbox-wrapper !text-center">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  row-cols-1 row-cols-md-2 row-cols-lg-4">
                    <!-- FEATURE BOX #1 -->

                    @foreach ($services as $service)
                        <div
                            class="col md:max-lg:w-6/12 lg:max-xl:w-3/12 xl:w-3/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div class="fbox-6 fb-1 wow fadeInUp md:max-lg:!mb-[35px]">
                                <!-- Icon -->
                                <div class="fbox-ico ico-55 !mb-[20px]">
                                    <div class="shape-ico relative inline-block !m-[0_auto] icon-card">
                                        <!-- শুধু ইমেজ আইকন -->
                                        <img src="{{ asset($service->image) }}" alt="Market Research"
                                            class="relative z-[2] w-[64px] h-[64px] object-contain" />
                                    </div>
                                </div>

                                <!-- End Icon -->
                                <!-- Text -->
                                <div class="fbox-txt">
                                    <h6
                                        class="s-20 w--700 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[10px] lg:max-xl:!mb-[12px] md:max-lg:!mb-[12px] xsm:max-sm:!mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        Market Research</h6>
                                    <p class="!mb-0">Luctus augue egestas undo ultrice and quisque lacus</p>
                                </div>
                            </div>
                        </div
                        @endforeach

                </div>
                <!-- End row -->
            </div>
            <!-- END FEATURES-6 WRAPPER -->
        </div>
        <!-- End container -->
    </section>
