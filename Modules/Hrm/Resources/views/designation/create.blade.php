{{ Form::open(['url' => 'designation', 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('department_id', !empty(company_setting('hrm_department_name')) ? company_setting('hrm_department_name') : __('Department'), ['class' => 'form-label']) }}
                {{ Form::select('department_id', $departments, null, ['class' => 'form-control', 'placeholder' => __('Select '.(!empty(company_setting('hrm_department_name')) ? company_setting('hrm_department_name') : __('Department'))), 'required' => 'required']) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Designation Name')]) }}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
</div>
{{ Form::close() }}
