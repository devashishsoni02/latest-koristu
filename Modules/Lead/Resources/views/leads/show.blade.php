@extends('layouts.main')

@section('page-title')
    {{$lead->name}}
@endsection
@push('css')
    <style>
        .nav-tabs .nav-link-tabs.active {
            background: none;
        }
    </style>
    <link rel="stylesheet" href="{{ Module::asset('Lead:Resources/assets/js/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{ Module::asset('Lead:Resources/assets/css/dropzone.min.css')}}">

@endpush

@push('scripts')
<script src="{{ Module::asset('Lead:Resources/assets/js/dropzone.min.js')}}"></script>
<script src="{{ Module::asset('Lead:Resources/assets/js/summernote-bs4.js')}}"></script>

    <script>
        @if(!Auth::user()->hasRole('client'))
            Dropzone.autoDiscover = false;


            myDropzone2 = new Dropzone("#dropzonewidget2", {
                maxFiles: 20,
                maxFilesize: 20,
                parallelUploads: 1,
                acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt",
                url: "{{route('leads.file.upload',$lead->id)}}",
                success: function (file, response) {
                    if (response.is_success) {
                        dropzoneBtn(file, response);
                    } else {
                        myDropzone2.removeFile(file);
                        toastrs('Error', response.error, 'error');
                    }
                },
                error: function (file, response) {
                    myDropzone2.removeFile(file);
                    if (response.error) {
                        toastrs('Error', response.error, 'error');
                    } else {
                        toastrs('Error', response, 'error');
                    }
                }
            });
            myDropzone2.on("sending", function (file, xhr, formData) {
                formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                formData.append("lead_id", {{$lead->id}});
            });

            function dropzoneBtn(file, response) {
                var download = document.createElement('a');
                download.setAttribute('href', response.download);
                download.setAttribute('class', "btn btn-sm btn-primary m-1");
                download.setAttribute('data-toggle', "tooltip");
                download.setAttribute('download', file.name);
                download.setAttribute('data-original-title', "{{__('Download')}}");
                download.innerHTML = "<i class='ti ti-download'></i>";

                var del = document.createElement('a');
                del.setAttribute('href', response.delete);
                del.setAttribute('class', "btn btn-sm btn-danger mx-1");
                del.setAttribute('data-toggle', "tooltip");
                del.setAttribute('data-original-title', "{{__('Delete')}}");
                del.innerHTML = "<i class='ti ti-trash'></i>";

                del.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (confirm("Are you sure ?")) {
                        var btn = $(this);
                        $.ajax({
                            url: btn.attr('href'),
                            data: {_token: $('meta[name="csrf-token"]').attr('content')},
                            type: 'DELETE',
                            success: function (response) {
                                if (response.is_success) {
                                    btn.closest('.dz-image-preview').remove();
                                } else {
                                    toastrs('Error', response.error, 'error');
                                }
                            },
                            error: function (response) {
                                response = response.responseJSON;
                                if (response.is_success) {
                                    toastrs('Error', response.error, 'error');
                                } else {
                                    toastrs('Error', response, 'error');
                                }
                            }
                        })
                    }
                });

                var html = document.createElement('div');
                html.appendChild(download);
                @if(!Auth::user()->hasRole('client'))
                @can('lead edit')
                html.appendChild(del);
                @endcan
                @endif

                file.previewTemplate.appendChild(html);
            }

            @foreach($lead->files as $file)

            // Create the mock file:
            var mockFile2 = {name: "{{$file->file_name}}", size: "{{ get_size(get_file($file->file_path)) }}" };
            // Call the default addedfile event handler
            myDropzone2.emit("addedfile", mockFile2);
            // And optionally show the thumbnail of the file:
            myDropzone2.emit("thumbnail", mockFile2, "{{ get_file($file->file_path) }}");
            myDropzone2.emit("complete", mockFile2);

            dropzoneBtn(mockFile2, {download: "{{ get_file($file->file_path) }}", delete: "{{route('leads.file.delete',[$lead->id,$file->id])}}"});

            @endforeach
        @endif

        @can('lead task edit')
        $(document).on("click", ".task-checkbox", function () {
            var chbox = $(this);
            var lbl = chbox.parent().parent().find('label');

            $.ajax({
                url: chbox.attr('data-url'),
                data: {_token: $('meta[name="csrf-token"]').attr('content'), status: chbox.val()},
                type: 'PUT',
                success: function (response) {
                    if (response.is_success) {
                        chbox.val(response.status);
                        if (response.status) {
                            lbl.addClass('strike');
                            lbl.find('.badge').removeClass('bg-warning').addClass('bg-success');
                        } else {
                            lbl.removeClass('strike');
                            lbl.find('.badge').removeClass('bg-success').addClass('bg-warning');
                        }
                        lbl.find('.badge').html(response.status_label);

                        toastrs('Success', response.success, 'success');
                    } else {
                        toastrs('Error', response.error, 'error');
                    }
                },
                error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        toastrs('Error', response.error, 'error');
                    } else {
                        toastrs('Error', response, 'error');
                    }
                }
            })
        });
        @endcan
    </script>


