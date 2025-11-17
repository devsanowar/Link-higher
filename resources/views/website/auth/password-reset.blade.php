@extends('website.layouts.app')
@section('title', 'Password reset')
@section('page_id', 'password-reset')

@section('website_content')

    <style>
        /* Page center wrapper */
        .reset-center-wrapper {
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* container width fixing */
        .reset-box {
            max-width: 650px;
            width: 100%;
            margin: 0 auto;
        }

        .register-page-form {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            border-radius: 12px;
            background: #fff;
            padding: 45px 30px;
        }
    </style>

    <div class="reset-center-wrapper">
        <div class="reset-box" style="padding-top: 140px; padding-bottom:80px">

            <div
                class="xl:w-12/12 lg:max-xl:w-12/12 md:max-lg:w-12/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">

                <div
                    class="register-page-form">

                    <div
                        class="login-page-logo !text-center mb-[45px] lg:max-xl:!mb-[40px] md:max-lg:!mb-[40px] xsm:max-sm:!mb-[40px]">
                        <img class="img-fluid light-theme-img w-auto max-w-[inherit] xl:!max-h-[45px] lg:max-xl:!max-h-[40px] md:max-lg:!max-h-[35px] xsm:max-sm:!max-h-[40px] inline-block"
                            src="{{ asset($website_settings->website_logo ?? 'frontend/images/logo-blue-white.png') }}" alt="logo-image">
                        <img class="img-fluid dark-theme-img w-auto max-w-[inherit] xl:!max-h-[45px] lg:max-xl:!max-h-[40px] md:max-lg:!max-h-[35px] xsm:max-sm:!max-h-[40px] inline-block"
                            src="{{ asset($website_settings->website_logo ?? 'frontend/images/logo-blue-white.png') }}" alt="logo-image">
                    </div>

                    <form method="POST" action="{{ route('customer.password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <input id="email"
                            class="form-control block w-full  email placeholder:text-[#353f4f] xl:!h-[60px] border !text-[#353f4f] !text-[0.95rem] leading-none !font-normal xl:!mb-[25px] p-[5px_20px] rounded-[6px] border-solid border-transparent [transition:all_300ms_ease-in-out] focus:shadow-none bg-[#f5f6f8] focus:border-[#1680fb] focus:[outline:0px_none] lg:max-xl:!h-[54px] lg:max-xl:!mb-[20px] md:max-lg:!h-[50px] md:max-lg:!text-[1.0625rem] md:max-lg:!mb-[20px] md:max-lg:px-[15px] md:max-lg:py-[5px] sm:max-md:!h-[54px] sm:max-md:!text-[1.0625rem] xsm:max-sm:!h-[54px] xsm:max-sm:!text-[1.0625rem] !text-left"
                            type="email" name="email" placeholder="example@example.com" required
                            value="{{ $email ?? old('email') }}">

                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                        <div class="form-group">
                            <div class="flex[1_0_0%] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                <p
                                    class="p-sm input-header relative text-[#353f4f] xl:!text-[0.85rem] leading-none font-medium xl:!mb-[12px] pl-[5px]">
                                    New Password</p>
                                <div class="wrap-input relative">
                                    <span
                                        class="btn-show-pass ico-20 !text-[#999999] items-center !absolute h-full cursor-pointer [transition:all_0.4s] right-[20px] top-[20px] hover:!text-[#0195ff]">
                                        <span class="flaticon-visibility eye-pass"></span>
                                    </span>
                                    <input id="password"
                                        class="form-control block w-full password placeholder:text-[#999] xl:!h-[60px] bg-[#f5f6f8] border !text-[#353f4f] xl:!text-[0.95rem] leading-none !font-normal xl:!mb-[10px] p-[5px_20px] rounded-[6px] border-solid border-transparent [transition:all_300ms_ease-in-out] focus:shadow-none focus:border-[#1680fb] focus:[outline:0px_none]"
                                        type="password" name="password" placeholder="min 8 characters"
                                        autocomplete="new-password" minlength="8" required>
                                </div>
                                @error('password')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="flex[1_0_0%] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                <p
                                    class="p-sm input-header relative text-[#353f4f] xl:!text-[0.85rem] leading-none font-medium xl:!mb-[12px] pl-[5px]">
                                    Confirm Password</p>
                                <div class="wrap-input relative">
                                    <span
                                        class="btn-show-pass ico-20 !text-[#999999] items-center !absolute h-full cursor-pointer [transition:all_0.4s] right-[20px] top-[20px] hover:!text-[#0195ff]">
                                        <span class="flaticon-visibility eye-pass"></span>
                                    </span>
                                    <input id="password"
                                        class="form-control block w-full password placeholder:text-[#999] xl:!h-[60px] bg-[#f5f6f8] border !text-[#353f4f] xl:!text-[0.95rem] leading-none !font-normal xl:!mb-[10px] p-[5px_20px] rounded-[6px] border-solid border-transparent [transition:all_300ms_ease-in-out] focus:shadow-none focus:border-[#1680fb] focus:[outline:0px_none]"
                                        type="password" name="password_confirmation" placeholder="min 8 characters"
                                        autocomplete="new-password" minlength="8" required>
                                </div>
                            </div>
                        </div>

                        <div class="flex[1_0_0%] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <button type="submit"
                                class="btn btn--theme hover--theme submit w-full xl:!h-[60px] mt-[20px] lg:max-xl:!h-[54px] md:max-lg:!h-[50px] md:max-lg:!text-[1.0625rem]">
                                Create New Password
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
