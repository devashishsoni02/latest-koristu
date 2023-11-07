@extends('layouts.main')
@section('page-title')
    {{ __('Manage Resignation') }}
@endsection
@section('page-breadcrumb')
{{ __('Resignation') }}
@endsection
@section('page-action')
<div>
    @can('resignation create')
        <a  class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md" data-title="{{ __('Create New Resignation') }}" data-url="{{route('resignation.create')}}" data-toggle="tooltip" title="{{ __('Create') }}">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table mb-0 pc-dt-simple" id="assets">
                        <thead>
                            <tr>
                                @if (in_array(\Auth::user()->type, \Auth::user()->not_emp_type))
                                    <th>{{ __('Employee') }}</th>
                                @endif
                                <th>{{ __('Resignation Date') }}</th>
                                <th>{{ __('Last Working Day') }}</th>
                                <th>{{ __('Reason') }}</th>
                                @if (Gate::check('resignation edit') || Gate::check('resignation delete'))
                                    <th width="200px">{{ __('Action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($resignations as $resignation)
                            <tr>
                                @if (in_array(\Auth::user()->type, \Auth::user()->not_emp_type))
                                    <td>{{ !empty( Modules\Hrm\Entities\Employee::getEmployee($resignation->user_id)) ? Modules\Hrm\Entities\Employee::getEmployee($resignation->user_id)->name : '--' }}</td>
                                @endif
                                <td>{{ company_date_formate($resignation->resignation_date) }}</td>
                                <td>{{ company_date_formate($resignation->last_working_date) }}</td>
                                <td>
                                    <p style="white-space: nowrap;
                                        width: 200px;
                                        overflow: hidden;
                                        text-overflow: ellipsis;">{{  !empty($resignation->description) ? $resignation->description : '' }}
                                    </p>
                                </td>
                                @if (Gate::check('resignation edit') || Gate::check('resignation delete'))
                                    <td class="Action">
                                        <span>
                                            @can('resignation edit')
                                            <div class="action-btn bg-info ms-2">
                                                <a  class="mx-3 btn btn-sm  align-items-center"
                                                    data-url="{{ route('resignation.edit', $resignation->id) }}"
                                                    data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title=""
                                                    data-title="{{ __('Edit Resignation') }}"
                                                    data-bs-original-title="{{ __('Edit') }}">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                            @endcan
                                            @can('resignation delete')
                                            <div class="action-btn bg-danger ms-2">
                                                {{Form::open(array('route'=>array('resignation.destroy', $resignation->id),'class' => 'm-0'))}}
                                                @method('DELETE')
                                                    <a 
                                                        class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                        data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                        aria-label="Delete" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"  data-confirm-yes="delete-form-{{$resignation->id}}"><i
                                                            class="ti ti-trash text-white text-white"></i></a>
                                                {{Form::close()}}
                                            </div>
                                            @endcan
                                        </span>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
