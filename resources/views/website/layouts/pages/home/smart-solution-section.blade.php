<section class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  ws-wrapper content-section">
    <div class="container">
        <div
            class="bc-1-wrapper bg--02 r-16 bg--fixed rounded-[16px] bg-scroll sm:max-md:w-auto xsm:max-sm:w-auto w-full bg-no-repeat bg-[center_center] bg-cover bg-[url(./images/bg-02.jpg)]">
            <div
                class="section-overlay p-[80px_70px] lg:max-xl:px-[50px] lg:max-xl:py-[65px] md:max-lg:px-[40px] md:max-lg:py-[60px] sm:max-md:!px-[50px] sm:max-md:py-[70px] xsm:max-sm:px-[22px] xsm:max-sm:py-[70px]">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                    <!-- IMAGE BLOCK -->
                    <div
                        class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div
                            class="img-block !text-center left-column wow fadeInRight lg:max-xl:pr-[10px] md:max-lg:pr-0 pr-[10px]">
                            @if (empty($smartSolution->image_one))
                                <img class="img-fluid" src="images/img-09.png" alt="content-image">
                            @else
                                <img class="img-fluid" src="{{ asset($smartSolution->image_one) }}" alt="content-image">
                            @endif
                        </div>
                    </div>
                    <!-- TEXT BLOCK -->
                    <div
                        class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div class="txt-block right-column wow fadeInLeft">
                            <!-- Section ID -->
                            <span
                                class="section-id block !text-[0.85rem] leading-none !font-bold !tracking-[0.5px] uppercase xl:!mb-[35px] lg:max-xl:!mb-[30px] md:max-lg:!mb-[25px] sm:max-md:!mb-[25px] font-Jakarta">{{ $smartSolution->subtitle ?? '' }}</span>
                            <!-- Title -->
                            <h2
                                class="s-46 w--700 xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] !font-bold leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] xl:!mb-[26px] lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px]">
                                {{ $smartSolution->title ?? '' }}</h2>
                            <!-- Text -->
                            <p>{!! $smartSolution->description ?? '' !!}
                            </p>
                            <!-- Small Title -->
                            @foreach ($smartSolutionFeatures as $key => $item)
                                @if ($loop->first)
                                    <h5 class="s-24 w--700 h5-title my-[20px] !font-bold leading-[1.35]">
                                        {{ $item['feature_title'] ?? 'The smarter way to work' }}
                                    </h5>
                                    <p class="!mb-0">
                                        {{ $item['feature_description'] ?? 'Sapien tempor sodales quaerat ipsum undo congue laoreet...' }}
                                    </p>
                                @endif
                            @endforeach


                        </div>
                    </div>
                    <!-- END TEXT BLOCK -->
                </div>
                <!-- End row -->
            </div>
            <!-- End section overlay -->
        </div>
        <!-- End content wrapper -->
    </div>
    <!-- End container -->
</section>


{{-- <section id="lnk-2"
    class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  ct-01 content-section division">
    <div class="container">
        <!-- SECTION CONTENT (ROW) -->
        <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
            <!-- TEXT BLOCK -->

            <div
                class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-last order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                <div class="txt-block left-column wow fadeInRight">
                    @foreach ($smartSolutionFeatures as $item)
                        @unless ($loop->first)
                            <!-- TEXT BOX -->
                            <div class="txt-box !mb-[20px] md:max-lg:!mb-[5px] last:!mb-0">
                                <!-- Title -->
                                <h5
                                    class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4] xl:!mb-[20px] lg:max-xl:!mb-[18px] md:max-lg:!mb-[18px] sm:max-md:!mb-[18px]">
                                    {{ $item['feature_title'] ?? 'Solution that grows with you' }}
                                </h5>

                                <!-- Text -->
                                <p>
                                    {{ $item['feature_description'] ?? 'Sodales tempor sapien quaerat ipsum undo congue laoreet turpis neque auctor turpis vitae dolor luctus placerat magna and ligula cursus purus vitae purus an ipsum suscipit' }}
                                </p>
                            </div>
                            <!-- END TEXT BOX -->
                        @endunless
                    @endforeach


                </div>
            </div>
            <!-- END TEXT BLOCK -->
            <!-- IMAGE BLOCK -->
            <div
                class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-first order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                <div
                    class="img-block !text-center right-column wow fadeInLeft ml-[30px] lg:max-xl:ml-[5px] md:max-lg:ml-0 sm:max-md:!mx-[3%] xsm:max-sm:!m-[0_2%_35px]">
                    @if (empty($smartSolution->image_two))
                    <img class="img-fluid" src="images/img-05.png" alt="content-image">
                    @else
                    <img class="img-fluid" src="{{ asset($smartSolution->image_two) }}" alt="content-image">
                    @endif
                </div>
            </div>
        </div>
        <!-- END SECTION CONTENT (ROW) -->
    </div>
    <!-- End container -->
</section> --}}
