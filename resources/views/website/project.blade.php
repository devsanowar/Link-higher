@extends('website.layouts.app')
@section('title', 'Portfolio Page')
@section('website_content')
    <!-- PROJECTS-1
                                 ============================================= -->
    <section id="projects-1"
        class="inner-page-hero projects-section pt-[180px] lg:max-xl:pt-[160px] md:max-lg:!mt-[80px] md:max-lg:pt-[70px]">
        <div class="container">
            <!-- SECTION TITLE -->
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <div class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                    <div class="section-title mb--80 mb-[80px] lg:max-xl:!mb-[60px] md:max-lg:!mb-[50px] !text-center">
                        <!-- Title -->
                        <h2
                            class="s-52 w--700 xl:!text-[3.25rem] lg:max-xl:!text-[3rem] md:max-lg:!text-[2.79411rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] !tracking-[-0.5px]">
                            Our Portfolio</h2>

                    </div>
                </div>
            </div>
            <!-- PROJECTS WRAPPER -->
            <div class="projects-wrapper p-[0_10px] md:max-lg:!p-0">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center row-cols-1 row-cols-md-2">

                    <!-- PROJECT #2 -->
                    @foreach ($projects as $project)
                        <div
                            class="col md:max-lg:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div id="pt--1-2"
                                class="project-details !mb-[50px] lg:max-xl:!mb-[40px] md:max-lg:!mb-[35px] sm:max-md:!mb-[40px] xsm:max-sm:!mb-[40px]">
                                <!-- Title -->
                                <h5
                                    class="s-24 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !leading-none mb--30 xl:!mb-[30px] lg:max-xl:!mb-[25px] md:max-lg:!mb-[20px] xsm:max-sm:!mb-[25px] font-Jakarta">
                                    {{ $project->title ?? '' }}</h5>
                                <!-- Image -->
                                <div class="project-preview relative overflow-hidden group rounded-[10px] ">
                                    <!-- Project Preview -->
                                    <div class="hover-overlay w-full h-auto overflow-hidden relative">
                                        @if (empty($project->image))
                                            <img class="img-fluid overflow-hidden transition-transform duration-[400ms] scale-100 group-hover:scale-105"
                                                src="{{ asset('frontend') }}/images/projects/project-02.jpg" alt="project-preview">
                                        @else
                                            <img class="img-fluid overflow-hidden transition-transform duration-[400ms] scale-100 group-hover:scale-105"
                                                src="{{ asset($project->image) }}" alt="{{ $project->title ?? '' }}">
                                        @endif

                                        <div
                                            class="item-overlay opacity-0 !absolute w-full h-full transition-all duration-[400ms] ease-[ease-in-out] left-0 top-0 bg-[rgba(20,20,20,0.25)]  group-hover:opacity-100">
                                        </div>
                                    </div>
                                    <!-- Project Link -->
                                    <div
                                        class="project-link ico-35 color--white w-full !absolute -translate-y-2/4 opacity-0 !text-center !text-white transition-all duration-[400ms] ease-[ease-in-out] top-[55%] group-hover:opacity-100 group-hover:top-2/4">
                                        <a href="{{ route('portfolio.details', $project->id) }}" title=""><span
                                                class="flaticon-visibility"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- END PROJECT #2 -->




                </div>
            </div>
            <!-- END PROJECTS WRAPPER -->
        </div>
        <!-- End container -->
    </section>
    <!-- END PROJECTS-1 -->


    {!! $projects->onEachSide(1)->withQueryString()->links('vendor.pagination.project') !!}

@endsection
