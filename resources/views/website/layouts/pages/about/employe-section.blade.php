    <section id="team-1" class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  team-section">
        <div class="container">
            <!-- SECTION TITLE -->
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <div
                    class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                    <div class="section-title mb--80 mb-[80px] lg:max-xl:!mb-[60px] md:max-lg:!mb-[50px] !text-center">
                        <!-- Title -->
                        <h2
                            class="s-50 w--700 xl:!text-[3.25rem] lg:max-xl:!text-[3rem] md:max-lg:!text-[2.79411rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] !tracking-[-0.5px]">
                            We are a team</h2>
                        <!-- Text -->
                        <p
                            class="s-21 color--grey xl:!text-[1.3125rem] xl:!mt-[18px] !mb-0 lg:max-xl:!mt-[15px] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.32352rem] md:max-lg:!mt-3 sm:max-md:!text-[1.21875rem] sm:max-md:!mt-3 xsm:max-sm:!text-[1.1875rem] xsm:max-sm:!mt-3 xsm:max-sm:px-[3%] xsm:max-sm:py-0">
                            Ligula risus auctor tempus magna feugiat lacinia.</p>
                    </div>
                </div>
            </div>
            <!-- TEAM MEMBERS WRAPPER -->
            <div class="team-members-wrapper">
                <div
                    class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                    <!-- TEAM MEMBER #1 -->

                    @foreach ($employelists as $employe)
                        <div
                            class="col md:max-lg:w-4/12 lg:max-xl:w-3/12 xl:w-3/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div
                                class="team-member mb--50 xl:!mb-[50px] lg:max-xl:!mb-[45px] md:max-lg:!mb-[30px]  wow fadeInUp group">
                                <!-- Team Member Photo -->
                                <div
                                    class="team-member-photo r-14 relative overflow-hidden !text-center mb--30 !mb-[30px] lg:max-xl:!mb-[20px] md:max-lg:!mb-[20px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[25px]  rounded-[14px] ">
                                    <div class="hover-overlay w-full h-auto overflow-hidden relative">
                                        @if (empty($employe->image))
                                            <img class="img-fluid overflow-hidden transition-transform duration-[400ms] scale-100 group-hover:!scale-105"
                                                src="{{ asset('frontend') }}/images/team-2.jpg" alt="team-member-foto">
                                            <div
                                                class="item-overlay opacity-0 !absolute w-full h-full transition-all duration-[400ms] ease-[ease-in-out] left-0 top-0 bg-[rgba(20,20,20,0.25)] group-hover:opacity-[0.45]">
                                            </div>
                                        @else
                                            <img class="img-fluid overflow-hidden transition-transform duration-[400ms] scale-100 group-hover:!scale-105"
                                                src="{{ asset($employe->image) }}" alt="team-member-foto">
                                            <div
                                                class="item-overlay opacity-0 !absolute w-full h-full transition-all duration-[400ms] ease-[ease-in-out] left-0 top-0 bg-[rgba(20,20,20,0.25)] group-hover:opacity-[0.45]">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- Team Member Data -->
                                <div class="team-member-data relative ml-[5px]">
                                    <h6
                                        class="s-20 color--black w--700 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.4375rem] color--black !font-bold xl:!mb-[8px] lg:max-xl:!mb-[6px] md:max-lg:!mb-[6px] sm:max-md:!mb-[6px] xsm:max-sm:!mb-[6px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        {{ $employe->name ?? '' }}</h6>
                                    <p
                                        class="color--grey leading-none !font-normal tracking-[0] !mb-0 font-Jakarta xsm:max-sm:!text-[1.175rem]">
                                        {{ $employe->profession ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- END TEAM MEMBER #2 -->


                </div>
                <!-- End row -->
            </div>
            <!-- TEAM MEMBERS WRAPPER -->
           
        </div>
        <!-- End container -->
    </section>
    <!-- END TEAM-1 -->
