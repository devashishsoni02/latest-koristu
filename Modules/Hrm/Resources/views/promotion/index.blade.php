@extends('layouts.main')
@section('page-title')
    {{ __('Manage Promotion') }}
@endsection
@section('page-breadcrumb')
{{ __('Promotion') }}
@endsection
@section('page-action')
<div>
    @can('promotion create')
        <a  class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md" data-title="{{ __('Create New Promotion') }}" data-url="{{route('promotion.create')}}" data-toggle="tooltip" title="{{ __('Create') }}">
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
                                <th>{{ !empty(company_setting('hrm_designation_name')) ? company_setting('hrm_designation_name') : __('Designation') }}</th>
                                <th>{{ __('Promotion Title') }}</th>
                                <th>{{ __('Promotion Date') }}</th>
                                <th>{{ __('Description') }}</th>
                                @if (Gate::check('promotion edit') || Gate::check('promotion delete'))
                                    <th width="200px">{{ __('Action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promotions as $promotion)
                            <tr>
                                @if (in_array(\Auth::user()->type, \Auth::user()->not_emp_type))
                                    <td>{{ !empty( Modules\Hrm\Entities\Employee::getEmployee($promotion->user_id)) ? Modules\Hrm\Entities\Employee::getEmployee($promotion->user_id)->name : '--' }}</td>
                                @endif
                                <td>{{ !empty($promotion->designation) ? ($promotion->designation->name ) ?? '' : '--' }}</td>
                                <td>{{ $promotion->promotion_title }}</td>
                                <td>{{ company_date_formate($promotion->promotion_date) }}</td>
                                <td>
                                    <p style="white-space: nowrap;
                                        width: 200px;
                                        overflow: hidden;
                                        text-overflow: ellipsis;">{{  !empty($promotion->description) ? $promotion->description : '' }}
                                    </p>
                                </td>
                                @if (Gate::check('promotion edit') || Gate::check('promotion delete'))
                                    <td class="Action">
                                        <span>
                                            @can('promotion edit')
                                                <div class="action-btn bg-info ms-2">
                                                    <a  class="mx-3 btn btn-sm  align-items-center"
                                                        data-url="{{ URL::to('promotion/' . $promotion->id . '/edit') }}"
                                                        data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title=""
                                                        data-title="{{ __('Edit Promotion') }}"
                                                        data-bs-original-title="{{ __('Edit') }}">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            @endcan

                                            @can('promotion delete')
                                            <div class="action-btn bg-danger ms-2">
                                                    {{Form::open(array('route'=>array('promotion.destroy', $promotion->id),'class' => 'm-0'))}}
                                                    @method('DELETE')
                                                        <a 
                                                            class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                            data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                            aria-label="Delete" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"  data-confirm-yes="delete-form-{{$promotion->id}}"><i
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

