@extends('layouts.loginlayout')
@section('page-title')
    {{ __('Passwork Check') }}
@endsection
@section('language-bar')
    <li class="dropdown dash-h-item drp-language nav-item">
        <a class="dash-head-link dropdown-toggle btn btn-primary text-white" data-bs-toggle="dropdown" href="#">
            <span class="drp-text hide-mob text-white">{{Str::upper($lang)}}</span>
        </a>
        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
            @foreach(languages() as $key => $language)
                <a href="{{ route('project.shared.link',[$id,$key]) }}" class="dropdown-item @if($lang == $key) text-primary  @endif">
                    <span>{{Str::ucfirst($language)}}</span>
                </a>
            @endforeach
        </div>
    </li>
@endsection

@push('css')
@endpush
@section('action-btn')
@endsection
@section('content')
<div class="card">
    <div class="row align-items-center text-start">
        <div class="col-xl-6">
            <div class="card-body">
                <div class="">
                    <h2 class="h3">{{__('Password required')}}</h2>
                  <h6>{{ __('This document is password-protected. Please enter a password.') }}</h6>
                </div>
                <form method="POST" action="{{ route('project.password.check',[$id,$lang]) }}" class="needs-validation" novalidate="">
                    @csrf
                    <div>
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="{{ __('Password') }}" required>
                            @if($message = Session::get('error'))
                                <span class="error invalid-password text-danger" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @endif
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block mt-2" tabindex="4">{{ __('Save') }}</button>
                        </div>
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
