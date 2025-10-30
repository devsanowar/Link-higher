<section id="faqs-3" class="py--100 py-[100px] lg:max-xl:py-[80px] md:max-lg:py-[70px] faqs-section">
    <div class="container">
        <!-- SECTION TITLE -->
        <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
            <div class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                <div
                    class="section-title !text-center mb--70 xl:!mb-[70px] lg:max-xl:!mb-[55px] md:max-lg:!mb-[45px] sm:max-md:!mb-[40px] xsm:max-sm:!mb-[40px]">
                    <!-- Title -->
                    <h2
                        class="s-50 w--700 xl:!text-[3.125rem] lg:max-xl:!text-[2.875rem] md:max-lg:!text-[2.64705rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold !tracking-[-0.5px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                        Questions & Answers</h2>
                    <!-- Text -->
                    <p
                        class="s-21 color--grey xl:!text-[1.3125rem] xl:!mt-[18px] !mb-0 lg:max-xl:!mt-[15px] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.32352rem] md:max-lg:!mt-3 sm:max-md:!text-[1.21875rem] sm:max-md:!mt-3 xsm:max-sm:!text-[1.1875rem] xsm:max-sm:!mt-3 xsm:max-sm:px-[3%] xsm:max-sm:py-0">
                        Ligula risus auctor tempus magna feugiat lacinia.</p>
                </div>
            </div>
        </div>
        <!-- FAQs-3 QUESTIONS -->
        @php
            use Illuminate\Support\Str;
        @endphp

        {{-- প্রতি রোতে ১০টা করে (বাম ৫ + ডান ৫) --}}
        @foreach ($faqs->chunk(10) as $chunkIndex => $chunk)
            <div class="faqs-3-questions">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">

                    {{-- LEFT COLUMN (১ম ৫টি) --}}
                    <div class="xl:w-6/12 lg:max-xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                        <div class="questions-holder px-[10px] py-0 lg:max-xl:!p-0 md:max-lg:!p-0">
                            @foreach ($chunk->slice(0, 5)->values() as $i => $faq)
                                <div class="question mb--35 !mb-[35px] wow fadeInUp">
                                    <h5
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[15px] md:max-lg:!mb-[12px] sm:max-md:!mb-[15px] xsm:max-sm:!mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        <span class="mr-[5px]">{{ $chunkIndex * 10 + $i + 1 }}.</span>
                                        {{ $faq->question ?? 'Question' }}
                                    </h5>

                                    {{-- উত্তর HTML হলে 그대로 দেখাবে; না হলে <p> হিসেবে --}}
                                    @if (!empty($faq->answer) && Str::startsWith(trim($faq->answer), ['<p', '<ul', '<ol', '<div']))
                                        {!! $faq->answer !!}
                                    @else
                                        <p class="color--grey">{!! nl2br(e($faq->answer ?? 'Answer')) !!}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- RIGHT COLUMN (পরের ৫টি) --}}
                    <div class="xl:w-6/12 lg:max-xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                        <div class="questions-holder px-[10px] py-0 lg:max-xl:!p-0 md:max-lg:!p-0">
                            @foreach ($chunk->slice(5, 5)->values() as $j => $faq)
                                <div class="question mb--35 !mb-[35px] wow fadeInUp">
                                    <h5
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[15px] md:max-lg:!mb-[12px] sm=max-md:!mb-[15px] xsm:max-sm:!mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        <span class="mr-[5px]">{{ $chunkIndex * 10 + 5 + $j + 1 }}.</span>
                                        {{ $faq->question ?? 'Question' }}
                                    </h5>

                                    @if (!empty($faq->answer) && Str::startsWith(trim($faq->answer), ['<p', '<ul', '<ol', '<div']))
                                        {!! $faq->answer !!}
                                    @else
                                        <p class="color--grey">{!! nl2br(e($faq->answer ?? 'Answer')) !!}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        @endforeach

        <!-- MORE QUESTIONS LINK -->
        <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
            <div class="flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                <div class="more-questions !text-center mt--40 mt-[40px] lg:max-xl:!mt-[30px] md:max-lg:!mt-[30px] ">
                    <div
                        class="more-questions-txt bg--white-400 rounded-[100px] inline-block px-[46px] py-[22px] lg:max-xl:px-11 lg:max-xl:py-[18px] md:max-lg:px-[42px] md:max-lg:py-[18px] sm:max-md:px-[42px] sm:max-md:py-[18px] xsm:max-sm:px-9 xsm:max-sm:py-[18px]">
                        <p
                            class="p-lg leading-none !mb-0 lg:max-xl:!text-[1.125rem] md:max-lg:!text-[1.125rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem]">
                            Have any questions?
                            <a href="{{ route('contact.page') }}"
                                class="color--theme font-medium !underline hover:text-[#353f4f] hover:!underline">Get
                                in Touch</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End container -->
</section>
