@extends('layouts.main')
@section('page-title')
    {{ __('Proposal Edit') }}
@endsection
@section('page-breadcrumb')
    {{ __('Proposal') }}
@endsection
@push('scripts')
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/jquery.repeater.min.js') }}"></script>
<script>
     $(document).ready(function () {
           $("input[name='proposal_type_radio']:checked").trigger('change');
        });
        $(document).on('click', '[data-repeater-delete]', function ()
        {
            var el = $(this).parent().parent();
            var id = $(el.find('.id')).val();

            $.ajax({
                url: '{{route('proposal.product.destroy')}}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'id': id
                },
                cache: false,
                success: function (data) {
                    if (data.error) {
                        toastrs('Error', data.error, 'error');
                    } else {
                        toastrs('Success', data.success, 'success');
                    }
                },
                error: function (data) {
                    toastrs('Error','{{ __("something went wrong please try again") }}', 'error');
                },
            });
        });
</script>

    <script>
        $(document).on('change', '#customer', function () {
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
                success: function (data) {
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

        $(document).on('click', '#remove', function () {
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

        $(document).on('change', '.item', function()
        {
            items($(this));
        });
        function items(data)
        {
            var in_type = $('#proposal_type').val();
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

                            }else{
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
                                taxes += '<span class="badge bg-primary p-2 px-3 rounded mt-1 mr-1 product_tax">' +
                                    item.taxes[i].name + ' ' + '(' + item.taxes[i].rate + '%)' +
                                    '</span>';
                                tax.push(item.taxes[i].id);
                                totalItemTaxRate += parseFloat(item.taxes[i].rate);
                            }
                        }
                        var itemTaxPrice = 0;
                        if(item.product != null){

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
                            if(item.product != null){
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
    @if (module_is_active('Taskly') )
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
            } else {
                $(".itemTaxRate").val(0);
                $(".price").change();
                $('.taxes').html("");
                $("#loader").addClass('d-none');
            }
        });
    </script>
    @endif

<script>
      function SectionGet(type = 'product',project_id = "0",title = 'Project'){
            var acction = $("#acction_type").val();
            $.ajax({
                    type: 'post',
                    url: "{{ route('proposal.section.type') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        type: type,
                        project_id: project_id,
                        acction: acction,
                        proposal_id: {{$proposal->id}},
                    },
                    beforeSend: function () {
                            $("#loader").removeClass('d-none');
                        },
                    success: function (response)
                    {
                        if(response != false)
                        {
                            $('.section_div').html(response.html);
                            $("#loader").addClass('d-none');
                            $('.pro_name').text(title)
                             // for item SearchBox ( this function is  custom Js )
                             JsSearchBox();
                        }
                        else
                        {
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
<script>
     $(document).on('change',"[name='proposal_type_radio']", function() {
            var val = $(this).val();
            $(".proposal_div").empty();
            var proposal_module = '{{$proposal->proposal_module}}';
            if(val == 'product')
            {
                $(".discount_apply_div").removeClass('d-none');
                $(".tax_project_div").addClass('d-none');
                $(".discount_project_div").addClass('d-none');

                var label = `{{ Form::label('category_id', __('Category'),['class'=>'form-label']) }} {{ Form::select('category_id', $category,null, array('class' => 'form-control','required'=>'required')) }}`;
                $(".proposal_div").append(label);
                $("#proposal_type").val('product');

                if(proposal_module == 'account')
                {
                    $("#acction_type").val('edit');
                }
                else
                {
                    $("#acction_type").val('create');
                }
                SectionGet(val);
            }
            else if(val == 'project')
            {
                $(".discount_apply_div").addClass('d-none');
                $(".tax_project_div").removeClass('d-none');

                $(".discount_project_div").removeClass('d-none');

                var label  = ` {{ Form::label('project', __('Project'),['class'=>'form-label']) }} {{ Form::select('project',$projects,$proposal->category_id, array('class' => 'form-control','required'=>'required')) }}`
                $(".proposal_div").append(label);
                $("#proposal_type").val('project');
                var project_id = $("#project").val();

                if(proposal_module == 'taskly')
                {
                    $("#acction_type").val('edit');
                }
                else
                {
                    $("#acction_type").val('create');
                }

                SectionGet(val,project_id);
            }

            choices();
        });
</script>

@if (module_is_active('Account') && $proposal->proposal_module =='account')
<script>
        $(document).ready(function () {
            SectionGet('product');
    });
</script>
@elseif (module_is_active('Taskly') && $proposal->proposal_module =='taskly')
<script>
        $(document).ready(function () {
            $("#project").trigger("change");
    });
</script>
@endif
<script>
    setTimeout(() => {
        $('#issue_date').trigger('click');
    }, 1500);
 </script>
@endpush
@section('content')
    <div class="row">
        {{ Form::model($proposal, array('route' => array('proposal.update', $proposal->id), 'method' => 'PUT','class'=>'w-100', 'enctype' => 'multipart/form-data')) }}
        @if ( $proposal->proposal_module =='account')
            <input type="hidden" name="proposal_type" id="proposal_type" value="product">
        @elseif ( $proposal->proposal_module =='taskly' )
            <input type="hidden" name="proposal_type" id="proposal_type" value="project">
        @endif
        <input type="hidden" name="acction_type" id="acction_type" value="edit">

        <div class="col-12">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="customer-box">
                                    {{ Form::label('customer_id', __('Customer'),['class'=>'form-label']) }}
                                    {{ Form::select('customer_id', $customers,null, array('class' => 'form-control','id'=>'customer','data-url'=>route('proposal.customer'),'required'=>'required','placeholder'=>"Select Customer")) }}
                            </div>
                            <div id="customer_detail" class="d-none">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                @if(module_is_active('Account') && module_is_active('Taskly'))
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('type', __('Type'),['class'=>'form-label']) }}
                                            <div class="d-flex radio-check">
                                                <div class="form-check form-check-inline form-group col-md-3">
                                                    <input type="radio" id="product" value="product" name="proposal_type_radio" class="form-check-input code" {{ ($proposal->proposal_module =='account') ? 'checked="checked"' :''}}>
                                                    <label class="custom-control-label " for="product">{{__('Item Wise')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline form-group col-md-3 ">
                                                    <input type="radio" id="project1" value="project" name="proposal_type_radio" class="form-check-input code " {{ ($proposal->proposal_module =='taskly') ? 'checked="checked"' :''}}>
                                                    <label class="custom-control-label " for="project1">{{__('Project Wise')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('issue_date', __('Issue Date'),['class'=>'form-label']) }}
                                        <div class="form-icon-user">
                                            {{Form::date('issue_date',null,array('class'=>'form-control','required'=>'required'))}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group proposal_div">
                                       @if ( module_is_active('Account'))
                                            {{ Form::label('category_id', __('Category'),['class'=>'form-label']) }}
                                            {{ Form::select('category_id', $category,null, array('class' => 'form-control ','required'=>'required')) }}
                                       @elseif (module_is_active('Taskly'))
                                            {{ Form::label('project', __('Project'),['class'=>'form-label']) }}
                                            {{ Form::select('project',$projects,$proposal->category_id, array('class' => 'form-control ','required'=>'required')) }}
                                       @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('proposal_number', __('Proposal Number'),['class'=>'form-label']) }}
                                        <div class="form-icon-user">
                                            <input type="text" class="form-control" value="{{$proposal_number}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                @if (module_is_active('Taskly'))
                                    <div class="col-md-6 tax_project_div {{ (module_is_active('Account') ? "d-none" : '')}}">
                                        <div class="form-group">
                                            {{ Form::label('tax_project', __('Tax'),['class'=>'form-label']) }}
                                            {{ Form::select('tax_project[]',$taxs,!empty($proposal->items->first()->tax) ? explode(",",$proposal->items->first()->tax) :null, array('class' => 'form-control get_tax multi-select choices','multiple'=>'multiple','id' => 'tax_project')) }}

                                        </div>
                                    </div>
                                @endif
                                @if(module_is_active('CustomField') && !$customFields->isEmpty())
                                    <div class="col-md-12">
                                        <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                                            @include('customfield::formBuilder',['fildedata' => !empty($proposal->customField) ? $proposal->customField : ''])
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
        <div class="modal-footer mb-3">
            <input type="button" value="{{__('Cancel')}}" onclick="location.href = '{{route('proposal.index')}}';" class="btn btn-light mx-3">
            <input type="submit" value="{{__('Save Changes')}}" class="btn btn-primary">
        </div>
        {{ Form::close() }}
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/jquery-searchbox.js') }}"></script>
@endpush

