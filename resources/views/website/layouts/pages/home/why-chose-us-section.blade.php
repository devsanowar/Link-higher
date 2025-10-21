<section id="features-13"
    class="shape--bg  shape--white-500 features-section division after:bg-[#f2f4f8] pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px] after:absolute after:content-[''] after:z-[-1] after:w-[48%] after:h-[72%] after:top-[21%] lg:max-xl:after:!w-6/12 lg:max-xl:after:!h-[76%] lg:max-xl:after:!top-[18%] md:max-lg:after:!w-[52%] md:max-lg:after:!h-3/4 md:max-lg:after:!top-[19%] xsm:max-sm:after:!h-[64%] xsm:max-sm:after:!top-[32.35%]">
    <div class="container">
        <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
            <!-- FEATURES-13 WRAPPER -->
            @php
                // ডিফল্ট আইকন (icon_class না থাকলে)
                $defaultIcon = 'flaticon-layers-1';
            @endphp

            <div
                class="md:w-7/12 lg:max-xl:w-7/12 xl:w-7/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-last order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                <div class="fbox-13-wrapper wow fadeInRight pr-[45px] lg:max-xl:pr-[30px] md:max-lg:pr-0">

                    {{-- প্রতি রোতে ৪টা করে নেবো (বাম কলামে ২টা + ডান কলামে ২টা) --}}
                    @foreach ($reasons->chunk(4) as $group)
                        <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] ">

                            {{-- LEFT COLUMN --}}
                            <div
                                class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                                @foreach ($group->slice(0, 2) as $reason)
                                    {{-- FEATURE BOX --}}
                                    <div
                                        class="fbox-12 bg--white-100 block-shadow rounded-[12px] {{ $loop->first ? 'mb--30 xl:!mb-[30px]' : '' }} px-[35px] py-[32px] lg:max-xl:!p-[30px] md:max-lg:px-[18px] md:max-lg:py-[22px] sm:max-md:!px-[50px] sm:max-md:py-[40px] xsm:max-sm:px-[30px] xsm:max-sm:py-[35px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">

                                        <!-- Icon -->
                                        <div class="fbox-ico ico-50 !mb-[20px] xsm:max-sm:!mb-[20px]">
                                            <div class="shape-ico color--theme relative inline-block !m-[0_auto]">
                                                <!-- Vector Icon (dynamic) -->
                                                <span
                                                    class="{{ $reason->icon_class ?? $defaultIcon }} relative z-[2]"></span>
                                                <!-- Shape -->
                                                <svg class="xl:!w-[130px] xl:!h-[130px] top-[-35px] left-[calc(50%_-_60px)] lg:max-xl:!w-[110px] lg:max-xl:!h-[110px] lg:max-xl:top-[-30px] lg:max-xl:left-[calc(50%_-_55px)] md:max-lg:!w-[95px] md:max-lg:!h-[95px] md:max-lg:top-[-25px] md:max-lg:left-[calc(50%_-_50px)] sm:max-md:!w-[125px] sm:max-md:!h-[125px] sm:max-md:top-[-35px] sm:max-md:left-[calc(50%_-_65px)] xsm:max-sm:!w-[120px] xsm:max-sm:!h-[120px] xsm:max-sm:top-[-35px] xsm:max-sm:left-[calc(50%_-_60px)] !absolute z-[1]"
                                                    viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M69.8,-23C76.3,-2.7,57.6,25.4,32.9,42.8C8.1,60.3,-22.7,67,-39.1,54.8C-55.5,42.7,-57.5,11.7,-48.6,-11.9C-39.7,-35.5,-19.8,-51.7,5.9,-53.6C31.7,-55.6,63.3,-43.2,69.8,-23Z"
                                                        transform="translate(100 100)" />
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- End Icon -->

                                        <!-- Text -->
                                        <div class="fbox-txt">
                                            <h5
                                                class="s-19 w--700 xl:!text-[1.1875rem] lg:max-xl:!text-[1.125rem] md:max-lg:!text-[1.3rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold mt-[20px] !mb-[10px] md:max-lg:!mb-[10px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                                {{ $reason->title ?? 'Title' }}</h5>
                                            <p class="!mb-0">
                                                {{ ($reason->description ?? 'Description') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- RIGHT COLUMN --}}
                            <div
                                class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                                @foreach ($group->slice(2, 2) as $reason)
                                    {{-- FEATURE BOX --}}
                                    <div
                                        class="fbox-12 bg--white-100 block-shadow rounded-[12px] {{ $loop->first ? 'mb--30 xl:!mb-[30px]' : '' }} px-[35px] py-[32px] lg:max-xl:!p-[30px] md:max-lg:px-[18px] md:max-lg:py-[22px] sm:max-md:!px-[50px] sm:max-md:py-[40px] xsm:max-sm:px-[30px] xsm:max-sm:py-[35px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">

                                        <!-- Icon -->
                                        <div class="fbox-ico ico-50 !mb-[20px] xsm:max-sm:!mb-[20px]">
                                            <div class="shape-ico color--theme relative inline-block !m-[0_auto]">
                                                <!-- Vector Icon (dynamic) -->
                                                <span
                                                    class="{{ $reason->icon_class ?? $defaultIcon }} relative z-[2]"></span>
                                                <!-- Shape -->
                                                <svg class="xl:!w-[130px] xl:!h-[130px] top-[-35px] left-[calc(50%_-_60px)] lg:max-xl:!w-[110px] lg:max-xl:!h-[110px] lg:max-xl:top-[-30px] lg:max-xl:left-[calc(50%_-_55px)] md:max-lg:!w-[95px] md:max-lg:!h-[95px] md:max-lg:top-[-25px] md:max-lg:left-[calc(50%_-_50px)] sm:max-md:!w-[125px] sm:max-md:!h-[125px] sm:max-md:top-[-35px] sm:max-md:left-[calc(50%_-_65px)] xsm:max-sm:!w-[120px] xsm:max-sm:!h-[120px] xsm:max-sm:top-[-35px] xsm:max-sm:left-[calc(50%_-_60px)] !absolute z-[1]"
                                                    viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M69.8,-23C76.3,-2.7,57.6,25.4,32.9,42.8C8.1,60.3,-22.7,67,-39.1,54.8C-55.5,42.7,-57.5,11.7,-48.6,-11.9C-39.7,-35.5,-19.8,-51.7,5.9,-53.6C31.7,-55.6,63.3,-43.2,69.8,-23Z"
                                                        transform="translate(100 100)" />
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- End Icon -->

                                        <!-- Text -->
                                        <div class="fbox-txt">
                                            <h5
                                                class="s-19 w--700 xl:!text-[1.1875rem] lg:max-xl:!text-[1.125rem] md:max-lg:!text-[1.3rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold mt-[20px] !mb-[10px] md:max-lg:!mb-[10px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                                {{ $reason->title ?? 'Title' }}</h5>
                                            <p class="!mb-0">
                                                {!! $reason->description ?? 'Description' !!}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <!-- End row -->
                    @endforeach

                </div>
            </div>

            <!-- END FEATURES-13 WRAPPER -->
            <!-- TEXT BLOCK -->
            <div
                class="md:w-5/12 lg:max-xl:w-5/12 xl:w-5/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-first order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">

                <div class="txt-block left-column wow fadeInLeft">
                    <!-- Section ID -->
                    <span
                        class="section-id block !text-[0.85rem] leading-none !font-bold !tracking-[0.5px] uppercase xl:!mb-[35px] lg:max-xl:!mb-[30px] md:max-lg:!mb-[25px] sm:max-md:!mb-[25px] font-Jakarta">{{ $whyChoseUs->subtitle ?? '' }}</span>
                    <!-- Title -->
                    <h2
                        class="s-46 w--700 xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] !font-bold lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px] xl:!mb-[26px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                        {{ $whyChoseUs->title ?? '' }}</h2>
                    <!-- Text -->
                    <p>
                        {!! $whyChoseUs->description ?? '' !!}
                    </p>

                </div>
            </div>
            <!-- END TEXT BLOCK -->
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
</section>
