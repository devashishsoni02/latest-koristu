{{ Form::model($employee, ['route' => ['employee.salary.update', $employee->id], 'method' => 'POST']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('salary_type', __('Payslip Type'), ['class' => 'form-label']) }}
                {{ Form::select('salary_type', $payslip_type, null, ['class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Select Payslip Type']) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('salary', __('Salary'), ['class' => 'form-label']) }}
                {{ Form::number('salary', null, ['class' => 'form-control ', 'required' => 'required', 'min' => '0']) }}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
</div>
{{ Form::close() }}
