{{ Form::open(array('url' => 'bank-account')) }}
<div class= modal-body>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('holder_name', __('Bank Holder Name'), ['class' => 'form-label']) }}
                {{ Form::text('holder_name', null, ['class' => 'form-control','required' => 'required','placeholder' => __('Enter Bank Holder Name')]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('bank_name', __('Bank Name'), ['class' => 'form-label']) }}
                {{ Form::text('bank_name', null, ['class' => 'form-control','required' => 'required','placeholder' => __('Enter Bank Name')]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('account_number', __('Account Number'), ['class' => 'form-label']) }}
                {{ Form::text('account_number', null, ['class' => 'form-control','required' => 'required','placeholder' => __('Enter Account Number')]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('opening_balance', __('Opening Balance'), ['class' => 'form-label']) }}
                {{ Form::number('opening_balance', '', array('class' => 'form-control','required'=>'required',"min"=>"0",'placeholder' => __('Enter Opening Balance'))) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('contact_number', __('Contact Number'), ['class' => 'form-label']) }}
                {{ Form::text('contact_number', '', array('class' => 'form-control','required'=>'required','placeholder' => __('Enter Contact Number'))) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('bank_address', __('Bank Address'), ['class' => 'form-label']) }}
                {{ Form::textarea('bank_address', null, ['class' => 'form-control', 'placeholder' => __('Enter Bank Address'),'rows'=>'3' , 'required' => 'required']) }}
            </div>
        </div>
    </div>
</div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
        {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
    </div>

{{ Form::close() }}
