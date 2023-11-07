@extends('layouts.main')
@section('page-title')
    {{ __('Invoice Create') }}
@endsection
@section('page-breadcrumb')
    {{ __('Invoice Create') }}
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.repeater.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var customerId = '{{ $customerId }}';
            if (customerId > 0) {
                $('#customer').val(customerId).change();
            }
        });
        $(document).on('change', '#customer', function() {
            $('#customer_detail').removeClass('d-none');
            $('#customer_detail').addClass('d-block');
            $('#customer-box').removeClass('d-block');
            $('#customer-box').addClass('d-none');
            var id = $(this).val();
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'id': id
                },
                cache: false,
                success: function(data) {
                    if (data != '') {
                        $('#customer_detail').html(data);
                    } else {
                        $('#customer-box').removeClass('d-none');
                        $('#customer-box').addClass('d-block');
                        $('#customer_detail').removeClass('d-block');
                        $('#customer_detail').addClass('d-none');
                    }

                },

            });
        });

        $(document).on('click', '#remove', function() {
            $('#customer-box').removeClass('d-none');
            $('#customer-box').addClass('d-block');
            $('#customer_detail').removeClass('d-block');
            $('#customer_detail').addClass('d-none');
        })
    </script>
        <Script>
            $(document).on('keyup', '.quantity', function () {
                var quntityTotalTaxPrice = 0;

                var el = $(this).parent().parent().parent().parent();

                var quantity = $(this).val();
                var price = $(el.find('.price')).val();
                var discount = $(el.find('.discount')).val();
                if(discount.length <= 0)
                {
                    discount = 0 ;
                }

                var totalItemPrice = (quantity * price) - discount;

                var amount = (totalItemPrice);


                var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
                var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
                $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

                $(el.find('.amount')).html(parseFloat(itemTaxPrice)+parseFloat(amount));

                var totalItemTaxPrice = 0;
                var itemTaxPriceInput = $('.itemTaxPrice');
                for (var j = 0; j < itemTaxPriceInput.length; j++) {
                    totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
                }


                var totalItemPrice = 0;
                var inputs_quantity = $(".quantity");

                var priceInput = $('.price');
                for (var j = 0; j < priceInput.length; j++) {
                    totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
                }

                var inputs = $(".amount");

                var subTotal = 0;
                for (var i = 0; i < inputs.length; i++) {
                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                }

                $('.subTotal').html(totalItemPrice.toFixed(2));
                $('.totalTax').html(totalItemTaxPrice.toFixed(2));

                $('.totalAmount').html((parseFloat(subTotal)).toFixed(2));
            })

            $(document).on('keyup change', '.price', function () {
                var el = $(this).parent().parent().parent().parent();
                var price = $(this).val();
                var quantity = $(el.find('.quantity')).val();
                if(quantity.length <= 0)
                {
                    quantity = 1 ;
                }
                var discount = $(el.find('.discount')).val();
                if(discount.length <= 0)
                {
                    discount = 0 ;
                }
                var totalItemPrice = (quantity * price)-discount;

                var amount = (totalItemPrice);

                var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
                var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
                $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

                $(el.find('.amount')).html(parseFloat(itemTaxPrice)+parseFloat(amount));

                var totalItemTaxPrice = 0;
                var itemTaxPriceInput = $('.itemTaxPrice');
                for (var j = 0; j < itemTaxPriceInput.length; j++) {
                    totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
                }


                var totalItemPrice = 0;
                var inputs_quantity = $(".quantity");
                var priceInput = $('.price');
                for (var j = 0; j < priceInput.length; j++) {
                    if(inputs_quantity[j].value <= 0)
                    {
                        inputs_quantity[j].value = 1 ;
                    }
                    totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
                }

                var inputs = $(".amount");

                var subTotal = 0;
                for (var i = 0; i < inputs.length; i++) {
                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                }

                $('.subTotal').html(totalItemPrice.toFixed(2));
                $('.totalTax').html(totalItemTaxPrice.toFixed(2));

                $('.totalAmount').html((parseFloat(subTotal)).toFixed(2));
            })

            $(document).on('keyup change', '.discount', function () {
                var el = $(this).parent().parent().parent();
                var discount = $(this).val();
                if(discount.length <= 0)
                {
                    discount = 0 ;
                }

                var price = $(el.find('.price')).val();
                var quantity = $(el.find('.quantity')).val();
                var totalItemPrice = (quantity * price) - discount;


                var amount = (totalItemPrice);


                var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
                var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
                $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

                $(el.find('.amount')).html(parseFloat(itemTaxPrice)+parseFloat(amount));

                var totalItemTaxPrice = 0;
                var itemTaxPriceInput = $('.itemTaxPrice');
                for (var j = 0; j < itemTaxPriceInput.length; j++) {
                    totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
                }


                var totalItemPrice = 0;
                var inputs_quantity = $(".quantity");

                var priceInput = $('.price');
                for (var j = 0; j < priceInput.length; j++) {
                    totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
                }

                var inputs = $(".amount");

                var subTotal = 0;
                for (var i = 0; i < inputs.length; i++) {
                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                }


                var totalItemDiscountPrice = 0;
                var itemDiscountPriceInput = $('.discount');

                for (var k = 0; k < itemDiscountPriceInput.length; k++) {
                    if (itemDiscountPriceInput[k].value == '') {
                            itemDiscountPriceInput[k].value = parseFloat(0);
                        }
                    totalItemDiscountPrice += parseFloat(itemDiscountPriceInput[k].value);
                }


                $('.subTotal').html(totalItemPrice.toFixed(2));
                $('.totalTax').html(totalItemTaxPrice.toFixed(2));

                $('.totalAmount').html((parseFloat(subTotal)).toFixed(2));
                $('.totalDiscount').html(totalItemDiscountPrice.toFixed(2));
            })
    </Script>

    @if (module_is_active('Account'))
        <script>
            $(document).on('change', '.item', function() {
                items($(this));
            });

            function items(data)
            {
                var in_type = $('#invoice_type').val();
                if (in_type == 'product') {
                    var iteams_id = data.val();
                    var url = data.data('url');
                    var el = data;
                    $.ajax({
                        url: url,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': jQuery('#token').val()
                        },
                        data: {
                            'product_id': iteams_id
                        },
                        cache: false,
                        success: function(data) {
                            var item = JSON.parse(data);
                            $(el.parent().parent().find('.quantity')).val(1);
                            if(item.product != null)
                            {
                                $(el.parent().parent().find('.price')).val(item.product.sale_price);
                                $(el.parent().parent().parent().find('.pro_description')).val(item.product.description);

                            }
                            else
                            {
                                $(el.parent().parent().find('.price')).val(0);
                                $(el.parent().parent().parent().find('.pro_description')).val('');

                            }

                            var taxes = '';
                            var tax = [];

                            var totalItemTaxRate = 0;

                            if (item.taxes == 0) {
                                taxes += '-';
                            } else {
                                for (var i = 0; i < item.taxes.length; i++) {
                                    taxes += '<span class="badge bg-primary p-2 px-3 rounded mt-1 mr-1">' +
                                        item.taxes[i].name + ' ' + '(' + item.taxes[i].rate + '%)' +
                                        '</span>';
                                    tax.push(item.taxes[i].id);
                                    totalItemTaxRate += parseFloat(item.taxes[i].rate);
                                }
                            }
                            var itemTaxPrice = 0;
                            if(item.product != null)
                            {
                                var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (item.product
                                .sale_price * 1));
                            }
                            $(el.parent().parent().find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));
                            $(el.parent().parent().find('.itemTaxRate')).val(totalItemTaxRate.toFixed(2));
                            $(el.parent().parent().find('.taxes')).html(taxes);
                            $(el.parent().parent().find('.tax')).val(tax);
                            $(el.parent().parent().find('.unit')).html(item.unit);
                            $(el.parent().parent().find('.discount')).val(0);
                            $(el.parent().parent().find('.amount')).html(item.totalAmount);


                            var inputs = $(".amount");
                            var subTotal = 0;
                            for (var i = 0; i < inputs.length; i++) {
                                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                            }

                            var totalItemPrice = 0;
                            var priceInput = $('.price');
                            for (var j = 0; j < priceInput.length; j++) {
                                totalItemPrice += parseFloat(priceInput[j].value);
                            }

                            var totalItemTaxPrice = 0;
                            var itemTaxPriceInput = $('.itemTaxPrice');
                            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
                                if(item.product != null)
                                {
                                    $(el.parent().parent().find('.amount')).html(parseFloat(item.totalAmount)+parseFloat(itemTaxPriceInput[j].value));
                                }
                            }



                            var totalItemDiscountPrice = 0;
                            var itemDiscountPriceInput = $('.discount');

                            for (var k = 0; k < itemDiscountPriceInput.length; k++) {

                                totalItemDiscountPrice += parseFloat(itemDiscountPriceInput[k].value);
                            }

                            $('.subTotal').html(totalItemPrice.toFixed(2));
                            $('.totalTax').html(totalItemTaxPrice.toFixed(2));
                            $('.totalAmount').html((parseFloat(totalItemPrice) - parseFloat(totalItemDiscountPrice) + parseFloat(totalItemTaxPrice)).toFixed(2));

                        },
                    });
                }
            }
        </script>
    @endif
    @if (module_is_active('Taskly'))
        <script>
            $(document).on('change', '.item', function() {
                var iteams_id = $(this).val();
                var el = $(this);
                $(el.parent().parent().find('.price')).val(0);
                $(el.parent().parent().find('.amount')).html(0);
                $(el.parent().parent().find('.taxes')).val(0);
                var proposal_type =  $("#proposal_type").val();
                if (proposal_type == 'project') {
                    $("#tax_project").change();
                }
            });

            $(document).on('change', '#tax_project', function() {
                var tax_id = $(this).val();
                if (tax_id.length != 0) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('get.taxes') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            tax_id: tax_id,
                        },
                        beforeSend: function() {
                            $("#loader").removeClass('d-none');
                        },
                        success: function(response) {
                            var response = jQuery.parseJSON(response);
                            if (response != null) {
                                $("#loader").addClass('d-none');
                                var TaxRate = 0;
                                if (response.length > 0) {
                                    $.each(response, function(i) {
                                        TaxRate = parseInt(response[i]['rate']) + TaxRate;
                                    });
                                }
                                $(".itemTaxRate").val(TaxRate);
                                $(".price").change();
                            } else {
                                $(".itemTaxRate").val(0);
                                $(".price").change();
                                $('.section_div').html('');
                                toastrs('Error', 'Something went wrong please try again !', 'error');
                            }
                        },
                    });
                }
                else
                {
                    $(".itemTaxRate").val(0);
                    $('.taxes').html("");
                    $(".price").change();
                    $("#loader").addClass('d-none');
                }
            });
        </script>
    @endif

    @if (module_is_active('Account'))
        <script>
            $(document).ready(function() {
                SectionGet('product');
            });
        </script>
    @elseif (module_is_active('Taskly'))
        <script>
            $(document).ready(function() {
                SectionGet('project');
            });
        </script>
    @endif
    <script>
        $(document).on('click', '[data-repeater-delete]', function () {
            $(".price").change();
            $(".discount").change();
        });
    </script>
    <script>
        $(document).on('change', "[name='invoice_type_radio']", function() {
            var val = $(this).val();
            $(".invoice_div").empty();
            if (val == 'product') {
                $(".discount_apply_div").removeClass('d-none');
                $(".tax_project_div").addClass('d-none');
                $(".discount_project_div").addClass('d-none');

                var label =
                    `{{ Form::label('category_id', __('Category'), ['class' => 'form-label']) }} {{ Form::select('category_id', $category, null, ['class' => 'form-control', 'required' => 'required']) }}`;
                $(".invoice_div").append(label);
                $("#invoice_type").val('product');
                SectionGet(val);
            } else if (val == 'project') {
                $(".discount_apply_div").addClass('d-none');
                $(".tax_project_div").removeClass('d-none');
                $(".discount_project_div").removeClass('d-none');

                var label =
                    ` {{ Form::label('project', __('Project'), ['class' => 'form-label']) }} {{ Form::select('project', $projects, null, ['class' => 'form-control', 'required' => 'required']) }}`
                $(".invoice_div").append(label);
                $("#invoice_type").val('project');
                var project_id = $("#project").val();
                SectionGet(val, project_id);
            }

            choices();
        });

        function SectionGet(type = 'product', project_id = "0",title = 'Project') {
            $.ajax({
                type: 'post',
                url: "{{ route('invoice.section.type') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: type,
                    project_id: project_id,
                    acction: 'create',
                },
                beforeSend: function() {
                    $("#loader").removeClass('d-none');
                },
                success: function(response) {
                    if (response != false) {
                        $('.section_div').html(response.html);
                        $("#loader").addClass('d-none');
                        $('.pro_name').text(title)
                        // for item SearchBox ( this function is  custom Js )
                        JsSearchBox();
                    } else {
                        $('.section_div').html('');
                        toastrs('Error', 'Something went wrong please try again !', 'error');
                    }
                },
            });
        }
        $(document).on('change', "#project", function() {
            var title = $(this).find('option:selected').text();
            var project_id = $(this).val();
            SectionGet('project', project_id,title);

        });
    </script>
