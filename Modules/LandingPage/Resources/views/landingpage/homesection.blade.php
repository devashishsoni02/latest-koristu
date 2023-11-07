@extends('layouts.main')
@section('page-title')
    {{ __('Landing Page') }}
@endsection

@section('page-breadcrumb')
    {{__('Landing Page')}}
@endsection

@push('scrips')
    <script>
        document.getElementById('home_banner').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        };
    document.getElementById('home_logo').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('image1').src = src
    };
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            @include('landingpage::layouts.tab')
                        </div>
                    </div>
                </div>

                <div class="col-xl-9">
                    {{--  Start for all settings tab --}}
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <h5>{{ __('Home Section') }}</h5>
                                    </div>
                                    <div id="p1" class="col-auto text-end text-primary h3">
                                        <a image-url="{{ get_file('Modules/LandingPage/Resources/assets/infoimages/home.png') }}"
                                           data-url="{{ route('info.image.view',['landingpage','home']) }}" class="view-images">
                                            <i class="ti ti-info-circle pointer"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{ Form::open(array('route' => 'homesection.store', 'method'=>'post', 'enctype' => "multipart/form-data")) }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('Offer Text', __('Offer Text'), ['class' => 'form-label']) }}
                                                {{ Form::text('home_offer_text', $settings['home_offer_text'], ['class' => 'form-control', 'placeholder' => __('70% Special Offer')]) }}
                                                @error('home_offer_text')
                                                    <span class="invalid-home_offer_text" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('Title', __('Title'), ['class' => 'form-label']) }}
                                                {{ Form::text('home_title',$settings['home_title'], ['class' => 'form-control ', 'placeholder' => __('Enter Title')]) }}
                                                @error('home_title')
                                                <span class="invalid-home_title" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('Heading', __('Heading'), ['class' => 'form-label']) }}
                                                {{ Form::text('home_heading',$settings['home_heading'], ['class' => 'form-control ', 'placeholder' => __('Enter Heading')]) }}
                                                @error('home_heading')
                                                <span class="invalid-home_heading" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('Trusted by', __('Trusted by'), ['class' => 'form-label']) }}
                                                {{ Form::text('home_trusted_by', $settings['home_trusted_by'], ['class' => 'form-control', 'placeholder' => __('1,000+ customers')]) }}
                                                @error('mail_port')
                                                <span class="invalid-mail_port" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ Form::label('Description', __('Description'), ['class' => 'form-label']) }}
                                                {{ Form::text('home_description', $settings['home_description'], ['class' => 'form-control', 'placeholder' => __('Enter Description')]) }}
                                                @error('mail_port')
                                                <span class="invalid-mail_port" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-8">
                                            <div class="form-group">
                                                {{ Form::label('Live Demo Link', __('Live Demo Link'), ['class' => 'form-label']) }}
                                                {{ Form::text('home_live_demo_link', $settings['home_live_demo_link'], ['class' => 'form-control', 'placeholder' => __('Enter Link')]) }}
                                                @error('home_live_demo_link')
                                                <span class="invalid-mail_port" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('Live Link Button Text', __('Live Demo Button Text'), ['class' => 'form-label']) }}
                                                {{ Form::text('home_link_button_text',$settings['home_link_button_text'], ['class' => 'form-control', 'placeholder' => __('Enter Button Text')]) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('Banner', __('Banner'), ['class' => 'form-label']) }}
                                                <div class="logo-content mt-4">
                                                    <img id="image" src="{{ check_file($settings['home_banner']) ? get_file($settings['home_banner']) : get_file('market_assets/images/images1.png') }}"
                                                        class="big-logo" width="100%">
                                                </div>
                                                <div class="choose-files mt-5">
                                                    <label for="home_banner">
                                                        <div class=" bg-primary " style="cursor: pointer;">
                                                            <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="home_banner" id="home_banner" class="form-control choose_file_custom" data-filename="home_banner">
                                                    </label>
                                                </div>
                                                @error('home_banner')
                                                    <div class="row">
                                                    <span class="invalid-logo" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('Logo', __('Logo'), ['class' => 'form-label']) }}
                                                <div class="logo-content mt-4">
                                                    <img id="image1" src="{{ check_file($settings['home_logo']) ? get_file($settings['home_logo']) : get_file('uploads/logo/logo_dark.png') }}"
                                                        class="small-logo img_setting">
                                                </div>
                                                <div class="choose-files mt-5">
                                                    <label for="home_logo">
                                                        <div class=" bg-primary" style="cursor: pointer;"> <i class="ti ti-upload px-1">
                                                            </i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file" name="home_logo" id="home_logo" class="form-control" data-filename="home_logo">
                                                    </label>
                                                </div>
                                                @error('home_logo')
                                                <div class="row">
                                                    <span class="invalid-logo" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="{{ __('Save Changes') }}">
                                </div>
                            {{ Form::close() }}
                        </div>
                    {{--  End for all settings tab --}}
                </div>
            </div>
        </div>
    </div>
@endsection




