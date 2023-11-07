{{ Form::open(['url' => 'leads', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="text-end">
        @if (module_is_active('AIAssistant'))
            @include('aiassistant::ai.generate_ai_btn', ['template_module' => 'lead', 'module' => 'Lead'])
        @endif
    </div>
    @if (module_is_active('CustomField') && !$customFields->isEmpty())
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#tab-1" role="tab"
                    aria-controls="pills-home" aria-selected="true">{{ __('Lead Detail') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#tab-2" role="tab"
                    aria-controls="pills-profile" aria-selected="false">{{ __('Custom Fields') }}</a>
            </li>
        </ul>
    @endif
    <div class="tab-content tab-bordered">
        <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
            <div class="row">
                <div class="col-6 form-group">
                    {{ Form::label('subject', __('Subject'), ['class' => 'col-form-label']) }}
                    {{ Form::text('subject', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>

                <div class="col-6 form-group">
                    {{ Form::label('user_id', __('User'), ['class' => 'col-form-label']) }}
                    {{ Form::select('user_id', $users, null, ['class' => 'form-control select2', 'required' => 'required']) }}
                    @if (count($users) == 1)
                        <div class="text-muted text-xs">
                            {{ __('Please create new users') }} <a href="{{ route('users') }}">{{ __('here') }}</a>.
                        </div>
                    @endif
                </div>
                <div class="col-6 form-group">
                    {{ Form::label('name', __('Name'), ['class' => 'col-form-label']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
                <div class="col-6 form-group">
                    {{ Form::label('email', __('Email'), ['class' => 'col-form-label']) }}
                    {{ Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
                <div class="col-6 form-group">
                    {{ Form::label('phone', __('Phone No'), ['class' => 'col-form-label']) }}
                    {{ Form::text('phone', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>

                <!-- CODE FOR COUNTRY DROPDOWNS ADDED BY HEMANT -->

                <div class="col-6 form-group">
                    {{ Form::label('countries', __('Country'), ['class' => 'col-form-label']) }}
                    {{ Form::select('countries', $countries, null, ['class' => 'form-control countries', 'required' => 'required']) }}
                </div>
                <div class="col-6 form-group">
                    {{ Form::label('source', __('Source'), ['class' => 'col-form-label']) }}
                    {{ Form::select('source', $source, null, ['class' => 'form-control ', 'required' => 'required']) }}
                </div>

            </div>
        </div>
        @if (module_is_active('CustomField') && !$customFields->isEmpty())
            <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                <div class="col-md-6">
                    @include('customfield::formBuilder')
                </div>
            </div>
        @endif
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
    <button type="submit" class="btn  btn-primary">{{ __('Create') }}</button>
</div>

{{ Form::close() }}
