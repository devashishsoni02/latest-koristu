@extends('layouts.main')
@section('page-title')
    {{ __('Designation') }}
@endsection
@section('page-breadcrumb')
{{ __('Designation') }}
@endsection
@section('page-action')
<div>
    @can('designation create')
        <a  class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md" data-title="{{ __('Create New Designation') }}" data-url="{{route('designation.create')}}" data-toggle="tooltip" title="{{ __('Create') }}">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-3">
        @include('hrm::layouts.hrm_setup')
    </div>
    @can('designation name edit')
    <div class="col-sm-9">
        <div class="card">
            <div class="d-flex justify-content-between">
                <div class="card-body table-border-style">
                    <h4>{{!empty(company_setting('hrm_designation_name')) ? company_setting('hrm_designation_name') : __('Designation')}}</h4>
                </div>
                <div class="d-flex align-items-center px-4">
                    <div class="action-btn bg-info">
                        <a  class="mx-3 btn btn-sm  align-items-center"
                            data-url="{{ route('designationname.edit') }}"
                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title=""
                            data-title="{{ __('Edit '.(!empty(company_setting('hrm_designation_name')) ? company_setting('hrm_designation_name') : __('Designation')))}}"
                            data-bs-original-title="{{ __('Edit Name') }}">
                            <i class="ti ti-pencil text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table mb-0 " >
                        <thead>
                            <tr>
                                <th>{{!empty(company_setting('hrm_branch_name')) ? company_setting('hrm_branch_name') : __('Branch')}}</th>
                                <th>{{!empty(company_setting('hrm_department_name')) ? company_setting('hrm_department_name') : __('Department') }}</th>
                                <th>{{!empty(company_setting('hrm_designation_name')) ? company_setting('hrm_designation_name') : __('Designation') }}</th>
                                <th width="200px">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody >
                            @forelse ($designations as $designation)
                                <tr>
                                    <td>{{ !empty($designation->branch_id) ? ($designation->branch->name ) ?? '' : '' }}</td>
                                    <td>{{ !empty($designation->department_id) ? ($designation->department->name ) ?? '' : '' }}</td>
                                    <td>{{ !empty($designation->name) ? $designation->name : '' }}</td>
                                    <td class="Action">
                                        <span>
                                            @can('designation edit')
                                                <div class="action-btn bg-info ms-2">
                                                    <a  class="mx-3 btn btn-sm  align-items-center"
                                                        data-url="{{ URL::to('designation/' . $designation->id . '/edit') }}"
                                                        data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title=""
                                                        data-title="{{ __('Edit Designation') }}"
                                                        data-bs-original-title="{{ __('Edit') }}">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('designation delete')
                                            <div class="action-btn bg-danger ms-2">
                                                {{Form::open(array('route'=>array('designation.destroy', $designation->id),'class' => 'm-0'))}}
                                                @method('DELETE')
                                                    <a 
                                                        class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                        data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                        aria-label="Delete" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"  data-confirm-yes="delete-form-{{$designation->id}}"><i
                                                            class="ti ti-trash text-white text-white"></i></a>
                                                {{Form::close()}}
                                            </div>
                                            @endcan
                                    </span>
                                    </td>
                                </tr>
                            @empty
                                 @include('layouts.nodatafound')
                            @endforelse
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
