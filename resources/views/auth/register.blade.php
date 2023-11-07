@extends('layouts.auth')
@section('page-title')
    {{__('Register')}}
@endsection
@section('language-bar')
    <li class="dropdown dash-h-item drp-language nav-item">
        <a class="dash-head-link dropdown-toggle btn btn-primary text-white" data-bs-toggle="dropdown" href="#">
            <span class="drp-text hide-mob text-white">{{Str::upper($lang)}}</span>
        </a>
        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
            @foreach(languages() as $key => $language)
                <a href="{{ route('register',$key) }}" class="dropdown-item @if($lang == $key) text-primary  @endif">
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
            <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="card-body">
                    <div class="">
                        <h2 class="mb-3 f-w-600">{{ __('Register') }}</h2>
                    </div>
                    <div class="">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="error invalid-name text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('WorkSpace Name') }}</label>
                            <input id="store_name" type="text" class="form-control @error('store_name') is-invalid @enderror" name="store_name" value="{{ old('store_name') }}" required autocomplete="store_name">
                            @error('store_name')
                            <span class="error invalid-name text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <span class="error invalid-email text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="error invalid-password text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label class="form-label">{{__('Confirm password')}}</label>
                            <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                            @error('password_confirmation')
                                <span class="error invalid-password_confirmation text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                            <button class="btn btn-primary btn-block mt-2" type="submit">{{ __('Register') }}</button>
                        </div>

                    </div>
                    <p class="mb-2 my-4 text-center">{{ __('Already have an account?') }} <a href="{{route('login',$lang)}}" class="f-w-400 text-primary">{{ __('Login') }}</a></p>
                </div>
        </div>
        <div class="col-xl-6 img-card-side">
            <div class="auth-img-content">
                <img src="{{asset('assets/images/auth/img-auth-3.svg')}}" alt="" class="img-fluid">
                <h3 class="text-white mb-4 mt-5">{{ __('“Attention is the new currency”') }}</h3>
                <p class="text-white">{{ __('The more effortless the writing looks, the more effort the writer
                    actually put into the process.')}}</p>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
@if(module_is_active('GoogleCaptcha') && admin_setting('google_recaptcha_is_on') == 'on' )
        {!! NoCaptcha::renderJs() !!}
@endif
@endpush
