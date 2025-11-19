<section id="smart-strategy-section"
    class="smart-strategy ct-02 content-section division">
    <div class="container">
        <!-- SECTION CONTENT (ROW) -->
        <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
            <!-- IMAGE BLOCK -->
            <div
                class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                <div
                    class="img-block !text-center left-column wow fadeInRight mr-[30px] lg:max-xl:mr-[5px] md:max-lg:mr-0 sm:max-md:mx-[3%] xsm:max-sm:m-[0_2%_35px]">
                    @if(empty($smartStrategy->image))
                    <img class="img-fluid" src="{{ asset('frontend') }}/images/img-07.png" alt="content-image">
                    @else
                    <img class="img-fluid" src="{{ asset($smartStrategy->image) }}" alt="content-image">
                    @endif
                </div>
            </div>
            <!-- TEXT BLOCK -->
            <div
                class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                <div class="txt-block right-column wow fadeInLeft">
                    <!-- Section ID -->
                    <span
                        class="section-id block !text-[0.85rem] leading-none !font-bold !tracking-[0.5px] uppercase xl:!mb-[35px] lg:max-xl:!mb-[30px] md:max-lg:!mb-[25px] sm:max-md:!mb-[25px] font-Jakarta">{{ $smartStrategy->subtitle ?? '' }}</span>
                    <!-- Title -->
                    <h2
                        class="s-46 w--700 xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] !font-bold leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] xl:!mb-[26px] lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px]">
                        {{ $smartStrategy->title ?? '' }}</h2>
                    <!-- Text -->
                    <p>
                        {{ $smartStrategy->description ?? '' }}
                    </p>
                    <!-- Small Title -->
                    <h5
                        class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4] xl:!mb-[20px] lg:max-xl:!mb-[18px] md:max-lg:!mb-[18px] sm:max-md:!mb-[18px]">
                        {{ $smartStrategy->feature_title ?? '' }}</h5>
                    <!-- List -->


                    @php
                        $features = is_string($smartStrategy->features)
                            ? json_decode($smartStrategy->features, true)
                            : $smartStrategy->features ?? [];
                    @endphp

                    @if (!empty($features) && is_array($features))
                        <ul class="simple-list">
                            @foreach ($features as $feat)
                                @php
                                    $text = is_array($feat) ? $feat['text'] ?? '' : $feat;
                                    $text = trim($text ?? '');
                                @endphp

                                @continue($text === '')

                                <li class="list-item">
                                    <p class="!mb-0">{{ $text }}
                                    </p>
                                </li>
                            @endforeach

                        </ul>
                    @endif
                </div>
            </div>
            <!-- END TEXT BLOCK -->
        </div>
        <!-- END SECTION CONTENT (ROW) -->
    </div>
    <!-- End container -->
</section>
