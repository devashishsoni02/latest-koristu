@extends('layouts.auth')
@section('page-title')
    {{__('Verify Email')}}
@endsection
@section('language-bar')
    <li class="dropdown dash-h-item drp-language nav-item">
        <a class="dash-head-link dropdown-toggle btn btn-primary text-white" data-bs-toggle="dropdown" href="#">
            <span class="drp-text hide-mob text-white">{{Str::upper($lang)}}</span>
        </a>
        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
            @foreach(languages() as $key => $language)
                <a href="{{ route('verification.notice',$key) }}" class="dropdown-item @if($lang == $key) text-primary  @endif">
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
                    <h2 class="mb-3 f-w-600">{{ __('Verify Email') }}</h2>
                    <h6>{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</h6>
                </div>
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-success">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @elseif(session('status') == 'verification-link-not-sent')
                    <div class="mb-4 font-medium text-sm text-danger">
                        {{ __("Oops! We encountered an issue while attempting to send the email. It seems there's a problem with the mail server's SMTP (Simple Mail Transfer Protocol). Please review the SMTP settings and configuration to resolve the problem.") }}
                    </div>
                @endif
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block mt-2" tabindex="4">{{ __('Resend Verification Email') }}</button>
                        </div>
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-danger btn-block mt-2">
                            {{ __('LogOut') }}
                        </button>
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
@push('custom-scripts')

@endpush

