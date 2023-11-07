@php
    $temp_lang = \App::getLocale('lang');
    if($temp_lang == 'ar' || $temp_lang == 'he'){
        $rtl = 'on';
    }
    else {
        $rtl = company_setting('site_rtl',$company_id,$workspace_id);
    }
@endphp

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{  $rtl == 'on'?'rtl':''}}">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
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

<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

 <!-- Favicon icon -->
 <link rel="icon" href="{{ get_file(favicon())}}{{'?'.time()}}" type="image/x-icon" />

 <!-- font css -->
 <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
 <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
 <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
 <link rel="stylesheet" href="{{ asset('assets/fonts/material.css')}}">

 <!-- vendor css -->
 <link rel="stylesheet" href="{{ asset('assets/css/plugins/style.css') }}">

 <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap-switch-button.min.css') }}" id="main-style-link">
 <link rel="stylesheet" href="{{ asset('assets/css/plugins/datepicker-bs5.min.css') }}" >
 <link rel="stylesheet" href="{{ asset('assets/css/plugins/flatpickr.min.css') }}" >
 <link rel="stylesheet" href="{{ asset('assets/css/customizer.css') }}">
 <link rel="stylesheet" href="{{ asset('css/custome.css') }}">
 @stack('css')

 @if ( $rtl == 'on')
 <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
@endif

@if(company_setting('cust_darklayout',$company_id,$workspace_id) == 'on')
 <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}" id="main-style-link">
@endif

@if ( $rtl != 'on' && company_setting('cust_darklayout',$company_id,$workspace_id) != 'on')
 <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
@endif

 <script src="{{ asset('js/jquery.min.js') }}"></script>
 <link rel="stylesheet" href="{{ asset('Modules/Account/Resources/assets/css/nprogress.css') }}" >
<script src="{{ asset('Modules/Account/Resources/assets/js/nprogress.js') }}"></script>
</head>

<body class="{{ !empty(company_setting('color',$company_id,$workspace_id))?company_setting('color',$company_id,$workspace_id):'theme-1' }}">
    <div class="container">
        <div class="dash-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                  <div class="page-block">
                      <div class="row align-items-center">
                          <div class="col-md-12 mt-5 mb-4">
                              <div class="d-block d-sm-flex align-items-center justify-content-between">
                                  <div>
                                      <div class="page-header-title">
                                          <h4 class="m-b-10">@yield('page-title')</h4>
                                      </div>
                                      <ul class="breadcrumb">
                                              @yield('breadcrumb')
                                      </ul>
                                  </div>
                                  <div>
                                    @yield('action-btn')
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
    <div  id="commonModal" class="modal" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-modal="true" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="body">
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999">
        <div id="liveToast" class="toast text-white  fade" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"> </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
<script src="{{asset('assets/js/plugins/tinymce/tinymce.min.js')}}"></script>
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
