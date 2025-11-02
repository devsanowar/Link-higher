<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="elite-themes24">
    <meta name="description" content="Martex - Tailwind CSS Software, SaaS & Startup Template">
    <meta name="keywords"
        content="Responsive, HTML5, elite-themes24, Landing, Software, Mobile App, SaaS, Startup, Creative, Digital Product">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Login - {{ $website_settings->website_title ?? '' }}</title>

    <!-- FAVICON AND TOUCH ICONS -->
    <link rel="shortcut icon" href="{{ asset($website_settings->website_favicon ?? '') }}" type="image/x-icon">

    @include('website.inc.style')
</head>

<body>

    <div id="page" class="page font--jakarta">
        <!-- LOGIN PAGE
                     ============================================= -->
        <div id="login"
            class="bg--scroll login-section division !bg-[bottom_left] min-h-screen py-[80px] bg-[url(./images/login.jpg)] bg-scroll w-full bg-no-repeat bg-fixed sm:max-md:w-auto sm:max-md:bg-scroll xsm:max-sm:w-auto xsm:max-sm:bg-scroll">
            <div class="container">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                    <!-- REGISTER PAGE WRAPPER -->
                    <div class="xl:w-11/12 lg:max-xl:w-11/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div
                            class="register-page-wrapper overflow-hidden relative z-[1] shadow-[0_10px_20px_0_rgba(0,0,0,0.12)] sm:max-md:mx-[25px] sm:max-md:my-0 rounded-[16px]  bg--fixed bg-left-top bg-[url(./images/login-wrapper.jpg)] after:left-2/4 after:absolute after:content-[''] after:z-[-1] after:!w-6/12 after:!h-full after:bg-white after:!top-0 bg-scroll sm:max-md:w-auto xsm:max-sm:w-auto w-full bg-no-repeat">
                            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                                <!-- LOGIN PAGE TEXT -->
                                <div
                                    class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                    <div
                                        class="register-page-txt color--white p-[70px_60px] lg:max-xl:!p-[60px_45px] md:max-lg:!p-[50px_30px_0]">
                                        <!-- Logo -->
                                        <img class="img-fluid w-auto max-w-[inherit] !max-h-[32px] !mb-[55px] lg:max-xl:!max-h-[30px] lg:max-xl:!mb-[45px] md:max-lg:!max-h-[26px] md:max-lg:!mb-[40px]"
                                            src="images/logo-white.png" alt="logo-image">
                                        <!-- Title -->
                                        <h2
                                            class="s-24 w--700 !text-[2.625rem] lg:max-xl:!text-[2.4375rem] md:max-lg:!text-[2.20588rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] !leading-[1.15] !font-bold !mb-[6px] lg:max-xl:leading-none md:max-lg:leading-none sm:max-md:!leading-[1.35] font-Jakarta">
                                            Welcome</h2>
                                        <h2
                                            class="s-24 w--700 !text-[2.625rem] lg:max-xl:!text-[2.4375rem] md:max-lg:!text-[2.20588rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] !leading-[1.15] !font-bold !mb-[6px] lg:max-xl:leading-none md:max-lg:leading-none sm:max-md:!leading-[1.35] font-Jakarta">
                                            back to Martex</h2>
                                        <!-- Text -->
                                        <p class="p-md !mt-[25px]">Integer congue sagittis and velna augue egestas magna
                                            suscipit purus aliquam
                                        </p>
                                        <!-- Copyright -->
                                        <div
                                            class="register-page-copyright !absolute left-[60px] bottom-[45px] lg:max-xl:left-[45px] lg:max-xl:bottom-[40px] md:max-lg:left-[30px] md:max-lg:bottom-[40px]">
                                            <p
                                                class="p-sm !text-[0.85rem] !leading-none !mb-0 lg:max-xl:!text-[0.9rem] md:max-lg:!text-[0.95rem]">
                                                &copy; 2025 Martex. <span>All Rights Reserved</span></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- END LOGIN PAGE TEXT -->
                                <!-- LOGIN FORM -->
                                <div
                                    class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                    <div
                                        class="register-page-form p-[60px] lg:max-xl:!p-[50px_45px_50px_35px] md:max-lg:!p-[45px_35px_45px_25px] sm:max-md:!p-[50px_40px] xsm:max-sm:!p-[35px_20px]">
                                        <form name="signinform" action="{{ route('login.store') }}" method="POST"
                                            class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  sign-in-form">

                                            @csrf
                                            <!-- Google Button -->
                                            {{-- <div class="flex[1_0_0%] w-full max-w-full  px-[calc(0.5*_1.5rem)]">
                                                <a href="#"
                                                    class="btn btn-google ico-left w-full text-[#333] xl:!text-[0.95rem] bg-white ![border:1px_solid_#cccccc] hover:![border:1px_solid_#333333] md:max-lg:!text-[1rem] sm:max-md:!text-[1rem] xsm:max-sm:!text-[1rem]">
                                                    <img class="relative xl:!w-[22px] xl:!h-[22px] right-[5px] -top-[2px] md:max-lg:!w-[18px] md:max-lg:!h-[18px] md:max-lg:-top-[2px] sm:max-md:w-5 sm:max-md:!h-5 sm:max-md:right-[5px] sm:max-md:-top-[2px] xsm:max-sm:w-5 xsm:max-sm:!h-5 xsm:max-sm:right-[5px] xsm:max-sm:-top-[2px] inline-block"
                                                        src="images/png_icons/google.png" alt="google-icon"> Sign in
                                                    with Google
                                                </a>
                                            </div> --}}
                                            <!-- Login Separator -->
                                            <div
                                                class="flex[1_0_0%] w-full max-w-full  px-[calc(0.5*_1.5rem)] !text-center">
                                                <div
                                                    class="separator-line flex w-full justify-center items-center !text-center xl:!text-[0.9rem] font-medium mt-[25px] mb--30 mb-[30px] mx-0 after:ml-[15px] after:mr-0 after:my-0 font-Jakarta lg:max-xl:mx-0 lg:max-xl:my-[20px] md:max-lg:!text-[1rem] md:max-lg:mx-0 md:max-lg:my-[20px] xsm:max-sm:mx-0 xsm:max-sm:my-6 sm:max-md:!text-[1rem] xsm:max-sm:!text-[1rem] before:content-[''] before:flex-[1_0_20px] before:m-[0_15px_0_0] before:border-t-2 before:border-t-[rgba(0,0,0,0.1)] before:border-solid after:content-[''] after:flex-[1_0_20px] after:m-[0_15px_0_0] after:border-t-2 after:border-t-[rgba(0,0,0,0.1)] after:border-solid">
                                                    Sign in with your email</div>
                                            </div>
                                            <!-- Form Input -->
                                            <div class="flex[1_0_0%] w-full max-w-full  px-[calc(0.5*_1.5rem)]">
                                                <p
                                                    class="p-sm input-header relative text-[#353f4f] xl:!text-[0.85rem] leading-none font-medium xl:!mb-[12px] pl-[5px] lg:max-xl:!text-[0.9rem] lg:max-xl:!mb-[10px] lg:max-xl:!pl-[5px] md:max-lg:!text-[0.95rem] md:max-lg:!mb-[10px] md:max-lg:!pl-[5px] sm:max-md:!text-[1rem] xsm:max-sm:!text-[1rem]">
                                                    Email address</p>
                                                <input
                                                    class="form-control block w-full  email placeholder:text-[#999] xl:!h-[60px] border !text-[#353f4f] xl:!text-[0.95rem] leading-none !font-normal xl:!mb-[25px] p-[5px_20px] rounded-[6px] border-solid border-transparent [transition:all_300ms_ease-in-out] focus:shadow-none bg-[#f5f6f8] focus:border-[#1680fb] focus:[outline:0px_none] lg:max-xl:!h-[54px] lg:max-xl:!mb-[20px] md:max-lg:!h-[50px] md:max-lg:!text-[1.0625rem] md:max-lg:!mb-[20px] md:max-lg:px-[15px] md:max-lg:py-[5px] sm:max-md:!h-[54px] sm:max-md:!text-[1.0625rem] xsm:max-sm:!h-[54px] xsm:max-sm:!text-[1.0625rem]"
                                                    type="email" name="email" placeholder="example@example.com">
                                            </div>
                                            <!-- Form Input -->
                                            <div class="flex[1_0_0%] w-full max-w-full  px-[calc(0.5*_1.5rem)]">
                                                <p
                                                    class="p-sm input-header relative text-[#353f4f] xl:!text-[0.85rem] leading-none font-medium xl:!mb-[12px] pl-[5px] lg:max-xl:!text-[0.9rem] lg:max-xl:!mb-[10px] lg:max-xl:!pl-[5px] md:max-lg:!text-[0.95rem] md:max-lg:!mb-[10px] md:max-lg:!pl-[5px] sm:max-md:!text-[1rem] xsm:max-sm:!text-[1rem]">
                                                    Password</p>
                                                <div class="wrap-input relative">
                                                    <span
                                                        class="btn-show-pass ico-20 !text-[#999999] items-center !absolute h-full cursor-pointer [transition:all_0.4s] right-[20px] top-[20px] hover:!text-[#0195ff] lg:max-xl:top-[18px] md:max-lg:top-[17px] xsm:max-sm:top-[18px]"><span
                                                            class="flaticon-visibility eye-pass"></span></span>
                                                    <input
                                                        class="form-control block w-full  password placeholder:text-[#999] xl:!h-[60px] bg-[#f5f6f8] border !text-[#353f4f] xl:!text-[0.95rem] leading-none !font-normal xl:!mb-[25px] p-[5px_20px] rounded-[6px] border-solid border-transparent [transition:all_300ms_ease-in-out] focus:shadow-none bg-[#f5f6f8] focus:border-[#1680fb] focus:[outline:0px_none] lg:max-xl:!h-[54px] lg:max-xl:!mb-[20px] md:max-lg:!h-[50px] md:max-lg:!text-[1.0625rem] md:max-lg:!mb-[20px] md:max-lg:px-[15px] md:max-lg:py-[5px] sm:max-md:!h-[54px] sm:max-md:!text-[1.0625rem] xsm:max-sm:!h-[54px] xsm:max-sm:!text-[1.0625rem]"
                                                        type="password" name="password" placeholder="* * * * * * * * *">
                                                </div>
                                            </div>
                                            <!-- Reset Password Link -->
                                            <div class="flex[1_0_0%] w-full max-w-full  px-[calc(0.5*_1.5rem)]">
                                                <div class="reset-password-link">
                                                    <p
                                                        class="p-sm relative xl:!text-[0.9rem] leading-none -mt-[8px] xl:!mb-[10px] md:max-lg:!text-[1rem] md:max-lg:!mt-[-3px] md:max-lg:!mb-[10px] sm:max-md:!text-[1rem] sm:max-md:!mt-0 sm:max-md:!mb-[10px] xsm:max-sm:!text-[1rem] xsm:max-sm:!mt-0 xsm:max-sm:!mb-[8px]">
                                                        <a href="reset-password.html" class="color--theme">Forgot your
                                                            password?</a></p>
                                                </div>
                                            </div>
                                            <!-- Form Submit Button -->
                                            <div class="flex[1_0_0%] w-full max-w-full  px-[calc(0.5*_1.5rem)]">
                                                <button type="submit"
                                                    class="btn btn--theme hover--theme submit w-full xl:!h-[60px] mt-[20px] lg:max-xl:!h-[54px] lg:max-xl:!mt-3 md:max-lg:!h-[50px] md:max-lg:!text-[1.0625rem] md:max-lg:!mt-3 sm:max-md:!h-[54px] sm:max-md:!text-[1.0625rem] xsm:max-sm:!h-[54px] xsm:max-sm:!text-[1.0625rem]">Log
                                                    In</button>
                                            </div>
                                            <!-- Sign Up Link -->
                                            <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                                <p
                                                    class="create-account !text-center xl:!text-[0.925rem] !leading-none xl:!mt-[30px] !mb-0 lg:max-xl:!mt-[20px] md:max-lg:!text-[1rem] sm:max-md:!text-[1rem] xsm:max-sm:!text-[1rem] xsm:max-sm:!mt-[20px] sm:max-md:!mt-[30px]">
                                                    Don't have an account? <a href="{{ route('customer.register') }}"
                                                        class="color--theme font-medium !underline hover:text-[#353f4f]">Sign
                                                        up</a>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END LOGIN FORM -->
                            </div>
                            <!-- End row -->
                        </div>
                        <!-- End register-page-wrapper -->
                    </div>
                    <!-- END REGISTER PAGE WRAPPER -->
                </div>
                <!-- End row -->
            </div>
            <!-- End container -->
        </div>
        <!-- END LOGIN PAGE -->
    </div>

    @include('website.inc.script')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.querySelector('.btn-show-pass');
            const pass = document.getElementById('password');
            if (btn && pass) {
                btn.addEventListener('click', () => {
                    pass.type = pass.type === 'password' ? 'text' : 'password';
                });
            }
        });
    </script>
</body>

</html>
