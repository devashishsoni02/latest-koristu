@extends('layouts.main')
@section('page-title')
    {{ __('Manage Employee') }}
@endsection
@section('page-breadcrumb')
    {{ __('Employee') }}
@endsection
@section('page-action')
    <div>
        @stack('addButtonHook')
        @can('employee import')
            <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="{{ __('Employee Import') }}"
                data-url="{{ route('employee.file.import') }}" data-toggle="tooltip" title="{{ __('Import') }}"><i
                    class="ti ti-file-import"></i>
            </a>
        @endcan
        <a href="{{ route('employee.grid') }}" class="btn btn-sm btn-primary btn-icon"
            data-bs-toggle="tooltip"title="{{ __('Grid View') }}">
            <i class="ti ti-layout-grid text-white"></i>
        </a>
        @can('employee create')
            <a href="{{ route('employee.create') }}" data-title="{{ __('Create New Employee') }}" data-bs-toggle="tooltip"
                title="" class="btn btn-sm btn-primary" data-bs-original-title="{{ __('Create') }}">
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
                                    <th>{{ __('Employee ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ !empty(company_setting('hrm_branch_name')) ? company_setting('hrm_branch_name') : __('Branch') }}
                                    </th>
                                    <th>{{ !empty(company_setting('hrm_department_name')) ? company_setting('hrm_department_name') : __('Department') }}
                                    </th>
                                    <th>{{ !empty(company_setting('hrm_designation_name')) ? company_setting('hrm_designation_name') : __('Designation') }}
                                    </th>
                                    <th>{{ __('Date Of Joining') }}</th>
                                    @if (Gate::check('employee edit') || Gate::check('employee delete'))
                                        <th width="200px">{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        @if (!empty($employee->employee_id))
                                            <td>
                                                @can('employee show')
                                                    <a class="btn btn-outline-primary"
                                                        href="{{ route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($employee->id)) }}">{{ Modules\Hrm\Entities\Employee::employeeIdFormat($employee->employee_id) }}</a>
                                                @else
                                                    <a
                                                        class="btn btn-outline-primary">{{ Modules\Hrm\Entities\Employee::employeeIdFormat($employee->employee_id) }}</a>
                                                @endcan
                                            </td>
                                        @else
                                            <td>--</td>
                                        @endif
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>
                                            {{ !empty(Modules\Hrm\Entities\Employee::Branchs($employee->branch_id)) ? Modules\Hrm\Entities\Employee::Branchs($employee->branch_id)->name : '--' }}
                                        </td>
                                        <td>
                                            {{ !empty(Modules\Hrm\Entities\Employee::Departments($employee->department_id)) ? Modules\Hrm\Entities\Employee::Departments($employee->department_id)->name : '--' }}
                                        </td>
                                        <td>
                                            {{ !empty(Modules\Hrm\Entities\Employee::Designations($employee->designation_id)) ? Modules\Hrm\Entities\Employee::Designations($employee->designation_id)->name : '--' }}
                                            {{-- {{ !empty($employee->designation()) ? $employee->designation()->name : '' }} --}}
                                        </td>
                                        <td>
                                            {{ !empty($employee->company_doj) ? company_date_formate($employee->company_doj) : '--' }}
                                        </td>
                                        @if (Gate::check('employee edit') || Gate::check('employee delete'))
                                            <td class="Action">
                                                @if ($employee->is_disable == 1)
                                                    <span>
                                                        @can('employee edit')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('employee.edit', \Illuminate\Support\Facades\Crypt::encrypt($employee->ID)) }}"
                                                                    class="mx-3 btn btn-sm  align-items-center"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-bs-original-title="{{ __('Edit') }}">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @if (!empty($employee->employee_id))
                                                            @can('employee show')
                                                                <div class="action-btn bg-warning ms-2">
                                                                    <a href="{{ route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($employee->id)) }}"
                                                                        class="mx-3 btn btn-sm  align-items-center"
                                                                        data-bs-toggle="tooltip" title=""
                                                                        data-bs-original-title="{{ __('Show') }}">
                                                                        <i class="ti ti-eye text-white"></i>
                                                                    </a>
                                                                </div>
                                                            @endcan
                                                            @can('employee delete')
                                                                <div class="action-btn bg-danger ms-2">
                                                                    {{ Form::open(['route' => ['employee.destroy', $employee->id], 'class' => 'm-0']) }}
                                                                    @method('DELETE')
                                                                    <a class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                        data-bs-toggle="tooltip" title=""
                                                                        data-bs-original-title="Delete" aria-label="Delete"
                                                                        data-confirm="{{ __('Are You Sure?') }}"
                                                                        data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                        data-confirm-yes="delete-form-{{ $employee->id }}"><i
                                                                            class="ti ti-trash text-white text-white"></i></a>
                                                                    {{ Form::close() }}
                                                                </div>
                                                            @endcan
                                                        @endif
                                                    </span>
                                                @else
                                                    <div class="text-center">
                                                        <i class="ti ti-lock"></i>
                                                    </div>
                                                @endif
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
