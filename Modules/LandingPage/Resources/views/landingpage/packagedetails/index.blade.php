@extends('layouts.main')

@section('page-title')
    {{ __('Landing Page') }}
@endsection

@section('page-breadcrumb')
    {{__('Landing Page')}}
@endsection

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
                    <div class="card">
                        {{ Form::open(array('route' => 'packagedetails_store', 'method'=>'post', 'enctype' => "multipart/form-data")) }}
                            @csrf
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5>{{ __('PackageDetails Section Details') }}</h5>
                                    </div>
                                    <div id="p1" class="col-auto text-end text-primary h3">
                                        <a image-url="{{ get_file('Modules/LandingPage/Resources/assets/infoimages/packagedetailssection.png') }}"
                                           data-url="{{ route('info.image.view',['landingpage','package']) }}" class="view-images pt-2">
                                            <i class="ti ti-info-circle pointer"></i>
                                        </a>
                                    </div>
                                    <div class="col-auto switch-width text-end">
                                        <div class="form-group mb-0">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary" class="" name="packagedetails_section_status"
                                                    id="packagedetails_section_status"  {{ $settings['packagedetails_section_status'] == 'on' ? 'checked="checked"' : '' }}>
                                                <label class="custom-control-label" for="packagedetails_section_status"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('packagedetails heading', __('Heading'), ['class' => 'form-label']) }}
                                            {{ Form::text('packagedetails_heading', $settings['packagedetails_heading'], ['class' => 'form-control', 'placeholder' => __('Enter Heading')]) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('packagedetails Description', __('Short Description'), ['class' => 'form-label']) }}
                                            {{ Form::text('packagedetails_short_description', $settings['packagedetails_short_description'], ['class' => 'form-control', 'placeholder' => __('Enter Description')]) }}
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        {{ Form::label('packagedetails Description', __('Long Description'), ['class' => 'col-form-label text-dark']) }}
                                        {{ Form::textarea('packagedetails_long_description',$settings['packagedetails_long_description'], ['class' => 'ckdescription form-control', 'required' => 'required', 'id'=>'']) }}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('Package ', __('Package Link'), ['class' => 'form-label']) }}
                                            {{ Form::text('packagedetails_link',$settings['packagedetails_link'], ['class' => 'form-control ', 'placeholder' => __('Enter Details Link'),'required'=>'required']) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('Live Link Button Text', __('Live Demo Button Text'), ['class' => 'form-label']) }}
                                            {{ Form::text('packagedetails_button_text',$settings['packagedetails_button_text'], ['class' => 'form-control', 'placeholder' => __('Enter Button Text')]) }}
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

@push('scripts')
    <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
    <script src="{{ asset('Modules/LandingPage/Resources/assets/js/editorplaceholder.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.each($('.ckdescription'), function(i, editor) {
                CKEDITOR.replace(editor, {
                    // contentsLangDirection: 'rtl',
                    extraPlugins: 'editorplaceholder',
                    editorplaceholder: editor.placeholder
                });
            });
        });
    </script>
@endpush

