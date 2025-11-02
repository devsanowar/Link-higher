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
    <title>Customer SignUp Page - {{ $website_settings->website_title ?? '' }}</title>


    <!-- FAVICON AND TOUCH ICONS -->
    <link rel="shortcut icon" href="{{ asset($website_settings->website_favicon ?? '') }}" type="image/x-icon">

    @include('website.inc.style')
</head>

<body>
    <div id="page" class="page font--jakarta">
        <!-- SIGN UP PAGE -->
        <div id="signup"
            class="bg--scroll login-section division !bg-[bottom_left] min-h-screen py-[80px] bg-[url(./images/login.jpg)] bg-scroll w-full bg-no-repeat !bg-fixed sm:max-md:w-auto sm:max-md:bg-scroll xsm:max-sm:w-auto xsm:max-sm:bg-scroll">
            <div class="container">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] justify-center">
                    <!-- REGISTER PAGE WRAPPER -->
                    <div class="xl:w-11/12 lg:max-xl:w-11/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div
                            class="register-page-wrapper overflow-hidden relative z-[1] shadow-[0_10px_20px_0_rgba(0,0,0,0.12)] sm:max-md:w-auto sm:max-md:mx-[25px] sm:max-md:my-0 rounded-[16px] bg--fixed bg-[right_center] bg-[url(./images/login-wrapper.jpg)] after:absolute after:content-[''] after:z-[-1] after:!w-6/12 after:!h-full after:bg-white after:!top-0 after:left-0 bg-scroll sm:max-md:w-auto xsm:max-sm:w-auto w-full bg-no-repeat">
                            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                                <!-- SIGN UP FORM -->
                                <div
                                    class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                    <div
                                        class="register-page-form p-[60px] lg:max-xl:!p-[50px_45px_50px_35px] md:max-lg:!p-[45px_35px_45px_25px] sm:max-md:!p-[50px_40px] xsm:max-sm:!p-[35px_20px]">
                                        <form name="signupform" id="signupform" action="{{ route('signup.store') }}"
                                            method="POST" class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] sign-up-form"
                                            novalidate>
                                            @csrf

                                            <!-- Google Button -->
                                            <div class="flex[1_0_0%] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                                <a href="#"
                                                    class="btn btn-google ico-left w-full text-[#333] xl:!text-[0.95rem] bg-white ![border:1px_solid_#cccccc] hover:![border:1px_solid_#333333] md:max-lg:!text-[1rem] sm:max-md:!text-[1rem] xsm:max-sm:!text-[1rem]">
                                                    <img class="relative xl:!w-[22px] xl:!h-[22px] right-[5px] -top-[2px] md:max-lg:!w-[18px] md:max-lg:!h-[18px] md:max-lg:-top-[2px] sm:max-md:w-5 sm:max-md:!h-5 sm:max-md:right-[5px] sm:max-md:-top-[2px] xsm:max-sm:w-5 xsm:max-sm:!h-5 xsm:max-sm:right-[5px] xsm:max-sm:-top-[2px] inline-block"
                                                        src="{{ asset('frontend/images/png_icons/google.png') }}"
                                                        alt="google-icon">
                                                    Sign Up with Google
                                                </a>
                                            </div>

                                            <!-- Login Separator -->
                                            <div
                                                class="flex[1_0_0%] w-full max-w-full px-[calc(0.5*_1.5rem)] !text-center">
                                                <div
                                                    class="separator-line flex w-full justify-center items-center !text-center xl:!text-[0.9rem] font-medium mt-[25px] mb--30 mb-[30px] mx-0 after:ml-[15px] after:mr-0 after:my-0 font-Jakarta lg:max-xl:mx-0 lg:max-xl:my-[20px] md:max-lg:!text-[1rem] md:max-lg:mx-0 md:max-lg:my-[20px] xsm:max-sm:mx-0 xsm:max-sm:my-6 sm:max-md:!text-[1rem] xsm:max-sm:!text-[1rem] before:content-[''] before:flex-[1_0_20px] before:m-[0_15px_0_0] before:border-t-2 before:border-t-[rgba(0,0,0,0.1)] before:border-solid after:content-[''] after:flex-[1_0_20px] after:m-[0_15px_0_0] after:border-t-2 after:border-t-[rgba(0,0,0,0.1)] after:border-solid">
                                                    Or, sign Up with your email
                                                </div>
                                            </div>

                                            <!-- Full name -->
                                            <div class="flex[1_0_0%] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                                <p
                                                    class="p-sm input-header relative text-[#353f4f] xl:!text-[0.85rem] leading-none font-medium xl:!mb-[12px] pl-[5px]">
                                                    Full name</p>
                                                <input
                                                    class="form-control block w-full email placeholder:text-[#999] xl:!h-[60px] border !text-[#353f4f] xl:!text-[0.95rem] leading-none !font-normal xl:!mb-[10px] p-[5px_20px] rounded-[6px] border-solid border-transparent [transition:all_300ms_ease-in-out] focus:shadow-none bg-[#f5f6f8] focus:border-[#1680fb] focus:[outline:0px_none]"
                                                    type="text" name="name" placeholder="John Doe"
                                                    value="{{ old('name') }}" autocomplete="name" required
                                                    aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}">
                                                @error('name')
                                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Email -->
                                            <div class="flex[1_0_0%] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                                <p
                                                    class="p-sm input-header relative text-[#353f4f] xl:!text-[0.85rem] leading-none font-medium xl:!mb-[12px] pl-[5px]">
                                                    Email address</p>
                                                <input
                                                    class="form-control block w-full email placeholder:text-[#999] xl:!h-[60px] border !text-[#353f4f] xl:!text-[0.95rem] leading-none !font-normal xl:!mb-[10px] p-[5px_20px] rounded-[6px] border-solid border-transparent [transition:all_300ms_ease-in-out] focus:shadow-none bg-[#f5f6f8] focus:border-[#1680fb] focus:[outline:0px_none]"
                                                    type="email" name="email" placeholder="example@example.com"
                                                    value="{{ old('email') }}" autocomplete="email" required
                                                    aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">
                                                @error('email')
                                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Password -->
                                            <div class="flex[1_0_0%] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                                <p
                                                    class="p-sm input-header relative text-[#353f4f] xl:!text-[0.85rem] leading-none font-medium xl:!mb-[12px] pl-[5px]">
                                                    Password</p>
                                                <div class="wrap-input relative">
                                                    <span
                                                        class="btn-show-pass ico-20 !text-[#999999] items-center !absolute h-full cursor-pointer [transition:all_0.4s] right-[20px] top-[20px] hover:!text-[#0195ff]">
                                                        <span class="flaticon-visibility eye-pass"></span>
                                                    </span>
                                                    <input id="password"
                                                        class="form-control block w-full password placeholder:text-[#999] xl:!h-[60px] bg-[#f5f6f8] border !text-[#353f4f] xl:!text-[0.95rem] leading-none !font-normal xl:!mb-[10px] p-[5px_20px] rounded-[6px] border-solid border-transparent [transition:all_300ms_ease-in-out] focus:shadow-none focus:border-[#1680fb] focus:[outline:0px_none]"
                                                        type="password" name="password" placeholder="min 8 characters"
                                                        autocomplete="new-password" minlength="8" required
                                                        aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}">
                                                </div>
                                                @error('password')
                                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Terms (text only) -->
                                            <div class="w-full flex-[0_0_0] px-[calc(0.5*_1.5rem)] max-w-full">
                                                <div
                                                    class="form-data block !text-[0.85rem] !mb-0 md:max-lg:!text-sm sm:max-md:!text-[1rem] xsm:max-sm:!text-[1rem]">
                                                    <span>
                                                        By clicking “Create Account”, you agree to our
                                                        <a class="text-[#353f4f] font-medium !underline"
                                                            href="{{ url('terms') }}">Terms</a>
                                                        and that you have read our
                                                        <a class="text-[#353f4f] font-medium !underline"
                                                            href="{{ url('privacy') }}">Privacy Policy</a>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Submit -->
                                            <div class="flex[1_0_0%] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                                <button type="submit"
                                                    class="btn btn--theme hover--theme submit w-full xl:!h-[60px] mt-[20px] lg:max-xl:!h-[54px] md:max-lg:!h-[50px] md:max-lg:!text-[1.0625rem]">
                                                    Create Account
                                                </button>
                                            </div>

                                            <!-- Log In Link -->
                                            <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                                <p
                                                    class="create-account !text-center xl:!text-[0.925rem] !leading-none xl:!mt-[30px] !mb-0">
                                                    Already have an account?
                                                    <a href="{{ route('customer.signin') }}"
                                                        class="color--theme font-medium !underline hover:text-[#353f4f]">Log
                                                        in</a>
                                                </p>
                                            </div>
                                        </form>

                                        {{-- Small JS for show/hide password --}}
                                    </div>
                                </div>
                                <!-- END SIGN UP FORM -->

                                <!-- SIGN UP PAGE TEXT -->
                                <div
                                    class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                    <div
                                        class="register-page-txt color--white p-[70px_60px] lg:max-xl:!p-[60px_45px] md:max-lg:!p-[50px_30px_0]">
                                        <span
                                            class="section-id block !text-[0.85rem] leading-none !font-bold !tracking-[0.5px] uppercase xl:!mb-[35px] lg:max-xl:!mb-[30px] md:max-lg:!mb-[25px] sm:max-md:!mb-[25px] font-Jakarta">Start
                                            for free</span>
                                        <h2
                                            class="s-48 w--700 xl:!text-[3rem] lg:max-xl:!text-[2.4375rem] md:max-lg:!text-[2.20588rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] xl:!leading-[1.15] !font-bold !mb-[6px] lg:max-xl:leading-none md:max-lg:leading-none sm:max-md:!leading-[1.35] font-Jakarta">
                                            Create</h2>
                                        <h2
                                            class="s-48 w--700 xl:!text-[3rem] lg:max-xl:!text-[2.4375rem] md:max-lg:!text-[2.20588rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] xl:!leading-[1.15] !font-bold !mb-[6px] lg:max-xl:leading-none md:max-lg:leading-none sm:max-md:!leading-[1.35] font-Jakarta">
                                            an account</h2>
                                        <p class="p-md !mt-[25px] !leading-[1.6666]">Integer congue sagittis and velna
                                            augue egestas magna suscipit purus aliquam</p>
                                        <div
                                            class="register-page-copyright !absolute right-[60px] bottom-[45px] lg:max-xl:right-[45px] lg:max-xl:bottom-[40px] md:max-lg:right-[30px] md:max-lg:bottom-[40px]">
                                            <p
                                                class="p-sm !text-[0.85rem] !leading-none !mb-0 lg:max-xl:!text-[0.9rem] md:max-lg:!text-[0.95rem]">
                                                &copy; {{ $website_settings->copyright_text ?? '' }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- END SIGN UP PAGE TEXT -->
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
        <!-- END SIGN UP PAGE -->
    </div>
    <!-- END PAGE CONTENT -->

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
