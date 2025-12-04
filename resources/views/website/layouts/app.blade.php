<!doctype html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="elite-themes24">
    <meta name="description" content="{{ $website_settings->website_title ?? '' }}">
    <meta name="keywords"
        content="Responsive, HTML5, elite-themes24, Landing, Software, Mobile App, SaaS, Startup, Creative, Digital Product">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title') - {{ $website_settings->website_title ?? '' }}</title>

    <!-- FAVICON AND TOUCH ICONS -->
    <link rel="shortcut icon" href="{{ asset($website_settings->website_favicon ?? '') }}" type="image/x-icon">


    @include('website.inc.style')
</head>

<body id="@yield('page_id')">
    <!-- PRELOADER SPINNER
                  ============================================= -->
    {{-- <div id="loading" class="loading--theme  h-full w-full fixed z-[99999999] mt--0 top-0 bg-[#f5f5f9]">
        <div id="loading-center"
            class="absolute !h-[100px] !w-[100px] mt-[-50px] ml-[-50px] animate-[loading-center-absolute_1s_infinite] left-2/4 top-2/4 lg:max-xl:!h-[90px] lg:max-xl:!w-[90px] lg:max-xl:!mt-[-45px] lg:max-xl:ml-[-45px] md:max-lg:!h-[90px] md:max-lg:!w-[90px] md:max-lg:!mt-[-45px] md:max-lg:ml-[-45px]">
            <span
                class="loader !w-[100px] !h-[100px] inline-block relative box-border animate-[rotation_1s_linear_infinite] rounded-[50%] border-2 border-solid border-[transparent_#888] after:content-[''] after:box-border after:absolute after:-translate-x-2/4 after:-translate-y-2/4 after:rounded-[50%] after:border-[50px] after:border-solid after:border-[transparent_rgba(30,30,30,0.15)] after:left-2/4 after:!top-2/4 lg:max-xl:!w-[90px] lg:max-xl:!h-[90px] lg:max-xl:after:border-[45px] lg:max-xl:after:border-solid md:max-lg:!w-[90px] md:max-lg:!h-[90px] md:max-lg:after:border-[45px] md:max-lg:after:border-solid sm:max-md:!w-[80px] sm:max-md:!h-[80px] sm:max-md:after:border-[40px] sm:max-md:after:border-solid"></span>
        </div>
    </div> --}}

    <!-- PAGE CONTENT
                  ============================================= -->
    <div id="page" class="page font--jakarta">
        <!-- HEADER
    ============================================= -->
        @include('website.inc.header')
        <!-- END HEADER -->



        @yield('website_content')



        <!-- END MODAL WINDOW (NEWSLETTER FORM) -->
        <!-- FOOTER-3
                     ============================================= -->


        @include('website.inc.footer')

        <!-- END FOOTER-3 -->
    </div>
    <!-- END PAGE CONTENT -->

    <!-- WhatsApp Floating Button -->
    {{-- @if (request()->is('/'))
    <a href="https://wa.me/8801XXXXXXXXX" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
    @endif --}}


    {{-- <div id="chat-widget">

    <!-- Floating Message Icon -->
    <div id="chat-toggle">💬</div>

    <!-- Chat Window -->
    <div id="chat-window" class="hidden">

        <!-- Header -->
        <div class="chat-header">
            <strong>Sanwoar Web Agency</strong><br>
            <small>Live Assistant</small>
        </div>

        <!-- Body -->
        <div class="chat-body" id="messages">
            <div class="msg bot">
                <span>হ্যালো! 👋 কোন সার্ভিস সম্পর্কে জানতে চান?</span>
            </div>

            <div class="quick-questions">
                <button class="quick-btn" data-text="Tell me about Link Building service">Link Building</button>
                <button class="quick-btn" data-text="Tell me about SEO service">SEO</button>
                <button class="quick-btn" data-text="Tell me about Website service">Website</button>
                <button class="quick-btn" data-text="Tell me about Content Writing service">Content Writing</button>
            </div>
        </div>

        <!-- Footer -->
        <div class="chat-footer">
            <input type="text" id="messageInput" placeholder="Type your message...">
            <button id="sendBtn">Send</button>
        </div>
    </div>
</div> --}}



    <div id="chat-widget">

        <!-- Floating Message Icon -->
        <div id="chat-toggle">💬</div>

        <!-- Chat Window -->
        <div id="chat-window" class="hidden">

            <!-- Header -->
            <div class="chat-header">
                <div class="chat-header-text">
                    <strong>Link Higher - Web Agency</strong><br>
                    <small>Live Assistant</small>
                </div>

                <button id="chatHeaderToggle" class="chat-header-toggle" aria-label="Minimize chat">
                    &#9660; <!-- down arrow -->
                </button>
            </div>


            <!-- Body -->
            <div class="chat-body" id="messages">
                <div class="msg bot">
                    <span>Hello! 👋 Which service would you like to know about?</span>
                </div>

                <div class="quick-questions">
                    <button class="quick-btn" data-text="Tell me about Link Building service">Link Building</button>
                    <button class="quick-btn" data-text="Tell me about SEO service">SEO</button>
                    <button class="quick-btn" data-text="Tell me about Website service">Website</button>
                    <button class="quick-btn" data-text="Tell me about Content Writing service">Content Writing</button>
                </div>

                <!-- 🔹 Live Support / Quote Request box -->
                <div class="support-box">
                    <p>If you want to discuss a detailed quote or your project, please go to Live Support.</p>
                    <button id="liveSupportBtn">💬 Live Support / Quote Request</button>
                </div>


                <!-- 🔹 Hidden Support Form -->
                <div class="support-form" id="supportForm" style="display:none; margin-top:8px;">
                    <h4 style="margin-bottom:6px;">Give your Project Details </h4>
                    <form id="supportRequestForm">
                        <input type="text" name="name" placeholder="Name *" required>
                        <input type="email" name="email" placeholder="Email *" required>
                        <input type="text" name="phone" placeholder="Phone Number *" required>
                        <select name="service_type">
                            <option value="">Select Service</option>
                            <option value="Link Building">Link Building</option>
                            <option value="SEO Service">SEO Service</option>
                            <option value="Website Development">Website Development</option>
                            <option value="Content Writing">Content Writing</option>
                        </select>
                        <input type="text" name="website_url" placeholder="Website URL (If you have)">
                        <select name="budget_range">
                            <option value="">Budget range (optional)</option>
                            <option value="Under $200">Under $200</option>
                            <option value="$200 - $500">$200 - $500</option>
                            <option value="$500 - $1000">$500 - $1000</option>
                            <option value="Above $1000">Above $1000</option>
                        </select>

                        <textarea name="message" placeholder="About the project / services *" rows="3" required></textarea>
                        <button type="submit">Request A Qoute</button>
                    </form>
                    <p id="supportSuccessMsg" style="display:none; font-size:13px; margin-top:5px;"></p>
                </div>
            </div>

            <!-- Footer -->
            <div class="chat-footer">
                <input type="text" id="messageInput" placeholder="Type your message...">
                <button id="sendBtn">Send</button>
            </div>
        </div>
    </div>


    <button id="backToTop" aria-label="Back to top">↑</button>






    <!-- EXTERNAL SCRIPTS
    ============================================= -->
    <!-- JS FILES -->
    @include('website.inc.script')

</body>

</html>
