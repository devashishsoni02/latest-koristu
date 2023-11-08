@extends('layouts.auth')
@section('page-title')
    {{__('Login')}}
@endsection
@section('language-bar')
    <li class="dropdown dash-h-item drp-language nav-item">
        <a class="dash-head-link dropdown-toggle btn btn-primary text-white" data-bs-toggle="dropdown" href="#">
            <span class="drp-text hide-mob text-white">{{Str::upper($lang)}}</span>
        </a>
        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
            @foreach(languages() as $key => $language)
                <a href="{{ route('login',$key) }}" class="dropdown-item @if($lang == $key) text-primary  @endif">
                    <span>{{Str::ucfirst($language)}}</span>
                </a>
            @endforeach
        </div>
    </li>
@endsection
@section('content')
<div class="card">
    <div class="row align-items-center text-start">
        <div class="col-xl-6">
            <div class="card-body">
                <div class="">
                    <h2 class="mb-3 f-w-600">{{ __('Login Devashish Soni From Jaipur') }}</h2>
                </div>
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="" id="form_data">
                    @csrf
                    <div>
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autofocus>
                            @error('email')
                                <span class="error invalid-email text-danger" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required>
                            @error('password')
                            <span class="error invalid-password text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                            @enderror
                            @if (Route::has('password.request'))
                            <div class="mt-2">
                                <a href="{{ route('password.request') }}" class="small text-muted text-underline--dashed border-primar">{{ __('Forgot Your Password?') }}</a>
                            </div>
                            @endif
                        </div>
                        @if(module_is_active('GoogleCaptcha') && admin_setting('google_recaptcha_is_on') == 'on' )
                            <div class="form-group col-lg-12 col-md-12 mt-3">
                                {!! NoCaptcha::display() !!}
                                @error('g-recaptcha-response')
                                <span class="error small text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        @endif

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block mt-2 login_button" tabindex="4">{{ __('Login') }}</button>
                        </div>
                        @if (empty( admin_setting('signup')) ||  admin_setting('signup') == "on")
                            <p class="my-4 text-center">{{ __("Don't have an account?") }}
                                <a href="{{route('register')}}" class="my-4 text-primary">{{__('Register')}}</a>
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-6 img-card-side">
            <div class="auth-img-content">
                <img src="{{ asset('assets/images/auth/img-auth-3.svg') }}" alt="" class="img-fluid">
                <h3 class="text-white mb-4 mt-5"> {{ __('“Attention is the new currency”') }}</h3>
                <p class="text-white"> {{__('The more effortless the writing looks, the more effort the writer
                    actually put into the process.')}}</p>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
      $("#form_data").submit(function (e) {
          $(".login_button").attr("disabled", true);
          return true;
      });
    });
    </script>
    @if(module_is_active('GoogleCaptcha') && admin_setting('google_recaptcha_is_on') == 'on' )
        {!! NoCaptcha::renderJs() !!}
    @endif
@endpush
