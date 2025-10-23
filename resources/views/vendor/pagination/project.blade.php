    @if ($paginator->hasPages())
<div class="py--100 py-[100px] lg:max-xl:py-[80px] md:max-lg:py-[70px] page-pagination theme-pagination">
    <div class="container">
        <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
            <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">

                <nav aria-label="Page navigation">
                    <ul class="pagination ico-20 justify-center flex pl-0 [list-style:none]">

                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                <span class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] !m-[0_8px] p-[2px_14px] [border:2px_solid_transparent] hover:!text-[#6c757d] hover:!bg-transparent hover:border-2 hover:border-solid hover:border-[#ccc] focus:!text-[#6c757d] focus:!bg-transparent focus:shadow-[0_0] focus:border-2 focus:border-solid focus:border-transparent xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]">
                                    <span class="flaticon-back"></span>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] !m-[0_8px] p-[2px_14px] [border:2px_solid_transparent] hover:!text-[#6c757d] hover:!bg-transparent hover:border-2 hover:border-solid hover:border-[#ccc] focus:!text-[#6c757d] focus:!bg-transparent focus:shadow-[0_0] focus:border-2 focus:border-solid focus:border-transparent xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]"
                                   href="{{ $paginator->previousPageUrl() }}"
                                   rel="prev" aria-label="@lang('pagination.previous')">
                                    <span class="flaticon-back"></span>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] ml-[-1px] mr-[8px] p-[2px_14px] [border:2px_solid_transparent] xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]">…</span>
                                </li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link relative block !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] ml-[-1px] mr-[8px] p-[2px_14px] [border:2px_solid_transparent] xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]">
                                                {{ $page }}
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] ml-[-1px] mr-[8px] p-[2px_14px] [border:2px_solid_transparent] hover:!text-[#6c757d] hover:!bg-transparent hover:border-2 hover:border-solid hover:border-[#ccc] focus:!text-[#6c757d] focus:!bg-transparent focus:shadow-[0_0] focus:border-2 focus:border-solid focus:border-transparent xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]"
                                               href="{{ $url }}">
                                                {{ $page }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                                <a class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] ml-[-1px] mr-[8px] p-[2px_14px] [border:2px_solid_transparent] hover:!text-[#6c757d] hover:!bg-transparent hover:border-2 hover:border-solid hover:border-[#ccc] focus:!text-[#6c757d] focus:!bg-transparent focus:shadow-[0_0] focus:border-2 focus:border-solid focus:border-transparent xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]"
                                   href="{{ $paginator->nextPageUrl() }}"
                                   rel="next" aria-label="@lang('pagination.next')">
                                    <span class="flaticon-next"></span>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                <span class="page-link relative block !text-[#6c757d] !text-[1.1rem] font-medium bg-transparent rounded transition-all duration-[400ms] ease-[ease-in-out] ml-[-1px] mr-[8px] p-[2px_14px] [border:2px_solid_transparent] xsm:max-sm:!text-[0.95rem] xsm:max-sm:px-[10px] xsm:max-sm:py-[2px]">
                                    <span class="flaticon-next"></span>
                                </span>
                            </li>
                        @endif

                    </ul>
                </nav>

            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
</div>
@endif
