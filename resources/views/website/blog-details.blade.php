@extends('website.layouts.app')
@section('title', 'Blog Details Page')
@section('website_content')
    <!-- SINGLE POST
                             ============================================= -->
    <section id="single-post"
        class="pb--90 pb-[90px] lg:max-xl:!pb-[70px] md:max-lg:!pb-[60px] sm:max-md:!pb-[60px] xsm:max-sm:!pb-[60px] inner-page-hero blog-page-section pt-[180px] lg:max-xl:pt-[160px] md:max-lg:!mt-[80px] md:max-lg:pt-[70px]">
        <div class="container">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <!-- SINGLE POST CONTENT -->
                <div class="xl:w-10/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                    <div class="post-content">
                        <!--  SINGLE POST TITLE -->
                        <div class="single-post-title !text-center">
                            <!-- Post Tag -->
                            <span
                                class="post-tag color--green-400 !text-[0.85rem] block font-semibold tracking-[0] uppercase xl:!mb-[20px] font-Jakarta lg:max-xl:!mb-[15px] md:max-lg:!mb-[12px] xsm:max-sm:!mb-[14px]">{{ $postDetail->category->category_name ?? '' }}</span>
                            <!-- Title -->
                            <h2
                                class="s-46 w--700 xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] !font-bold p-[0_10px] lg:max-xl:px-[10%] lg:max-xl:py-0 md:max-lg:!mb-[20px] md:max-lg:px-[3%] md:max-lg:py-0 sm:max-md:!mb-[20px] sm:max-md:px-[5%] sm:max-md:py-0 xsm:max-sm:!mb-[20px] xsm:max-sm:px-[8%] xsm:max-sm:py-0 leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                                {!! $postDetail->title ?? 'Title not found please add the title' !!}</h2>
                            <!-- Post Meta -->
                            <div
                                class="blog-post-meta mt--35 mt-[35px] md:max-lg:!mt-[25px] sm:max-md:!mt-[20px] xsm:max-sm:!mt-[25px]">
                                <ul class="post-meta-list ico-10">
                                    <li class=" w-auto inline-block align-top clear-none">
                                        <p class="p-md font-medium !text-[#353f4f] leading-none !mb-0 xsm:max-sm:!mb-0">By
                                            {{ $postDetail->user->name }}</p>
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
                        <div class="blog-post-img py--50 py-[50px] lg:max-xl:py-[40px] md:max-lg:py-[30px]">
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
                        <!-- END ABOUT POST AUTHOR -->
                        <!-- POST COMMENTS -->
                        {{-- <div
                            class="post-comments pt--100 pt-[100px] lg:max-xl:pt-[60px] md:max-lg:pt-[50px] sm:max-md:pt-[50px] xsm:max-sm:pt-[50px]">
                            <div class="comments-wrapper">
                                <!-- Title -->
                                <h5
                                    class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold mb--60 xl:!mb-[60px] md:max-lg:!mb-[40px] sm:max-md:!mb-[40px] xsm:max-sm:!mb-[40px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                    4 Comments</h5>
                                <!-- COMMENT #1 -->
                                <div class="comment flex">
                                    <!-- Comment-1 Avatar -->
                                    <img class="xl:!w-[68px] xl:!h-[68px] rounded-[100%] lg:max-xl:!w-[60px] lg:max-xl:!h-[60px] md:max-lg:!w-[52px] md:max-lg:!h-[52px] sm:max-md:!w-[52px] sm:max-md:!h-[52px] xsm:max-sm:!w-[45px] xsm:max-sm:!h-[45px]"
                                        src="images/comment-author-1.jpg" alt="comment-avatar">
                                    <!-- Comment-Body -->
                                    <div
                                        class="comment-body ml-[25px] md:max-lg:ml-[20px] sm:max-md:ml-[20px] xsm:max-sm:ml-[18px]">
                                        <!-- Comment-1 Meta -->
                                        <div
                                            class="comment-meta !mb-[10px] lg:max-xl:!mb-[5px] md:max-lg:!mb-[5px] sm:max-md:!mb-[5px] xsm:max-sm:!mb-[8px]">
                                            <h6
                                                class="s-17 w--700 xl:!text-[1.0625rem] lg:max-xl:!text-[1.0625rem] md:max-lg:!text-[1.066176rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem] !font-bold leading-none xl:!mb-0 lg:max-xl:!mb-[5px] md:max-lg:!mb-[5px] sm:max-md:!mb-[5px] xsm:max-sm:!mb-[5px] font-Jakarta">
                                                Jack H.</h6>
                                            <span
                                                class="comment-date !text-[16px] !font-normal !mb-[5px] lg:max-xl:!text-[16px] md:max-lg:!text-[1.0625rem]">2
                                                days ago&#8194;- </span>
                                            <span class="btn-reply ico-20 ml-[3px]">
                                                <a class=" !text-[17px] !font-normal hover:!text-[#222] lg:max-xl:!text-[1rem] md:max-lg:!text-[1.0625rem]"
                                                    href="#leave-comment"><span
                                                        class="flaticon-reply-arrow relative mr-[4px] left-[3px] top-[3px]"></span>
                                                    Reply</a>
                                            </span>
                                        </div>
                                        <!-- Comment-1 Text -->
                                        <p class=" !mb-[40px] lg:max-xl:!mb-[30px] md:max-lg:!mb-[30px] ">Ratione mollis
                                            undo risus aenean arcu lectus rutrum porta
                                            primis and puruss augue luctus neque purus and ipsum neque dolor primis
                                            libero tempus eget tempor ligula posuere varius impedit enim tempor vitae
                                            pulvinar at congue egestas vitae augue
                                        </p>
                                        <hr class=" mt-[24px] !mb-[40px]">
                                        <!-- Nested Comment -->

                                        <div class="comment flex">
                                            <!-- Comment Avatar -->
                                            <img class="xl:!w-[68px] xl:!h-[68px] rounded-[100%] lg:max-xl:!w-[60px] lg:max-xl:!h-[60px] md:max-lg:!w-[52px] md:max-lg:!h-[52px] sm:max-md:!w-[52px] sm:max-md:!h-[52px] xsm:max-sm:!w-[45px] xsm:max-sm:!h-[45px]"
                                                src="images/comment-author-2.jpg" alt="comment-avatar">
                                            <!-- Comment Body -->
                                            <div
                                                class="comment-body ml-[25px] md:max-lg:ml-[20px] sm:max-md:ml-[20px] xsm:max-sm:ml-[18px]">
                                                <!-- Comment Meta -->
                                                <div
                                                    class="comment-meta !mb-[10px] lg:max-xl:!mb-[5px] md:max-lg:!mb-[5px] sm:max-md:!mb-[5px] xsm:max-sm:!mb-[8px]">
                                                    <h6
                                                        class="s-17 w--700 xl:!text-[1.0625rem] lg:max-xl:!text-[1.0625rem] md:max-lg:!text-[1.066176rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem] !font-bold leading-none xl:!mb-0 lg:max-xl:!mb-[5px] md:max-lg:!mb-[5px] sm:max-md:!mb-[5px] xsm:max-sm:!mb-[5px] font-Jakarta">
                                                        S. Parker</h6>
                                                    <span
                                                        class="comment-date !text-[16px] !font-normal !mb-[5px] lg:max-xl:!text-[16px] md:max-lg:!text-[1.0625rem]">4
                                                        days ago&#8194;- </span>
                                                    <span class="btn-reply ico-20 ml-[3px]">
                                                        <a class=" !text-[17px] !font-normal hover:!text-[#222] lg:max-xl:!text-[1rem] md:max-lg:!text-[1.0625rem]"
                                                            href="#leave-comment"><span
                                                                class="flaticon-reply-arrow relative mr-[4px] left-[3px] top-[3px]"></span>
                                                            Reply</a>
                                                    </span>
                                                </div>
                                                <!-- Comment Text -->
                                                <p>Etiam sapien magna at vitae pulvinar congue egestas and undo pretium
                                                    neque viverra porta suscipit ratione, mollis risus a lectus aliquet</p>
                                            </div>
                                            <!-- End Comment Body -->
                                        </div>
                                        <!-- End Nested Comment -->
                                    </div>
                                </div>
                                <!-- END COMMENT #1 -->
                                <hr class=" mt-[24px] !mb-[40px]">
                                <!-- COMMENT #3 -->
                                <div class="comment flex">
                                    <!-- Comment Avatar -->
                                    <img class="xl:!w-[68px] xl:!h-[68px] rounded-[100%] lg:max-xl:!w-[60px] lg:max-xl:!h-[60px] md:max-lg:!w-[52px] md:max-lg:!h-[52px] sm:max-md:!w-[52px] sm:max-md:!h-[52px] xsm:max-sm:!w-[45px] xsm:max-sm:!h-[45px]"
                                        src="images/comment-author-3.jpg" alt="comment-avatar">
                                    <!-- Comment Body -->
                                    <div
                                        class="comment-body ml-[25px] md:max-lg:ml-[20px] sm:max-md:ml-[20px] xsm:max-sm:ml-[18px]">
                                        <!-- Comment Meta -->
                                        <div
                                            class="comment-meta !mb-[10px] lg:max-xl:!mb-[5px] md:max-lg:!mb-[5px] sm:max-md:!mb-[5px] xsm:max-sm:!mb-[8px]">
                                            <h6
                                                class="s-17 w--700 xl:!text-[1.0625rem] lg:max-xl:!text-[1.0625rem] md:max-lg:!text-[1.066176rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem] !font-bold leading-none xl:!mb-0 lg:max-xl:!mb-[5px] md:max-lg:!mb-[5px] sm:max-md:!mb-[5px] xsm:max-sm:!mb-[5px] font-Jakarta">
                                                Sarah Griffi</h6>
                                            <span
                                                class="comment-date !text-[16px] !font-normal !mb-[5px] lg:max-xl:!text-[16px] md:max-lg:!text-[1.0625rem]">16
                                                days ago&#8194;- </span>
                                            <span class="btn-reply ico-20 ml-[3px]">
                                                <a class=" !text-[17px] !font-normal hover:!text-[#222] lg:max-xl:!text-[1rem] md:max-lg:!text-[1.0625rem]"
                                                    href="#leave-comment"><span
                                                        class="flaticon-reply-arrow relative mr-[4px] left-[3px] top-[3px]"></span>
                                                    Reply</a>
                                            </span>
                                        </div>
                                        <!-- Comment Text -->
                                        <p>Porta ratione mollis risus aenean arcu lectus rutrum porta primis and
                                            puruss augue luctus neque purus and ipsum neque dolor primis libero tempus
                                            eget tempor ligula posuere varius impedit enim tempor vitae pulvinar at
                                            congue an augue egestas vitae
                                        </p>
                                    </div>
                                    <!-- End Comment Body -->
                                </div>
                                <!-- END COMMENT #3 -->
                                <hr class=" mt-[24px] !mb-[40px]">
                                <!-- COMMENT #4 -->
                                <div class="comment flex">
                                    <!-- Comment Avatar -->
                                    <img class="xl:!w-[68px] xl:!h-[68px] rounded-[100%] lg:max-xl:!w-[60px] lg:max-xl:!h-[60px] md:max-lg:!w-[52px] md:max-lg:!h-[52px] sm:max-md:!w-[52px] sm:max-md:!h-[52px] xsm:max-sm:!w-[45px] xsm:max-sm:!h-[45px]"
                                        src="images/comment-author-4.jpg" alt="comment-avatar">
                                    <!-- Comment Body -->
                                    <div
                                        class="comment-body ml-[25px] md:max-lg:ml-[20px] sm:max-md:ml-[20px] xsm:max-sm:ml-[18px]">
                                        <!-- Comment Meta -->
                                        <div
                                            class="comment-meta !mb-[10px] lg:max-xl:!mb-[5px] md:max-lg:!mb-[5px] sm:max-md:!mb-[5px] xsm:max-sm:!mb-[8px]">
                                            <h6
                                                class="s-17 w--700 xl:!text-[1.0625rem] lg:max-xl:!text-[1.0625rem] md:max-lg:!text-[1.066176rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem] !font-bold leading-none xl:!mb-0 lg:max-xl:!mb-[5px] md:max-lg:!mb-[5px] sm:max-md:!mb-[5px] xsm:max-sm:!mb-[5px] font-Jakarta">
                                                Joshua A.</h6>
                                            <span
                                                class="comment-date !text-[16px] !font-normal !mb-[5px] lg:max-xl:!text-[16px] md:max-lg:!text-[1.0625rem]">30
                                                days ago&#8194;- </span>
                                            <span class="btn-reply ico-20 ml-[3px]">
                                                <a class=" !text-[17px] !font-normal hover:!text-[#222] lg:max-xl:!text-[1rem] md:max-lg:!text-[1.0625rem]"
                                                    href="#leave-comment"><span
                                                        class="flaticon-reply-arrow relative mr-[4px] left-[3px] top-[3px]"></span>
                                                    Reply</a>
                                            </span>
                                        </div>
                                        <!-- Comment Text -->
                                        <p>Congue augue egestas integer velna purus undo purus magna nec suscipit
                                            egestas magna and neque egestas a porta ratione mollis risus lectus porta
                                            quisque lacus
                                        </p>
                                    </div>
                                    <!-- End Comment Body -->
                                </div>
                                <!-- END COMMENT #4 -->
                                <hr class=" mt-[24px] !mb-[40px]">
                                <!-- COMMENT FORM -->
                                <div id="leave-comment">
                                    <!-- Title -->
                                    <h5
                                        class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold mt-[80px] !mb-[10px] !pb-0 border-[none] lg:max-xl:!mt-[60px] md:max-lg:!mt-[50px] sm:max-md:!mt-[50px] xsm:max-sm:!mt-[50px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        Leave a Comment</h5>
                                    <!-- Text -->
                                    <p>Your email address will not be published. Required fields are marked *</p>
                                    <form name="commentform"
                                        class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  comment-form relative mt--60 mt-[60px] md:max-lg:!mt-[40px] sm:max-md:!mt-[50px] xsm:max-sm:!mt-[50px]">
                                        <div
                                            class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full  input-message">
                                            <p
                                                class="black--color relative !text-[#353f4f] leading-none font-medium block !mb-[15px] pl-[8px] md:max-lg:!mb-[12px] xsm:max-sm:!mb-[10px]">
                                                Add Comment <span class=" relative !text-[#ff3366] top-[-3px]">*</span></p>
                                            <textarea
                                                class="form-control block w-full !h-[62px] bg-[#f5f6f8] border shadow-[0_0_0_0] !text-[#353f4f] xl:!text-[1rem] leading-none !font-normal [transition:all_300ms_ease-in-out] mb--30 !mb-[30px] p-[0_20px] rounded-[6px] border-solid border-transparent focus:shadow-none focus:bg-[#fcfdfd] focus:border-[#1680fb] lg:max-xl:!h-[52px] lg:max-xl:!text-[1.05rem] md:max-lg:!h-[52px] focus:[outline:0px_none] message p-[25px_20px] min-h-[220px] lg:max-xl:min-h-[190px] md:max-lg:min-h-[190px] sm:max-md:min-h-[190px] xsm:max-sm:min-h-[220px] placeholder:text-[#353f4f]"
                                                name="message" rows="6" placeholder="Enter Your Comment Here* ..." required></textarea>
                                        </div>
                                        <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                            <p
                                                class="black--color relative !text-[#353f4f] leading-none font-medium block !mb-[15px] pl-[8px] md:max-lg:!mb-[12px] xsm:max-sm:!mb-[10px]">
                                                Name <span class=" relative !text-[#ff3366] top-[-3px]">*</span></p>
                                            <input type="text" name="name"
                                                class="form-control block w-full xl:!h-[62px] bg-[#f5f6f8] border shadow-[0_0_0_0] !text-[#353f4f] xl:!text-[1rem] leading-none !font-normal [transition:all_300ms_ease-in-out] mb--30 !mb-[30px] p-[0_20px] rounded-[6px] border-solid border-transparent focus:shadow-none focus:bg-[#fcfdfd] focus:border-[#1680fb] lg:max-xl:!h-[52px] lg:max-xl:!text-[1.05rem] md:max-lg:!h-[52px] focus:[outline:0px_none] name placeholder:text-[#353f4f]"
                                                placeholder="Enter Your Name*" required>
                                        </div>
                                        <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                            <p
                                                class="black--color relative !text-[#353f4f] leading-none font-medium block !mb-[15px] pl-[8px] md:max-lg:!mb-[12px] xsm:max-sm:!mb-[10px]">
                                                Email <span class=" relative !text-[#ff3366] top-[-3px]">*</span></p>
                                            <input type="email" name="email"
                                                class="form-control block w-full xl:!h-[62px] bg-[#f5f6f8] border shadow-[0_0_0_0] !text-[#353f4f] xl:!text-[1rem] leading-none !font-normal [transition:all_300ms_ease-in-out] mb--30 !mb-[30px] p-[0_20px] rounded-[6px] border-solid border-transparent focus:shadow-none focus:bg-[#fcfdfd] focus:border-[#1680fb] lg:max-xl:!h-[52px] lg:max-xl:!text-[1.05rem] md:max-lg:!h-[52px] focus:[outline:0px_none] email placeholder:text-[#353f4f]"
                                                placeholder="Enter Your Email*" required>
                                        </div>
                                        <!-- Contact Form Button -->
                                        <div
                                            class="lg:w-full w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full  form-btn">
                                            <button type="submit"
                                                class="btn btn--theme hover--theme submit mt-[15px] md:max-lg:!mt-0 sm:max-md:!mt-0 xsm:max-sm:!text-[1rem] xsm:max-sm:!mt-0 focus:shadow-none focus:[outline:0px_none]">
                                                Post Comment
                                            </button>
                                        </div>
                                        <!-- Contact Form Message -->
                                        <div
                                            class="md:w-full w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full  comment-form-msg !text-center">
                                            <div class="sending-msg"><span class="loading"></span></div>
                                        </div>
                                    </form>
                                </div>
                                <!-- END COMMENT FORM -->
                            </div>
                        </div> --}}
                        <!-- END POST COMMENTS -->
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
