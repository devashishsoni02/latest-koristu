<div class="tab-pane fade" id="paypal-payment" role="tabpanel" aria-labelledby="paypal-payment">
    <form method="post" action="{{route('invoice.pay.with.paypal')}}" class="require-validation" id="payment-form">
        @csrf
        @if($type == 'invoice')
            <input type="hidden" name="type" value="invoice">
        @elseif ($type == 'salesinvoice')
            <input type="hidden" name="type" value="salesinvoice">
        @elseif ($type == 'retainer')
            <input type="hidden" name="type" value="retainer">
        @endif
        <div class="row">
            <div class="form-group col-md-12">
                <label for="amount">{{ __('Amount') }}</label>
                <div class="input-group">
                    <span class="input-group-prepend"><span
                            class="input-group-text">{{ !empty(company_setting('defult_currancy', $invoice->created_by,$invoice->workspace)) ? company_setting('defult_currancy', $invoice->created_by,$invoice->workspace) : '$' }}</span>
                    </span>
                    <input class="form-control" required="required" min="0"
                        name="amount" type="number"
                        value="{{ $invoice->getDue() }}" min="0"
                        step="0.01" max="{{ $invoice->getDue() }}"
                        id="amount">
                    <input type="hidden" value="{{ $invoice->id }}"
                        name="invoice_id">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="error" style="display: none;">
                    <div class='alert-danger alert'>
                        {{ __('Please correct the errors and try again.') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="text-end">
            <button type="button" class="btn  btn-light"
                data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button class="btn btn-primary"
                type="submit">{{ __('Make Payment') }}</button>
        </div>
    </form>
</div>
