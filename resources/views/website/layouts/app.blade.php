<!doctype html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="elite-themes24">
    <meta name="description" content="Martex - Tailwind CSS Software, SaaS & Startup Template">
    <meta name="keywords"
        content="Responsive, HTML5, elite-themes24, Landing, Software, Mobile App, SaaS, Startup, Creative, Digital Product">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Martex - Tailwind CSS Software, SaaS & Startup Template</title>

    <!-- FAVICON AND TOUCH ICONS -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('frontend/images/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('frontend/images/apple-touch-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('frontend/images/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('frontend/images/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('frontend/images/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('frontend/images/apple-touch-icon.png') }}" type="image/x-icon">

    @include('website.inc.style')
</head>

<body>
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
    <!-- EXTERNAL SCRIPTS
    ============================================= -->
    <!-- JS FILES -->
    @include('website.inc.script')

</body>

</html>
