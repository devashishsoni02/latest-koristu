@extends('layouts.main')
@push('scripts')
   
@endpush
@section('page-title')
    {{__('Manage Team_tasks')}}
@endsection
@section('page-breadcrumb')
        {{__('Team_task')}}
@endsection
@section('page-action')


    <div>
   
    
    <a href="#" data-size="md" data-url="{{ route('team_tasks.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create')}}" data-title="{{__('Create New Team_task')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
    </a>
       
    </div>
    
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
            <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="team_task">
                            <thead>
                            <tr>
      						<th> {{__('Title')}}</th>
      						<th> {{__('Priorty')}}</th>
                            {{-- <th> {{__('Frequency')}}</th> --}}
                            <th> {{__('Date')}}</th>
                            <th> {{__('Assign To')}}</th>

                            </tr>
                            
                            </thead>
                            <tbody> @foreach ($team_tasks as $team_task) <tr class="font-style">
                            <td>{{ $team_task->title }}</td>
                            <td>{{ $team_task->priority }}</td>
                            <td>{{ $team_task->dates }}</td>
                            <td>{{ $team_task->assign_to }}</td>
                            
                            <td class="Action">
                                        <span>
                                        <div class="action-btn bg-info ms-2">
                                        <a href="{{ route('team_tasks.show',$team_task->id) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('View')}}">
                                            <i class="ti ti-eye text-white"></i>
                                        </a>
                                        </div>
                                        @can('coupon edit')
                                        <div class="action-btn bg-primary ms-2">
                                                <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="{{ route('team_tasks.edit',$team_task->id) }}" data-ajax-popup="true" data-title="{{__('Edit Team_task')}}" data-bs-toggle="tooltip"  title="{{__('Edit')}}" data-original-title="{{__('Edit')}}">
                                                <i class="ti ti-pencil text-white"></i>
                                            </a>
                                        </div>
                                            @endcan
                                            @can('coupon delete')
                                                <div class="action-btn bg-danger ms-2">
                                                    {{ Form::open(['route' => ['team_tasks.destroy', $team_task->id], 'class' => 'm-0']) }}
                                                    @method('DELETE')
                                                    <a href="#"
                                                        class="mx-3 btn btn-sm  align-items-center  show_confirm"
                                                        data-bs-toggle="tooltip" title=""
                                                        data-bs-original-title="Delete" aria-label="Delete"
                                                        data-confirm-yes="delete-form-{{ $team_task->id }}"><i
                                                            class="ti ti-trash text-white text-white"></i></a>
                                                    {{ Form::close() }}
                                                </div>
                                            @endcan
                                        </span>
                                    </td>
    </td>
    
  </tr> @endforeach </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

