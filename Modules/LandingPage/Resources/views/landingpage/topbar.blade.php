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
                    {{--  Start for all settings tab --}}
                        {{Form::model(null, array('route' => array('landingpage.store'), 'method' => 'POST')) }}
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <h5 class="mb-2">{{ __('Top Bar') }}</h5>
                                        </div>
                                        <div class="col switch-width text-end">
                                            <div class="form-group mb-0">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary" class="" name="topbar_status"
                                                        id="topbar_status"  {{ $settings['topbar_status'] == 'on' ? 'checked="checked"' : '' }}>
                                                    <label class="custom-control-label" for="topbar_status"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            {{ Form::label('content', __('Message'), ['class' => 'col-form-label text-dark']) }}
                                            {{ Form::textarea('topbar_notification_msg',$settings['topbar_notification_msg'], ['class' => 'ckdescription form-control', 'required' => 'required', 'id'=>'']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="{{ __('Save Changes') }}">
                                </div>
                            </div>
                        {{ Form::close() }}
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
      