@extends('layouts.main')
@section('page-title')
    {{ __('Project Report') }}
@endsection
@section('page-breadcrumb')
    {{ __('Project Report') }}
@endsection
@section('page-action')
    <div>
        <a href="#" class="btn btn-sm btn-primary filter" data-toggle="tooltip" title="{{ __('Filter') }}">
            <i class="ti ti-filter"></i>
        </a>
    </div>
@endsection
@php

    $client_keyword = Auth::user()->hasRole('client') ? 'client.' : '';
@endphp

@section('content')

    <div class="row  display-none" id="show_filter">

        @if (Auth::user()->hasRole('company') || Auth::user()->hasRole('client'))
            <div class="col-2">
                <select class="select2 form-select" name="all_users" id="all_users">
                    <option value="" class="px-4">{{ __('All Users') }}</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="col-3">
            <select class="select2 form-select" name="status" id="status">
                <option value="" class="px-4">{{ __('All Status') }}</option>

                <option value="Ongoing">{{ __('Ongoing') }}</option>
                <option value="Finished">{{ __('Finished') }}</option>
                <option value="OnHold">{{ __('OnHold') }}</option>

            </select>
        </div>


        <div class="form-group col-md-3">
            <div class="input-group date ">
                <input class="form-control" type="date" id="start_date" name="start_date" value=""
                    autocomplete="off" required="required" placeholder="{{ __('Start Date') }}">
            </div>
        </div>
        <div class="form-group col-md-3">
            <div class="input-group date ">
                <input class="form-control" type="date" id="end_date" name="end_date" value=""
                    autocomplete="off" required="required" placeholder="{{ __('End Date') }}">
            </div>
        </div>
        <div class="col-1">

            <button class=" btn btn-primary btn-filter apply">{{ __('Apply') }}</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 mt-4">
            <div class="card">
                <div class="card-body table-border-style mt-3 mx-2">
                    <div class="table-responsive">
                        <table class="table selection-datatable px-4 mt-2" id="selection-datatable1">
                            <thead>
                                <tr>
                                    <th> {{ __('#') }}</th>
                                    <th> {{ __('Project Name') }}</th>
                                    <th> {{ __('Start Date') }}</th>
                                    <th> {{ __('Due Date') }}</th>
                                    <th> {{ __('Project Member') }}</th>
                                    <th> {{ __('Progress') }}</th>
                                    <th>{{ __('Project Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



@endsection
@push('css')
    <link rel="stylesheet" href="{{ Module::asset('Taskly:Resources/assets/css/datatables.min.css') }}">


    <style>
        table.dataTable.no-footer {
            border-bottom: none !important;
        }

        .display-none {
            display: none !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ Module::asset('Taskly:Resources/assets/js/jquery.dataTables.min.js') }}"></script>

    <script>
        var dataTableLang = {
            paginate: {
                previous: "<i class='fas fa-angle-left'>",
                next: "<i class='fas fa-angle-right'>"
            },
            lengthMenu: "{{ __('Show') }} _MENU_ {{ __('entries') }}",
            zeroRecords: "{{ __('No data available in table.') }}",
            info: "{{ __('Showing') }} _START_ {{ __('to') }} _END_ {{ __('of') }} _TOTAL_ {{ __('entries') }}",
            infoEmpty: "{{ __('Showing 0 to 0 of 0 entries') }}",
            infoFiltered: "{{ __('(filtered from _MAX_ total entries)') }}",
            search: "{{ __('Search:') }}",
            thousands: ",",
            loadingRecords: "{{ __('Loading...') }}",
            processing: "{{ __('Processing...') }}"
        }
    </script>
      <script type="text/javascript">
        $(".filter").click(function() {
            $("#show_filter").toggleClass('display-none');
        });
    </script>
    <script>

        $(document).ready(function() {
            var table = $("#selection-datatable1").DataTable({
                order: [],
                select: {
                    style: "multi"
                },
                "language": dataTableLang,
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                }
            });
            $(document).on("click", ".btn-filter", function() {
                getData();
            });

            function getData() {
                table.clear().draw();
                $("#selection-datatable1 tbody tr").html(
                    '<td colspan="11" class="text-center"> Loading ...</td>');

                var data = {
                    status: $("#status").val(),
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                    all_users: $("#all_users").val(),
                };
                $.ajax({
                    url: '{{ route('projects.ajax') }}',
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        table.rows.add(data.data).draw(true);
                    },
                    error: function(data) {
                        toastrs('Info', data.error, 'error')
                    }
                })
            }

            getData();

        });
    </script>
@endpush
