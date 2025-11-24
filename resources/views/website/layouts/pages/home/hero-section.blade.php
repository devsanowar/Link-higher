    {{-- <section
  id="hero-7"
  class="gr--perl hero-section relative md:max-lg:!mt-[80px] z-[3]"
  style="background: url('{{ asset('frontend/images/hero-bg-3.png') }}') repeat;"> --}}

    <section id="hero-7" class="gr--perl hero-section relative md:max-lg:!mt-[80px] z-[3] ">
        <div class="hero-overlay">
            <div class="container">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                    <!-- HERO TEXT -->
                    <div
                        class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div class="hero-7-txt wow fadeInRight">
                            <!-- Title -->
                            <h2
                                class="s-54 w--700 xl:!text-[3.375rem] lg:max-xl:!text-[3.125rem] md:max-lg:!text-[2.79411rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] xl:!mb-[28px] lg:max-xl:!mb-[24px] md:max-lg:!mb-[18px] sm:max-md:!mb-[15px] xsm:max-sm:!mb-[18px]">
                                {{ $hero->title ?? '' }}</h2>
                            <!-- Text -->
                            <p
                                class="p-lg xl:!mb-[32px] lg:max-xl:!mb-[28px] md:max-lg:!mb-[24px] sm:max-md:!mb-[25px] xsm:max-sm:!mb-[25px]">
                                {!! $hero->short_description ?? '' !!}
                            </p>
                            <!-- HERO QUICK FORM -->
                            <form name="quickform"
                                class="quick-form form-shadow form-half mt--35 mt-[35px] mr-[4%] lg:max-xl:mr-[3%] md:max-lg:mr-[2%] sm:max-md:!mt-[25px] sm:max-md:!mb-0 sm:max-md:mx-[4%] xsm:max-sm:mx-[3%]">
                                <!-- Form Inputs -->
                                <div class="input-group [border:none] relative flex flex-wrap items-stretch w-full">
                                    {{-- <input type="email" name="email"
                                        class="form-control relative flex-[1_1_auto] min-w-0 block w-[1%] email r-06 rounded-[6px] !h-[58px] !text-[1.0625rem] lg:max-xl:!h-[54px] lg:max-xl:!text-[1rem] lg:max-xl:px-[14px] lg:max-xl:py-0 md:max-lg:!h-[48px] md:max-lg:!text-[1.0625rem] md:max-lg:px-[12px] md:max-lg:py-0 xsm:max-sm:!h-[58px] xsm:max-sm:!text-[1.175rem] xsm:max-sm:px-[14px] xsm:max-sm:py-0 shadow-[0_5px_10px_rgba(0,0,0,0.05)] bg-white !text-[#666] !font-normal [transition:all_450ms_ease-in-out] p-[0_20px] [border:2px_solid_transparent] focus:bg-white focus:shadow-none focus:border-[#1680fb] focus:[outline:0] placeholder:text-[#999] "
                                        placeholder="Your email address" autocomplete="off" required> --}}

                                    <span class="input-group-btn form-btn">
                                        <a href="{{ $hero->button_one_url ?? '#' }}"
                                            class="custom-button btn r-06 rounded-[6px] hover--theme submit !h-[58px] !text-[1rem] xl:ml-[14px] xl:px-[40px] xl:py-[13px] lg:max-xl:!h-[54px] lg:max-xl:!text-[0.985rem] lg:max-xl:ml-[10px] lg:max-xl:px-[40px] lg:max-xl:py-[13px] md:max-lg:!h-[48px] md:max-lg:!text-[1rem] md:max-lg:ml-[10px] md:max-lg:px-[22px] md:max-lg:py-[13px] xsm:max-sm:!h-[58px] xsm:max-sm:!text-[1.15rem]">
                                            {{ $hero->button_one ?? 'Get Plan' }}
                                        </a>
                                    </span>


                                    <span class="input-group-btn form-btn">
                                        <a href="{{ $hero->button_two_url ?? '#' }}"
                                            class="get-statred btn r-06 rounded-[6px] btn--theme hover--theme submit !h-[58px] !text-[1rem] xl:ml-[14px] xl:px-[40px] xl:py-[13px] lg:max-xl:!h-[54px] lg:max-xl:!text-[0.985rem] lg:max-xl:ml-[10px] lg:max-xl:px-[40px] lg:max-xl:py-[13px] md:max-lg:!h-[48px] md:max-lg:!text-[1rem] md:max-lg:ml-[10px] md:max-lg:px-[22px] md:max-lg:py-[13px] xsm:max-sm:!h-[58px] xsm:max-sm:!text-[1.15rem]">{{ $hero->button_two ?? 'Get Plan' }}</a>
                                    </span>
                                </div>

                            </form>
                            <!-- END HERO QUICK FORM -->
                        </div>
                    </div>
                    <!-- END HERO TEXT -->
                    <!-- HERO IMAGE -->
                    <div
                        class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div class="hero-7-img !text-center wow fadeInLeft">
                            @if ($hero->image)
                                <img class="img-fluid" src="{{ asset($hero->image) }}" alt="hero-image">
                            @else
                                <img class="img-fluid" src="{{ asset('frontend') }}/images/img-06.png" alt="hero-image">
                            @endif
                        </div>
                    </div>
                </div>
                <!-- End row -->
            </div>
            <!-- End container -->
        </div>
        <!-- End hero-overlay -->
    </section>