<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
    $(document).ready(function() {
      $('.summernote-simple').summernote({
        height: 165,
      });
    });
</script>
@if (Gate::check('lead edit'))
    <script>

        $( document ).ready(function() {
            $('.summernote-simple').on('summernote.blur', function () {
            $.ajax({
                url: "{{route('leads.note.store',$lead->id)}}",
                data: {_token: $('meta[name="csrf-token"]').attr('content'), notes: $(this).val()},
                type: 'POST',
                success: function (response) {
                    if (response.is_success) {
                    } else {
                        toastrs('Error', response.error, 'error');
                    }
                },
                error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        toastrs('Error', response.error, 'error');
                    } else {
                        toastrs('Error', response, 'error');
                    }
                }
            })
        });
        });
    </script>
@else
    <script>
        $('.summernote-simple').hide('disable');
    </script>
@endif
@endpush

@section('page-breadcrumb')
    {{__('Leads')}},
    {{$lead->name}}
@endsection


@section('page-action')
    <div>
        @can('lead edit')
            <a class="btn btn-sm btn-primary btn-icon " data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Labels')}}" data-ajax-popup="true" data-size="md" data-title="{{__('Label')}}" data-url="{{ URL::to('leads/'.$lead->id.'/labels') }}"><i class="ti ti-tag text-white"></i></a>
            <a class="btn btn-sm btn-primary btn-icon " data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Edit')}}" data-ajax-popup="true" data-size="lg" data-title="{{__('Edit Lead')}}" data-url="{{ URL::to('leads/'.$lead->id.'/edit') }}"><i class="ti ti-pencil text-white"></i></a>
        @endcan

       @can('lead to deal convert')
            @if(!empty($deal))
                    <a href="@can('deal show') @if($deal->is_active) {{route('deals.show',$deal->id)}} @else # @endif @else # @endcan" class="btn btn-sm btn-primary btn-icon " data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Already Converted To Deal')}}"><i class="ti ti-exchange text-white"></i></a>
            @else
                    <a class="btn btn-sm btn-primary btn-icon " data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Convert To Deal')}}" data-ajax-popup="true" data-size="md" data-title="{{__('Convert [').$lead->subject.('] To Deal')}}" data-url="{{ URL::to('leads/'.$lead->id.'/show_convert') }}"><i class="ti ti-exchange text-white"></i></a>
            @endif
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <div class="row">
                <div class="col-3">
                    <div class="card sticky-top" style="top:30px">
                        <div  class="list-group list-group-flush" id="useradd-sidenav">
                            <a class="list-group-item list-group-item-action border-0" href="#general">{{__('General')}}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        @if(!Auth::user()->hasRole('client'))
                            <a class="list-group-item list-group-item-action border-0"  href="#tasks">{{__('Tasks')}}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        @endif
                        @if(!Auth::user()->hasRole('client'))
                            <a class="list-group-item list-group-item-action border-0" href="#users-products">{{__('Users | Products')}}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        @endif
                        @if(!Auth::user()->hasRole('client'))
                            <a class="list-group-item list-group-item-action border-0" href="#sources-emails">{{__('Sources | Emails')}}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        @endif
                        <a class="list-group-item list-group-item-action border-0" href="#discussion-notes">{{__('Discussion | Notes')}}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        @if(!Auth::user()->hasRole('client'))
                        <a class="list-group-item list-group-item-action border-0" href="#files">{{__('Files')}}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        @endif
                        @if(!Auth::user()->hasRole('client'))
                            <a class="list-group-item list-group-item-action border-0" href="#calls">{{__('Calls')}}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        @endif
                        @if(!Auth::user()->hasRole('client'))
                            <a class="list-group-item list-group-item-action border-0" href="#activity">{{__('Activity')}}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        @endif
                        </div>
                    </div>
                </div>

                <div class="col-9">
                    <div id="general">
                        <?php
                        $tasks = $lead->tasks;
                        $products = $lead->products();
                        $sources = $lead->sources();
                        $calls = $lead->calls;
                        $emails = $lead->emails;
                        ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <div class="d-flex align-items-start">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-mail"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0">{{__('Email')}}</p>
                                                    <h5 class="mb-0 text-primary">{{$lead->email}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="d-flex align-items-start">
                                                <div class="theme-avtar bg-warning">
                                                    <i class="ti ti-phone"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0">{{__('Phone')}}</p>
                                                    <h5 class="mb-0 text-warning">{{$lead->phone}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="d-flex align-items-start">
                                                <div class="theme-avtar bg-info">
                                                    <i class="ti ti-test-pipe"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0">{{__('Pipeline')}}</p>
                                                    <h5 class="mb-0 text-info">{{$lead->pipeline->name}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 mt-4">
                                            <div class="d-flex align-items-start">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-server"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0">{{__('Stage')}}</p>
                                                    <h5 class="mb-0 text-primary">{{$lead->stage->name}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 mt-4">
                                            <div class="d-flex align-items-start">
                                                <div class="theme-avtar bg-warning">
                                                    <i class="ti ti-calendar"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0">{{__('Created')}}</p>
                                                    <h5 class="mb-0 text-warning">{{ company_date_formate ($lead->created_at)}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 mt-4">
                                            <div class="d-flex align-items-start">
                                                <div class="theme-avtar bg-info">
                                                    <i class="ti ti-chart-bar"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <h3 class="mb-0 text-info">{{$precentage}}%</h3>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info" style="width: {{$precentage}}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-12">
                                <div class="row">

                                    <div class="col-lg-3 col-6">
                                        <div class="card report_card">
                                            <div class="card-body">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <small class="text-muted">{{__('Tasks')}}</small>
                                                        <h3 class="mb-0">{{count($tasks)}}</h3>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="theme-avtar bg-danger">
                                                        <i class="ti ti-subtask text-white"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-6">
                                        <div class="card report_card">
                                            <div class="card-body">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <small class="text-muted">{{__('Product')}}</small>
                                                        <h3 class="mb-0">{{count($products)}}</h3>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="theme-avtar bg-info">
                                                        <i class="ti ti-shopping-cart text-white"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-6">
                                        <div class="card report_card">
                                            <div class="card-body">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <small class="text-muted">{{__('Source')}}</small>
                                                        <h3 class="mb-0">{{count($sources)}}</h3>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="theme-avtar bg-success">
                                                            <i class="ti ti-social text-white"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-6">
                                        <div class="card report_card">
                                            <div class="card-body">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <small class="text-muted">{{__('Files')}}</small>
                                                        <h3 class="mb-0">{{count($lead->files)}}</h3>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="theme-avtar bg-warning">
                                                            <i class="ti ti-file-invoice  text-white"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="tasks">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card table-card">
                                                    <div class="card-header">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h5>{{__('Tasks')}}</h5>
                                                            </div>
                                                            @can('lead task create')
                                                            <div class="float-end">
                                                                <a class="btn btn-sm btn-primary float-end " data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Add Task')}}" data-url="{{ route('leads.tasks.create',$lead->id) }}" data-ajax-popup="true" data-title="{{__('Add Task')}}">
                                                                    <i class="ti ti-plus text-white"></i>
                                                                </a>
                                                            </div>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                    <div class="card-body pt-0 table-border-style bg-none"  style ="height:300px;overflow: auto;">
                                                        <div class="">
                                                            <table class="table align-items-center mb-0" id="tasks">
                                                                <tbody class="list">
                                                                    @foreach($tasks as $task)
                                                                        <tr>
                                                                            <td>
                                                                                <div class="custom-control custom-switch form-check form-switch mb-2">
                                                                                    @can('lead task edit')
                                                                                        <input type="checkbox" class="form-check-input task-checkbox" role="switch" id="task_{{$task->id}}" @if($task->status) checked="checked" @endif type="checkbox" value="{{$task->status}}" data-url="{{route('leads.tasks.update.status',[$lead->id,$task->id])}}"/>

                                                                                    @endcan
                                                                                    <label for="task_{{$task->id}}" class="custom-control-label ml-4 @if($task->status) strike @endif">
                                                                                        <h6 class="media-title text-sm form-check-label">
                                                                                            {{$task->name}}
                                                                                            @if($task->status)
                                                                                                <div class="badge rounded p-2 px-3 bg-success mb-1">{{__(Modules\Lead\Entities\LeadTask::$status[$task->status])}}</div>
                                                                                            @else
                                                                                                <div class="badge rounded p-2 px-3 bg-warning mb-1">{{__(Modules\Lead\Entities\LeadTask::$status[$task->status])}}</div>
                                                                                            @endif
                                                                                        </h6>
                                                                                        <div class="text-xs text-muted">{{__(Modules\Lead\Entities\LeadTask::$priorities[$task->priority])}} -
                                                                                            <span class="text-primary">{{ company_datetime_formate($task->date.' '.$task->time)}}</span></div>
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td class="Action text-end">
                                                                                <span>
                                                                                    @can('lead task edit')
                                                                                        <div class="action-btn bg-info ms-2">
                                                                                            <a data-size="md" data-url="{{route('leads.tasks.edit',[$lead->id,$task->id])}}" data-ajax-popup="true" data-title="{{__('Edit Task')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Edit Task')}}" ><i class="ti ti-pencil text-white"></i></a>
                                                                                        </div>
                                                                                    @endcan
                                                                                    @can('lead task delete')
                                                                                        <div class="action-btn bg-danger ms-2">
                                                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['leads.tasks.destroy',$lead->id,$task->id],'id'=>'delete-form-'.$task->id]) !!}
                                                                                                <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Delete Task')}}">
                                                                                                <span class="text-white"> <i class="ti ti-trash"></i></span></a>
                                                                                            {!! Form::close() !!}
                                                                                        </div>
                                                                                    @endcan
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div id="users-products">
                        <div class="row">
                            @if(!Auth::user()->hasRole('client'))
                                <div class="col-md-6">
                                    <div class="card table-card deal-card">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5>{{__('Users')}}</h5>
                                                </div>
                                                @can('lead edit')
                                                <div class="float-end">
                                                    <a class="btn btn-sm btn-primary float-end " data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Add User')}}" data-url="{{ route('leads.users.edit',$lead->id) }}" data-ajax-popup="true" data-title="{{__('Add User')}}">
                                                        <i class="ti ti-plus text-white"></i>
                                                    </a>
                                                </div>
                                                @endcan
                                            </div>
                                        </div>
                                        <div class="card-body p-0 table-border-style bg-none height-300" style ="overflow: auto;">
                                            <div class="">
                                                <table class="table align-items-center mb-0">
                                                    <tbody class="list">
                                                    @foreach($lead->users as $user)
                                                        <tr>
                                                            <td>
                                                                <a @if($user->avatar) href="{{get_file($user->avatar)}}" @else href="{{get_file('uploads/users-avatar/avatar.png')}}" @endif target="_blnak">
                                                                    <img @if($user->avatar) src="{{get_file($user->avatar)}}" @else src="{{get_file('uploads/users-avatar/avatar.png')}}" @endif width="30" class="avatar-sm rounded-circle">
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <span class="number-id">{{$user->name}}</span>
                                                            </td>
                                                            @can('lead edit')
                                                                <td>
                                                                    @if($lead->created_by == \Auth::user()->id)
                                                                        <div class="action-btn bg-danger ">
                                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['leads.users.destroy',$lead->id,$user->id],'id'=>'delete-form-'.$lead->id]) !!}
                                                                                <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Delete User')}}">
                                                                                <span class="text-white"> <i class="ti ti-trash"></i></span></a>
                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                            @endcan
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endif
                            @if(!Auth::user()->hasRole('client'))
                                <div class="col-md-6">
                                    <div class="card table-card deal-card">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5>{{__('Products')}}</h5>
                                                </div>
                                                @can('lead edit')
                                                <div class="float-end">
                                                    <a class="btn btn-sm btn-primary float-end " data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Add Products')}}" data-url="{{ route('leads.products.edit',$lead->id) }}" data-ajax-popup="true" data-title="{{__('Add Products')}}">
                                                        <i class="ti ti-plus text-white"></i>
                                                    </a>
                                                </div>
                                                @endcan
                                            </div>
                                        </div>
                                        <div class="card-body p-0 table-border-style bg-none height-300" style ="overflow: auto;">
                                            <div class="">
                                                <table class="table align-items-center mb-0">
                                                    <tbody class="list">
                                                        @php($products = $lead->products())
                                                        @if($products)
                                                        @foreach($products as $product)
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                if(check_file($product->image) == false){
                                                                    $path = asset('Modules/ProductService/Resources/assets/image/img01.jpg');
                                                                }else{
                                                                    $path = get_file($product->image);
                                                                }
                                                                ?>
                                                                <a href="{{ $path }}"  target="_blank">
                                                                    <img width="50" src="{{ $path }}">
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <span class="number-id">{{$product->name}} </span> (<span class="text-muted">{{ currency_format_with_sym($product->price) }}</span>)
                                                            </td>
                                                            @can('lead edit')
                                                                <td>
                                                                    <div class="action-btn bg-danger ms-2">
                                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['leads.products.destroy',$lead->id,$product->id],'id'=>'delete-form-'.$lead->id]) !!}
                                                                            <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Delete Product')}}">
                                                                            <span class="text-white"> <i class="ti ti-trash"></i></span> </a>
                                                                        {!! Form::close() !!}
                                                                    </div>
                                                                </td>
                                                            @endcan
                                                        </tr>
                                                    @endforeach
                                                        @else
                                                            <tr>
                                                                <td class="text-center">{{__('No Product Found.!')}}</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if(!Auth::user()->hasRole('client'))
                        <div id="sources-emails">
                            <div class="row pt-2">
                                <div class="col-6">
                                    <div class="card table-card">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5>{{__('Sources')}}</h5>
                                                </div>
                                                @can('lead edit')
                                                <div class="float-end">
                                                    <a class="btn btn-sm btn-primary float-end " data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Edit Sources')}}" data-url="{{ route('leads.sources.edit',$lead->id) }}" data-ajax-popup="true" data-title="{{__('Edit Sources')}}">
                                                        <i class="ti ti-plus text-white"></i>
                                                    </a>
                                                </div>
                                                @endcan
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 table-border-style bg-none" style ="height:300px;overflow: auto;">
                                            <div class="">
                                                <table class="table align-items-center mb-0">
                                                    <tbody class="list">
                                                        @if($sources)
                                                            @foreach($sources as $source)
                                                                <tr>
                                                                    <td>
                                                                        <span class="text-dark">{{$source->name}}</span>
                                                                    </td>
                                                                    <td class="text-end">
                                                                        @can('lead edit')
                                                                            <div class="action-btn bg-danger ms-2">
                                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['leads.sources.destroy',$lead->id,$source->id],'id'=>'delete-form-'.$lead->id]) !!}
                                                                                    <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Delete Sources')}}">
                                                                                    <span class="text-white"> <i class="ti ti-trash"></i></span>
                                                                                    </a>
                                                                                {!! Form::close() !!}
                                                                            </div>
                                                                        @endcan
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="card table-card">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5>{{__('Email')}}</h5>
                                                </div>
                                                @can('lead email create')
                                                <div class="float-end">
                                                    <a class="btn btn-sm btn-primary float-end " data-size="md" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Add Email')}}" data-url="{{ route('leads.emails.create',$lead->id) }}" data-ajax-popup="true" data-title="{{__('Add Email')}}">
                                                        <i class="ti ti-plus text-white"></i>
                                                    </a>
                                                </div>
                                                @endcan
                                            </div>
                                        </div>
                                        <div class="card-body table-border-style bg-none" style ="height:300px;overflow: auto;">
                                            <ul class="list-unstyled list-unstyled-border">
                                                @foreach($emails as $email)
                                                    <li class="media mb-3">
                                                        <div style="margin-right: 10px;">
                                                            <a @if($user->avatar) href="{{get_file($user->avatar)}}" @else href="{{asset('custom/img/avatar/avatar-1.png')}}" @endif target="_blank">
                                                                <img @if($user->avatar) src="{{get_file($user->avatar)}}" @else src="{{asset('custom/img/avatar/avatar-1.png')}}" @endif width="30" class="avatar-sm rounded-circle">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="mt-0 mb-1 font-weight-bold text-sm">{{$email->subject}} <small class="float-right">{{$email->created_at->diffForHumans()}}</small></div>
                                                            <div class="text-xs"> {{$email->to}}</div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div id="discussion-notes">
                        <div class="row pt-2">
                            <div class="col-6">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5>{{__('Discussion')}}</h5>
                                            </div>
                                            <div class="float-end">
                                                <a class="btn btn-sm btn-primary float-end " data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Add Message')}}" data-url="{{ route('leads.discussions.create',$lead->id) }}" data-ajax-popup="true" data-title="{{__('Add Message')}}">
                                                    <i class="ti ti-plus text-white"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-border-style bg-none" style="height:330px;overflow: auto;">
                                        <ul class="list-unstyled list-unstyled-border">
                                        @foreach($lead->discussions as $discussion)
                                            <li class="media">
                                            <div style="margin-right: 10px;">

                                                <a @if($discussion->user->avatar) href="{{get_file($discussion->user->avatar)}}" @else href="{{get_file('uploads/users-avatar/avatar.png')}}" @endif target="_blnak">
                                                    <img @if($discussion->user->avatar) src="{{get_file($discussion->user->avatar)}}" @else src="{{get_file('uploads/users-avatar/avatar.png')}}" @endif width="50" class="avatar-sm rounded-circle">
                                                </a>
                                            </div>
                                                <div class="media-body">
                                                    <div class="mt-0 mb-1 font-weight-bold text-sm fw-bold">{{$discussion->user->name}} <small>{{$discussion->user->type}}</small> <small class="float-end">{{$discussion->created_at->diffForHumans()}}</small></div>
                                                    <div class="text-xs"> {{$discussion->comment}}</div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5>{{__('Notes')}}</h5>
                                            <div class="col-6 text-end">
                                                @if (module_is_active('AIAssistant'))
                                                    @include('aiassistant::ai.generate_ai_btn',['template_module' => 'lead_notes','module'=>'Lead'])
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" style="height:330px;">
                                        <textarea name="notes" class="summernote-simple" id="summernote-simple">{!! $lead->notes !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!Auth::user()->hasRole('client'))
                        <div id="files">
                            <div class="row pt-2">
                                <div class="col-12">
                                    <div class="card table-card">
                                        <div class="card-header">
                                            <h5>{{__('Files')}}</h5>
                                        </div>
                                        <div class="card-body">
                                                <div class="card-body bg-none">
                                                    <div class="col-md-12 dropzone browse-file" id="dropzonewidget2"></div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!Auth::user()->hasRole('client'))
                        <div id="calls">
                            <div class="row pt-2">
                                <div class="col-12">
                                    <div class="card table-card">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5>{{__('Calls')}}</h5>
                                                </div>
                                                @can('lead call create')
                                                <div class="float-end">
                                                    <a data-size="lg" class="btn btn-sm btn-primary float-end " data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Add Call')}}" data-url="{{ route('leads.calls.create',$lead->id) }}" data-ajax-popup="true" data-title="{{__('Add Call')}}">
                                                        <i class="ti ti-plus text-white"></i>
                                                    </a>
                                                </div>
                                                @endcan
                                            </div>
                                        </div>
                                        <div class=" card-body table-border-style">

                                            <div class="">
                                                <table class="table mb-0 pc-dt-simple" id="leadCall">
                                                    <thead>
                                                        <tr>
                                                            <th width="">{{__('Subject')}}</th>
                                                            <th>{{__('Call Type')}}</th>
                                                            <th>{{__('Duration')}}</th>
                                                            <th>{{__('User')}}</th>
                                                            <th class="text-end">{{__('Action')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($calls as $call)
                                                            <tr>
                                                                <td>{{ $call->subject }}</td>
                                                                <td>{{ ucfirst($call->call_type) }}</td>
                                                                <td>{{ $call->duration }}</td>
                                                                <td>{{ isset($call->getLeadCallUser) ? $call->getLeadCallUser->name : '-' }}</td>
                                                                <td class="text-end">
                                                                    @can('lead call edit')
                                                                        <div class="action-btn bg-info ms-2">
                                                                                <a data-size="lg" data-url="{{ URL::to('leads/'.$lead->id.'/call/'.$call->id.'/edit') }}" data-ajax-popup="true" data-title="{{__('Edit Call')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Edit Call')}}" >
                                                                                    <i class="ti ti-pencil text-white"></i>
                                                                                </a>
                                                                            </div>
                                                                    @endcan
                                                                    @can('lead call delete')
                                                                        <div class="action-btn bg-danger ms-2">
                                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['leads.calls.destroy',$lead->id ,$call->id],'id'=>'delete-form-'.$call->id]) !!}
                                                                                <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Delete Call')}}">
                                                                                    <span class="text-white">
                                                                                        <i class="ti ti-trash"></i>
                                                                                    </span>
                                                                                </a>
                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        @if(!Auth::user()->hasRole('client'))
                        <div id="activity">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>{{__('Activity')}}</h5>
                                    </div>
                                    <div class="card-body height-450 ">

                                        <div class="row" style="height:350px !important;overflow-y: scroll;">
                                            <ul class="event-cards list-group list-group-flush mt-3 w-100">
                                                @foreach($lead->activities as $activity)
                                                    <li class="list-group-item card mb-3">
                                                        <div class="row align-items-center justify-content-between">
                                                            <div class="col-auto mb-3 mb-sm-0">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="theme-avtar bg-primary">
                                                                        <i class="fas {{ $activity->logIcon() }}"></i>
                                                                    </div>
                                                                    <div class="ms-3">
                                                                        <h6 class="m-0">{!! $activity->getLeadRemark() !!}</h6>
                                                                        <small class="text-muted">{{$activity->created_at->diffForHumans()}}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">

                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
