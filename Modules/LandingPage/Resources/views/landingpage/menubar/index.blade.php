@extends('layouts.main')
@section('page-title')
    {{ __('Landing Page') }}
@endsection

@section('page-breadcrumb')
    {{__('Landing Page')}}
@endsection

@push('scripts')
    <script>
        document.getElementById('site_logo').onchange = function () {
                var src = URL.createObjectURL(this.files[0])
                document.getElementById('image').src = src
            }
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
                                    <h5>{{ __('Header Logo') }}</h5>
                                </div>
                            </div>
                        </div>
                        {{ Form::open(array('route' => 'custom_store', 'method'=>'post', 'enctype' => "multipart/form-data")) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('Site Logo', __('Site Logo'), ['class' => 'form-label']) }}
                                            <div class="logo-content mt-4">
                                                <img id="image" class="small-logo" src="{{check_file($settings['site_logo']) ? get_file($settings['site_logo']) : get_file('uploads/logo/logo_dark.png')}}" class="w-100 logo"  style="filter: drop-shadow(2px 3px 7px #011C4B);">
                                            </div>
                                            <div class="choose-files mt-5">
                                                <label for="site_logo">
                                                    <div class=" bg-primary" style="cursor: pointer;transform: translateY(+110%);">
                                                        <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                    </div>
                                                    <input type="file" name="site_logo" id="site_logo" class="form-control choose_file_custom" data-filename="site_logo">
                                                </label>
                                            </div>
                                            @error('site_logo')
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

                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5>{{ __('Menu Bar') }}</h5>
                                    </div>
                                    <div class="col-auto justify-content-end d-flex">
                                        <a data-size="lg" data-url="{{ route('custom_page.create') }}" data-ajax-popup="true"  data-bs-toggle="tooltip" title="{{__('Create')}}" data-title="{{__('Create New Menu')}}"  class="btn btn-sm btn-primary">
                                            <i class="ti ti-plus text-light"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>{{__('No')}}</th>
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (is_array($pages) || is_object($pages))
                                            @php
                                            $no = 1
                                            @endphp
                                                @foreach ($pages as $key => $value)

                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $value['menubar_page_name'] }}</td>
                                                        <td>
                                                            <span>
                                                                <div class="action-btn bg-info ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="{{ route('custom_page.edit',$key) }}" data-ajax-popup="true" data-title="{{__('Edit Page')}}" data-size="lg" data-bs-toggle="tooltip"  title="{{__('Edit')}}" data-original-title="{{__('Edit')}}">
                                                                        <i class="ti ti-pencil text-white"></i>
                                                                    </a>
                                                                </div>
                                                                @if($value['page_slug'] != 'terms_and_conditions' && $value['page_slug'] != 'about_us' && $value['page_slug'] != 'privacy_policy')
                                                                    <div class="action-btn bg-danger ms-2">
                                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['custom_page.destroy', $key],'id'=>'delete-form-'.$key]) !!}

                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm-yes="{{'delete-form-'.$key}}">
                                                                        <i class="ti ti-trash text-white"></i>
                                                                    </a>
                                                                        {!! Form::close() !!}
                                                                    </div>
                                                                @endif
                                                            </span>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>

                    {{--  End for all settings tab --}}
                </div>
            </div>
        </div>
    </div>
@endsection
