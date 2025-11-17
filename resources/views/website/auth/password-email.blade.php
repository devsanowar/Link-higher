{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Forgot Password</h2>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label>Email address</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-2">Send Reset Link</button>
    </form>
</div>
@endsection --}}

@extends('website.layouts.app')
@section('title', 'Customer reset password link')
@section('page_id', 'reset-link-page')
@section('website_content')
    <div id="page" class="page font--jakarta">
        <!-- RESET PASSWORD PAGE
                         ====================================== -->
        <section id="reset-password" style="padding-top: 140px;"
            class="bg--fixed reset-password-section division !bg-[center_center] min-h-screen pt-[80px] pb--100 !pb-[100px] bg-[url(./images/reset-password.jpg)] bg-scroll sm:max-md:w-auto xsm:max-sm:w-auto w-full bg-no-repeat">
            <div class="container">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                    <div
                        class="md:w-7/12 lg:max-xl:w-5/12 xl:w-5/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                        <!-- LOGO -->
                        <div
                            class="login-page-logo !text-center mb-[45px] lg:max-xl:!mb-[40px] md:max-lg:!mb-[40px] xsm:max-sm:!mb-[40px]">
                            <img class="img-fluid light-theme-img w-auto max-w-[inherit] xl:!max-h-[45px] lg:max-xl:!max-h-[40px] md:max-lg:!max-h-[35px] xsm:max-sm:!max-h-[40px] inline-block"
                            src="{{ asset($website_settings->website_logo ?? 'frontend/images/logo-blue-white.png') }}" alt="logo-image">
                            <img class="img-fluid dark-theme-img w-auto max-w-[inherit] xl:!max-h-[45px] lg:max-xl:!max-h-[40px] md:max-lg:!max-h-[35px] xsm:max-sm:!max-h-[40px] inline-block"
                            src="{{ asset($website_settings->website_logo ?? 'frontend/images/logo-blue-white.png') }}" alt="logo-image">
                        </div>
                        <!-- RESET PASSWORD FORM -->
                        <div
                            class="reset-page-wrapper !text-center mx-[10px] my-0 lg:max-xl:m-0 md:max-lg:mx-[30px] md:max-lg:my-0 sm:max-md:mx-[45px] sm:max-md:my-0 xsm:max-sm:mx-[15px] xsm:max-sm:my-0">
                            <form name="resetpasswordform" action="{{ route('customer.password.email') }}" method="POST" class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] reset-password-form rounded-[10px] [border:1px_solid_#fafafa] shadow-[0px_15px_20px_0px_rgba(5,5,5,0.05)] pt-[50px] !pb-[25px] px-[30px] bg-white lg:max-xl:pt-[40px] lg:max-xl:!pb-[15px] lg:max-xl:px-[25px] md:max-lg:pt-[35px] md:max-lg:!pb-[10px] md:max-lg:px-[25px] xsm:max-sm:pt-[40px] xsm:max-sm:!pb-[15px] xsm:max-sm:px-[20px]">

                                @csrf

                                <!-- Title-->
                                <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                    <div
                                        class="reset-form-title mb--30 xl:!mb-[30px] lg:max-xl:!mb-[25px] md:max-lg:!mb-[20px] sm:max-md:!mb-[25px] xsm:max-sm:!mb-[20px]">
                                        <h5
                                            class="s-26 w--700 xl:!text-[1.625rem] lg:max-xl:!text-[1.5rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold !leading-none !mb-0 font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                            Forgot your password?</h5>
                                        <p
                                            class="p-sm color--grey xl:!text-[0.9rem] xl:!mt-[25px] !mb-0 lg:max-xl:!text-[0.95rem] lg:max-xl:!mt-[20px] md:max-lg:!text-[1rem] md:max-lg:!mt-[15px] sm:max-md:!text-[1.0625rem] sm:max-md:!mt-[20px] xsm:max-sm:!text-[1rem] xsm:max-sm:!mt-[20px]">
                                            Enter your email address, if an account exists we‘ll
                                            send you a link to reset your password.
                                        </p>
                                    </div>
                                </div>

                                <!-- Form Input -->
                                <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                    <input id="email"
                                        class="form-control block w-full  email placeholder:text-[#353f4f] xl:!h-[60px] border !text-[#353f4f] !text-[0.95rem] leading-none !font-normal xl:!mb-[25px] p-[5px_20px] rounded-[6px] border-solid border-transparent [transition:all_300ms_ease-in-out] focus:shadow-none bg-[#f5f6f8] focus:border-[#1680fb] focus:[outline:0px_none] lg:max-xl:!h-[54px] lg:max-xl:!mb-[20px] md:max-lg:!h-[50px] md:max-lg:!text-[1.0625rem] md:max-lg:!mb-[20px] md:max-lg:px-[15px] md:max-lg:py-[5px] sm:max-md:!h-[54px] sm:max-md:!text-[1.0625rem] xsm:max-sm:!h-[54px] xsm:max-sm:!text-[1.0625rem] !text-center"
                                        type="email" name="email" placeholder="example@example.com" required autofocus>

                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                </div>
                                <!-- Form Submit Button -->
                                <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                    <button type="submit"
                                        class="btn btn--theme hover--theme submit w-full !mb-[20px] lg:max-xl:!h-[54px] lg:max-xl:!mb-[20px] md:max-lg:!text-[1.0625rem] md:max-lg:!h-[50px] md:max-lg:!mb-[20px] sm:max-md:!h-[54px] sm:max-md:!text-[1.0625rem] xsm:max-sm:!h-[54px] xsm:max-sm:!text-[1.0625rem]">Reset
                                        My Password</button>
                                </div>
                                <!-- Form Data  -->
                                <div class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                    <div class="form-data !text-center">
                                        <span
                                            class="block xl:!text-[0.85rem] !mb-0 md:max-lg:!text-sm sm:max-md:!text-[1rem] xsm:max-sm:!text-[1rem]"><a
                                                href="login-1.html" class="text-[#353f4f] font-medium !underline">Never
                                                mind, I remembered!</a></span>
                                    </div>
                                </div>
                                <!-- Form Message -->
                                <div
                                    class="lg:w-full w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full  reset-form-msg">
                                    <span class="loading"></span>
                                </div>
                            </form>
                        </div>
                        <!-- END RESET PASSWORD FORM -->
                    </div>
                </div>
                <!-- End row -->
            </div>
            <!-- End container -->
        </section>
        <!-- END RESET PASSWORD PAGE -->
    </div>

@endsection
