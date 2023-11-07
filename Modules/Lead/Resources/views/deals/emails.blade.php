
{{ Form::open(array('route' => ['deals.emails.store',$deal->id])) }}
    <div class="modal-body">
        <div class="text-end">
            @if (module_is_active('AIAssistant'))
                @include('aiassistant::ai.generate_ai_btn',['template_module' => 'deal_email','module'=>'Lead'])
            @endif
        </div>
        <div class="row">
            <div class="col-6 form-group">
                {{ Form::label('to', __('Mail To'),['class'=>'col-form-label']) }}
                {{ Form::email('to', null, array('class' => 'form-control','required'=>'required')) }}
            </div>
            <div class="col-6 form-group">
                {{ Form::label('subject', __('Subject'),['class'=>'col-form-label']) }}
                {{ Form::text('subject', null, array('class' => 'form-control','required'=>'required')) }}
            </div>
            <div class="col-12 form-group">
                {{ Form::label('description', __('Description'),['class'=>'col-form-label']) }}
                {{ Form::textarea('description',null, array('class' => 'tox-target pc-tinymce-2')) }}
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{__('Close')}}</button>
        <button type="submit" class="btn  btn-primary">{{__('Create')}}</button>
    </div>
{{ Form::close() }}

