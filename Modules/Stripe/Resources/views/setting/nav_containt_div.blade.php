@can('stripe manage')
    <div class="card" id="stripe-sidenav">
        {{ Form::open(['route' => 'stripe.setting.store', 'enctype' => 'multipart/form-data']) }}

        <div class="card-header">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <h5 class="">{{ __('Stripe') }}</h5>
                    @if (Auth::user()->type == 'company')
                        <small>{{ __('These details will be used to collect invoice payments. Each invoice will have a payment button based on the below configuration.') }}</small>
                    @elseif(Auth::user()->type == 'super admin')
                        <small>{{ __('These details will be used to collect subscription plan payments.Each subscription plan will have a payment button based on the below configuration.') }}</small>
                    @endif
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 text-end">
                    <div class="form-check form-switch custom-switch-v1 float-end">
                        <input type="checkbox" name="stripe_is_on" class="form-check-input input-primary" id="stripe_is_on"
                            {{ company_setting('stripe_is_on') == 'on' ? ' checked ' : '' }}>
                        <label class="form-check-label" for="stripe_is_on"></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stripe_key" class="form-label">{{ __('Stripe Key') }}</label>
                        <input class="form-control stripe_webhook" placeholder="{{ __('Stripe Key') }}" name="stripe_key"
                            type="text" value="{{ company_setting('stripe_key') }}"
                            {{ company_setting('stripe_is_on') == 'on' ? '' : ' disabled' }} id="stripe_key">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stripe_secret" class="form-label">{{ __('Stripe Secret Key') }}</label>
                        <input class="form-control stripe_webhook" placeholder="{{ __('Stripe Secret Key') }}"
                            name="stripe_secret" type="text" value="{{ company_setting('stripe_secret') }}"
                            {{ company_setting('stripe_is_on') == 'on' ? '' : ' disabled' }} id="stripe_secret">
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer text-end">
            <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="{{ __('Save Changes') }}">
        </div>
        {{ Form::close() }}
    </div>
    @push('scripts')
        <script>
            $(document).on('click', '#stripe_is_on', function() {
                if ($('#stripe_is_on').prop('checked')) {
                    $(".stripe_webhook").removeAttr("disabled");
                } else {
                    $('.stripe_webhook').attr("disabled", "disabled");
                }
            });
        </script>
    @endpush

@endcan
