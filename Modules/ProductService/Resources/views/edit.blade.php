{{ Form::model($productService, ['route' => ['product-service.update', $productService->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="text-end">
        @if (module_is_active('AIAssistant'))
            @include('aiassistant::ai.generate_ai_btn',['template_module' => 'product','module'=>'ProductService'])
        @endif
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
                <div class="form-icon-user">
                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('sku', __('SKU'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
                <div class="form-icon-user">
                    {{ Form::text('sku', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('sale_price', __('Sale Price'), ['class' => 'form-label']) }}<span
                    class="text-danger">*</span>
                <div class="form-icon-user">
                    {{ Form::number('sale_price', null, ['class' => 'form-control', 'required' => 'required', 'step' => '0.01']) }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('purchase_price', __('Purchase Price'), ['class' => 'form-label']) }}<span
                    class="text-danger">*</span>
                <div class="form-icon-user">
                    {{ Form::number('purchase_price', null, ['class' => 'form-control', 'required' => 'required', 'step' => '0.01']) }}
                </div>
            </div>
        </div>

        <div class="form-group  col-md-6">
            {{ Form::label('tax_id', __('Tax'), ['class' => 'form-label']) }}
            {{ Form::select('tax_id[]', $tax, null, ['class' => 'form-control choices', 'id' => 'choices-multiple1', 'multiple' => '']) }}
        </div>

        <div class="form-group  col-md-6">
            {{ Form::label('category_id', __('Category'), ['class' => 'form-label']) }}<span
                class="text-danger">*</span>
            {{ Form::select('category_id', $category, null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('unit_id', __('Unit'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('unit_id', $unit, null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('image', __('Image'), ['class' => 'col-form-label']) }}
            <div class="choose-files ">
                <label for="image">

                    <input type="file" class="form-control file" name="image" id="image"
                        data-filename="image_update"
                        onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    @php
                        if (check_file($productService->image) == false) {
                            $path = asset('Modules/ProductService/Resources/assets/image/img01.jpg');
                        } else {
                            $path = get_file($productService->image);
                        }
                    @endphp
                    <img id="blah" src="{{ $path }}" alt="your image" width="100" height="100" />
                </label>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="d-block form-label">{{ __('Type') }}</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input type" id="customRadio5" name="type"
                                value="product" @if ($productService->type == 'product') checked @endif
                                onclick="hide_show(this)">
                            <label class="custom-control-label form-label"
                                for="customRadio5">{{ __('Product') }}</label>
                        </div>
                    </div>
                    <div class="col-md-6" id="ksk">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input type services" id="customRadio6"
                                name="type" value="service" @if ($productService->type == 'service') checked @endif
                                onclick="hide_show(this)">
                            <label class="custom-control-label form-label"
                                for="customRadio6">{{ __('Service') }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6 quantity">
            {{ Form::label('quantity', __('Quantity'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
            {{ Form::text('quantity', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        @if(module_is_active('CustomField') && !$customFields->isEmpty())
            <div class="col-md-12">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    @include('customfield::formBuilder',['fildedata' => !empty($productService->customField) ? $productService->customField : ''])
                </div>
            </div>
        @endif

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}

{{ Form::close() }}
<script>
    $(document).ready(function() {
        if ($("input[value='service']").is(":checked")) {;
            $('.quantity').addClass('d-none')
            $('.quantity').removeClass('d-block');
        }
    });

    $(document).on('click', '.type', function() {
        var type = $(this).val();
        if (type == 'product') {
            $('.quantity').removeClass('d-none')
            $('.quantity').addClass('d-block');
        } else {
            $('.quantity').addClass('d-none')
            $('.quantity').removeClass('d-block');
        }
    });
</script>
