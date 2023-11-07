@extends('layouts.main')
@section('page-title')
  {{ __('Employee Set Salary') }}
@endsection
@section('page-breadcrumb')
{{ __('Employee Set Salary') }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('Modules/Hrm/Resources/assets/css/custom.css')}}">
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-xl-6">
                <div class="card set-card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5>{{ __('Employee Salary') }}</h5>
                            </div>
                            @can('setsalary create')
                                <div class="col-6 text-end">
                                    <a  data-url="{{ route('employee.basic.salary', $employee->id) }}"
                                        data-ajax-popup="true" data-title="{{ __('Set Basic Sallary') }}"
                                        data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
                                        data-bs-original-title="{{ __('Set Salary') }}">
                                        <i class="ti ti-plus"></i>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="project-info d-flex text-sm">
                            <div class="project-info-inner mr-3 col-6">
                                <b class="m-0"> {{ __('Payslip Type') }} </b>
                                <div class="project-amnt pt-1">{{ !empty($employee->salary_type()) ?  ($employee->salary_type()) ?? '' : '' }}</div>
                            </div>
                            <div class="project-info-inner mr-3 col-6">
                                <b class="m-0"> {{ __('Salary') }} </b>
                                <div class="project-amnt pt-1">{{ currency_format_with_sym($employee->salary) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- allowance -->
            @can('allowance manage')
                <div class="col-md-6">
                    <div class="card set-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5>{{ __('Allowance') }}</h5>
                                </div>
                                @can('allowance create')
                                    <div class="col-6 text-end">
                                        <a  data-url="{{ route('allowances.create', $employee->id) }}"
                                            data-ajax-popup="true" data-title="{{ __('Create Allowance') }}"
                                            data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
                                            data-bs-original-title="{{ __('Create') }}">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class=" card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Employee Name') }}</th>
                                            <th>{{ __('Allownace Option') }}</th>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Type') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            @if (Gate::check('allowance edit') || Gate::check('allowance delete'))
                                                <th>{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allowances as $allowance)
                                            <tr>
                                                <td>{{ !empty( Modules\Hrm\Entities\Employee::GetEmployeeByEmp($allowance->employee_id)) ? Modules\Hrm\Entities\Employee::GetEmployeeByEmp($allowance->employee_id)->name : '' }}</td>
                                                <td>{{ !empty($allowance->allowance_option()) ? $allowance->allowance_option()->name : '' }}
                                                </td>
                                                <td>{{ $allowance->title }}</td>

                                                <td>{{ ucfirst($allowance->type) }}</td>
                                                @if ($allowance->type == 'fixed')
                                                    <td>{{ currency_format_with_sym($allowance->amount) }}</td>
                                                @else
                                                    <td>{{ $allowance->amount }}%
                                                        ({{ currency_format_with_sym($allowance->tota_allow) }})
                                                    </td>
                                                @endif
                                                @if (Gate::check('allowance edit') || Gate::check('allowance delete'))
                                                    <td class="Action">
                                                        <span>
                                                            @can('allowance edit')
                                                                <div class="action-btn bg-info ms-2">
                                                                    <a  class="mx-3 btn btn-sm  align-items-center"
                                                                        data-url="{{ URL::to('allowance/' . $allowance->id . '/edit') }}"
                                                                        data-ajax-popup="true" data-size="md"
                                                                        data-bs-toggle="tooltip" title=""
                                                                        data-title="{{ __('Edit Allowance') }}"
                                                                        data-bs-original-title="{{ __('Edit') }}">
                                                                        <i class="ti ti-pencil text-white"></i>
                                                                    </a>
                                                                </div>
                                                            @endcan
                                                            @can('allowance delete')
                                                                <div class="action-btn bg-danger ms-2">
                                                                    {{Form::open(array('route'=>array('allowance.destroy', $allowance->id),'class' => 'm-0'))}}
                                                                    @method('DELETE')
                                                                        <a
                                                                            class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                            data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                                            aria-label="Delete" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"  data-confirm-yes="delete-form-{{$allowance->id}}"><i
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
            @endcan

            <!-- Commission -->
            @can('commission manage')
                <div class="col-md-6">
                    <div class="card set-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5>{{ __('Commission') }}</h5>
                                </div>
                                @can('commission create')
                                    <div class="col text-end">
                                        <a  data-url="{{ route('commissions.create', $employee->id) }}"
                                            data-ajax-popup="true" data-title="{{ __('Create Commission') }}"
                                            data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
                                            data-bs-original-title="{{ __('Create') }}">
                                            <i class="ti ti-plus"></i>
                                        </a>

                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class=" card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Employee Name') }}</th>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Type') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            @if (Gate::check('commission edit') || Gate::check('commission delete'))
                                                <th>{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($commissions as $commission)
                                            <tr>
                                                <td>{{ !empty( Modules\Hrm\Entities\Employee::GetEmployeeByEmp($commission->employee_id)) ? Modules\Hrm\Entities\Employee::GetEmployeeByEmp($commission->employee_id)->name : '' }}</td>
                                                <td>{{ $commission->title }}</td>
                                                <td>{{ ucfirst($commission->type) }}</td>
                                                @if ($commission->type == 'fixed')
                                                    <td>{{ currency_format_with_sym($commission->amount) }}</td>
                                                @else
                                                    <td>{{ $commission->amount }}%
                                                        ({{ currency_format_with_sym($commission->tota_allow) }})
                                                    </td>
                                                @endif
                                            @if (Gate::check('commission edit') || Gate::check('commission delete'))
                                                    <td class="Action">
                                                        <span>
                                                            @can('commission edit')
                                                                <div class="action-btn bg-info ms-2">
                                                                    <a  class="mx-3 btn btn-sm  align-items-center"
                                                                        data-url="{{ URL::to('commission/' . $commission->id . '/edit') }}"
                                                                        data-ajax-popup="true" data-size="md"
                                                                        data-bs-toggle="tooltip" title=""
                                                                        data-title="{{ __('Edit Commission') }}"
                                                                        data-bs-original-title="{{ __('Edit') }}">
                                                                        <i class="ti ti-pencil text-white"></i>
                                                                    </a>
                                                                </div>
                                                            @endcan
                                                            @can('commission delete')
                                                                <div class="action-btn bg-danger ms-2">
                                                                    {{Form::open(array('route'=>array('commission.destroy', $commission->id),'class' => 'm-0'))}}
                                                                        @method('DELETE')
                                                                            <a class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                                data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                                                aria-label="Delete" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"  data-confirm-yes="delete-form-{{$commission->id}}"><i
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
            @endcan
            <!-- loan-->
            @can('loan manage')
                <div class="col-md-6">
                    <div class="card set-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5>{{ __('Loan') }}</h5>
                                </div>
                                @can('loan create')
                                    <div class="col text-end">
                                        <a  data-url="{{ route('loans.create', $employee->id) }}"
                                            data-ajax-popup="true" data-title="{{ __('Create Loan') }}"
                                            data-bs-toggle="tooltip" title="" data-size="md" class="btn btn-sm btn-primary"
                                            data-bs-original-title="{{ __('Create') }}">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class=" card-body table-border-style">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Employee') }}</th>
                                            <th>{{ __('Loan Options') }}</th>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Type') }}</th>
                                            <th>{{ __('Loan Amount') }}</th>
                                            <th>{{ __('Start Date') }}</th>
                                            <th>{{ __('End Date') }}</th>
                                            @if (Gate::check('loan edit') || Gate::check('loan delete'))
                                                <th>{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($loans as $loan)
                                            <tr>
                                                <td>{{ !empty( Modules\Hrm\Entities\Employee::GetEmployeeByEmp($loan->employee_id)) ? Modules\Hrm\Entities\Employee::GetEmployeeByEmp($loan->employee_id)->name : '' }}</td>
                                                <td>{{ !empty($loan->loan_option()) ? $loan->loan_option()->name : '' }}</td>
                                                <td>{{ $loan->title }}</td>
                                                <td>{{ ucfirst($loan->type) }}</td>
                                                @if ($loan->type == 'fixed')
                                                    <td>{{ currency_format_with_sym($loan->amount) }}</td>
                                                @else
                                                    <td>{{ $loan->amount }}%
                                                        ({{ currency_format_with_sym($loan->tota_allow) }})
                                                    </td>
                                                @endif
                                                <td>{{ company_date_formate($loan->start_date) }}</td>
                                                <td>{{ company_date_formate($loan->end_date) }}</td>
                                                @if (Gate::check('loan edit') || Gate::check('loan delete'))
                                                    <td class="Action">
                                                        <span>
                                                            @can('loan edit')
                                                                <div class="action-btn bg-info ms-2">
                                                                    <a  class="mx-3 btn btn-sm  align-items-center"
                                                                        data-url="{{ URL::to('loan/' . $loan->id . '/edit') }}"
                                                                        data-ajax-popup="true" data-size="md"
                                                                        data-bs-toggle="tooltip" title=""
                                                                        data-title="{{ __('Edit Loan') }}"
                                                                        data-bs-original-title="{{ __('Edit') }}">
                                                                        <i class="ti ti-pencil text-white"></i>
                                                                    </a>
                                                                </div>
                                                            @endcan
                                                            @can('loan delete')
                                                                <div class="action-btn bg-danger ms-2">
                                                                    {{Form::open(array('route'=>array('loan.destroy', $loan->id),'class' => 'm-0'))}}
                                                                        @method('DELETE')
                                                                            <a class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                                data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                                                aria-label="Delete" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"  data-confirm-yes="delete-form-{{$loan->id}}"><i
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
            @endcan

            <!-- Saturation -->
            @can('saturation deduction manage')
                <div class="col-md-6">
                    <div class="card set-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5>{{ __('Saturation Deduction') }}</h5>
                                </div>
                                @can('saturation deduction create')
                                    <div class="col text-end">
                                        <a  data-url="{{ route('saturationdeductions.create', $employee->id) }}"
                                            data-ajax-popup="true" data-size="md" data-title="{{ __('Create Saturation Deduction') }}"
                                            data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
                                            data-bs-original-title="{{ __('Create') }}">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class=" card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Employee Name') }}</th>
                                            <th>{{ __('Deduction Option') }}</th>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Type') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            @if (Gate::check('saturation deduction edit') || Gate::check('saturation deduction delete'))
                                                <th>{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($saturationdeductions as $saturationdeduction)
                                            <tr>
                                                <td>{{ !empty( Modules\Hrm\Entities\Employee::GetEmployeeByEmp($saturationdeduction->employee_id)) ? Modules\Hrm\Entities\Employee::GetEmployeeByEmp($saturationdeduction->employee_id)->name : '' }}</td>
                                                <td>{{ !empty($saturationdeduction->deduction_option()) ? $saturationdeduction->deduction_option()->name : '' }}</td>
                                                <td>{{ $saturationdeduction->title }}</td>
                                                <td>{{ ucfirst($saturationdeduction->type) }}</td>
                                                @if ($saturationdeduction->type == 'fixed')
                                                    <td>{{ currency_format_with_sym($saturationdeduction->amount) }}
                                                    </td>
                                                @else
                                                    <td>{{ $saturationdeduction->amount }}%
                                                        ({{ currency_format_with_sym($saturationdeduction->tota_allow) }})
                                                    </td>
                                                @endif
                                            @if (Gate::check('saturation deduction edit') || Gate::check('saturation deduction delete'))
                                                <td class="Action">
                                                    <span>
                                                        @can('saturation deduction edit')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a  class="mx-3 btn btn-sm  align-items-center"
                                                                    data-url="{{  URL::to('saturationdeduction/' . $saturationdeduction->id . '/edit')  }}"
                                                                    data-ajax-popup="true" data-size="md"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-title="{{ __('Edit Saturation Deduction') }}"
                                                                    data-bs-original-title="{{ __('Edit') }}">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('saturation deduction delete')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {{Form::open(array('route'=>array('saturationdeduction.destroy', $saturationdeduction->id),'class' => 'm-0'))}}
                                                                @method('DELETE')
                                                                    <a class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                        data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                                        aria-label="Delete" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"  data-confirm-yes="delete-form-{{$saturationdeduction->id}}"><i
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
            @endcan

            <!-- other payment-->
            @can('other payment manage')
                <div class="col-md-6">
                    <div class="card set-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5>{{ __('Other Payment') }}</h5>
                                </div>
                                @can('other payment create')
                                    <div class="col text-end">

                                        <a  data-url="{{ route('otherpayments.create', $employee->id) }}"
                                            data-ajax-popup="true" data-title="{{ __('Create Other Payment') }}"
                                            data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
                                            data-bs-original-title="{{ __('Create') }}">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class=" card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Employee') }}</th>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Type') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            @if (Gate::check('other payment edit') || Gate::check('other payment delete'))
                                                <th>{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($otherpayments as $otherpayment)
                                            <tr>
                                                <td>{{ !empty( Modules\Hrm\Entities\Employee::GetEmployeeByEmp($otherpayment->employee_id)) ? Modules\Hrm\Entities\Employee::GetEmployeeByEmp($otherpayment->employee_id)->name : '' }}</td>
                                                <td>{{ $otherpayment->title }}</td>
                                                <td>{{ ucfirst($otherpayment->type) }}</td>
                                                @if ($otherpayment->type == 'fixed')
                                                    <td>{{ currency_format_with_sym($otherpayment->amount) }}</td>
                                                @else
                                                    <td>{{ $otherpayment->amount }}%
                                                        ({{ currency_format_with_sym($otherpayment->tota_allow) }})
                                                    </td>
                                                @endif
                                            @if (Gate::check('other payment edit') || Gate::check('other payment delete'))
                                                <td class="Action">
                                                    <span>
                                                        @can('other payment edit')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a  class="mx-3 btn btn-sm  align-items-center"
                                                                    data-url="{{ URL::to('otherpayment/' . $otherpayment->id . '/edit') }}"
                                                                    data-ajax-popup="true" data-size="md"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-title="{{ __('Edit Other Payment') }}"
                                                                    data-bs-original-title="{{ __('Edit') }}">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('other payment delete')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {{Form::open(array('route'=>array('otherpayment.destroy', $otherpayment->id),'class' => 'm-0'))}}
                                                                @method('DELETE')
                                                                    <a class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                        data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                                        aria-label="Delete" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"  data-confirm-yes="delete-form-{{$otherpayment->id}}"><i
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
            @endcan

            <!--overtime-->
            @can('overtime manage')
                <div class="col-md-6">
                    <div class="card set-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5>{{ __('Overtime') }}</h5>
                                </div>
                                @can('overtime create')
                                    <div class="col text-end">
                                        <a  data-url="{{ route('overtimes.create', $employee->id) }}"
                                            data-ajax-popup="true" data-title="{{ __('Create Overtime') }}"
                                            data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
                                            data-bs-original-title="{{ __('Create') }}">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class=" card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Employee Name') }}</th>
                                            <th>{{ __('Overtime Title') }}</th>
                                            <th>{{ __('Number of days') }}</th>
                                            <th>{{ __('Hours') }}</th>
                                            <th>{{ __('Rate') }}</th>
                                            @if (Gate::check('overtime edit') || Gate::check('overtime delete'))
                                                <th>{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($overtimes as $overtime)
                                            <tr>
                                                <td>{{ !empty( Modules\Hrm\Entities\Employee::GetEmployeeByEmp($overtime->employee_id)) ? Modules\Hrm\Entities\Employee::GetEmployeeByEmp($overtime->employee_id)->name : '' }}</td>
                                                <td>{{ $overtime->title }}</td>
                                                <td>{{ $overtime->number_of_days }}</td>
                                                <td>{{ $overtime->hours }}</td>
                                                <td>{{ currency_format_with_sym($overtime->rate) }}</td>
                                                @if (Gate::check('overtime edit') || Gate::check('overtime delete'))
                                                    <td class="Action">
                                                        <span>
                                                            @can('overtime edit')
                                                                <div class="action-btn bg-info ms-2">
                                                                    <a  class="mx-3 btn btn-sm  align-items-center"
                                                                        data-url="{{  URL::to('overtime/' . $overtime->id . '/edit') }}"
                                                                        data-ajax-popup="true" data-size="md"
                                                                        data-bs-toggle="tooltip" title=""
                                                                        data-title="{{ __('Edit OverTime') }}"
                                                                        data-bs-original-title="{{ __('Edit') }}">
                                                                        <i class="ti ti-pencil text-white"></i>
                                                                    </a>
                                                                </div>
                                                            @endcan
                                                            @can('overtime delete')
                                                                <div class="action-btn bg-danger ms-2">
                                                                    {{Form::open(array('route'=>array('overtime.destroy', $overtime->id),'class' => 'm-0'))}}
                                                                    @method('DELETE')
                                                                        <a class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                            data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                                            aria-label="Delete" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"  data-confirm-yes="delete-form-{{$overtime->id}}"><i
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
            @endcan

        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).on('change', '.amount_type', function() {
            var val = $(this).val();
            var label_text = 'Amount';
            if (val == 'percentage') {
                var label_text = 'Percentage';
            }
            $('.amount_label').html(label_text);
        });
    </script>
@endpush
