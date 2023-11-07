@php
    $temp_lang = \App::getLocale('lang');
    if($temp_lang == 'ar' || $temp_lang == 'he'){
        $rtl = 'on';
    }
    else {
        $rtl = admin_setting('site_rtl');
    }
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{  $rtl == 'on'?'rtl':''}}">

<head>
    
    <title>@yield('page-title') | {{ !empty(admin_setting('title_text')) ? admin_setting('title_text') : config('app.name', 'WorkDo') }}</title>

    <meta name="title" content="{{ !empty(admin_setting('meta_title')) ? admin_setting('meta_title') : 'WOrkdo Dash' }}">
    <meta name="keywords" content="{{ !empty(admin_setting('meta_keywords')) ? admin_setting('meta_keywords') : 'WorkDo Dash,SaaS solution,Multi-workspace' }}">
    <meta name="description" content="{{ !empty(admin_setting('meta_description')) ? admin_setting('meta_description') : 'Discover the efficiency of Dash, a user-friendly web application by Rajodiya Apps.'}}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:title" content="{{ !empty(admin_setting('meta_title')) ? admin_setting('meta_title') : 'WOrkdo Dash' }}">
    <meta property="og:description" content="{{ !empty(admin_setting('meta_description')) ? admin_setting('meta_description') : 'Discover the efficiency of Dash, a user-friendly web application by Rajodiya Apps.'}} ">
    <meta property="og:image" content="{{ get_file( (!empty(admin_setting('meta_image'))) ? (check_file(admin_setting('meta_image'))) ?  admin_setting('meta_image') : 'uploads/meta/meta_image.png' : 'uploads/meta/meta_image.png'  ) }}{{'?'.time() }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:title" content="{{ !empty(admin_setting('meta_title')) ? admin_setting('meta_title') : 'WOrkdo Dash' }}">
    <meta property="twitter:description" content="{{ !empty(admin_setting('meta_description')) ? admin_setting('meta_description') : 'Discover the efficiency of Dash, a user-friendly web application by Rajodiya Apps.'}} ">
    <meta property="twitter:image" content="{{ get_file( (!empty(admin_setting('meta_image'))) ? (check_file(admin_setting('meta_image'))) ?  admin_setting('meta_image') : 'uploads/meta/meta_image.png' : 'uploads/meta/meta_image.png'  ) }}{{'?'.time() }}">

    <meta name="author" content="Workdo.io">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ (!empty(admin_setting('favicon')) && check_file(admin_setting('favicon'))) ? get_file(admin_setting('favicon')) : get_file('uploads/logo/favicon.png')}}{{'?'.time()}}" type="image/x-icon" />
     <!-- CSS Libraries -->
     <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">

      <!-- font css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/customizer.css') }}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('css/custome.css') }}">

    @if ( $rtl == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    @endif

    @if(admin_setting('cust_darklayout') == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}" id="main-style-link">
    @endif

    @if( $rtl != 'on' && admin_setting('cust_darklayout') != 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    @endif

    <style>
        .navbar-brand .auth-navbar-brand
        {
            max-height: 38px !important;
        }
    </style>
</head>
<body class="{{ !empty(admin_setting('color'))?admin_setting('color'):'theme-1' }}">
    <div class="auth-wrapper auth-v3">
        <div class="bg-auth-side bg-primary"></div>
        <div class="auth-content">
            <nav class="navbar navbar-expand-md navbar-light default">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ get_file(sidebar_logo()) }}{{'?'.time()}}" alt="{{ config('app.name', 'WorkDo') }}" class="navbar-brand-img auth-navbar-brand">
                    </a>
                    <div class="lang-dropdown-only-mobile ">
                        @yield('language-bar')
                    </div>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="flex-grow: 0;">
                        <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                            @if(module_is_active('LandingPage'))
                                @include('landingpage::layouts.buttons')
                            @endif
                            <div class="lang-dropdown-only-desk">
                                @yield('language-bar')
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>
            @yield('content')
            <div class="auth-footer">
                <div class="container-fluid">
                    <p class="">@if (!empty(admin_setting('footer_text'))) {{admin_setting('footer_text')}} @else{{__('Copyright')}} &copy; {{ config('app.name', 'WorkGo') }}@endif{{date('Y')}}</p>
                </div>
            </div>
        </div>
    </div>
    @if(admin_setting('enable_cookie') == 'on')
        @include('layouts.cookie_consent')
    @endif
@stack('custom-scripts')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
@stack('script')
@if(admin_setting('cust_darklayout') == 'on')
<script>
       document.addEventListener('DOMContentLoaded', (event) => {
       const recaptcha = document.querySelector('.g-recaptcha');
       recaptcha.setAttribute("data-theme", "dark");
       });
</script>
@endif
</body>
</html>
