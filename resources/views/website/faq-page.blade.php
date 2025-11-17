@extends('website.layouts.app')
@section('title', 'FAQ page')
@section('website_content')
    <section id="service-page-breadcrumb" class="container">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title">FAQ Page</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li class="active">FAQs</li>
            </ul>
        </div>
    </section>


    <!-- FAQs-2  ============================================= -->
    <section id="faqs-2"
        class="xl:!pb-[30px] lg:max-xl:!pb-[20px] md:max-lg:!pb-[10px] inner-page-hero faqs-section division pt-[0px] lg:max-xl:pt-[0px] md:max-lg:!mt-[80px] md:max-lg:pt-[70px]">
        <div class="container">
            <div class="faq-content flex flex-wrap mx-[calc(-0.5*_1.5rem)] justify-center">
                <div class="lg:w-11/12 xl:w-10/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                    <!-- INNER PAGE TITLE -->
                    <div id="faq-sec-title" class="inner-page-title">
                        <div class="header">
                            <div class="title">Questions & Answers</div>

                        </div>

                    </div>
                    <!-- QUESTIONS ACCORDION -->
                    <div class="faq-accordion accordion-wrapper">
                        <ul class="accordion">
                            @foreach ($faqs as $faq)
                                <li class="accordion-item [border-bottom:1px_solid_#ddd] !bg-transparent border-[none]">
                                    <!-- CATEGORY HEADER -->
                                    <div class="accordion-thumb">
                                        <h4 class="s-28 w--700 !leading-none !mb-0">
                                            {{ $faq->question ?? '' }}</h4>
                                    </div>
                                    <!-- CATEGORY ANSWERS -->
                                    <div class="accordion-panel">

                                        <!-- QUESTION #2 -->
                                        <div class="accordion-panel-item  !mb-[35px] ">
                                            <!-- Answer -->
                                            <div class="faqs-2-answer color--grey">
                                                <!-- Text -->
                                                <p>
                                                    {!! $faq->answer ?? '' !!}
                                                </p>
                                            </div>
                                        </div>
                                        <!-- END QUESTION #2 -->

                                    </div>
                                    <!-- END CATEGORY ANSWERS -->
                                </li>
                            @endforeach
                            <!-- QUESTIONS CATEGORY #2 -->
                        </ul>
                    </div>
                    <!-- END QUESTIONS ACCORDION -->
                    <!-- MORE QUESTIONS LINK -->
                    <div class="more-questions !text-center mt--40 mt-[40px] lg:max-xl:!mt-[30px] md:max-lg:!mt-[30px] ">
                        <div
                            class="more-questions-txt bg--white-400 rounded-[100px] inline-block px-[46px] py-[22px] lg:max-xl:px-11 lg:max-xl:py-[18px] md:max-lg:px-[42px] md:max-lg:py-[18px] sm:max-md:px-[42px] sm:max-md:py-[18px] xsm:max-sm:px-9 xsm:max-sm:py-[18px]">
                            <p
                                class="p-lg leading-none !mb-0 lg:max-xl:!text-[1.125rem] md:max-lg:!text-[1.125rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem]">
                                Have any questions?
                                <a href="contacts.html"
                                    class="color--theme font-medium !underline hover:text-[#353f4f] hover:!underline">Get
                                    in Touch</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </section>
    <!-- END FAQs-2 -->


    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
@endsection

@push('scripts')
<script>
    // Select all accordion items
    const accordionItems = document.querySelectorAll('.accordion-item');

    // Page load e first item open thakbe
    if (accordionItems.length > 0) {
        accordionItems[0].classList.add('active');
    }

    // Click event
    document.querySelectorAll('.accordion-thumb').forEach(item => {
        item.addEventListener('click', function() {
            const parent = this.parentElement;

            // Jodi already active na hoy, sob close kore active add koro
            if (!parent.classList.contains('active')) {
                accordionItems.forEach(i => i.classList.remove('active'));
                parent.classList.add('active');
            } else {
                // optional: jodi same click korle close korte chao
                parent.classList.remove('active');
            }
        });
    });
</script>
@endpush
