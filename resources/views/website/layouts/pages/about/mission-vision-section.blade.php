<div id="about-3" class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  about-section division">
        <div class="container">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] ">
                <!-- ABOUT-3 TEXT -->
                <div
                    class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                    <div id="a3-1" class="txt-block">
                        <!-- Title -->
                        <h5
                            class="s-24 w--700 xl:!mb-[20px] lg:max-xl:!mb-[18px] md:max-lg:!mb-[18px] sm:max-md:!mb-[18px] xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                            {{ $missionVision->mission_title ?? '' }}</h5>
                        <!-- Text -->
                        <p>
                            {!! $missionVision->mission ?? '' !!}
                        </p>
                        <!-- List -->
                        {{-- <ul class="simple-list">
                            <li class="list-item">
                                <p>Tempor sapien quaerat an ipsum laoreet purus and sapien dolor an ultrice ipsum
                                    aliquam undo congue dolor cursus
                                </p>
                            </li>
                            <li class="list-item">
                                <p class="!mb-0">Cursus purus suscipit vitae cubilia magnis volute egestas vitae
                                    sapien turpis ultrice auctor congue magna placerat
                                </p>
                            </li>
                        </ul> --}}
                    </div>
                </div>
                <!-- END ABOUT-3 TEXT -->
                <!-- ABOUT-3 TEXT -->
                <div
                    class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                    <div id="a3-2" class="txt-block">
                        <!-- Title -->
                        <h5
                            class="s-24 w--700 xl:!mb-[20px] lg:max-xl:!mb-[18px] md:max-lg:!mb-[18px] sm:max-md:!mb-[18px] xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                            {{ $missionVision->vision_title ?? '' }}</h5>
                        <!-- Text -->
                        <p>
                            {!! $missionVision->vision ?? '' !!}
                        </p>

                    </div>
                </div>
                <!-- END ABOUT-3 TEXT -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </div>
