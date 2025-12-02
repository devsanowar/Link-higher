<section id="who-we-are"
        class="bg--04 bg--fixed ct-01 content-section division bg-no-repeat bg-[center_center] bg-cover bg-scroll sm:max-md:w-auto xsm:max-sm:w-auto w-full" style="background: url('{{ asset('frontend/images/hero-bg-3.png') }}') repeat;">
        <div class="container">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                <!-- TEXT BLOCK -->
                <div
                    class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-last order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                    <div class="txt-block left-column wow fadeInRight">
                        <!-- Section ID -->
                        <span
                            class="section-id block !text-[0.85rem] leading-none !font-bold !tracking-[0.5px] uppercase xl:!mb-[35px] lg:max-xl:!mb-[30px] md:max-lg:!mb-[25px] sm:max-md:!mb-[25px] font-Jakarta">{{ $whoWeAre->profession ?? '' }}</span>
                        <!-- Title -->
                        <h2
                            class="s-50 w--700 xl:!text-[3.125rem] lg:max-xl:!text-[2.875rem] md:max-lg:!text-[2.64705rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px] xl:!mb-[26px] xl:!leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] !tracking-[-0.5px]">
                            {{ $whoWeAre->name ?? '' }}</h2>
                        <!-- Text -->
                        <p class="p-lg">&quot;{!! $whoWeAre->description ?? '' !!}&quot;
                        </p>
                    </div>
                </div>
                <!-- END TEXT BLOCK -->
                <!-- IMAGE BLOCK -->
                <div
                    class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-first order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                    <div
                        class="img-block j-img video-preview right-column wow fadeInLeft relative !text-center ml-[30px] lg:max-xl:ml-[5px] md:max-lg:ml-0 sm:max-md:mx-[3%] xsm:max-sm:m-[0_2%_35px]">
                        <!-- Play Icon -->
                        <a class="video-popup2" href="{{ $whoWeAre->video_url ?? '' }}">
                            <div
                                class="video-btn video-btn-xl !w-[6.25rem] !h-[6.25rem] mt-[-3.125rem] ml-[-3.125rem] md:max-lg:w-28 md:max-lg:!h-28 md:max-lg:!mt-[-3.5rem] md:max-lg:ml-[-3.5rem] !absolute inline-block !text-center !text-white rounded-[100%] left-2/4 top-2/4 before:content-[''] before:absolute before:left-[-5px] before:right-[-5px] before:top-[-5px] before:bottom-[-5px] before:opacity-0 before:transition-all before:duration-[400ms] before:ease-[ease-in-out] before:rounded-[50%] before:bg-[rgba(255,255,255,0.2)] group hover:before:opacity-75  hover:before:left-[-1.5rem]  hover:before:right-[-1.5rem]  hover:before:top-[-1.5rem]  hover:before:bottom-[-1.5rem] bg--theme">
                                <div
                                    class="video-block-wrapper transition-all duration-[400ms] ease-[ease-in-out] group-hover:scale-95">
                                    <span class="flaticon-play-button"></span>
                                </div>
                            </div>
                        </a>
                        <!-- Preview Image -->
                        @if (empty($whoWeAre->image))
                            <img class="img-fluid rounded-[20px] inline-block"
                                src="{{ asset('frontend') }}/images/img-17.jpg" alt="video-preview">
                        @else
                            <img class="img-fluid rounded-[20px] inline-block" src="{{ asset($whoWeAre->image) }}"
                                alt="video-preview">
                        @endif

                    </div>
                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </section>
