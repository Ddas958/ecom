<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('/assets/css/frontend_css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/frontend_css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/frontend_css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/frontend_css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/frontend_css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('/assets/css/frontend_css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('/assets/css/frontend_css/responsive.css') }}" rel="stylesheet">       
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.png') }}">
</head>
<body>
    @include('layouts.frontLayout.front_header')
    @yield('content')
    @include('layouts.frontLayout.front_footer')
    <script src="{{ asset('/assets/js/frontend_js/jquery.js') }}"></script>
    <script src="{{ asset('/assets/js/frontend_js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/frontend_js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('/assets/js/frontend_js/price-range.js') }}"></script>
    <script src="{{ asset('/assets/js/frontend_js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('/assets/js/frontend_js/main.js') }}"></script>
</body>
</html>