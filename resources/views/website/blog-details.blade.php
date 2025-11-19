@extends('website.layouts.app')
@section('title', 'Blog Details Page')
@section('page_id', 'blog-details-page')
@section('website_content')

    <section id="service-page-breadcrumb" class="container">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title">Blog Single Page</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li class="active">Single Page</li>
            </ul>
        </div>
    </section>


    <section id="single-post"
        class="inner-page-hero blog-page-section">
        <div class="container">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <!-- SINGLE POST CONTENT -->
                <div class="xl:w-10/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                    <div class="post-content">
                        <!--  SINGLE POST TITLE -->
                        <div class="single-post-title !text-center">
                            <!-- Post Tag -->
                            <span
                                class="post-tag !text-[0.85rem] block font-semibold">{{ $postDetail->category->category_name ?? '' }}</span>
                            <!-- Title -->
                            <h2
                                class="s-46 w--700 xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] !font-bold p-[0_10px] lg:max-xl:px-[10%] lg:max-xl:py-0 md:max-lg:!mb-[20px] md:max-lg:px-[3%] md:max-lg:py-0 sm:max-md:!mb-[20px] sm:max-md:px-[5%] sm:max-md:py-0 xsm:max-sm:!mb-[20px] xsm:max-sm:px-[8%] xsm:max-sm:py-0 leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                                {!! $postDetail->title ?? 'Title not found please add the title' !!}</h2>
                            <!-- Post Meta -->
                            <div
                                class="blog-post-meta">
                                <ul class="post-meta-list ico-10">
                                    <li class=" w-auto inline-block align-top clear-none">
                                        <p class="p-md font-medium !text-[#353f4f] leading-none !mb-0 xsm:max-sm:!mb-0">By
                                            {{ $postDetail->user->name ?? '' }}</p>
                                    </li>
                                    <li
                                        class="meta-list-divider w-auto inline-block align-top clear-none relative -rotate-90 px-px py-0 top-0 lg:max-xl:px-px lg:max-xl:py-0 md:max-lg:px-px md:max-lg:py-0">
                                        <p class="text-[#353f4f] leading-none !mb-0 xsm:max-sm:!mb-0"><span
                                                class="flaticon-minus"></span></p>
                                    </li>
                                    <li class=" w-auto inline-block align-top clear-none">
                                        <p class="p-md !text-[#353f4f] leading-none !mb-0 xsm:max-sm:!mb-0">
                                            {{ $postDetail->created_at->format('M d, Y') }}
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- END SINGLE POST TITLE -->
                        <!-- SINGLE POST IMAGE -->
                        <div class="blog-post-img">
                            @if ($postDetail->featured_image)
                                <img class="img-fluid rounded-[16px] "
                                    src="{{ asset($postDetail->featured_image) }}" alt="blog-post-image">
                            @else
                                <img class="img-fluid rounded-[16px] "
                                    src="{{ asset('frontend/images/blog/post-12-img.jpg') }}" alt="blog-post-image">
                            @endif

                        </div>
                        <!-- SINGLE POST TEXT -->
                        <div class="single-post-txt">
                            <!-- Text -->
                            <p>
                                {!! $postDetail->long_description ?? '' !!}
                            </p>

                        </div>

                    </div>
                </div>
                <!-- END  SINGLE POST CONTENT -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </section>
    <!-- END SINGLE POST -->
@endsection
