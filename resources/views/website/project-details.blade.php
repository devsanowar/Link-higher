@extends('website.layouts.app')
@section('title', 'Portfolio Single Page')
@section('website_content')
    <section id="project-1"
        class="gr--whitesmoke inner-page-hero single-project pt-[180px] lg:max-xl:pt-[160px] md:max-lg:!mt-[80px] md:max-lg:pt-[70px]">
        <div class="container">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <!-- PROJECT DISCRIPTION -->
                <div class="lg:w-11/12 xl:w-10/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                    <div class="project-description">
                        <!-- PROJECT TITLE -->
                        <div
                            class="project-title xl:!mb-[80px] lg:max-xl:!mb-[60px] md:max-lg:!mb-[40px] sm:max-md:!mb-[50px] xsm:max-sm:!mb-[40px]">
                            <!-- Title -->
                            <h2
                                class="s-52 w--700 xl:!text-[3.25rem] lg:max-xl:!text-[3rem] md:max-lg:!text-[2.79411rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold xl:!mb-[35px] pr-[5%] xl:!pb-[40px] [border-bottom:1px_solid_#ddd] lg:max-xl:!mb-[30px] lg:max-xl:!pb-[35px] md:max-lg:!mb-[25px] md:max-lg:pr-[10%] md:max-lg:!pb-[30px] sm:max-md:!mb-[30px] sm:max-md:!pb-[35px] xsm:max-sm:!mb-[25px] xsm:max-sm:pr-0 xsm:max-sm:!pb-[25px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                                {{ $project->title ?? '' }}</h2>
                            <!-- Project Data -->
                            <div class="project-data">
                                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] row-cols-1 row-cols-sm-2 row-cols-md-3">
                                    <div
                                        class="col sm:w-6/12 md:max-lg:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                        <p class="p-lg !mb-[4px] sm:max-md:!mb-[10px] xsm:max-sm:!mb-[5px]"><span
                                                class=" !text-[#353f4f] font-medium">Category:</span>
                                            {{ $project->category->name ?? '' }}</p>
                                    </div>
                                    <div
                                        class="col sm:w-6/12 md:max-lg:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                        <p class="p-lg !mb-[4px] sm:max-md:!mb-[10px] xsm:max-sm:!mb-[5px]"><span
                                                class=" !text-[#353f4f] font-medium">Start Date:</span>
                                            {{ $project->start_date ?? '' }}</p>
                                    </div>
                                    <div
                                        class="col sm:w-6/12 md:max-lg:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                        <p class="p-lg !mb-[4px] sm:max-md:!mb-[10px] xsm:max-sm:!mb-[5px]"><span
                                                class=" !text-[#353f4f] font-medium">Handover:</span>
                                            {{ $project->end_date ?? '' }}</p>
                                    </div>
                                    <div
                                        class="col sm:w-6/12 md:max-lg:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                        <p class="p-lg !mb-[4px] sm:max-md:!mb-[10px] xsm:max-sm:!mb-[5px]"><span
                                                class=" !text-[#353f4f] font-medium">Client:</span>
                                            {{ $project->client_name ?? '' }}</p>
                                    </div>
                                    <div
                                        class="col sm:w-6/12 md:max-lg:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                        <p class="p-lg !mb-[4px] sm:max-md:!mb-[10px] xsm:max-sm:!mb-[5px]"><a
                                                href="{{ $project->website_url ?? '' }}"
                                                class="color--theme hover:!text-[#353f4f]"
                                                target="_blank">{{ $project->website_url ?? '' }}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PROJECT TITLE -->
                        <!-- PROJECT PREVIEW IMAGE  -->
                        <div class="project-priview-img mb--50 xl:!mb-[50px] lg:max-xl:!mb-[45px] md:max-lg:!mb-[30px] ">
                            @if (empty($project->image))
                                <img class="img-fluid rounded-[16px] "
                                    src="{{ asset('frontend') }}/images/projects/project-07.jpg" alt="project-preview">
                            @else
                                <img class="img-fluid rounded-[16px] " src="{{ asset($project->image) }}"
                                    alt="project-preview">
                            @endif

                        </div>
                        <!-- PROJECT TEXT -->
                        <div class="project-txt">
                            <!-- Text -->
                            <p>
                                {!! $project->description ?? '' !!}
                            </p>

                            <h5
                                class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold mt--35 mt-[35px] mb--35 xl:!mb-[35px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                Overview & Challenge</h5>
                            <!-- Text -->
                            <p>
                                {!! $project->overview_challenge ?? '' !!}
                            </p>

                            @php
                                // DB তে images = ["uploads/project/1.jpg","uploads/project/2.jpg", ...]
                                $imgs = collect($project->images ?? [])->filter(); // ফাঁকা বাদ
                            @endphp

                            @if ($imgs->isNotEmpty())
                                <div style="padding: 10px;"
                                    class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] items-center project-inner-img mt-[50px] lg:max-xl:!mt-[45px] md:max-lg:!mt-[30px]">
                                    @foreach ($imgs as $i => $imgPath)
                                        <div
                                            class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                            <div
                                                class="project-image project-preview relative overflow-hidden group rounded-[10px] {{ $i === 0 ? 'top-img' : '' }}">
                                                <!-- Project Preview -->
                                                <div class="hover-overlay w-full h-auto overflow-hidden relative">
                                                    <img class="img-fluid overflow-hidden transition-transform duration-[400ms] scale-100 group-hover:scale-105"
                                                        src="{{ asset($imgPath) }}"
                                                        alt="{{ $project->title ?? 'project-preview' }}" loading="lazy">
                                                    <div
                                                        class="item-overlay opacity-0 !absolute w-full h-full transition-all duration-[400ms] ease-[ease-in-out] left-0 top-0 bg-[rgba(20,20,20,0.25)] group-hover:opacity-100">
                                                    </div>
                                                </div>

                                                <!-- Project Link (eye icon) -->
                                                <div
                                                    class="project-link ico-35 color--white w-full !absolute -translate-y-2/4 opacity-0 !text-center !text-white transition-all duration-[400ms] ease-[ease-in-out] top-[55%] group-hover:opacity-100 group-hover:top-2/4">
                                                    <a class="image-link" href="{{ asset($imgPath) }}"
                                                        data-gallery="project-{{ $project->id }}" {{-- একই প্রজেক্টের ইমেজগুলো গ্রুপ হবে --}}
                                                        data-glightbox="title: {{ addslashes($project->title) }};"
                                                        title="{{ $project->title }}">
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
                                class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold mt--50 mt-[50px] lg:max-xl:!mt-[45px] md:max-lg:!mt-[30px] mb--35 xl:!mb-[35px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                Project Summary</h5>
                            <!-- Text -->
                            <p>
                                {!! $project->project_summary ?? '' !!}
                            </p>


                            <div
                                class="project-image project-inner-img video-preview mt-[50px] lg:max-xl:!mt-[45px] md:max-lg:!mt-[30px] relative !text-center">
                                <!-- Play Icon -->
                                <a class="video-popup1" href="https://www.youtube.com/embed/SZEflIVnhH8">
                                    <div
                                        class="video-btn video-btn-xl !w-[6.25rem] !h-[6.25rem] mt-[-3.125rem] ml-[-3.125rem] md:max-lg:w-28 md:max-lg:!h-28 md:max-lg:!mt-[-3.5rem] md:max-lg:ml-[-3.5rem] !absolute inline-block !text-center !text-white rounded-[100%] left-2/4 top-2/4 before:content-[''] before:absolute before:left-[-5px] before:right-[-5px] before:top-[-5px] before:bottom-[-5px] before:opacity-0 before:transition-all before:duration-[400ms] before:ease-[ease-in-out] before:rounded-[50%] before:bg-[rgba(255,255,255,0.2)] group hover:before:opacity-75  hover:before:left-[-1.5rem]  hover:before:right-[-1.5rem]  hover:before:top-[-1.5rem]  hover:before:bottom-[-1.5rem] bg--pink-400">
                                        <div
                                            class="video-block-wrapper transition-all duration-[400ms] ease-[ease-in-out] group-hover:scale-95">
                                            <span class="flaticon-play-button"></span>
                                        </div>
                                    </div>
                                </a>
                                <!-- Preview Image -->
                                <img class="img-fluid rounded-[10px] " src="{{ asset($project->image ?? 'frontend/assets/images/projects/project-09.jpg') }}"
                                    alt="video-preview">
                            </div>
                            <!-- END VIDEO PREVIEW -->
                            <!-- Small Title -->
                            <h5
                                class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold mt--50 mt-[50px] lg:max-xl:!mt-[45px] md:max-lg:!mt-[30px] mb--35 xl:!mb-[35px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                Solution & Results</h5>
                            <!-- Text -->
                            <p>
                                {!! $project->solution_result ?? '' !!}
                            </p>


                        </div>
                        <!-- END PROJECT TEXT -->
                        <!-- MORE PROJECTS BUTTON -->
                        <div
                            class="more-projects ico-25 !text-end pb--100 xl:!pb-[100px] lg:max-xl:!pb-[80px] md:max-lg:!pb-[70px] mt-[65px] lg:max-xl:!mt-[50px] md:max-lg:!mt-[45px] sm:max-md:!mt-[45px] xsm:max-sm:!mt-[45px]">
                            <a href="{{ route('portfolio.page') }}">
                                <h3
                                    class="s-38 w--700 xl:!text-[2.375rem] lg:max-xl:!text-[2.25rem] md:max-lg:!text-[1.98529rem] sm:max-md:!text-[2.0625rem] xsm:max-sm:!text-[1.6875rem] !font-bold inline-block !underline !mb-0 leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                    More Projects</h3>
                                <span class="flaticon-next"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END PROJECT DISCRIPTION -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </section>
    <!-- END SINGLE PROJECT-1 -->
@endsection
