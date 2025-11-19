@extends('website.layouts.app')
@section('title', 'Blog Page')
@section('website_content')
    <section id="service-page-breadcrumb" class="container">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title">Blog Page</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li class="active">Blog</li>
            </ul>
        </div>
    </section>


    <section id="blog-page"
        class="inner-page-hero blog-page-section">
        <div class="container">
            <div class="posts-wrapper">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                    <!-- BLOG POST #1 -->
                    @forelse($posts as $post)
                        <div class="md:w-6/12 lg:w-4/12 xl:w-4/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                            <div class="blog-post wow fadeInUp mb--40 mb-[40px]">
                                <!-- BLOG POST IMAGE -->
                                <div class="blog-post-img">
                                    @if ($post->featured_image)
                                        <img class="img-fluid rounded-[16px] " src="{{ asset($post->featured_image) }}"
                                            alt="blog-post-image">
                                    @else
                                        <img class="img-fluid rounded-[16px] "
                                            src="{{ asset('frontend') }}/images/blog/post-1-img.jpg" alt="blog-post-image">
                                    @endif
                                </div>
                                <!-- BLOG POST TEXT -->
                                <div class="blog-post-txt">
                                    <!-- Post Tag -->
                                    <span
                                        class="post-tag color--red-400 block xl:!text-[0.75rem] font-semibold tracking-[0] uppercase font-Jakarta lg:max-xl:!text-[0.85rem] md:max-lg:!text-[0.85rem] md:max-lg:!mb-[12px] xsm:max-sm:!text-[0.825rem] ">{{ $post->category->category_name }}</span>
                                    <!-- Post Link -->
                                    <h6
                                        class="s-20 w--700 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[15px] lg:max-xl:!mb-[12px] md:max-lg:!mb-[12px] sm:max-md:!mb-[18px] xsm:max-sm:!mb-[14px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        <a class="text-[#353f4f] hover:!underline" href="{{ route('blog.details', $post->slug) }}">{!! $post->title !!}</a>
                                    </h6>
                                    <!-- Text -->
                                    <p class="!mb-0">{!! Str::limit($post->long_description, 110) ?? '' !!}</p>
                                    <!-- Post Meta -->
                                    <div class="blog-post-meta  mt-[20px] ">
                                        <ul class="post-meta-list ico-10">
                                            <li class="w-auto inline-block align-top clear-none">
                                                <p
                                                    class="p-sm w--500 font-medium text-[#353f4f] leading-none !mb-0 xsm:max-sm:!mb-0">
                                                    By
                                                    {{ $post->user->name ?? 'Admin' }}</p>
                                            </li>
                                            <li
                                                class="meta-list-divider w-auto inline-block align-top clear-none relative -rotate-90 px-px py-0 top-0 lg:max-xl:px-px lg:max-xl:py-0 md:max-lg:px-px md:max-lg:py-0">
                                                <p class="text-[#353f4f] leading-none !mb-0 xsm:max-sm:!mb-0"><span
                                                        class="flaticon-minus"></span></p>
                                            </li>
                                            <li class="w-auto inline-block align-top clear-none">
                                                <p class="p-sm text-[#353f4f] leading-none !mb-0 xsm:max-sm:!mb-0">{{ $post->created_at->format('M d, Y') }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- END BLOG POST TEXT -->
                            </div>
                        </div>
                    @empty
                        <h2>No post found!</h2>
                    @endforelse
                    <!-- END BLOG POST #1 -->

                </div>
            </div>

            <!-- PAGE PAGINATION
                         ============================================= -->
            <div class="page-pagination theme-pagination">
                <div class="container">
                    <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                        <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                            @if ($posts->hasPages())
                                <nav aria-label="Page navigation">
                                    <ul class="pagination ico-20 justify-center flex pl-0 [list-style:none]">

                                        {{-- Previous Page Link --}}
                                        @if ($posts->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] !m-[0_8px] p-[2px_14px] [border:2px_solid_transparent] hover:!text-[#6c757d] hover:!bg-transparent hover:border-2 hover:border-solid hover:border-[#ccc] focus:!text-[#6c757d] focus:!bg-transparent focus:shadow-[0_0] focus:border-2 focus:border-solid focus:border-transparent xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]"
                                                    href="#" tabindex="-1">
                                                    <span class="flaticon-back"></span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] !m-[0_8px] p-[2px_14px] [border:2px_solid_transparent] hover:!text-[#6c757d] hover:!bg-transparent hover:border-2 hover:border-solid hover:border-[#ccc] focus:!text-[#6c757d] focus:!bg-transparent focus:shadow-[0_0] focus:border-2 focus:border-solid focus:border-transparent xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]"
                                                    href="{{ $posts->previousPageUrl() }}">
                                                    <span class="flaticon-back"></span>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Page Numbers --}}
                                        @foreach ($posts->links()->elements[0] ?? [] as $page => $url)
                                            @if ($page == $posts->currentPage())
                                                <li class="page-item active" aria-current="page">
                                                    <a class="page-link relative block !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] ml-[-1px] mr-[8px] p-[2px_14px] [border:2px_solid_transparent] xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]"
                                                        href="#">{{ $page }}</a>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] ml-[-1px] mr-[8px] p-[2px_14px] [border:2px_solid_transparent] hover:!text-[#6c757d] hover:!bg-transparent hover:border-2 hover:border-solid hover:border-[#ccc] focus:!text-[#6c757d] focus:!bg-transparent focus:shadow-[0_0] focus:border-2 focus:border-solid focus:border-transparent xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($posts->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] ml-[-1px] mr-[8px] p-[2px_14px] [border:2px_solid_transparent] hover:!text-[#6c757d] hover:!bg-transparent hover:border-2 hover:border-solid hover:border-[#ccc] focus:!text-[#6c757d] focus:!bg-transparent focus:shadow-[0_0] focus:border-2 focus:border-solid focus:border-transparent xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]"
                                                    href="{{ $posts->nextPageUrl() }}">
                                                    <span class="flaticon-next"></span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] ml-[-1px] mr-[8px] p-[2px_14px] [border:2px_solid_transparent] hover:!text-[#6c757d] hover:!bg-transparent hover:border-2 hover:border-solid hover:border-[#ccc] focus:!text-[#6c757d] focus:!bg-transparent focus:shadow-[0_0] focus:border-2 focus:border-solid focus:border-transparent xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]"
                                                    href="#" tabindex="-1">
                                                    <span class="flaticon-next"></span>
                                                </a>
                                            </li>
                                        @endif

                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
