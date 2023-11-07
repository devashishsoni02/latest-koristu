@extends('layouts.main')
@section('page-title')
    {{ __('System Setup') }}
@endsection
@section('page-breadcrumb')
    {{ __('System Setup') }}
@endsection
@section('page-action')
@endsection
@section('content')
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            @stack('company_system_setup_sidebar')
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    @stack('company_system_setup_sidebar_div')
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
@push('scripts')
@endpush
