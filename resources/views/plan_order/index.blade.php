@extends('layouts.main')
@section('page-title')
    {{__('Order')}}
@endsection
@section('page-breadcrumb')
    {{__('Order')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable pc-dt-simple" id="test">
                            <thead>
                            <tr>
                                <th>{{__('Order Id')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Plan Name')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Payment Type')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Coupon')}}</th>
                                <th class="text-center">{{__('Invoice')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->order_id}}</td>
                                    <td>{{ company_datetime_formate($order->created_at)}}</td>
                                    <td>{{$order->user_name}}</td>
                                    <td>{{$order->plan_name}}</td>
                                    <td>{{$order->price.' '.$order->price_currency}}</td>
                                    <td>{{$order->payment_type}}</td>
                                    <td>
                                        @if($order->payment_status == 'succeeded')
                                            <span class="bg-success p-1 px-3 rounded text-white">{{ucfirst($order->payment_status)}}</span>
                                        @else
                                            <span class="bg-danger p-2 px-3 rounded text-white">{{ucfirst($order->payment_status)}}</span>
                                        @endif
                                    </td>
                                    @if(module_is_active('Coupons'))
                                        <td>{{!empty($order->total_coupon_used)? !empty($order->total_coupon_used->coupon_detail)?$order->total_coupon_used->coupon_detail->code:'-':'-'}}</td>
                                    @else
                                    <td>-</td>
                                    @endif

                                    <td class="text-center">
                                        @if($order->receipt != 'free coupon' && $order->payment_type == 'STRIPE')
                                            <a href="{{$order->receipt}}" data-bs-toggle="tooltip"  data-bs-original-title="{{ __('Invoice')}}" target="_blank" class="">
                                                <i class="ti ti-file-invoice"></i>
                                            </a>
                                        @elseif($order->payment_type == 'Bank Transfer')
                                            <a href="{{ !empty($order->receipt) ? (check_file($order->receipt)) ? get_file($order->receipt) : '#!' : '#!' }}" data-bs-toggle="tooltip"  data-bs-original-title="{{ __('Invoice')}}" target="_blank" class="">
                                                <i class="ti ti-file-invoice"></i>
                                            </a>
                                        @elseif($order->receipt == 'free coupon')
                                            <p>{{__('Used 100 % discount coupon code.')}}</p>
                                        @elseif($order->payment_type == 'Manually')
                                            <p>{{__('Manually plan upgraded by super admin')}}</p>
                                        @else
                                            -
                                        @endif
                                    </td>
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
