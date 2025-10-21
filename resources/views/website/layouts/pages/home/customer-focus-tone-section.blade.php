    <section id="lnk-3"
        class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  ws-wrapper content-section">
        <div class="container">
            <div
                class="bc-5-wrapper bg--04 hidd bg--scroll rounded-[16px]  bg-no-repeat bg-[center_center] bg-cover bg-[url(./images/bg-04.jpg)] w-full bg-scroll sm:max-md:w-auto xsm:max-sm:w-auto">
                <div
                    class="section-overlay xl:!p-[80px_70px_0] lg:max-xl:pt-[65px] lg:max-xl:px-[50px] md:max-lg:pt-[60px] md:max-lg:px-[40px] sm:max-md:!p-[70px_40px_0] xsm:max-sm:!p-[70px_17px_0] w-full h-full">
                    <!-- SECTION TITLE -->
                    <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                        <div
                            class="md:w-11/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                            <div
                                class="section-title wow fadeInUp !text-center mb--60 !mb-[60px] lg:max-xl:!mb-[50px] md:max-lg:!mb-[50px] ">
                                <!-- Title -->
                                <h2
                                    class="s-50 w--700 xl:!text-[3.125rem] lg:max-xl:!text-[2.875rem] md:max-lg:!text-[2.64705rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold !tracking-[-0.5px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                                    {{ $customerFocusTone->title ?? '' }}</h2>
                                <!-- Text -->
                                <p
                                    class="p-xl mt-[18px] !mb-0 lg:max-xl:!mt-[15px] md:max-lg:!mt-[12px] sm:max-md:!mt-[14px] xsm:max-sm:!text-[1.125rem] xsm:max-sm:!mt-[14px] xsm:max-sm:px-[5%] xsm:max-sm:py-0 !p-0">
                                    {!! $customerFocusTone->description ?? '' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- IMAGE BLOCK -->
                    <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                        <div class="row flex-[1_0_0%] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div
                                class="bc-5-img bc-5-tablet img-block-hidden video-preview wow fadeInUp mb-[-200px] md:max-lg:!mb-[-150px] sm:max-md:!mb-[-100px] xsm:max-sm:!mb-[-70px] relative !text-center">
                                <!-- Play Icon -->
                                <a class="video-popup1" href="{{ $customerFocusTone->video_url ?? '' }}">
                                    <div
                                        class="video-btn video-btn-xl bg--theme w-[6.25rem] h-[6.25rem] mt-[-3.125rem] ml-[-3.125rem] hover:before:opacity-75 md:max-lg:w-28 md:max-lg:!h-28 md:max-lg:!mt-[-3.5rem] md:max-lg:ml-[-3.5rem] top-[calc(50%_-_70px)] md:max-lg:top-[calc(50%_-_60px)] xsm:max-sm:top-[calc(50%_-_30px)] !absolute inline-block !text-center !text-white rounded-[100%] left-2/4 before:content-[''] before:absolute before:left-[-5px] before:right-[-5px] before:top-[-5px] before:bottom-[-5px] before:opacity-0 before:transition-all before:duration-[400ms] before:ease-[ease-in-out] before:rounded-[50%] before:bg-[rgba(255,255,255,0.2)] group">
                                        <div
                                            class="video-block-wrapper transition-all duration-[400ms] ease-[ease-in-out] group-hover:scale-95">
                                            <span class="flaticon-play-button"></span>
                                        </div>
                                    </div>
                                </a>
                                <!-- Preview Image -->
                                @if (empty($customerFocusTone->video_thumbnail))
                                    <img class="img-fluid inline-block"
                                        src="{{ asset('frontend') }}/images/tablet-02.png" alt="content-image">
                                @else
                                    <img class="img-fluid inline-block"
                                        src="{{ asset($customerFocusTone->video_thumbnail) }}" alt="content-image">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End section overlay -->
            </div>
            <!-- End content wrapper -->
        </div>
        <!-- End container -->
    </section>

@push('scripts')
<script>
  $(function () {
    $('.video-popup1').magnificPopup({
      type: 'iframe',
      iframe: {
        patterns: {
          youtube: {
            index: ['youtube.com/', 'youtu.be/'],
            id: function (url) {
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

