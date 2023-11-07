@extends('layouts.main')
@section('page-title')
    {{ __('Setup') }}
@endsection
@section('page-breadcrumb')
    {{ __('Setup') }}
@endsection
@section('page-action')
    <div>
        @if (URL::previous() == URL::current())
            <a href="{{ route('product-service.index') }}" class="btn-submit btn btn-sm btn-primary " data-toggle="tooltip"
                title="{{ __('Back') }}">
                <i class=" ti ti-arrow-back-up"></i> </a>
        @else
            <a href="{{ url(URL::previous()) }}" class="btn-submit btn btn-sm btn-primary " data-toggle="tooltip"
                title="{{ __('Back') }}">
                <i class=" ti ti-arrow-back-up"></i> </a>
        @endif

    </div>
@endsection
@section('content')
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#product_category-settings" id="product_category-tab"
                                class="list-group-item list-group-item-action border-0">{{ __('Product & Services Category') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>

                            <a href="#income_category-settings" id="income_category-tab"
                                class="list-group-item list-group-item-action border-0">{{ __('Invoice /Proposal') }}
                                @if (module_is_active('Account'))
                                    {{ __('/Revenue') }}
                                @endif {{ __(' Category') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>

                            <a href="#expance_category-settings" id="expance_category-tab"
                                class="list-group-item list-group-item-action border-0">
                                @if (module_is_active('Account') && module_is_active('Pos'))
                                    {{ __('Bill / Purchase') }}
                                @elseif(module_is_active('Account'))
                                    {{ __('Bill') }}
                                @elseif(module_is_active('Pos'))
                                    {{ __('Purchase') }}
                                @endif
                                {{ __(' Category') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#tax-settings" id="tax-tab"
                                class="list-group-item list-group-item-action border-0">{{ __('Tax') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#unit-settings" id="unit-tab"
                                class="list-group-item list-group-item-action border-0">{{ __('Unit') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="product_category-settings" class="">
                        <div class="">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-11">
                                                <h5 class="">
                                                    {{ __('Product & Services Category') }}
                                                </h5>
                                            </div>
                                            <div class="col-1 text-end">
                                                @can('category create')
                                                    <a  data-url="{{ route('category.create', ['type' => 0]) }}"
                                                        data-ajax-popup="true" data-bs-toggle="tooltip"
                                                        title="{{ __('Create') }}" title="{{ __('Create') }}"
                                                        data-title="{{ __('Create New Category') }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ti ti-plus"></i>
                                                    </a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th> {{ __('Category') }}</th>
                                                    <th scope="col">{{ __('Color') }}</th>
                                                    @if (Gate::check('category edit') || Gate::check('category delete'))
                                                        <th width="10%"> {{ __('Action') }}</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($product_categories as $category)
                                                    <tr>
                                                        <td class="font-style">{{ $category->name }}</td>
                                                        <td><span class="badge"
                                                                style="background: {{ $category->color }}">&nbsp;&nbsp;&nbsp;</span>
                                                        </td>

                                                        @if (Gate::check('category edit') || Gate::check('category delete'))
                                                            <td class="Action">
                                                                <span>
                                                                    @can('category edit')
                                                                        <div class="action-btn bg-info ms-2">
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center"
                                                                                data-url="{{ route('category.edit', $category->id) }}"
                                                                                data-ajax-popup="true"
                                                                                data-title="{{ __('Edit Product Category') }}"
                                                                                data-bs-toggle="tooltip"
                                                                                title="{{ __('Edit') }}"
                                                                                data-original-title="{{ __('Edit') }}">
                                                                                <i class="ti ti-pencil text-white"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endcan
                                                                    @can('category edit')
                                                                        <div class="action-btn bg-danger ms-2">
                                                                            {!! Form::open([
                                                                                'method' => 'DELETE',
                                                                                'route' => ['category.destroy', $category->id],
                                                                                'id' => 'delete-form-' . $category->id,
                                                                            ]) !!}
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                                data-bs-toggle="tooltip"
                                                                                title="{{ __('Delete') }}"
                                                                                data-original-title="{{ __('Delete') }}"
                                                                                data-confirm="{{ __('Are You Sure?') }}"
                                                                                data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                                data-confirm-yes="document.getElementById('delete-form-{{ $category->id }}').submit();">
                                                                                <i class="ti ti-trash text-white"></i>
                                                                            </a>
                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                    @endcan
                                                                </span>
                                                            </td>
                                                        @endif
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

                    <div id="income_category-settings" class="">
                        <div class="">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-11">
                                                <h5 class="">
                                                    {{ __('Invoice /Proposal') }}
                                                    @if (module_is_active('Account'))
                                                        {{ __('/Revenue') }}
                                                    @endif {{ __(' Category') }}
                                                </h5>
                                            </div>
                                            <div class="col-1 text-end">
                                                @can('category create')
                                                    <a
                                                        data-url="{{ route('category.create', ['type' => 1]) }}"
                                                        data-ajax-popup="true" data-bs-toggle="tooltip"
                                                        title="{{ __('Create') }}" title="{{ __('Create') }}"
                                                        data-title="{{ __('Create New Category') }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ti ti-plus"></i>
                                                    </a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th> {{ __('Category') }}</th>
                                                    <th scope="col">{{ __('Color') }}</th>
                                                    @if (Gate::check('category edit') || Gate::check('category delete'))
                                                        <th width="10%"> {{ __('Action') }}</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($income_categories as $category)
                                                    <tr>
                                                        <td class="font-style">{{ $category->name }}</td>
                                                        <td><span class="badge"
                                                                style="background: {{ $category->color }}">&nbsp;&nbsp;&nbsp;</span>
                                                        </td>
                                                        @if (Gate::check('category edit') || Gate::check('category delete'))
                                                            <td class="Action">
                                                                <span>
                                                                    @can('category edit')
                                                                        <div class="action-btn bg-info ms-2">
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center"
                                                                                data-url="{{ route('category.edit', $category->id) }}"
                                                                                data-ajax-popup="true"
                                                                                data-title="{{ __('Edit Product Category') }}"
                                                                                data-bs-toggle="tooltip"
                                                                                title="{{ __('Edit') }}"
                                                                                data-original-title="{{ __('Edit') }}">
                                                                                <i class="ti ti-pencil text-white"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endcan
                                                                    @can('category edit')
                                                                        <div class="action-btn bg-danger ms-2">
                                                                            {!! Form::open([
                                                                                'method' => 'DELETE',
                                                                                'route' => ['category.destroy', $category->id],
                                                                                'id' => 'delete-form-' . $category->id,
                                                                            ]) !!}
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                                data-bs-toggle="tooltip"
                                                                                title="{{ __('Delete') }}"
                                                                                data-original-title="{{ __('Delete') }}"
                                                                                data-confirm="{{ __('Are You Sure?') }}"
                                                                                data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                                data-confirm-yes="document.getElementById('delete-form-{{ $category->id }}').submit();">
                                                                                <i class="ti ti-trash text-white"></i>
                                                                            </a>
                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                    @endcan
                                                                </span>
                                                            </td>
                                                        @endif
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
                    <div id="expance_category-settings" class="">
                        <div class="">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-11">
                                                <h5 class="">
                                                    @if (module_is_active('Account') && module_is_active('Pos'))
                                                        {{ __('Bill / Purchase') }}
                                                    @elseif(module_is_active('Account'))
                                                        {{ __('Bill') }}
                                                    @elseif(module_is_active('Pos'))
                                                        {{ __('Purchase') }}
                                                    @endif
                                                    {{ __(' Category') }}
                                                </h5>
                                            </div>
                                            <div class="col-1 text-end">
                                                @can('category create')
                                                    <a
                                                        data-url="{{ route('category.create', ['type' => 2]) }}"
                                                        data-ajax-popup="true" data-bs-toggle="tooltip"
                                                        title="{{ __('Create') }}" title="{{ __('Create') }}"
                                                        data-title="{{ __('Create New Category') }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ti ti-plus"></i>
                                                    </a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th> {{ __('Category') }}</th>
                                                    <th scope="col">{{ __('Color') }}</th>
                                                    @if (Gate::check('category edit') || Gate::check('category delete'))
                                                        <th width="10%"> {{ __('Action') }}</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($expance_categories as $category)
                                                    <tr>
                                                        <td class="font-style">{{ $category->name }}</td>
                                                        <td><span class="badge"
                                                                style="background: {{ $category->color }}">&nbsp;&nbsp;&nbsp;</span>
                                                        </td>
                                                        @if (Gate::check('category edit') || Gate::check('category delete'))
                                                            <td class="Action">
                                                                <span>
                                                                    @can('category edit')
                                                                        <div class="action-btn bg-info ms-2">
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center"
                                                                                data-url="{{ route('category.edit', $category->id) }}"
                                                                                data-ajax-popup="true"
                                                                                data-title="{{ __('Edit Product Category') }}"
                                                                                data-bs-toggle="tooltip"
                                                                                title="{{ __('Edit') }}"
                                                                                data-original-title="{{ __('Edit') }}">
                                                                                <i class="ti ti-pencil text-white"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endcan
                                                                    @can('category edit')
                                                                        <div class="action-btn bg-danger ms-2">
                                                                            {!! Form::open([
                                                                                'method' => 'DELETE',
                                                                                'route' => ['category.destroy', $category->id],
                                                                                'id' => 'delete-form-' . $category->id,
                                                                            ]) !!}
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                                data-bs-toggle="tooltip"
                                                                                title="{{ __('Delete') }}"
                                                                                data-original-title="{{ __('Delete') }}"
                                                                                data-confirm="{{ __('Are You Sure?') }}"
                                                                                data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                                data-confirm-yes="document.getElementById('delete-form-{{ $category->id }}').submit();">
                                                                                <i class="ti ti-trash text-white"></i>
                                                                            </a>
                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                    @endcan
                                                                </span>
                                                            </td>
                                                        @endif
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

                    <div id="tax-settings" class="">
                        <div class="">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-11">
                                                <h5 class="">
                                                    {{ __('Tax') }}
                                                </h5>
                                            </div>
                                            <div class="col-1 text-end">
                                                @can('tax create')
                                                    <div class="float-end">
                                                        <a  data-url="{{ route('tax.create') }}"
                                                            data-ajax-popup="true" data-title="{{ __('Create Tax Rate') }}"
                                                            data-bs-toggle="tooltip" title="{{ __('Create') }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="ti ti-plus"></i>
                                                        </a>
                                                    </div>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table mb-0 ">
                                            <thead>
                                                <tr>
                                                <tr>
                                                    <th> {{ __('Tax Name') }}</th>
                                                    <th> {{ __('Rate %') }}</th>
                                                    @if (Gate::check('tax edit') || Gate::check('tax delete'))
                                                        <th width="10%"> {{ __('Action') }}</th>
                                                    @endif
                                                </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($taxes as $taxe)
                                                    <tr class="font-style">
                                                        <td>{{ $taxe->name }}</td>
                                                        <td>{{ $taxe->rate }}</td>
                                                        @if (Gate::check('tax edit') || Gate::check('tax delete'))
                                                            <td class="Action">
                                                                <span>
                                                                    @can('tax edit')
                                                                        <div class="action-btn bg-info ms-2">
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center"
                                                                                data-url="{{ route('tax.edit', $taxe->id) }}"
                                                                                data-ajax-popup="true"
                                                                                data-title="{{ __('Edit Tax Rate') }}"
                                                                                data-bs-toggle="tooltip"
                                                                                title="{{ __('Edit') }}"
                                                                                data-original-title="{{ __('Edit') }}">
                                                                                <i class="ti ti-pencil text-white"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endcan
                                                                    @can('tax delete')
                                                                        <div class="action-btn bg-danger ms-2">
                                                                            {!! Form::open([
                                                                                'method' => 'DELETE',
                                                                                'route' => ['tax.destroy', $taxe->id],
                                                                                'id' => 'delete-form-' . $taxe->id,
                                                                            ]) !!}
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                                data-bs-toggle="tooltip"
                                                                                title="{{ __('Delete') }}"
                                                                                data-original-title="{{ __('Delete') }}"
                                                                                data-confirm="{{ __('Are You Sure?') }}"
                                                                                data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                                data-confirm-yes="document.getElementById('delete-form-{{ $taxe->id }}').submit();">
                                                                                <i class="ti ti-trash text-white"></i>
                                                                            </a>
                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                    @endcan

                                                                </span>
                                                            </td>
                                                        @endif
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

                    <div id="unit-settings" class="">
                        <div class="">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-11">
                                                <h5 class="">
                                                    {{ __('Unit') }}
                                                </h5>
                                            </div>
                                            <div class="col-1 text-end">
                                                @can('unit cerate')
                                                    <div class="float-end">
                                                        <a  data-url="{{ route('units.create') }}"
                                                            data-ajax-popup="true" data-title="{{ __('Create New Unit') }}"
                                                            data-bs-toggle="tooltip" title="{{ __('Create') }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="ti ti-plus"></i>
                                                        </a>
                                                    </div>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table mb-0 " >
                                            <thead>
                                                <tr>
                                                    <th> {{ __('Unit') }}</th>
                                                    @if (Gate::check('unit edit') || Gate::check('unit delete'))
                                                        <th width="10%"> {{ __('Action') }}</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($units as $unit)
                                                    <tr>
                                                        <td>{{ $unit->name }}</td>
                                                        @if (Gate::check('unit edit') || Gate::check('unit delete'))
                                                            <td class="Action">
                                                                <span>
                                                                    @can('unit edit')
                                                                        <div class="action-btn bg-info ms-2">
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center"
                                                                                data-url="{{ route('units.edit', $unit->id) }}"
                                                                                data-ajax-popup="true"
                                                                                title="{{ __('Edit') }}"
                                                                                data-bs-toggle="tooltip"
                                                                                data-original-title="{{ __('Edit') }}">
                                                                                <i class="ti ti-pencil text-white"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endcan
                                                                    @can('unit delete')
                                                                        <div class="action-btn bg-danger ms-2">

                                                                            {!! Form::open([
                                                                                'method' => 'DELETE',
                                                                                'route' => ['units.destroy', $unit->id],
                                                                                'id' => 'delete-form-' . $unit->id,
                                                                            ]) !!}
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                                data-bs-toggle="tooltip"
                                                                                title="{{ __('Delete') }}"
                                                                                data-original-title="{{ __('Delete') }}"
                                                                                data-confirm="{{ __('Are You Sure?') }}"
                                                                                data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                                data-confirm-yes="document.getElementById('delete-form-{{ $unit->id }}').submit();">
                                                                                <i class="ti ti-trash text-white"></i>
                                                                            </a>
                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                    @endcan
                                                                </span>
                                                            </td>
                                                        @endif
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
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
@push('scripts')
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
@endpush
