
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ company_setting('site_rtl') == 'on'?'rtl':''}}">
<head>
    <title>@yield('page-title') | {{ !empty(company_setting('title_text')) ? company_setting('title_text') : (!empty(admin_setting('title_text')) ? admin_setting('title_text') :'WorkDo') }}</title>
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

    <!-- Meta -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"
    />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ company_setting('favicon') }}" type="image/x-icon" />
     @stack('head')
      <!-- for calender-->
      <link rel="stylesheet" href="{{ asset('assets/css/plugins/main.css') }}">

      <link rel="stylesheet" href="{{ asset('assets/css/plugins/datepicker-bs5.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/plugins/style.css') }}">
      <!-- font css -->
      <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap-switch-button.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
        @if (company_setting('site_rtl') == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
      @endif
      @if (company_setting('cust_darklayout') == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
      @else
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"id="main-style-link">
      @endif
      @stack('css')
</head>
<body class={{ !empty(company_setting('color'))?company_setting('color'):'theme-3' }}>
  <!-- [ Pre-loader ] start -->
  <!-- [ Mobile header ] End -->



<!-- [ Main Content ] start -->
<div class="container">
    <div class="dash-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
              <div class="page-block">
                  <div class="row align-items-center">
                      <div class="col-md-12 mt-5 mb-4">
                          <div class="d-block d-sm-flex align-items-center justify-content-between">
                              <div>

                              </div>
                              <div>
                                @yield('action-button')
                              </div>

                          </div>
                      </div>
                  </div>
              </div>
          </div>

        <!-- <div class="row"> -->
               @yield('content')

        <!-- </div> -->

    </div>
</div>

<script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.form.js') }}"></script>

<script src="{{ asset('js/letter.avatar.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datepicker-full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-switch-button.min.js') }}"></script>
<script src="{{ asset('assets/js/dash.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flatpickr.min.js') }}"></script>

<script src="{{ asset('js/custom.js') }}"></script>

<script src="{{ asset('js/chatify/autosize.js') }}"></script>
<script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

@if(admin_setting('enable_cookie') == 'on')
@include('layouts.cookie_consent')
@endif
@stack('scripts')

</body>

</html>
