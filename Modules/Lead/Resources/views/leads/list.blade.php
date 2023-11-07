@extends('layouts.main')

@section('page-title')
    {{__('Manage Leads')}} @if($pipeline) - {{$pipeline->name}} @endif
@endsection
@push('scripts')
    <script>
        $(document).on("change", "#change-pipeline select[name=default_pipeline_id]", function () {
            $('#change-pipeline').submit();
        });
    </script>
@endpush

@section('page-breadcrumb')
   {{__('Leads')}}
@endsection
@section('page-action')
    @if($pipeline)
    <div class="col-auto pe-0">
        {{ Form::open(array('route' => 'deals.change.pipeline','id'=>'change-pipeline')) }}
        {{ Form::select('default_pipeline_id', $pipelines,$pipeline->id, array('class' => 'form-select custom-form-select mx-2','id'=>'default_pipeline_id')) }}
        {{ Form::close() }}
    </div>
    @endif
    @can('lead import')
    <div class="col-auto pe-0 pt-2">
        <a href="#"  class="btn btn-sm btn-primary btn-icon" data-ajax-popup="true" data-title="{{__('Lead Import')}}" data-url="{{ route('lead.file.import') }}"  data-toggle="tooltip" title="{{ __('Import') }}"><i class="ti ti-file-import"></i>
        </a>
    </div>
    @endcan
    <div class="col-auto pe-0 ps-1 pt-2">
        <a href="{{ route('leads.index') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Kanban View')}}" class="btn btn-sm btn-primary btn-icon"><i class="ti ti-table"></i> </a>
    </div>
    @can('lead create')
    <div class="col-auto ps-1 pt-2">
    <a class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Create Lead')}}" data-ajax-popup="true" data-size="lg" data-title="{{__('Create Lead')}}" data-url="{{route('leads.create')}}"><i class="ti ti-plus text-white"></i></a>
    </div>
    @endcan

@endsection

@section('content')
    @if($pipeline)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table mb-0 pc-dt-simple" id="Leads">
                                <thead>
                                    <tr>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Subject')}}</th>
                                        <th>{{__('Stage')}}</th>
                                        <th>{{__('Users')}}</th>
                                        <th width="300px">{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($leads) > 0)
                                        @foreach ($leads as $lead)
                                            <tr>
                                                <td>{{ $lead->name }}</td>
                                                <td>{{ $lead->subject }}</td>
                                                <td>{{!empty($lead->stage->name)?$lead->stage->name:'' }}</td>
                                                <td>
                                                    @foreach($lead->users as $user)
                                                    <a href="#" class="btn btn-sm mr-1 p-0 rounded-circle">
                                                        <img alt="image" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$user->name}}" @if($user->avatar) src="{{get_file($user->avatar)}}" @else src="{{ get_file('uploads/users-avatar/avatar.png')}}" @endif class="rounded-circle " width="25" height="25">
                                                    </a>
                                                    @endforeach
                                                </td>
                                                @if(!Auth::user()->hasRole('client'))
                                                    <td class="Action">
                                                        <span>
                                                        @can('lead show')
                                                                @if($lead->is_active)
                                                                    <div class="action-btn bg-warning ms-2">
                                                                        <a href="{{route('leads.show',$lead->id)}}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-toggle="tooltip" data-original-title="{{__('View')}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('View')}}"><i class="ti ti-eye text-white"></i></a>
                                                                    </div>
                                                                @endif
                                                            @endcan
                                                            @can('lead edit')
                                                                <div class="action-btn bg-info ms-2">
                                                                    <a data-size="lg" data-url="{{ URL::to('leads/'.$lead->id.'/edit') }}" data-ajax-popup="true" data-title="{{__('Edit Lead')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Edit Lead')}}" ><i class="ti ti-pencil text-white"></i></a>
                                                                </div>
                                                            @endcan
                                                            @can('lead delete')
                                                                <div class="action-btn bg-danger ms-2">
                                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['leads.destroy', $lead->id],'id'=>'delete-form-'.$lead->id]) !!}
                                                                        <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Delete Lead')}}">
                                                                           <span class="text-white"> <i class="ti ti-trash"></i></span>
                                                                    {!! Form::close() !!}
                                                                </div>
                                                            @endif
                                                        </span>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="font-style">
                                            <td colspan="6" class="text-center">{{ __('No data available in table') }}</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
