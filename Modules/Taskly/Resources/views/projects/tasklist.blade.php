@extends('layouts.main')
@section('page-title')
    {{__('Task Board')}}
@endsection
@section('title')
    {{__('Task Board')}}
@endsection
@section('page-breadcrumb')
{{ __('Project') }},{{ __('Project Details') }},{{ __('Task Board') }}
@endsection
@section('page-action')
<div>
    <a href="{{ route('projects.task.board',[$project->id]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"title="{{ __('Grid View') }}">
        <i class="ti ti-layout-grid text-white"></i>
    </a>

    @can('task create')
        <a class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="lg" data-title="{{ __('Create New Task') }}" data-url="{{ route('tasks.create', [$project->id]) }}" data-toggle="tooltip" title="{{ __('Add Task') }}"><i class="ti ti-plus"></i></a>
    @endcan
    <a href="{{ route('projects.show', [$project->id]) }}"  class="btn-submit btn btn-sm btn-primary"
       data-toggle="tooltip" title="{{ __('Back') }}">
        <i class=" ti ti-arrow-back-up"></i>
    </a>
</div>
@endsection
@section('filter')
@endsection

@section('content')

<div class="row">
    <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Milestone')}}</th>
                                    <th>{{__('Priority')}}</th>
                                    <th>{{__('Stage')}}</th>
                                    <th>{{__('Assigned User')}}</th>
                                    @if(Gate::check('task show') || Gate::check('task edit') || Gate::check('task delete'))
                                        <th scope="col" class="text-end">{{__('Action')}}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stages as $stage)
                                @foreach ($stage->tasks as $task)
                                    <tr>
                                        <td>
                                            <a href="#" data-url="{{ route('tasks.show', [$task->project_id, $task->id]) }}"
                                                 class="" data-size="lg" data-ajax-popup="true" data-title="{{__('View')}}">{{ $task->title }}</a>
                                        </td>
                                        <td><span class="budget">{{ !empty($task->milestones->title)? $task->milestones->title:'-'}}</span>
                                        </td>
                                        <td>
                                            <span class="budget">{{$task->priority}}</span>
                                        </td>
                                        <td>
                                            <span class="budget">{{$stage->name}}</span>
                                        </td>
                                        <td>
                                            @if ($users = $task->users())
                                                @foreach ($users as $key => $user)
                                                    @if ($key < 3)
                                                            <img alt="image" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$user->name}}" @if($user->avatar) src="{{get_file($user->avatar)}}" @else src="{{ get_file('avatar.png')}}"  @endif class="rounded-circle " width="20px" height="20px">
                                                    @endif
                                                @endforeach
                                                @if (count($users) > 3)
                                                        <img alt="image" data-toggle="tooltip" data-original-title="{{ count($users) - 3 }} {{ __('more') }}" avatar="+ {{ count($users) - 3 }}">
                                                @endif
                                            @endif
                                        </td>
                                         @if(Gate::check('task show') || Gate::check('task edit') || Gate::check('task delete'))
                                            <td class="text-end">
                                                @can('task show')
                                                <div class="action-btn bg-warning ms-2">
                                                    <a data-size="lg" data-url="{{ route('tasks.show', [$task->project_id, $task->id]) }}" data-bs-toggle="tooltip" title="{{__('View')}}" data-ajax-popup="true" data-title="{{__('View')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                </div>
                                                @endcan
                                                @can('task edit')
                                                <div class="action-btn bg-info ms-2">
                                                    <a data-ajax-popup="true" data-size="lg" data-url="{{ route('tasks.edit', [$task->project_id, $task->id]) }}" class="btn btn-sm d-inline-flex align-items-center text-white " data-bs-toggle="tooltip" data-title="{{__('Task Edit')}}" title="{{__('Edit')}}"><i class="ti ti-pencil"></i></a>

                                                </div>
                                                @endcan
                                                @can('task delete')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['tasks.destroy', $task->project_id, $task->id]]) !!}
                                                    <a href="#!" class="btn btn-sm   align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                        <i class="ti ti-trash"></i>
                                                    </a>
                                                    {!! Form::close() !!}
                                                </div>
                                                @endcan
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection


@if ($project && $currentWorkspace)
@push('scripts')
<!-- third party js -->
<script src="{{ asset('js/letter.avatar.js') }}"></script>

