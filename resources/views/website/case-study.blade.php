@extends('website.layouts.app')
@section('title', 'Case Study Page')
@section('page_id', 'case-study-page')
@section('website_content')
    <section id="service-page-breadcrumb" class="container">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title">Case Study Page</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li class="active">Case Study</li>
            </ul>
        </div>
    </section>


    <section class="cs-slider" id="cs-slider" aria-label="Case studies">
        <div class="header">
            <div class="title">Case Studies</div>
        </div>

        <div class="cs-viewport">
            <div class="cs-track" id="cs-track" style="display: flex; flex-wrap: wrap; gap: 20px;">
                @forelse ($caseStudies as $caseStudy)
                    <article class="cs-card"
                        style="flex: 1 1 calc(33.333% - 20px); box-sizing: border-box; position: relative; overflow: hidden; height: 450px;">
                        <div class="cs-hero-wrapper" style="position: relative; overflow: hidden;">
                            @if ($caseStudy->image)
                                <img class="cs-hero" src="{{ asset($caseStudy->image) }}" alt="case study image"
                                    style="transition: transform 0.3s ease;" />
                            @else
                                <img class="cs-hero" src="https://picsum.photos/seed/cs2/1200/800" alt="case study image"
                                    style="transition: transform 0.3s ease;" />
                            @endif
                            <a href="{{ route('case.study.details', $caseStudy->id) }}" class="cs-hover-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 5c-7.633 0-11.999 6.692-12 6.698L0 12l.001.302C.002 12.308 4.368 19 12 19s11.998-6.692 12-6.698L24 12l-.001-.302C23.998 11.692 19.632 5 12 5zm0 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10z" />
                                    <circle cx="12" cy="12" r="2.5" />
                                </svg>
                            </a>
                        </div>
                        <div class="cs-body">
                            <div class="cs-category">{{ $caseStudy->service->service_title ?? '' }}</div>
                            <a href="{{ route('case.study.details', $caseStudy->id) }}">
                                <h3 class="cs-title">{{ $caseStudy->title ?? '' }}</h3>
                            </a>
                            <p class="cs-excerpt" style="margin-bottom: 0">
                                {!! Str::limit($caseStudy->description, 140, '...') !!}
                            </p>
                        </div>
                        <div class="cs-footer">
                            <div class="cs-author">
                                @if ($caseStudy->user && $caseStudy->user->image)
                                    <img src="{{ asset($caseStudy->user->image) }}" alt="author" />
                                @else
                                    <img src="https://i.pravatar.cc/100?img=18" alt="author" />
                                @endif
                                <div class="cs-author-name">{{ $caseStudy->user->name ?? 'Unknown Author' }}</div>
                            </div>

                            <div class="cs-date">{{ $caseStudy->created_at->format('M d, Y') }}</div>
                        </div>
                    </article>

                @empty
                    <h2>No case studies found! Please add case studies.</h2>
                @endforelse
            </div>
        </div>
    </section>


    <!-- PAGE PAGINATION
                             ============================================= -->
    <div class="page-pagination theme-pagination">
        <div class="container">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                    @if ($caseStudies->hasPages())
                        <nav aria-label="Page navigation">
                            <ul class="pagination ico-20 justify-center flex pl-0 [list-style:none]">

                                {{-- Previous Page Link --}}
                                @if ($caseStudies->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] !m-[0_8px] p-[2px_14px] [border:2px_solid_transparent] hover:!text-[#6c757d] hover:!bg-transparent hover:border-2 hover:border-solid hover:border-[#ccc] focus:!text-[#6c757d] focus:!bg-transparent focus:shadow-[0_0] focus:border-2 focus:border-solid focus:border-transparent xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]"
                                            href="#" tabindex="-1">
                                            <span class="flaticon-back"></span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] !m-[0_8px] p-[2px_14px] [border:2px_solid_transparent] hover:!text-[#6c757d] hover:!bg-transparent hover:border-2 hover:border-solid hover:border-[#ccc] focus:!text-[#6c757d] focus:!bg-transparent focus:shadow-[0_0] focus:border-2 focus:border-solid focus:border-transparent xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]"
                                            href="{{ $caseStudies->previousPageUrl() }}">
                                            <span class="flaticon-back"></span>
                                        </a>
                                    </li>
                                @endif

                                {{-- Page Numbers --}}
                                @foreach ($caseStudies->links()->elements[0] ?? [] as $page => $url)
                                    @if ($page == $caseStudies->currentPage())
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
                                @if ($caseStudies->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] ml-[-1px] mr-[8px] p-[2px_14px] [border:2px_solid_transparent] hover:!text-[#6c757d] hover:!bg-transparent hover:border-2 hover:border-solid hover:border-[#ccc] focus:!text-[#6c757d] focus:!bg-transparent focus:shadow-[0_0] focus:border-2 focus:border-solid focus:border-transparent xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]"
                                            href="{{ $caseStudies->nextPageUrl() }}">
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


@endsection
