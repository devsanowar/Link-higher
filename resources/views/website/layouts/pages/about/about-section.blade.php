<section id="hero-7" class="about-us gr--perl hero-section relative md:max-lg:!mt-[80px] z-[3] ">
        <div class="hero-overlay">
            <div class="container">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] items-center">

                    <!-- HERO IMAGE (now first / left column) -->
                    <div
                        class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-1 md:order-1">
                        <div class="hero-7-img !text-center wow fadeInLeft">
                            @if ($about->image)
                                <img class="img-fluid" src="{{ asset($about->image) }}" alt="hero-image">
                            @else
                                <img class="img-fluid" src="{{ asset('frontend/images/img-06.png') }}" alt="hero-image">
                            @endif
                        </div>
                    </div>

                    <!-- HERO TEXT (now second / right column) -->
                    <div
                        class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-2 md:order-2">
                        <div class="hero-7-txt wow fadeInRight about-us-text">
                            <h2
                                class="s-54 w--700 2xl:!text-[3rem] xl:!text-[2.5rem] lg:max-xl:!text-[3rem] md:max-lg:!text-[2.79411rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] xl:!mb-[28px] lg:max-xl:!mb-[24px] md:max-lg:!mb-[18px] sm:max-md:!mb-[15px] xsm:max-sm:!mb-[18px]">
                                {{ $about->title ?? '' }}
                            </h2>

                            <p
                                class="p-lg xl:!mb-[32px] lg:max-xl:!mb-[28px] md:max-lg:!mb-[24px] sm:max-md:!mb-[25px] xsm:max-sm:!mb-[25px]">
                                {!! $about->description ?? '' !!}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
