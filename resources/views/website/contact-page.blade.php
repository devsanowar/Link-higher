@extends('website.layouts.app')
@section('title', 'Contact Page')
@section('page_id', 'contact-page')
@section('website_content')
    <section id="service-page-breadcrumb">
        <div class="container">
            <div class="breadcrumb-container">
                <h2 class="breadcrumb-title">Contact Us Page</h2>
                <ul class="breadcrumb-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>›</span></li>
                    <li class="active">Contact</li>
                </ul>
            </div>
        </div>
    </section>


    <section id="features-6" class="features-section">
        <div class="container">
            <!-- FEATURES WRAPPER -->
            <div class="features-wrapper">
                <div class="features-row">

                    <!-- FEATURE BOX #1 -->
                    <div class="feature-box">
                        <div class="fbox-inner">
                            <div class="fbox-icon">
                                <img src="{{ asset('frontend/images/icons/phone.png') }}" alt="Phone Number">
                            </div>
                            <div class="fbox-content">
                                <h6>Phone Number</h6>
                                <p>{{ $website_settings->phone_one }}</p>
                                <p>{{ $website_settings->phone_two }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- FEATURE BOX #2 -->
                    <div class="feature-box">
                        <div class="fbox-inner">
                            <div class="fbox-icon">
                                <img src="{{ asset('frontend/images/icons/gmail.png') }}" alt="Email">
                            </div>
                            <div class="fbox-content">
                                <h6>Email</h6>
                                <p>{{ $website_settings->email_one ?? '' }}</p>
                                <p>{{ $website_settings->email_two ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- FEATURE BOX #3 -->
                    <div class="feature-box">
                        <div class="fbox-inner">
                            <div class="fbox-icon">
                                <img src="{{ asset('frontend/images/icons/gps.png') }}" alt="Address (Office One)">
                            </div>
                            <div class="fbox-content">
                                <h6>Address (Office One)</h6>
                                <p>{{ $website_settings->address_one }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- FEATURE BOX #4 -->
                    <div class="feature-box">
                        <div class="fbox-inner">
                            <div class="fbox-icon">
                                <img src="{{ asset('frontend/images/icons/location-pin.png') }}" alt="Address (Office Two)">
                            </div>
                            <div class="fbox-content">
                                <h6>Address (Office Two)</h6>
                                <p>{{ $website_settings->address_two ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End row -->
            </div>
            <!-- End features-wrapper -->
        </div>
    </section>


    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">


    <!-- CONTACTS-1 -->
    <section id="contacts-1"
        class="pb--50 xl:!pb-[50px] lg:max-xl:!pb-[40px] md:max-lg:!pb-[30px]  inner-page-hero contacts-section division pt-[100px] lg:max-xl:pt-[80px] md:max-lg:!mt-[60px] md:max-lg:pt-[70px]">
        <div class="container">
            <!-- SECTION TITLE -->
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <div
                    class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                    <div class="section-title !text-center mb--80 xl:!mb-[80px] lg:max-xl:!mb-[60px] md:max-lg:!mb-[50px]">
                        <!-- Title -->
                        <h2
                            class="s-52 w--700 xl:!text-[3.25rem] lg:max-xl:!text-[3rem] md:max-lg:!text-[2.79411rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold !tracking-[-0.5px] !mb-0 xsm:max-sm:px-[1%] xsm:max-sm:py-0 font-Jakarta leading-[1.25] sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                            Questions? Let's Talk</h2>
                        <!-- Text -->
                        <p
                            class="p-lg !text-[1.125rem] xl:!mt-[18px] !mb-0 px-[3%] py-0 lg:max-xl:!mt-[15px] md:max-lg:!mt-3 lg:max-xl:!p-0 md:max-lg:!p-0 sm:max-md:!mt-[14px] sm:max-md:!p-0 xsm:max-sm:!p-0 !leading-[1.6666]">
                            Want to learn more about Martex, get a quote, or speak with an expert?
                            Let us know what you are looking for and we’ll get back to you right away
                        </p>
                    </div>
                </div>
            </div>
            <!-- CONTACT FORM -->
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <div
                    class="md:w-11/12 lg:max-xl:w-10/12 xl:w-8/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                    <div class="form-holder">

                        <form id="contactForm" name="contactform"
                            class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  contact-form">
                            @csrf
                            <!-- Contact Form Input -->
                            <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                <p
                                    class="p-lg text-[#353f4f] !text-[1.125rem] !leading-none font-medium !mb-[10px] pl-[8px]">
                                    Your Name: </p>
                                <input type="text" name="name"
                                    class="form-control block w-full name xl:!h-[62px] bg-[#f5f6f8] border shadow-[0_0_0_0] !text-[#3a4a56] !text-[1rem] !font-normal mb--30 mb-[30px] p-[0_15px] rounded-[6px] border-solid border-transparent lg:max-xl:!h-[54px] md:max-lg:!h-[52px] sm:max-md:!h-[54px] xsm:max-sm:!h-[54px] focus:shadow-none focus:bg-[#fcfdfd] focus:border-[#1680fb] focus:[outline:0px_none]"
                                    placeholder="Your Name*">
                            </div>
                            <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                <p
                                    class="p-lg text-[#353f4f] !text-[1.125rem] !leading-none font-medium !mb-[10px] pl-[8px]">
                                    Your Email Address: </p>

                                <input type="text" name="email"
                                    class="form-control block w-full email xl:!h-[62px] bg-[#f5f6f8] border shadow-[0_0_0_0] !text-[#3a4a56] !text-[1rem] !font-normal mb--30 mb-[30px] p-[0_15px] rounded-[6px] border-solid border-transparent lg:max-xl:!h-[54px] md:max-lg:!h-[52px] sm:max-md:!h-[54px] xsm:max-sm:!h-[54px] focus:shadow-none focus:bg-[#fcfdfd] focus:border-[#1680fb] focus:[outline:0px_none]"
                                    placeholder="Email Address*">
                            </div>

                            <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                <p
                                    class="p-lg text-[#353f4f] !text-[1.125rem] !leading-none font-medium !mb-[10px] pl-[8px]">
                                    Services:
                                </p>

                                <div class="relative">
                                    <select name="service_name" id="services"
                                        class="form-control block w-full email xl:!h-[62px] bg-[#f5f6f8] border shadow-[0_0_0_0] !text-[#3a4a56] !text-[1rem] !font-normal mb--30 mb-[30px] p-[0_15px] rounded-[6px] border-solid border-transparent lg:max-xl:!h-[54px] md:max-lg:!h-[52px] sm:max-md:!h-[54px] xsm:max-sm:!h-[54px] focus:shadow-none focus:bg-[#fcfdfd] focus:border-[#1680fb] focus:[outline:0px_none]">
                                        <option value="">-- Select a service --</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->service_title ?? '' }}">
                                                {{ $service->service_title ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                <p
                                    class="p-lg text-[#353f4f] !text-[1.125rem] !leading-none font-medium !mb-[10px] pl-[8px]">
                                    Explain your question in details: </p>

                                <textarea
                                    class="form-control block w-full message xl:!h-[62px] bg-[#f5f6f8] border shadow-[0_0_0_0] !text-[#3a4a56] !text-[1rem] !font-normal mb--30 mb-[30px] p-[0_15px] rounded-[6px] border-solid border-transparent lg:max-xl:!h-[54px] md:max-lg:!h-[52px] sm:max-md:!h-[54px] xsm:max-sm:!h-[54px] focus:shadow-none focus:bg-[#fcfdfd] focus:border-[#1680fb] focus:[outline:0px_none]"
                                    name="message" rows="6" placeholder="I have a problem with..."></textarea>
                            </div>
                            <!-- Contact Form Button -->
                            <!-- Submit -->
                            <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full mt-[15px] form-btn">
                                <button type="submit" class="btn btn--theme hover--theme submit" id="submitBtn">Submit
                                    Request</button>
                            </div>

                            <!-- Loading / Global message -->
                            <div
                                class="contact-form-msg w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full block mt-[20px] pl-0">
                                <span
                                    class="loading !text-[#00b2e4] !text-[1.0625rem] leading-none font-medium pl-[15px]"></span>
                                <div id="globalSuccess" class="hidden rounded-md bg-green-50 p-3 text-green-700 mt-2">
                                </div>
                                <div id="globalError" class="hidden rounded-md bg-red-50 p-3 text-red-700 mt-2"></div>
                            </div>




                            <div class="contact-form-notice w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                <p
                                    class="p-sm !text-[0.835rem] !font-light leading-[1.5555] mt--40 xl:!mt-[40px] pl-0 lg:max-xl:!text-sm lg:max-xl:!mt-[30px] md:max-lg:!text-sm md:max-lg:!mt-[30px] sm:max-md:!text-sm sm:max-md:!mt-[30px] xsm:max-sm:!text-sm xsm:max-sm:!mt-[30px] text-[#353f4f] !mb-[10px]">
                                    We are committed to your privacy. Martex uses the information you
                                    provide us to contact you about our relevant content, products, and services.
                                    You may unsubscribe from these communications at any time. For more information,
                                    check out our <a href="privacy.html"
                                        class="text-[#353f4f] font-medium !underline">Privacy Policy</a>.
                                </p>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
            <!-- END CONTACT FORM -->
        </div>
        <!-- End container -->
    </section>
    <!-- END CONTACTS-1 -->


    <section id="map-1" class="map-section">
        <div
            class="map-overlay py-[60px] lg:max-xl:py-[45px] md:max-lg:!text-center md:max-lg:pt-[40px] md:max-lg:!pb-[30px] md:max-lg:px-[18%] sm:max-md:pt-[50px] sm:max-md:!pb-[40px] xsm:max-sm:pt-[50px] xsm:max-sm:!pb-[40px]">

            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] items-center row-cols-1 row-cols-lg-2">

                <!-- GOOGLE MAP -->
                <div class="w-full h-[500px] md:h-[450px] sm:h-[400px] overflow-hidden">
                    <iframe title="Google Map" width="100%" height="400" style="border:0;" allowfullscreen
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="{!! $website_settings->google_map ?? '' !!}">
                    </iframe>
                </div>
                <!-- END GOOGLE MAP -->

            </div>
            <!-- End row -->

        </div>
        <!-- End map-overlay -->
    </section>


    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">

@endsection

@push('scripts')
    @push('scripts')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json' // <-- important
                    }
                });

                const $form = $('#contactForm');
                const $submitBtn = $('#submitBtn');
                const $loading = $('.loading');
                const $globalSuccess = $('#globalSuccess');
                const $globalError = $('#globalError');

                function clearErrors() {
                    $form.find('.field-error').text('');
                    $form.find('input, textarea').removeClass('border-red-500 focus:border-red-500');
                    $globalSuccess.addClass('hidden').text('');
                    $globalError.addClass('hidden').text('');
                }

                $form.on('submit', function(e) {
                    e.preventDefault();
                    clearErrors();

                    $loading.text('Submitting...');
                    $submitBtn.prop('disabled', true);

                    $.post({
                        url: "{{ route('contact.form.submit') }}",
                        data: $form.serialize(),
                        success: function(res) {
                            $loading.text('');
                            $globalSuccess.removeClass('hidden').text(res.message ||
                                'Submitted successfully.');
                            $form[0].reset();
                        },
                        error: function(xhr) {
                            $loading.text('');

                            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                                const errors = xhr.responseJSON.errors;

                                if (errors.name) {
                                    const $f = $('#name');
                                    $f.addClass('border-red-500 focus:border-red-500');
                                    $f.closest('div').find('.field-error').first().text(errors.name[
                                        0]);
                                }
                                if (errors.email) {
                                    const $f = $('#email');
                                    $f.addClass('border-red-500 focus:border-red-500');
                                    $f.closest('div').find('.field-error').first().text(errors
                                        .email[0]);
                                }
                                if (errors.message) {
                                    const $f = $('#message');
                                    $f.addClass('border-red-500 focus:border-red-500');
                                    $f.closest('div').find('.field-error').first().text(errors
                                        .message[0]);
                                }

                                $globalError.removeClass('hidden').text(
                                    'Please fix the errors below and try again.');
                            } else {
                                $globalError.removeClass('hidden').text(
                                    'An unexpected error occurred. Please try again.');
                            }
                        },
                        complete: function() {
                            $submitBtn.prop('disabled', false);
                        }
                    });
                });
            });
        </script>
    @endpush
@endpush
