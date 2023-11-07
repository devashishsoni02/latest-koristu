@php
    $temp_lang = \App::getLocale('lang');
    if($temp_lang == 'ar' || $temp_lang == 'he'){
        $rtl = 'on';
    }
    else {
        $rtl = company_setting('site_rtl',$company_id,$workspace_id);
    }
@endphp

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $rtl == 'on'?'rtl':''}}">
<head>

    <title>@yield('page-title') | {{ !empty(company_setting('title_text',$company_id,$workspace_id)) ? company_setting('title_text',$company_id,$workspace_id) : (!empty(admin_setting('title_text')) ? admin_setting('title_text') :'WorkDo') }}</title>

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

    <link rel="icon" href="{{ get_file(!empty(company_setting('favicon',$company_id,$workspace_id)) ? company_setting('favicon',$company_id,$workspace_id) : (!empty(admin_setting('favicon')) ? admin_setting('favicon') : 'uploads/logo/favicon.png')) }}" type="image/x-icon" />
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

    @if ($rtl == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    @endif
    @if(company_setting('cust_darklayout',$company_id,$workspace_id) == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}" id="main-style-link">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    @endif
    <style>
        .navbar-brand .auth-navbar-brand
        {
            max-height: 38px !important;
        }
    </style>
</head>
<body class="{{ !empty(company_setting('color',$company_id,$workspace_id))?company_setting('color',$company_id,$workspace_id):'theme-1' }}">
    <div class="auth-wrapper auth-v3">
        <div class="bg-auth-side bg-primary"></div>
        <div class="auth-content">
            <nav class="navbar navbar-expand-md navbar-light default">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        @php
                            $logo = '';
                            if (company_setting('cust_darklayout',$company_id,$workspace_id) == 'on' )
                            {
                                if(check_file(company_setting('logo_light',$company_id,$workspace_id)))
                                {
                                    $logo =  get_file(company_setting('logo_light',$company_id,$workspace_id));
                                }
                                else
                                {
                                    $logo =  asset('uploads/logo/logo_light.png');
                                }
                            }
                            else
                            {
                                if(check_file(company_setting('logo_dark',$company_id,$workspace_id)))
                                {
                                    $logo =  get_file(company_setting('logo_dark',$company_id,$workspace_id));
                                }
                                else
                                {
                                    $logo =  asset('uploads/logo/logo_dark.png');
                                }
                            }
                        @endphp
                        <img src="{{ $logo }}{{'?'.time()}}" alt="{{ config('app.name', 'WorkDo') }}" class="navbar-brand-img auth-navbar-brand">
                    </a>
                    <div class="lang-dropdown-only-mobile ">
                        @yield('language-bar')
                    </div>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="flex-grow: 0;">
                        <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">{{ __('Support')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">{{ __('Terms')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">{{ __('Privacy')}}</a>
                            </li>
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
                    <p class="">@if (!empty(company_setting('footer_text',$company_id,$workspace_id))) {{company_setting('footer_text',$company_id,$workspace_id)}} @elseif (!empty(admin_setting('footer_text'))) {{ admin_setting('footer_text') }} @else{{__('Copyright')}} &copy; {{ config('app.name', 'WorkGo') }}@endif{{date('Y')}}</p>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
<script src="{{asset('assets/js/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="{{ asset('assets/js/dash.js') }}"></script>
<script src="{{asset('assets/js/plugins/simple-datatables.js')}}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-switch-button.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datepicker-full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
<script src="{{ asset('js/jquery.form.js') }}"></script>



<script src="{{ asset('js/custom.js') }}"></script>
@if($message = Session::get('success'))
    <script>
        toastrs('Success', '{!! $message !!}', 'success');
    </script>
@endif
@if($message = Session::get('error'))
    <script>
        toastrs('Error', '{!! $message !!}', 'error');
    </script>
@endif
@if(admin_setting('enable_cookie') == 'on')
@include('layouts.cookie_consent')
@endif
@stack('scripts')
</body>
</html>
