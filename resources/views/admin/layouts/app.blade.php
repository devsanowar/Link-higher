<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: {{ $website_settings->website_title ?? '' }} :: @yield('title')</title>

<!-- Favicon-->
@if (!empty($website_settings->website_favicon))
    <link rel="icon" href="{{ asset($website_settings->website_favicon) }}?v=1" type="image/png">
@endif


@include('admin.layouts.inc.style')

</head>

<body class="theme-orange">
<!-- Page Loader -->
@include('admin.layouts.inc.page-loader')


<!-- Top Bar -->
@include('admin.layouts.inc.topbar')

<!-- Left Sidebar -->
@include('admin.layouts.inc.left-sidebar')

<!-- Right Sidebar -->
@include('admin.layouts.inc.right-sidebar')


<!-- Main Content -->
<section class="content home">
@yield('admin_content')
</section>


@include('admin.layouts.inc.script')
</body>
</html>