<!-- third party js ends -->
<script>
   $(document).on('click', '#form-comment button', function(e) {
       var comment = $.trim($("#form-comment textarea[name='comment']").val());
       if (comment != '') {
           $.ajax({
               url: $("#form-comment").data('action'),
               data: {
                   comment: comment,
                   _token: "{{ csrf_token() }}"
               },
               type: 'POST',
               success: function(data) {
                   data = JSON.parse(data);

                   if (data.user_type == 'Client') {
                       var avatar = "avatar='" + data.client.name + "'";
                       var html = "<li class='media border-bottom mb-3'>" +
                           "                    <img class='mr-3 avatar-sm rounded-circle img-thumbnail hight_img' width='60' " +
                           avatar + " alt='" + data.client.name + "'>" +
                           "                    <div class='media-body mb-2'>" +
                           "                    <div class='float-left'>" +
                           "                        <h5 class='mt-0 mb-1 form-control-label'>" +
                           data.client.name + "</h5>" +
                           "                        " + data.comment +
                           "                    </div>" +
                           "                    </div>" +
                           "                </li>";
                   } else {
                       var avatar = (data.user.avatar) ?
                           "src='{{ asset('') }}" + data.user.avatar + "'" :
                           "avatar='" + data.user.name + "'";
                       var html = "<li class='media border-bottom mb-3'>" +
                           "                    <div class='col-1'>" +
                           "                        <img class='mr-3 avatar-sm rounded-circle img-thumbnail hight_img ' width='60' " +
                           avatar + " alt='" + data.user.name + "'>" +
                           "                    </div>"+
                           "                    <div class='col media-body mb-2'>" +
                           "                        <h5 class='mt-0 mb-1 form-control-label'>" +
                           data.user.name + "</h5>" +
                           "                        " + data.comment +
                           "                    </div>" +
                           "                    <div class='col text-end'>" +
                           "                           <a href='#' class='delete-icon action-btn btn-danger mt-1 btn btn-sm d-inline-flex align-items-center delete-comment' data-url='" +
                           data.deleteUrl + "'>" +
                           "                               <i class='ti ti-trash'></i>" +
                           "                           </a>" +
                           "                     </div>" +
                           "                </li>";
                   }

                   $("#task-comments").prepend(html);
                   LetterAvatar.transform();
                   $("#form-comment textarea[name='comment']").val('');
                   toastrs('{{ __('Success') }}', '{{ __('Comment Added Successfully!') }}',
                       'success');
               },
               error: function(data) {
                   toastrs('{{ __('Error') }}', '{{ __('Some Thing Is Wrong!') }}', 'error');
               }
           });
       } else {
           toastrs('{{ __('Error') }}', '{{ __('Please write comment!') }}', 'error');
       }
   });
   $(document).on("click", ".delete-comment", function() {
       if (confirm('{{ __('Are you sure ?') }}')) {
           var btn = $(this);
           $.ajax({
               url: $(this).attr('data-url'),
               type: 'DELETE',
               dataType: 'JSON',
               success: function(data) {
                   toastrs('{{ __('Success') }}', '{{ __('Comment Deleted Successfully!') }}',
                       'success');
                   btn.closest('.media').remove();
               },
               error: function(data) {
                   data = data.responseJSON;
                   if (data.message) {
                       toastrs('{{ __('Error') }}', data.message, 'error');
                   } else {
                       toastrs('{{ __('Error') }}', '{{ __('Some Thing Is Wrong!') }}',
                           'error');
                   }
               }
           });
       }
   });
   $(document).on('click', '#form-subtask button', function(e) {
       e.preventDefault();

       var name = $.trim($("#form-subtask input[name=name]").val());
       var due_date = $.trim($("#form-subtask input[name=due_date]").val());
       if (name == '' || due_date == '') {
           toastrs('{{ __('Error') }}', '{{ __('Please enter fields!') }}', 'error');
           return false;
       }

       $.ajax({
           url: $("#form-subtask").data('action'),
           type: 'POST',
           data: {
               name: name,
               due_date: due_date,
           },
           dataType: 'JSON',
           success: function(data) {
               toastrs('{{ __('Success') }}', '{{ __('Sub Task Added Successfully!') }}',
                   'success');

               var html = '<li class="list-group-item py-3">' +
                   '    <div class="form-check form-switch d-inline-block">' +
                   '        <input type="checkbox" class="form-check-input" name="option" id="option' +
                   data.id + '" value="' + data.id + '" data-url="' + data.updateUrl + '">' +
                   '        <label class="custom-control-label form-control-label" for="option' +
                   data.id + '">' + data.name + '</label>' +
                   '    </div>' +
                   '    <div class="float-end">' +
                   '        <a href="#" class=" action-btn btn-danger  btn btn-sm d-inline-flex align-items-center delete-comment delete-icon delete-subtask" data-url="' +
                   data.deleteUrl + '">' +
                   '            <i class="ti ti-trash"></i>' +
                   '        </a>' +
                   '    </div>' +
                   '</li>';

               $("#subtasks").prepend(html);
               $("#form-subtask input[name=name]").val('');
               $("#form-subtask input[name=due_date]").val('');
               $("#form-subtask").collapse('toggle');
           },
           error: function(data) {
               data = data.responseJSON;
               if (data.message) {
                   toastrs('{{ __('Error') }}', data.message, 'error');
                   $('#file-error').text(data.errors.file[0]).show();
               } else {
                   toastrs('{{ __('Error') }}', '{{ __('Some Thing Is Wrong!') }}', 'error');
               }
           }
       });
   });
   $(document).on("change", "#subtasks input[type=checkbox]", function() {
       $.ajax({
           url: $(this).attr('data-url'),
           type: 'POST',
           data: {
               _token: "{{ csrf_token() }}"
           },
           dataType: 'JSON',
           success: function(data) {
               toastrs('{{ __('Success') }}', '{{ __('Subtask Updated Successfully!') }}',
                   'success');
           },
           error: function(data) {
               data = data.responseJSON;
               if (data.message) {
                   toastrs('{{ __('Error') }}', data.message, 'error');
               } else {
                   toastrs('{{ __('Error') }}', '{{ __('Some Thing Is Wrong!') }}', 'error');
               }
           }
       });
   });
   $(document).on("click", ".delete-subtask", function() {
       if (confirm('{{ __('Are you sure ?') }}')) {
           var btn = $(this);
           $.ajax({
               url: $(this).attr('data-url'),
               type: 'DELETE',
               dataType: 'JSON',
               success: function(data) {
                   toastrs('{{ __('Success') }}', '{{ __('Subtask Deleted Successfully!') }}',
                       'success');
                   btn.closest('.list-group-item').remove();
               },
               error: function(data) {
                   data = data.responseJSON;
                   if (data.message) {
                       toastrs('{{ __('Error') }}', data.message, 'error');
                   } else {
                       toastrs('{{ __('Error') }}', '{{ __('Some Thing Is Wrong!') }}',
                           'error');
                   }
               }
           });
       }
   });
   // $("#form-file").submit(function(e){
   $(document).on('submit', '#form-file', function(e) {
       e.preventDefault();

       $.ajax({
           url: $("#form-file").data('url'),
           type: 'POST',
           data: new FormData(this),
           dataType: 'JSON',
           contentType: false,
           cache: false,
           processData: false,
           success: function(data) {
               toastrs('Success', '{{ __('File Upload Successfully!') }}', 'success');

               var delLink = '';

               if (data.deleteUrl.length > 0) {
                   delLink =
                       "<a href='#' class=' action-btn btn-danger  btn btn-sm d-inline-flex align-items-center delete-comment delete-icon delete-comment-file'  data-url='" +
                       data.deleteUrl + "'>" +
                       "                                        <i class='ti ti-trash'></i>" +
                       "                                    </a>";
               }

               var html = "<div class='card mb-1 shadow-none border'>" +
                   "                        <div class='card-body p-3'>" +
                   "                            <div class='row align-items-center'>" +
                   "                                <div class='col-auto'>" +
                   "                                    <div class='avatar-sm'>" +
                   "                                        <span class='avatar-title rounded text-uppercase'>" +
                    "  <img src='{{asset('uploads/tasks/')}}/"+
                   data.file +
                   "' width='60px' height='60px' >"+
                   "                                        </span>" +
                   "                                    </div>" +
                   "                                </div>" +
                   "                                <div class='col pl-0'>" +
                   "                                    <a href='#' class='text-muted form-control-label'>" +
                   data.name + "</a>" +
                   "                                    <p class='mb-0'>" + data.file_size +
                   "</p>" +
                   "                                </div>" +
                   "                                <div class='col-auto'>" +
                   "                                    <a download href='{{ asset('/uploads/tasks/') }}/" +
                   data.file +
                   "' class='edit-icon action-btn btn-primary  btn btn-sm d-inline-flex align-items-center mx-1'>" +
                   "                                        <i class='ti ti-download'></i>" +
                   "                                    </a>" +
                   delLink +
                   "                                </div>" +
                   "                            </div>" +
                   "                        </div>" +
                   "                    </div>";
               $("#comments-file").prepend(html);
           },
           error: function(data) {
               data = data.responseJSON;
               if (data.message) {
                   toastrs('{{ __('Error') }}', data.message, 'error');
                   $('#file-error').text(data.errors.file[0]).show();
               } else {
                   toastrs('{{ __('Error') }}', '{{ __('Some Thing Is Wrong!') }}', 'error');
               }
           }
       });
   });
   $(document).on("click", ".delete-comment-file", function() {
       if (confirm('{{ __('Are you sure ?') }}')) {
           var btn = $(this);
           $.ajax({
               url: $(this).attr('data-url'),
               type: 'DELETE',
               data: {
                   _token: "{{ csrf_token() }}"
               },
               dataType: 'JSON',
               success: function(data) {
                   toastrs('{{ __('Success') }}', '{{ __('File Deleted Successfully!') }}',
                       'success');
                   btn.closest('.border').remove();
               },
               error: function(data) {
                   data = data.responseJSON;
                   if (data.message) {
                       toastrs('{{ __('Error') }}', data.message, 'error');
                   } else {
                       toastrs('{{ __('Error') }}', '{{ __('Some Thing Is Wrong!') }}',
                           'error');
                   }
               }
           });
       }
   });
</script>
@endpush
@endif
