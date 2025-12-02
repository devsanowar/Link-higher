<section id="features-2" class="features-section division" style="background: url('{{ asset('frontend/images/hero-bg-3.png') }}') repeat;">
    <div class="container custom-features">
        <!-- SECTION TITLE -->
        <div class="header">
            <div class="title">{{ $goalProgressSectionTitile->section_title ?? '' }}</div>

        </div>

        <!-- FEATURES-2 WRAPPER -->
        <div class="fbox-wrapper !text-center">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  row-cols-1 row-cols-md-3" >

                <!-- FEATURE BOX #2 -->
                @foreach ($goalProgesses as $goalProgess)
                    <div class="progress-box" style="width: 32%; margin: 5px;">
                        <div class="fbox-2 fb-2 wow fadeInUp tracking-box">
                            <!-- Image -->
                            <div
                                class="fbox-img traking-box-image" >
                                @if (empty($goalProgess->image))
                                    <img class="img-fluid light-theme-img mb-[-25px] xl:!max-h-[175px] md:max-lg:!max-h-32 sm:max-md:!max-h-[220px] xsm:max-sm:!max-h-[185px] lg:max-xl:!max-h-40 w-auto max-w-[inherit] inline-block"
                                        src="images/f_02.png" alt="feature-image">
                                @else
                                    <img class="img-fluid light-theme-img mb-[-25px] xl:!max-h-[175px] md:max-lg:!max-h-32 sm:max-md:!max-h-[220px] xsm:max-sm:!max-h-[185px] lg:max-xl:!max-h-40 w-auto max-w-[inherit] inline-block"
                                        src="{{ asset($goalProgess->image) }}" alt="feature-image">
                                @endif

                            </div>
                            <!-- Text -->
                            <div class="fbox-txt">
                                <h6
                                    class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold !mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                    {{ $goalProgess->title ?? '' }}</h6>
                                <p class="!mb-0">{!! $goalProgess->description !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- END FEATURE BOX #2 -->

            </div>
            <!-- End row -->
        </div>
        <!-- END FEATURES-2 WRAPPER -->
    </div>
    <!-- End container -->
</section>
