@extends('website.layouts.app')
@section('title', 'Case Studies Single Page')
@section('website_content')
    <section id="service-page-breadcrumb" class="container">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title"> Case Study Details Page</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li class="active">Case Study</li>
            </ul>
        </div>
    </section>

    <section id="caseStudy-1"
        class="inner-page-hero single-caseStudy pt-[0px] lg:max-xl:pt-[0px] md:max-lg:!mt-[0px] md:max-lg:pt-[0px]">
        <div class="container">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <!-- caseStudy DISCRIPTION -->
                <div class="lg:w-11/12 xl:w-10/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                    <div class="caseStudy-description">
                        <!-- caseStudy TITLE -->
                        <div class="caseStudy-title">
                            <!-- Title -->
                            <h2
                                class="s-52 w--700 [border-bottom:1px_solid_#ddd] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                                {{ $caseStudy->title ?? '' }}</h2>
                            <!-- caseStudy Data -->
                            <div class="caseStudy-data">
                                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] row-cols-1 row-cols-sm-2 row-cols-md-3">
                                    <div
                                        class="col sm:w-6/12 md:max-lg:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                        <p class="p-lg !mb-[4px] sm:max-md:!mb-[10px] xsm:max-sm:!mb-[5px]"><span
                                                class=" !text-[#353f4f] font-medium">Category:</span>
                                            {{ $caseStudy->category->name ?? '' }}</p>
                                    </div>
                                    <div
                                        class="col sm:w-6/12 md:max-lg:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                        <p class="p-lg !mb-[4px] sm:max-md:!mb-[10px] xsm:max-sm:!mb-[5px]">
                                            <span class="!text-[#353f4f] font-medium">Start Date:</span>
                                            {{ $caseStudy->start_date ? \Carbon\Carbon::parse($caseStudy->start_date)->format('d M, Y') : '' }}
                                        </p>
                                    </div>

                                    <div
                                        class="col sm:w-6/12 md:max-lg:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                        <p class="p-lg !mb-[4px] sm:max-md:!mb-[10px] xsm:max-sm:!mb-[5px]">
                                            <span class="!text-[#353f4f] font-medium">Handover:</span>
                                            {{ $caseStudy->end_date ? \Carbon\Carbon::parse($caseStudy->end_date)->format('d M, Y') : '' }}
                                        </p>
                                    </div>

                                    <div
                                        class="col sm:w-6/12 md:max-lg:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                        <p class="p-lg !mb-[4px] sm:max-md:!mb-[10px] xsm:max-sm:!mb-[5px]"><span
                                                class=" !text-[#353f4f] font-medium">Client:</span>
                                            {{ $caseStudy->client_name ?? '' }}</p>
                                    </div>
                                    <div
                                        class="col sm:w-6/12 md:max-lg:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                        <p class="p-lg !mb-[4px] sm:max-md:!mb-[10px] xsm:max-sm:!mb-[5px]"><a
                                                href="{{ $caseStudy->website_url ?? '' }}"
                                                class="color--theme hover:!text-[#353f4f]"
                                                target="_blank">{{ $caseStudy->website_url ?? '' }}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END caseStudy TITLE -->
                        <!-- caseStudy PREVIEW IMAGE  -->
                        <div class="caseStudy-priview-img">
                            @if (empty($caseStudy->image))
                                <img class="img-fluid rounded-[16px] "
                                    src="{{ asset('frontend') }}/images/caseStudys/caseStudy-07.jpg"
                                    alt="caseStudy-preview">
                            @else
                                <img class="img-fluid rounded-[16px] " src="{{ asset($caseStudy->image) }}"
                                    alt="caseStudy-preview">
                            @endif

                        </div>
                        <!-- caseStudy TEXT -->
                        <div class="caseStudy-txt">
                            <!-- Text -->
                            <p>
                                {!! $caseStudy->description ?? '' !!}
                            </p>

                            <h5 class="s-24 w--700">
                                Overview & Challenge</h5>
                            <!-- Text -->
                            <p>
                                {!! $caseStudy->overview_challenge ?? '' !!}
                            </p>

                            @php
                                use Illuminate\Support\Str;

                                // 1) JSON → array
                                $raw = $caseStudy->images ?? [];
                                $paths = is_array($raw) ? $raw : (is_string($raw) ? json_decode($raw, true) : []);

                                // 2) ফাঁকা বাদ + path নরমালাইজ + URL তৈরি
                                $imgs = collect($paths)
                                    ->filter()
                                    ->map(function ($p) {
                                        $p = trim($p);

                                        // full URL হলে 그대로
                                        if (Str::startsWith($p, ['http://', 'https://'])) {
                                            return $p;
                                        }

                                        // ভুল করে 'public/' থেকে থাকলে কেটে দিন
                                        if (Str::startsWith($p, 'public/')) {
                                            $p = Str::after($p, 'public/');
                                        }

                                        // লিডিং স্ল্যাশ থাকলে কেটে দিন
                                        $p = ltrim($p, '/');

                                        // আপনার কেস: uploads/caseStudy/file.jpg → asset()
                                        return asset($p); // base-url + /uploads/caseStudy/file.jpg
                                    });
                            @endphp

                            @if ($imgs->isNotEmpty())
                                <div style="padding: 10px 10px 20px 10px;"
                                    class="flex flex-wrap image-gallery">
                                    @foreach ($imgs as $i => $imgUrl)
                                        <div
                                            class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                            <div
                                                class="caseStudy-image caseStudy-preview relative overflow-hidden group rounded-[10px] {{ $i === 0 ? 'top-img' : '' }}">
                                                <div class="hover-overlay w-full h-auto overflow-hidden relative">
                                                    <img class="img-fluid overflow-hidden transition-transform duration-[400ms] scale-100 group-hover:scale-105"
                                                        src="{{ $imgUrl }}"
                                                        alt="{{ $caseStudy->title ?? 'caseStudy-preview' }}"
                                                        loading="lazy">
                                                    <div
                                                        class="item-overlay opacity-0 !absolute w-full h-full transition-all duration-[400ms] ease-[ease-in-out] left-0 top-0 bg-[rgba(20,20,20,0.25)] group-hover:opacity-100">
                                                    </div>
                                                </div>
                                                <div
                                                    class="caseStudy-link ico-35 color--white w-full !absolute -translate-y-2/4 opacity-0 !text-center !text-white transition-all duration-[400ms] ease-[ease-in-out] top-[55%] group-hover:opacity-100 group-hover:top-2/4">
                                                    <a class="image-link" href="{{ $imgUrl }}"
                                                        data-gallery="caseStudy-{{ $caseStudy->id }}"
                                                        data-glightbox="title: {{ addslashes($caseStudy->title) }};"
                                                        title="{{ $caseStudy->title }}">
                                                        <span class="flaticon-visibility"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif


                            <!-- Small Title -->
                            <h5
                                class="s-24 w--700 case-study-summary">
                                caseStudy Summary</h5>
                            <!-- Text -->
                            <p>
                                {!! $caseStudy->caseStudy_summary ?? '' !!}
                            </p>


                            <div
                                class="caseStudy-image caseStudy-inner-img video-preview mt-[50px] lg:max-xl:!mt-[45px] md:max-lg:!mt-[30px] relative !text-center">
                                <!-- Play Icon -->
                                <a class="video-popup1" href="{{ $caseStudy->video_url ?? '' }}">
                                    <div
                                        class="video-btn video-btn-xl !w-[6.25rem] !h-[6.25rem] mt-[-3.125rem] ml-[-3.125rem] md:max-lg:w-28 md:max-lg:!h-28 md:max-lg:!mt-[-3.5rem] md:max-lg:ml-[-3.5rem] !absolute inline-block !text-center !text-white rounded-[100%] left-2/4 top-2/4 before:content-[''] before:absolute before:left-[-5px] before:right-[-5px] before:top-[-5px] before:bottom-[-5px] before:opacity-0 before:transition-all before:duration-[400ms] before:ease-[ease-in-out] before:rounded-[50%] before:bg-[rgba(255,255,255,0.2)] group hover:before:opacity-75  hover:before:left-[-1.5rem]  hover:before:right-[-1.5rem]  hover:before:top-[-1.5rem]  hover:before:bottom-[-1.5rem] bg--pink-400">
                                        <div
                                            class="video-block-wrapper transition-all duration-[400ms] ease-[ease-in-out] group-hover:scale-95">
                                            <span class="flaticon-play-button"></span>
                                        </div>
                                    </div>
                                </a>
                                <!-- Preview Image -->
                                <img class="img-fluid rounded-[10px] "
                                    src="{{ asset($caseStudy->image ?? 'frontend/assets/images/caseStudys/caseStudy-09.jpg') }}"
                                    alt="video-preview">
                            </div>
                            <!-- END VIDEO PREVIEW -->
                            <!-- Small Title -->
                            <h5
                                class="s-24 w--700" style="margin-top: 20px">
                                Solution & Results</h5>
                            <!-- Text -->
                            <p>
                                {!! $caseStudy->solution_result ?? '' !!}
                            </p>


                        </div>
                        <!-- END caseStudy TEXT -->
                        <!-- MORE caseStudyS BUTTON -->
                        <div
                            class="more-caseStudys ico-25 !text-end pb--100 xl:!pb-[100px] lg:max-xl:!pb-[80px] md:max-lg:!pb-[70px] mt-[65px] lg:max-xl:!mt-[50px] md:max-lg:!mt-[45px] sm:max-md:!mt-[45px] xsm:max-sm:!mt-[45px]">
                            <a href="{{ route('case.study.page') }}">
                                <h3
                                    class="s-38 w--700 !font-bold inline-block !underline">
                                    More Case Studys</h3>
                                <span class="flaticon-next"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END caseStudy DISCRIPTION -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </section>
    <!-- END SINGLE caseStudy-1 -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
@endsection
@push('scripts')
    <script>
        $(function() {
            $('.video-popup1').magnificPopup({
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
