<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>:: Link Hire :: Sign In</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/main.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/authentication.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/color_skins.css">
</head>

<body class="theme-orange">

    @php
        $bgStyle = 'background:#f5f5f5;'; // fallback default

        if (!empty($login_settings->login_page_bg)) {
            $bgStyle =
                "background-image: url('" .
                asset($login_settings->login_page_bg) .
                "'); background-size: cover; background-position: center; background-repeat: no-repeat;";
        } elseif (!empty($login_settings->login_page_bg_color)) {
            $bgStyle = 'background:' . $login_settings->login_page_bg_color . ';';
        }
    @endphp

    <div class="authentication" style="{{ $bgStyle }}">
        <div class="card">
            <div class="body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header slideDown">
                            <div class="logo">
                                @if (empty($website_settings->website_logo))
                                <img src="{{ asset('backend') }}/assets/images/logo.png" alt="Link Higher">
                                @else
                                    <img src="{{ asset($website_settings->website_logo ?? '') }}" alt="Link Higher"
                                        width="150px">
                                @endif
                            </div>

                        </div>
                    </div>
                    <form class="col-lg-12" id="sign_in" method="POST" action="{{ route('login') }}">
                        @csrf

                        <h5 class="title">Sign in to your Account</h5>

                        <!-- Email Address -->
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" :value="old('email')"
                                    required autofocus autocomplete="username">
                                <label class="form-label" for="email">Username</label>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>


                        <!-- Password -->
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" required
                                    autocomplete="current-password">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>


                        <div>
                            <input type="checkbox" name="remember" id="rememberme" class="filled-in chk-col-cyan">
                            <label for="rememberme">Remember Me</label>
                        </div>


                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-raised btn-primary waves-effect">SIGN IN</button>
                        </div>
                    </form>
                    <div class="col-lg-12 m-t-20">
                        @if (Route::has('password.request'))
                            <a class="" href="{{ route('password.request') }}">Forgot Password?</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('backend') }}/assets/bundles/libscripts.bundle.js"></script>
    <script src="{{ asset('backend') }}/assets/bundles/vendorscripts.bundle.js"></script>
    <script src="{{ asset('backend') }}/assets/bundles/mainscripts.bundle.js"></script>
</body>

</html>
