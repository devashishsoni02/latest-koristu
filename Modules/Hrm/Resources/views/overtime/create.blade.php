{{ Form::open(['url' => 'overtime', 'method' => 'post']) }}
{{ Form::hidden('employee_id', $employee->id, []) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('title', __('Title'), ['class' => 'form-label']) }}
                {{ Form::text('title', null, ['class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Enter Title']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('number_of_days', __('Number of days'), ['class' => 'form-label']) }}
                {{ Form::number('number_of_days', null, ['class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Enter Number of days', 'min' => '0']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('hours', __('Hours'), ['class' => 'form-label']) }}
                {{ Form::number('hours', null, ['class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Enter Hours', 'min' => '0']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('rate', __('Rate'), ['class' => 'form-label']) }}
                {{ Form::number('rate', null, ['class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Enter Rate', 'min' => '0']) }}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
</div>
{{ Form::close() }}
