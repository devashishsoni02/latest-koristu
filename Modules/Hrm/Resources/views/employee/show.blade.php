@extends('layouts.main')
@section('page-title')
    {{ __('Employee') }}
@endsection
@section('page-breadcrumb')
    {{ __('Employee') }}
@endsection
<style>
    .emp-card {
        min-height: 193px !important;
    }
</style>
@push('css')
    <link rel="stylesheet" href="{{ asset('Modules/Hrm/Resources/assets/css/custom.css') }}">
@endpush
@section('page-action')
    <div class="col-auto p-0">
        <div class="d-flex justify-content-end drp-languages">
            <ul class="list-unstyled mb-0 m-2">
                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="drp-text hide-mob text-primary"> {{ __('Joining Letter') }}
                            <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">
                        <a href="{{ route('joiningletter.download.pdf', $employee->employee_id) }}"
                            class=" btn-icon dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top"
                            target="_blanks"><i class="ti ti-download ">&nbsp;</i>{{ __('PDF') }}</a>

                        <a href="{{ route('joininglatter.download.doc', $employee->employee_id) }}"
                            class=" btn-icon dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top"
                            target="_blanks"><i class="ti ti-download ">&nbsp;</i>{{ __('DOC') }}</a>
                    </div>
                </li>
            </ul>
            <ul class="list-unstyled mb-0 m-2">
                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="drp-text hide-mob text-primary"> {{ __('Experience Certificate') }}
                            <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">
                        <a href="{{ route('exp.download.pdf', $employee->employee_id) }}" class=" btn-icon dropdown-item"
                            data-bs-toggle="tooltip" data-bs-placement="top" target="_blanks"><i
                                class="ti ti-download ">&nbsp;</i>{{ __('PDF') }}</a>

                        <a href="{{ route('exp.download.doc', $employee->employee_id) }}" class=" btn-icon dropdown-item"
                            data-bs-toggle="tooltip" data-bs-placement="top" target="_blanks"><i
                                class="ti ti-download ">&nbsp;</i>{{ __('DOC') }}</a>
                    </div>
                </li>
            </ul>
            <ul class="list-unstyled mb-0 m-2">
                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="drp-text hide-mob text-primary"> {{ __('NOC') }}
                            <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">
                        <a href="{{ route('noc.download.pdf', $employee->employee_id) }}" class=" btn-icon dropdown-item"
                            data-bs-toggle="tooltip" data-bs-placement="top" target="_blanks"><i
                                class="ti ti-download ">&nbsp;</i>{{ __('PDF') }}</a>

                        <a href="{{ route('noc.download.doc', $employee->employee_id) }}" class=" btn-icon dropdown-item"
                            data-bs-toggle="tooltip" data-bs-placement="top" target="_blanks"><i
                                class="ti ti-download ">&nbsp;</i>{{ __('DOC') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    @if($employee->user->is_disable == 1)
        <div class="col-auto pe-0 pt-3">
            @can('designation create')
                <a href="{{ route('employee.edit', \Illuminate\Support\Facades\Crypt::encrypt($employee->user_id)) }}"
                    class="btn btn-sm btn-primary p-2" data-toggle="tooltip" title="{{ __('Edit') }}">
                    <i class="ti ti-pencil"></i>
                </a>
            @endcan
        </div>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-sm-12 col-md-6">

                    <div class="card ">
                        <div class="card-body employee-detail-body fulls-card emp-card">
                            <h5>{{ __('Personal Detail') }}</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong class="font-bold">{{ __('Employee ID') }} : </strong>
                                        <span>{{ $employeesId }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info text-sm font-style">
                                        <strong class="font-bold">{{ __('Name') }} :</strong>
                                        <span>{{ $employee->name }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info text-sm font-style">
                                        <strong class="font-bold">{{ __('Email') }} :</strong>
                                        <span>{{ $employee->email }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong class="font-bold">{{ __('Date of Birth') }} :</strong>
                                        <span>{{ !empty($employee->dob) ? company_date_formate($employee->dob) : '' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong class="font-bold">{{ __('Phone') }} :</strong>
                                        <span>{{ $employee->phone }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong class="font-bold">{{ __('Address') }} :</strong>
                                        <span>{{ $employee->address }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong class="font-bold">{{ __('Salary Type') }} :</strong>
                                        <span>{{ !empty($employee->salaryType) ? $employee->salaryType->name : '' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong class="font-bold">{{ __('Basic Salary') }} :</strong>
                                        <span>{{ $employee->salary }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">

                    <div class="card ">
                        <div class="card-body employee-detail-body fulls-card emp-card">
                            <h5>{{ __('Company Detail') }}</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong
                                            class="font-bold">{{ !empty(company_setting('hrm_branch_name')) ? company_setting('hrm_branch_name') : __('Branch') }}
                                            : </strong>
                                        <span>{{ !empty($employee->branch) ? $employee->branch->name : '' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info text-sm font-style">
                                        <strong
                                            class="font-bold">{{ !empty(company_setting('hrm_department_name')) ? company_setting('hrm_department_name') : __('Department') }}
                                            :</strong>
                                        <span>{{ !empty($employee->department) ? $employee->department->name : '' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong
                                            class="font-bold">{{ !empty(company_setting('hrm_designation_name')) ? company_setting('hrm_designation_name') : __('Designation') }}
                                            :</strong>
                                        <span>{{ !empty($employee->designation) ? $employee->designation->name : '' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong class="font-bold">{{ __('Date Of Joining') }} :</strong>
                                        <span>{{ !empty($employee->company_doj) ? company_date_formate($employee->company_doj) : '' }}</span>
                                    </div>
                                </div>
                                @if (!empty($customFields) && count($employee->customField) > 0)
                                    @foreach ($customFields as $field)
                                        <div class="info text-sm">
                                            <strong class="font-bold">{{ $field->name }} :</strong>
                                            @if ($field->type == 'attachment')
                                                <a href="{{ isset($employee->customField[$field->id]) ? get_file($employee->customField[$field->id]) : '#' }}"
                                                    target="_blank">
                                                    @if (isset($employee->customField[$field->id]))
                                                        <img src="{{ get_file($employee->customField[$field->id]) }}"
                                                            class="wid-40 rounded me-3">
                                                    @endif
                                                </a>
                                            @else
                                                <span>{{ !empty($employee->customField) ? (isset($employee->customField[$field->id])) ? $employee->customField[$field->id] : '-' : '-' }}</span>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-6">

                    <div class="card ">
                        <div class="card-body employee-detail-body fulls-card emp-card">
                            <h5>{{ __('Document Detail') }}</h5>
                            <hr>
                            <div class="row">
                                @if (count($documents) > 0)
                                    @php
                                        $employeedoc = $employee->documents()->pluck('document_value', 'document_id');
                                    @endphp
                                    @foreach ($documents as $key => $document)
                                        <div class="col-md-6">
                                            <div class="info text-sm">
                                                <strong class="font-bold">{{ $document->name }} : </strong>
                                                <span><a href="{{ !empty($employeedoc[$document->id]) ? get_file($employeedoc[$document->id]) : '' }}"
                                                        target="_blank">{{ !empty($employeedoc[$document->id]) ? $employeedoc[$document->id] : '' }}</a></span>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center">
                                        No Document Type Added.!
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">

                    <div class="card ">
                        <div class="card-body employee-detail-body fulls-card emp-card">
                            <h5>{{ __('Bank Account Detail') }}</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong class="font-bold">{{ __('Account Holder Name') }} : </strong>
                                        <span>{{ $employee->account_holder_name }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info text-sm font-style">
                                        <strong class="font-bold">{{ __('Account Number') }} :</strong>
                                        <span>{{ $employee->account_number }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong class="font-bold">{{ __('Bank Name') }} :</strong>
                                        <span>{{ $employee->bank_name }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong class="font-bold">{{ __('Bank Identifier Code') }} :</strong>
                                        <span>{{ $employee->bank_identifier_code }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong class="font-bold">{{ __('Branch Location') }} :</strong>
                                        <span>{{ $employee->branch_location }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong class="font-bold">{{ __('Tax Payer Id') }} :</strong>
                                        <span>{{ $employee->tax_payer_id }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
