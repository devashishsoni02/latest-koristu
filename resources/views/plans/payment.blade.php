@extends('layouts.main')
@section('page-title')
{{ __('Plans')}}
@endsection
@section('page-breadcrumb')
{{ __('Plans') }}
@endsection
@section('content')
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xl-3">
                <div class="sticky-top" style="top:30px">

                    <div class="card ">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            @if (module_is_active('Stripe') && admin_setting('stripe_is_on')=='on')
                                <a href="#stripe_payment"
                                    class="list-group-item list-group-item-action border-0 active">{{ __('Stripe') }}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9">
                {{-- stripe payment --}}
                @if (module_is_active('Stripe') && admin_setting('stripe_is_on')=='on')
                <div id="stripe_payment" class="card">
                    <form role="form" action="{{ route('stripe.plan.payment') }}" method="post" class="" id="stripe-payment-form">
                        @csrf
                        <div class="card-header">
                            <h5>{{ __('Stripe') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mt-1">
                                @if (module_is_active('Coupons'))
                                <div class="col-10">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Coupon Code') }}</label>
                                        <input type="text" id="stripe_coupon" name="coupon" class="form-control coupon" data-from="stripe" placeholder="{{ __('Enter Coupon Code') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mt-4">
                                        <a href="#" class="btn  btn-primary apply-coupon" data-from="stripe">{{ __('Apply') }}</a>
                                    </div>
                                </div>
                            @endif

                            </div>
                        </div>
                        <div class="card-footer text-end" >
                                <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                <button class="btn  btn-primary" type="submit" id="pay_with_stripe">
                                {{__('Checkout')}} ( <span class="coupon-stripe">{{ currency_format($plan->price) }} {{ admin_setting('defult_currancy') }}</span> )
                                </button>
                        </div>
                    </form>
                </div>
                @endif
                {{-- stripr payment end --}}



            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@if(isset($stripe_session))
    <script src="https://js.stripe.com/v3/"></script>
    <script>
    var stripe = Stripe('{{ admin_setting('stripe_key') }}');
    stripe.redirectToCheckout({
        sessionId: '{{ $stripe_session->id }}',
    }).then((result) => {
    });
    </script>
    <script>
            $(document).on('click', '.apply-coupon', function (e) {

            e.preventDefault();

            var ele = $(this);
            var coupon = $('#' + ele.attr('data-from') + '_coupon').val();

            applyCoupon(coupon, ele.attr('data-from'));
            });

            function applyCoupon(coupon_code, where) {
            if (coupon_code != null && coupon_code != '') {
                $.ajax({
                    url: '{{route('apply.coupon')}}',
                    datType: 'json',
                    data: {
                        plan_id: '{{ $plan->id }}',
                        coupon: coupon_code,
                        frequency: $('input[name="' + where + '_payment_frequency"]:checked').val()
                    },
                    success: function (data) {
                        if (data.is_success) {
                            $('.coupon-' + where).text(data.final_price);
                        } else {
                            $('.final-price').text(data.final_price);
                            toastrs('Error', data.message, 'error');
                        }
                    }
                })
            } else {
                toastrs('Error', '{{__('Invalid Coupon Code.')}}', 'error');
            }
            }
    </script>
@endif
@endpush