@endpush
@section('content')
    <div class="row">
        {{ Form::open(['url' => 'invoice', 'class' => 'w-100', 'enctype' => 'multipart/form-data']) }}
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        @if (module_is_active('Account'))
            <input type="hidden" name="invoice_type" id="invoice_type" value="product">
        @elseif (module_is_active('Taskly'))
            <input type="hidden" name="invoice_type" id="invoice_type" value="project">
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group" id="customer-box">
                                {{ Form::label('customer_id', __('Customer'), ['class' => 'form-label']) }}
                                {{ Form::select('customer_id', $customers, $customerId, ['class' => 'form-control ', 'id' => 'customer', 'data-url' => route('invoice.customer'), 'required' => 'required', 'placeholder' => 'Select Customer']) }}
                                @if (empty($customers->count()))
                                    <div class=" text-xs">
                                        {{ __('Please create Customer/Client first.') }}<a
                                            @if (module_is_active('Account')) href="{{ route('customer.index') }}"  @else href="{{ route('users.index') }}" @endif><b>{{ __('Create Customer/Client') }}</b></a>
                                    </div>
                                @endif
                            </div>
                            <div id="customer_detail" class="d-none">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="row">
                                @if (module_is_active('Account') && module_is_active('Taskly'))
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="d-flex radio-check">
                                                <div class="form-check form-check-inline form-group col-md-3">
                                                    <input type="radio" id="product" value="product"
                                                        name="invoice_type_radio" class="form-check-input code"
                                                        checked="checked">
                                                    <label class="custom-control-label "
                                                        for="product">{{ __('Item Wise') }}</label>
                                                </div>
                                                <div class="form-check form-check-inline form-group col-lg-3 col-md-6">
                                                    <input type="radio" id="project1" value="project"
                                                        name="invoice_type_radio" class="form-check-input code">
                                                    <label class="custom-control-label"
                                                        for="project1">{{ __('Project Wise') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('issue_date', __('Issue Date'), ['class' => 'form-label']) }}
                                        <div class="form-icon-user">
                                            {{ Form::date('issue_date',date('Y-m-d'), ['class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Select Issue Date']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('due_date', __('Due Date'), ['class' => 'form-label']) }}
                                        <div class="form-icon-user">
                                            {{ Form::date('due_date',date('Y-m-d'), ['class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Select Due Date']) }}

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('invoice_number', __('Invoice Number'), ['class' => 'form-label']) }}
                                        <div class="form-icon-user">
                                            <input type="text" class="form-control" value="{{ $invoice_number }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group invoice_div">
                                        @if (module_is_active('Account'))
                                            {{ Form::label('category_id', __('Category'), ['class' => 'form-label']) }}
                                            {{ Form::select('category_id', $category, null, ['class' => 'form-control ', 'required' => 'required']) }}
                                            @if (empty($category->count()))
                                                <div class=" text-xs">
                                                    {{ __('Please add constant category. ') }}<a
                                                        href="{{ route('category.index') }}"><b>{{ __('Add Category') }}</b></a>
                                                </div>
                                            @endif
                                        @elseif (module_is_active('Taskly'))
                                            {{ Form::label('project', __('Project'), ['class' => 'form-label']) }}
                                            {{ Form::select('project', $projects, null, ['class' => 'form-control ', 'required' => 'required']) }}
                                        @endif
                                    </div>
                                </div>
                                @if (module_is_active('Taskly'))
                                    <div
                                        class="col-md-6 tax_project_div {{ module_is_active('Account') ? 'd-none' : '' }}">
                                        <div class="form-group">
                                            {{ Form::label('tax_project', __('Tax'), ['class' => 'form-label']) }}
                                            {{ Form::select('tax_project[]', $taxs, null, ['class' => 'form-control get_tax multi-select choices', 'data-toggle' => 'select2', 'multiple' => 'multiple', 'id' => 'tax_project', 'data-placeholder' => 'Select Tax']) }}
                                        </div>
                                    </div>
                                @endif
                                @if(module_is_active('CustomField') && !$customFields->isEmpty())
                                    <div class="col-md-12">
                                        <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                                            @include('customfield::formBuilder')
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="loader" class="card card-flush">
            <div class="card-body">
                <div class="row">
                    <img class="loader" src="{{ asset('public/images/loader.gif') }}" alt="">
                </div>
            </div>
        </div>
        <div class="col-12 section_div">

        </div>
        <div class="modal-footer">
            <input type="button" value="{{ __('Cancel') }}" onclick="location.href = '{{ route('invoice.index') }}';"
                class="btn btn-light ">
            <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary mx-3">
        </div>
        {{ Form::close() }}

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/jquery-searchbox.js') }}"></script>
@endpush
