@extends('layouts.main')
@section('page-title')
    {{ __('Manage Award') }}
@endsection
@section('page-breadcrumb')
{{ __('Award') }}
@endsection
@section('page-action')
<div>
    @can('award create')
        <a  class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md" data-title="{{ __('Create New Award') }}" data-url="{{route('award.create')}}" data-toggle="tooltip" title="{{ __('Create') }}">
            <i class="ti ti-plus text-white"></i>
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
                                <th>{{ __('Award Type') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Gift') }}</th>
                                <th>{{ __('Description') }}</th>
                                @if (Gate::check('award edit') || Gate::check('award delete'))
                                    <th width="200px">{{ __('Action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($awards as $award)
                            <tr>
                                @if (in_array(\Auth::user()->type, \Auth::user()->not_emp_type))
                                    <td>{{ !empty( Modules\Hrm\Entities\Employee::getEmployee($award->user_id)) ? Modules\Hrm\Entities\Employee::getEmployee($award->user_id)->name : '--' }}</td>
                                @endif
                                <td>{{ !empty($award->awardType) ?  ($award->awardType->name ) ?? '' : '' }}</td>
                                <td>{{ company_date_formate($award->date) }}</td>
                                <td>{{ $award->gift }}</td>
                                <td>
                                    <p style="white-space: nowrap;
                                        width: 200px;
                                        overflow: hidden;
                                        text-overflow: ellipsis;">{{  !empty($award->description) ? $award->description : '' }}
                                    </p>
                                </td>
                                @if (Gate::check('award edit') || Gate::check('award delete'))
                                    <td class="Action">
                                        <span>
                                            @can('award edit')
                                            <div class="action-btn bg-info ms-2">
                                                <a  class="mx-3 btn btn-sm  align-items-center"
                                                    data-url="{{ route('award.edit', $award->id) }}"
                                                    data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title=""
                                                    data-title="{{ __('Edit Award') }}"
                                                    data-bs-original-title="{{ __('Edit') }}">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                            @endcan
                                            @can('award delete')
                                            <div class="action-btn bg-danger ms-2">
                                                {{Form::open(array('route'=>array('award.destroy', $award->id),'class' => 'm-0'))}}
                                                @method('DELETE')
                                                    <a
                                                        class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                        data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                        aria-label="Delete" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"  data-confirm-yes="delete-form-{{$award->id}}"><i
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
