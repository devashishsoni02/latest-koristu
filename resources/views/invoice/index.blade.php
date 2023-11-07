@extends('layouts.main')
@section('page-title')
    {{ __('Invoices') }}
@endsection
@section('page-breadcrumb')
    {{ __('Invoices') }}
@endsection
@push('css')
@endpush
@section('page-action')
    <div>
        @stack('addButtonHook')
        @if (module_is_active('ProductService'))
            <a href="{{ route('category.index') }}"data-size="md" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"data-title="{{ __('Setup') }}" title="{{ __('Setup') }}"><i class="ti ti-settings"></i></a>
        @endif
        @if ((module_is_active('ProductService') && module_is_active('Account')) || module_is_active('Taskly'))
            @can('invoice manage')
                <a href="{{ route('invoice.grid.view') }}"  data-bs-toggle="tooltip" data-bs-original-title="{{__('Grid View')}}" class="btn btn-sm btn-primary btn-icon">
                    <i class="ti ti-layout-grid"></i>
                </a>
            @endcan

            @can('invoice create')
                <a href="{{ route('invoice.create', 0) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                    data-bs-original-title="{{ __('Create') }}">
                    <i class="ti ti-plus"></i>
                </a>
            @endcan
        @endif
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="mt-2" id="multiCollapseExample1">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => ['invoice.index'], 'method' => 'GET', 'id' => 'customer_submit']) }}
                    <div class="row d-flex align-items-center justify-content-end">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                            <div class="btn-box">
                                {{ Form::label('issue_date', __('Issue Date'), ['class' => 'form-label']) }}
                                {{ Form::text('issue_date', isset($_GET['issue_date']) ? $_GET['issue_date'] : null, ['class' => 'form-control flatpickr-to-input','placeholder' => 'Select Date']) }}

                            </div>
                        </div>
                        @if (!\Auth::user()->type != 'vendor')
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                <div class="btn-box">
                                    {{ Form::label('customer', __('Customer'), ['class' => 'form-label']) }}
                                    {{ Form::select('customer', $customer, isset($_GET['customer']) ? $_GET['customer'] : '', ['class' => 'form-control select', 'placeholder' => 'Select Customer']) }}
                                </div>
                            </div>
                        @endif
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="btn-box">
                                {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
                                {{ Form::select('status', ['' => 'Select Status'] + $status, isset($_GET['status']) ? $_GET['status'] : '', ['class' => 'form-control select']) }}
                            </div>
                        </div>
                        <div class="col-auto float-end ms-2 mt-4">

                            <a href="#" class="btn btn-sm btn-primary"
                                onclick="document.getElementById('customer_submit').submit(); return false;"
                                data-bs-toggle="tooltip" title="{{ __('Apply') }}"
                                data-original-title="{{ __('apply') }}">
                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                            </a>
                            <a href="{{ route('invoice.index') }}" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                data-original-title="{{ __('Reset') }}">
                                <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off"></i></span>
                            </a>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead>
                                <tr>
                                    <th> {{ __('Invoice') }}</th>
                                    @if (\Auth::user()->type != 'Client')
                                        <th>{{ __('Customer') }}</th>
                                    @endif
                                    <th>{{ __('Issue Date') }}</th>
                                    <th>{{ __('Due Date') }}</th>
                                    <th>{{ __('Due Amount') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    @if (Gate::check('invoice edit') ||
                                    Gate::check('invoice delete') ||
                                        Gate::check('invoice show') ||
                                        Gate::check('invoice duplicate'))
                                        <th>{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td class="Id">
                                            @if (Gate::check('invoice show'))
                                                <a href="{{ route('invoice.show', \Crypt::encrypt($invoice->id)) }}"
                                                    class="btn btn-outline-primary">{{ App\Models\Invoice::invoiceNumberFormat($invoice->invoice_id) }}</a>
                                            @else
                                                <a href="#"
                                                    class="btn btn-outline-primary">{{ App\Models\Invoice::invoiceNumberFormat($invoice->invoice_id) }}</a>
                                            @endif
                                        </td>
                                        @if (\Auth::user()->type != 'Client')
                                            <td>{{ !empty($invoice->customer) ? $invoice->customer->name : '' }}</td>
                                        @endif
                                        <td>{{ company_date_formate($invoice->issue_date) }}</td>
                                        <td>
                                            @if ($invoice->due_date < date('Y-m-d'))
                                                <p class="text-danger">
                                                    {{ company_date_formate($invoice->due_date) }}</p>
                                            @else
                                                {{ company_date_formate($invoice->due_date) }}
                                            @endif
                                        </td>
                                        <td>{{ currency_format_with_sym($invoice->getDue()) }}</td>
                                        <td>
                                            @if ($invoice->status == 0)
                                                <span
                                                    class="badge fix_badges bg-primary p-2 px-3 rounded">{{ __(App\Models\Invoice::$statues[$invoice->status]) }}</span>
                                            @elseif($invoice->status == 1)
                                                <span
                                                    class="badge fix_badges bg-info p-2 px-3 rounded">{{ __(App\Models\Invoice::$statues[$invoice->status]) }}</span>
                                            @elseif($invoice->status == 2)
                                                <span
                                                    class="badge fix_badges bg-secondary p-2 px-3 rounded">{{ __(App\Models\Invoice::$statues[$invoice->status]) }}</span>
                                            @elseif($invoice->status == 3)
                                                <span
                                                    class="badge fix_badges bg-warning p-2 px-3 rounded">{{ __(App\Models\Invoice::$statues[$invoice->status]) }}</span>
                                            @elseif($invoice->status == 4)
                                                <span
                                                    class="badge fix_badges bg-danger p-2 px-3 rounded">{{ __(App\Models\Invoice::$statues[$invoice->status]) }}</span>
                                            @endif
                                        </td>

                                        @if (Gate::check('invoice edit') ||
                                            Gate::check('invoice delete') ||
                                            Gate::check('invoice show') ||
                                            Gate::check('invoice duplicate'))
                                            <td class="Action">
                                                <span>
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" class="btn btn-sm  align-items-center cp_link" data-link="{{route('pay.invoice',\Illuminate\Support\Facades\Crypt::encrypt($invoice->id))}}" data-bs-toggle="tooltip" title="{{__('Copy')}}" data-original-title="{{__('Click to copy invoice link')}}">
                                                            <i class="ti ti-file text-white"></i>
                                                        </a>
                                                    </div>
                                                    @if(module_is_active('EInvoice'))
                                                        @can('download invoice')
                                                            @include('einvoice::download.generate_invoice',['invoice_id'=>$invoice->id])
                                                        @endcan
                                                    @endif
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" class="btn btn-sm  align-items-center" data-url="{{route('delivery-form.pdf',\Crypt::encrypt($invoice->id))}}" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="{{__('Invoice Delivery Form')}}" data-title="{{ __('Invoice Delivery Form') }}">
                                                            <i class="ti ti-clipboard-list text-white"></i>
                                                        </a>
                                                    </div>
                                                    @can('invoice duplicate')
                                                        <div class="action-btn bg-secondary ms-2">
                                                            {!! Form::open([
                                                                'method' => 'get',
                                                                'route' => ['invoice.duplicate', $invoice->id],
                                                                'id' => 'duplicate-form-' . $invoice->id,
                                                            ]) !!}
                                                            <a href="#"
                                                                class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="{{ __('Duplicate') }}"
                                                                aria-label="Delete"
                                                                data-text="{{ __('You want to confirm duplicate this invoice. Press Yes to continue or Cancel to go back') }}"
                                                                data-confirm-yes="duplicate-form-{{ $invoice->id }}">
                                                                <i class="ti ti-copy  text-white"></i>
                                                            </a>
                                                            {{ Form::close() }}
                                                        </div>
                                                    @endcan
                                                    @can('invoice show')
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="{{ route('invoice.show', \Crypt::encrypt($invoice->id)) }}"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-bs-toggle="tooltip" title="{{ __('View') }}">
                                                                <i class="ti ti-eye  text-white"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @if (module_is_active('ProductService') && $invoice->invoice_module == 'taskly' ? module_is_active('Taskly') : module_is_active('Account'))
                                                        @can('invoice edit')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('invoice.edit', \Crypt::encrypt($invoice->id)) }}"
                                                                    class="mx-3 btn btn-sm  align-items-center"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-original-title="{{ __('Edit') }}">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                    @endif
                                                    @can('invoice delete')
                                                        <div class="action-btn bg-danger ms-2">
                                                            {{ Form::open(['route' => ['invoice.destroy', $invoice->id], 'class' => 'm-0']) }}
                                                            @method('DELETE')
                                                            <a href="#"
                                                                class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="Delete" aria-label="Delete"
                                                                data-confirm="{{ __('Are You Sure?') }}"
                                                                data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="delete-form-{{ $invoice->id }}">
                                                                <i class="ti ti-trash text-white text-white"></i>
                                                            </a>
                                                            {{ Form::close() }}
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
@push('scripts')
    <script>
        $(document).on("click",".cp_link",function() {
            var value = $(this).attr('data-link');
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(value).select();
                document.execCommand("copy");
                $temp.remove();
                toastrs('success', '{{__('Link Copy on Clipboard')}}', 'success')
        });
    </script>
@endpush






