<div id="statistic-1" class=" py--100 py-[100px] lg:max-xl:py-[80px] md:max-lg:py-[70px]  statistic-section division">
    <div class="container">
        <!-- STATISTIC-1 WRAPPER -->
        <div class="statistic-1-wrapper">
            <div
                class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-content-md-center md:max-lg:justify-center lg:max-xl:justify-center xl:justify-center row-cols-1 row-cols-md-3">

                <!-- STATISTIC BLOCK #2 -->
                @foreach ($achievements as $achievement)
                    <div class="md:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                        <div id="sb-1-2" class="wow fadeInUp">
                            <div class="statistic-block">
                                <!-- Digit -->
                                <div
                                    class="statistic-block-digit !text-center xl:!w-[35%] inline-block float-left lg:max-xl:!w-[32%] md:max-lg:!w-full md:max-lg:block md:max-lg:float-none md:max-lg:!mb-[15px] sm:max-md:!mb-[12px] xsm:max-sm:!mb-[12px]">
                                    <h2
                                        class="s-46 statistic-number leading-none !font-bold tracking-[-1px] !mb-0 md:max-lg:tracking-[-0.5px] xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.5rem] sm:max-md:!leading-[1.35] xsm:max-sm:!text-[2.25rem] font-Jakarta">
                                        <span class="count-element">{{ $achievement->count_value ?? '' }}</span>%
                                    </h2>
                                </div>
                                <!-- Text -->
                                <div
                                    class="statistic-block-txt color--grey xl:!w-[65%] inline-block pl-[20px] lg:max-xl:!w-[68%] lg:max-xl:!pl-[10px] md:max-lg:!w-full md:max-lg:inline-block md:max-lg:!p-[0_8%] md:max-lg:!text-center">
                                    <p class="p-md leading-[1.35] !mb-0">{{ $achievement->title ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- END STATISTIC BLOCK #2 -->

            </div>
            <!-- End row -->
        </div>
        <!-- END STATISTIC-1 WRAPPER -->
    </div>
    <!-- End container -->
</div>
