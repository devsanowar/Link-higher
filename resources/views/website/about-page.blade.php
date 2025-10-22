@extends('website.layouts.app')
@section('title', 'About Page')
@section('website_content')

    @include('website.layouts.pages.about.about-section')


    <!-- END ABOUT-2 -->

    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">


    @include('website.layouts.pages.about.mission-vision-section')

    <!-- STATISTIC-5
                                         ============================================= -->
    @include('website.layouts.pages.about.achievement-section')
    <!-- END STATISTIC-5 -->
    <!-- TEXT CONTENT
                                         ============================================= -->
    @include('website.layouts.pages.about.who-we-are-section')
    <!-- END TEXT CONTENT -->


    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
    <!-- BRANDS-1
                                         ============================================= -->
    @include('website.layouts.pages.about.trusted-client-section')
    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
    <!-- TEAM-1
                                         ============================================= -->
    @include('website.layouts.pages.about.employe-section')



    <!-- TESTIMONIALS-2
                                         ============================================= -->
   @include('website.layouts.pages.about.testimonial-section')
    <!-- END TESTIMONIALS-2 -->


    <section id="newsletter-1" class="newsletter-section">
        <div
            class="newsletter-overlay py-[60px] lg:max-xl:py-[45px] md:max-lg:!text-center md:max-lg:pt-[40px] md:max-lg:!pb-[30px] md:max-lg:px-[18%] sm:max-md:pt-[50px] sm:max-md:!pb-[40px] xsm:max-sm:pt-[50px] xsm:max-sm:!pb-[40px]">
            <div class="container">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center row-cols-1 row-cols-lg-2">
                    <!-- NEWSLETTER TEXT -->
                    <div class="xl:w-6/12 lg:max-xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div class="newsletter-txt">
                            <h4
                                class="s-34 w--700 xl:!text-[2.125rem] lg:max-xl:!text-[2rem] md:max-lg:!text-[1.764705rem] !font-bold leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4] xl:!mb-0 md:max-lg:!mb-[22px] md:max-lg:px-[10%] md:max-lg:py-0 sm:max-md:!text-[2.0625rem] sm:max-md:!mb-[30px] sm:max-md:px-[5%] sm:max-md:py-0 xsm:max-sm:!text-[1.75rem] xsm:max-sm:!mb-[25px] xsm:max-sm:!p-0">
                                Stay up to date with our news, ideas and updates</h4>
                        </div>
                    </div>
                    <!-- NEWSLETTER FORM -->
                    <div class="xl:w-6/12 lg:max-xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <form
                            class="newsletter-form mt-[30px] pl-[15%] lg:max-xl:!mt-[25px] lg:max-xl:!pl-[8%] md:max-lg:!mt-0 md:max-lg:px-[10%] md:max-lg:py-0 sm:max-md:!px-[10%] sm:max-md:py-0 xsm:max-sm:!px-[5%] xsm:max-sm:py-0 block">
                            <div class="input-group relative flex flex-wrap items-stretch w-full">
                                <input type="email" autocomplete="off"
                                    class="form-control xl:!h-[54px] xl:!text-[0.975rem] lg:max-xl:!text-[0.975rem] md:max-lg:!text-[1.0625rem] bg-white border !text-[#353f4f] !font-normal shadow-none xl:!mr-3 p-[0_15px] rounded-[6px] border-solid border-[#ccc] focus:bg-white focus:shadow-none focus:border-[#1680fb] lg:max-xl:!h-[50px] md:max-lg:!h-[46px] md:max-lg:mr-[8px] placeholder:text-[#aaa] focus:[outline:0] sm:max-md:!h-[54px] sm:max-md:!text-[1.0625rem] xsm:max-sm:!h-[54px] xsm:max-sm:!text-[1.0625rem] relative flex-[1_1_auto] !w-[1%] min-w-0"
                                    placeholder="Your email address" required id="s-email">
                                <span class="input-group-btn">
                                    <button type="submit"
                                        class="btn btn--theme hover--theme xl:!h-[54px] xl:!text-[0.925rem] xl:!px-[1.3rem] xl:!py-[0.7rem] lg:max-xl:!h-[50px] lg:max-xl:!text-[0.925rem] lg:max-xl:!px-[1.3rem] lg:max-xl:!py-[0.7rem] md:max-lg:!h-[46px] md:max-lg:!text-[1.0625rem] md:max-lg:!px-[1.3rem] md:max-lg:!py-[0.7rem] sm:max-md:!h-[54px] sm:max-md:!text-[1.0625rem] xsm:max-sm:!h-[54px] xsm:max-sm:!text-[1.0625rem]">Subscribe
                                        Now</button>
                                </span>
                            </div>
                            <!-- Newsletter Form Notification -->
                            <label for="s-email" class="form-notification"></label>
                        </form>
                    </div>
                    <!-- END NEWSLETTER FORM -->
                </div>
                <!-- End row -->
            </div>
            <!-- End container -->
        </div>
        <!-- End newsletter-overlay -->
    </section>
    <!-- END NEWSLETTER-1 -->
    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">


@endsection

@push('scripts')
    <script>
        $(function() {
            $('.video-popup2').magnificPopup({
                type: 'iframe',
                iframe: {
                    patterns: {
                        youtube: {
                            index: ['youtube.com/', 'youtu.be/'],
                            id: function(url) {
                                // watch?v=ID
                                var vMatch = url.match(/[?&]v=([^?&]+)/);
                                if (vMatch && vMatch[1]) return vMatch[1];

                                // youtu.be/ID
                                var short = url.match(/youtu\.be\/([^?&/]+)/);
                                if (short && short[1]) return short[1];

                                // embed/ID
                                var embed = url.match(/embed\/([^?&/]+)/);
                                if (embed && embed[1]) return embed[1];

                                return null;
                            },
                            src: 'https://www.youtube.com/embed/%id%?autoplay=1&rel=0'
                        }
                    }
                }
            });

        });
    </script>

@endpush
