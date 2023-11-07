{{Form::model($workSpace,array('route' => array('workspace.update', $workSpace->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="form-group">
        {{ Form::label('name', __('Name'), ['class' => 'col-form-label']) }}
        {{ Form::text('name', null, ['class' => 'form-control','required'=>'required','placeholder' => __('Enter Workspace Name')]) }}
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    {{Form::submit(__('Update'),array('class'=>'btn  btn-primary'))}}
</div>
{{ Form::close() }}
