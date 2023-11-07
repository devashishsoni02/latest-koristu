@extends('layouts.main')
@section('page-title')
    {{ __('Manage Product & Services') }}
@endsection
@section('title')
    {{ __('Product & Services') }}
@endsection
@section('page-breadcrumb')
    {{ __('Product & Services') }}
@endsection
@section('page-action')
    <div>
        @can('product&service import')
            <a href="#"  class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="{{__('Product & Service Import')}}" data-url="{{ route('product-service.file.import') }}"  data-toggle="tooltip" title="{{ __('Import') }}"><i class="ti ti-file-import"></i>
            </a>
        @endcan
        <a href="{{ route('product-service.index') }}" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip"
            title="{{ __('List View') }}">
            <i class="ti ti-list text-white"></i>
        </a>
        <a href="{{ route('category.index') }}"data-size="md"  class="btn btn-sm btn-primary" data-bs-toggle="tooltip"data-title="{{__('Setup')}}" title="{{__('Setup')}}"><i class="ti ti-settings"></i></a>

        <a href="{{ route('productstock.index') }}"data-size="md"  class="btn btn-sm btn-primary" data-bs-toggle="tooltip"data-title="{{__(' Product Stock')}}" title="{{__('Product Stock')}}"><i class="ti ti-shopping-cart"></i></a>

        @can('product&service create')
            <a  class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{ __('Create') }}"
                data-ajax-popup="true" data-size="lg" data-title="{{ __('Create New Product') }}"
                data-url="{{ route('product-service.create') }}">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>
@endsection
@section('filter')
@endsection
@section('content')
    <div class="filters-content">
        <div class="col-sm-12">
            <div class=" multi-collapse mt-2" id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['route' => ['product-service.grid'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'), ['class' => 'text-type form-label d-none']) }}
                                    {{ Form::select('category', $category, !empty($_GET['category']) ? $_GET['category'] : null, ['class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Select Category']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2">
                                <a  class="btn btn-sm btn-primary"
                                    onclick="document.getElementById('product_service').submit(); return false;"
                                    data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('product-service.grid') }}" class="btn btn-sm btn-danger"
                                    data-bs-toggle="tooltip" title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off"></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row grid">
            @isset($productServices)
                @foreach ($productServices as $productService)
                    <div class="col-md-6 col-xl-3 All {{ $productService->status }}">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <div class="d-flex align-items-center">
                                    <?php
                                    if (check_file($productService->image) == false) {
                                        $path = asset('Modules/ProductService/Resources/assets/image/img01.jpg');
                                    } else {
                                        $path = get_file($productService->image);
                                    }
                                    ?>
                                    <td>
                                        <a href="{{ $path }}" target="_blank">
                                            <img src=" {{ $path }}" class=" me-3"
                                                style="border-radius: 10px;
                                            max-width: 50px !important;">
                                        </a>
                                    </td>

                                    <h5 class="mb-0">
                                        <a  title="{{ $productService->name }}"
                                            class="">{{ $productService->name }}</a>
                                    </h5>
                                </div>
                                <div class="card-header-right">
                                    <div class="btn-group card-option">

                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @if (module_is_active('Pos'))
                                                    <a  class="dropdown-item"
                                                        data-url="{{ route('productservice.detail', $productService->id) }}"
                                                        data-ajax-popup="true" data-size="lg"
                                                        data-title="{{ __('Warehouse Details') }}">
                                                        <i class="ti ti-eye"></i> <span>{{ __('Details') }}</span>
                                                    </a>
                                            @endif
                                            @can('product&service edit')
                                                <a  class="dropdown-item" data-ajax-popup="true" data-size="lg"
                                                    data-title="{{ __('Edit Product') }}"
                                                    data-url="{{ route('product-service.edit', [$productService->id]) }}">
                                                    <i class="ti ti-pencil"></i> <span>{{ __('Edit') }}</span>
                                                </a>
                                            @endcan
                                            @can('product&service delete')
                                                <form id="delete-form-{{ $productService->id }}"
                                                    action="{{ route('product-service.destroy', [$productService->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <a
                                                        class="dropdown-item text-danger delete-popup bs-pass-para show_confirm"
                                                        data-confirm="{{ __('Are You Sure?') }}"
                                                        data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                        data-confirm-yes="delete-form-{{ $productService->id }}">
                                                        <i class="ti ti-trash"></i><span>{{ __('Delete') }}</span>
                                                    </a>
                                                    @method('DELETE')
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-2 justify-content-between">
                                    <div class="col-auto"><span
                                            class="badge rounded-pill bg-success">{{ !empty($productService->category) ? $productService->category->name : '' }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <p class="mb-0"class="text-center">{{ $productService->sku }}</p>
                                    </div>
                                </div>
                                <div class="card mb-0 mt-3">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-4">
                                                <h6 class="mb-0">{{ $productService->quantity }}</h6>
                                                <p class="text-muted text-sm mb-0">{{ __('Quantity') }}</p>
                                            </div>
                                            <div class="col-4">
                                                <h6 class="mb-0 text-center">

                                                    @if (!empty($productService->tax_id))
                                                        @php
                                                            $taxes = Modules\ProductService\Entities\Tax::tax($productService->tax_id);
                                                        @endphp

                                                        @foreach ($taxes as $tax)
                                                            {{ !empty($tax) ? $tax->name : '' }}<br>
                                                        @endforeach
                                                    @else
                                                        -
                                                    @endif
                                                </h6>
                                                <p class="text-muted text-sm mb-0 text-center">{{ __('Tax') }}</p>
                                            </div>

                                            <div class="col-4 text-end">
                                                <h6 class="mb-0">{{ $productService->type }}</h6>
                                                <p class="text-muted text-sm mb-0">{{ __('Type') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-0 mt-3">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <h6 class="mb-0">{{ currency_format_with_sym($productService->sale_price) }}</h6>
                                                <p class="text-muted text-sm mb-0">{{ __('Sale Price') }}</p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-0">{{ currency_format_with_sym($productService->purchase_price) }}</h6>
                                                <p class="text-muted text-sm mb-0">{{ __('Purchase Price') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset


            @auth('web')
                @can('product&service create')
                        <div class="col-md-3 All">
                            <a  class="btn-addnew-project " style="padding: 90px 10px;" data-ajax-popup="true"
                                data-size="lg" data-title="{{ __('Create New Product') }}"
                                data-url="{{ route('product-service.create') }}">
                                <div class="bg-primary proj-add-icon">
                                    <i class="ti ti-plus"></i>
                                </div>
                                <h6 class="mt-4 mb-2">{{ __('Add Product') }}</h6>
                                <p class="text-muted text-center">{{ __('Click here to add New Product') }}</p>
                            </a>
                        </div>
                @endcan
            @endauth

        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ Module::asset('Sales:Resources/assets/js/letter.avatar.js') }}"></script>

@endpush
