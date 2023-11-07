@extends('layouts.main')
@section('page-title')
{{__('Manage Product & Services')}}
@endsection
@section('page-breadcrumb')
{{ __('Product And Services') }}
@endsection
@section('page-action')
@can('product&service create')
<div>
        @stack('addButtonHook')
        @can('product&service import')
            <a href="#"  class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="{{__('Product & Service Import')}}" data-url="{{ route('product-service.file.import') }}"  data-toggle="tooltip" title="{{ __('Import') }}"><i class="ti ti-file-import"></i>
            </a>
        @endcan
        <a href="{{ route('product-service.grid') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-title="{{__('Grid View')}}" title="{{ __('Grid View') }}"><i class="ti ti-layout-grid text-white"></i></a>

        <a href="{{ route('category.index') }}"data-size="md"  class="btn btn-sm btn-primary" data-bs-toggle="tooltip"data-title="{{__('Setup')}}" title="{{__('Setup')}}"><i class="ti ti-settings"></i></a>

        <a href="{{ route('productstock.index') }}"data-size="md"  class="btn btn-sm btn-primary" data-bs-toggle="tooltip"data-title="{{__(' Product Stock')}}" title="{{__('Product Stock')}}"><i class="ti ti-shopping-cart"></i></a>

        <a  class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{__('Create')}}" data-ajax-popup="true" data-size="lg" data-title="{{ __('Create New Product') }}" data-url="{{ route('product-service.create') }}">
            <i class="ti ti-plus"></i>
        </a>

    </div>
@endcan
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class=" multi-collapse mt-2" id="multiCollapseExample1">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => ['product-service.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="btn-box">
                                {{ Form::label('category', __('Category'), ['class' => 'text-type form-label d-none']) }}
                                {{ Form::select('category',$category,!empty($_GET['category'])? $_GET['category']:null, ['class' => 'form-control ','required' => 'required','placeholder'=>'Select Category']) }}
                            </div>
                        </div>
                        <div class="col-auto float-end ms-2">
                            <a  class="btn btn-sm btn-primary"
                               onclick="document.getElementById('product_service').submit(); return false;"
                               data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                            </a>
                            <a href="{{ route('product-service.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                               title="{{ __('Reset') }}">
                                <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off"></i></span>
                            </a>
                        </div>

                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style">
                <h5></h5>
                <div class="table-responsive">
                    <table class="table mb-0 pc-dt-simple" id="products">
                        <thead>
                        <tr>
                            <th >{{__('Image')}}</th>
                            <th >{{__('Name')}}</th>
                            <th >{{__('Sku')}}</th>
                            <th>{{__('Sale Price')}}</th>
                            <th>{{__('Purchase Price')}}</th>
                            <th>{{__('Tax')}}</th>
                            <th>{{__('Category')}}</th>
                            <th>{{__('Unit')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Type')}}</th>
                            @if (Gate::check('product&service delete') || Gate::check('product&service edit'))
                                <th>{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($productServices as $productService)
                            <?php
                                if(check_file($productService->image) == false){
                                    $path = asset('Modules/ProductService/Resources/assets/image/img01.jpg');
                                }else{
                                    $path = get_file($productService->image);
                                }
                            ?>
                            <tr class="font-style">
                                <td>
                                    <a href="{{ $path }}" target="_blank">
                                        <img src=" {{ $path }} " class="wid-75 rounded me-3">
                                    </a>
                                </td>
                                <td class="text-center">{{ $productService->name}}</td>
                                <td class="text-center">{{ $productService->sku }}</td>
                                <td>{{ currency_format_with_sym($productService->sale_price) }}</td>
                                <td>{{ currency_format_with_sym($productService->purchase_price )}}</td>
                                <td>
                                    @if(!empty($productService->tax_id))
                                        @php
                                            $taxes=Modules\ProductService\Entities\Tax::tax($productService->tax_id);
                                        @endphp

                                        @foreach($taxes as $tax)
                                            {{ !empty($tax)?$tax->name:''  }}<br>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ !empty($productService->category)?$productService->category->name:'' }}</td>
                                <td>{{ !empty($productService->unit())?$productService->unit()->name:'' }}</td>
                                @if($productService->type == 'product')
                                        <td>{{$productService->quantity}}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                <td>{{ $productService->type }}</td>
                                @if (Gate::check('product&service delete') || Gate::check('product&service edit'))
                                   <td class="Action">
                                    @if(module_is_active('Pos'))
                                        <div class="action-btn bg-warning ms-2">
                                            <a  class="mx-3 btn btn-sm align-items-center" data-url="{{ route('productservice.detail',$productService->id) }}"
                                            data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Warehouse Details')}}" data-title="{{__('Warehouse Details')}}">
                                                <i class="ti ti-eye text-white"></i>
                                            </a>
                                        </div>
                                    @endif
                                        @can('product&service edit')
                                            <div class="action-btn bg-info ms-2">
                                                <a  class="mx-3 btn btn-sm align-items-center" data-url="{{ route('product-service.edit',$productService->id) }}" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Edit Product')}}">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                        @endcan
                                        @can('product&service delete')
                                            <div class="action-btn bg-danger ms-2">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['product-service.destroy', $productService->id],'id'=>'delete-form-'.$productService->id]) !!}
                                                <a  class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm" data-bs-toggle="tooltip" title="{{__('Delete')}}"><i class="ti ti-trash text-white text-white"></i></a>
                                                {!! Form::close() !!}
                                            </div>
                                        @endcan
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
