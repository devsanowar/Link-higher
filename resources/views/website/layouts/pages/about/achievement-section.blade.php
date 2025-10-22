    <div id="statistic-5" class=" py--100 py-[100px] lg:max-xl:py-[80px] md:max-lg:py-[70px]  statistic-section division">
        <div class="container">
            <!-- STATISTIC-1 WRAPPER -->
            <div class="statistic-5-wrapper">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  row-cols-1 row-cols-md-3">
                    <!-- STATISTIC BLOCK #1 -->
                    @foreach ($achievements as $achievement)
                        <div
                            class="col md:max-lg:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div id="sb-5-1" class="wow fadeInUp">
                                <div class="statistic-block">
                                    <!-- Digit -->
                                    <div
                                        class="statistic-digit xl:!m-[0_100px_20px_0] xl:!pb-[20px] border-b-[#999] border-b border-solid lg:max-xl:ml-0 lg:max-xl:mr-[70px] lg:max-xl:!mt-0 lg:max-xl:!mb-[18px] lg:max-xl:!pb-[18px] md:max-lg:ml-0  md:max-lg:mr-[40px]  md:max-lg:!mt-0  md:max-lg:!mb-[15px] md:max-lg:!pb-[15px] sm:max-md:!m-[0_12%_20px] xsm:max-sm:!m-[0_12%_18px] xsm:max-sm:!pb-[18px]">
                                        <h2
                                            class="s-44 w--700 xl:!text-[2.75rem] lg:max-xl:!text-[2.5rem] md:max-lg:!text-[2.20588rem] sm:max-md:!text-[2.5rem] xsm:max-sm:!text-[2.25rem] !font-bold tracking-[-1.5px] lg:max-xl:tracking-[-0.5px] md:max-lg:tracking-[-0.5px] sm:max-md:tracking-[-0.5px] xsm:max-sm:tracking-[-0.5px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                                            <span class="count-element">{{ $achievement->count_value }}+
                                        </h2>
                                    </div>
                                    <!-- Text -->
                                    <div class="statistic-txt">
                                        <h5
                                            class="s-19 w--700 xl:!text-[1.1875rem] lg:max-xl:!text-[1.125rem] md:max-lg:!text-[1.3rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold font-Jakarta leading-none xl:!mb-[12px] lg:max-xl:!mb-[10px] md:max-lg:!mb-[10px] sm:max-md:!mb-[12px]">
                                            {{ $achievement->title ?? '' }}</h5>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- END STATISTIC BLOCK #1 -->


                </div>
                <!-- End row -->
            </div>
            <!-- END STATISTIC-5 WRAPPER -->
        </div>
        <!-- End container -->
    </div>
