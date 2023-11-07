{{ Form::model($team_task, ['route' => ['team_tasks.update', $team_task->id], 'method' => 'PUT']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('title', __('Title'), ['class' => 'form-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control font-style', 'required' => 'required']) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('description', __('Descreption'), ['class' => 'form-label']) }}
            {{ Form::text('description', null, ['class' => 'form-control font-style']) }}
        </div>

        <div class="form-group col-md-12">
            <label class="col-form-label">{{ __('Assign To') }}</label>
            <select class="multi-select" multiple="multiple" id="assign_to" name="assign_to[]" required>
                @foreach ($users as $u)
                    <option @if (in_array($u->id, $team_task->assign_to)) selected @endif value="{{ $u->id }}">
                        {{ $u->name }} - {{ $u->email }}</option>
                @endforeach
            </select>
            <p class="text-danger d-none" id="user_validation">{{ __('Assign To filed is required.') }}</p>
        </div>

        <div class="form-group col-md-12">
            <label class="col-form-label">{{ __('Day') }}</label>
            <select class="multi-select" multiple="multiple" id="days" name="days" required>
                @foreach ($days as $u)
                <option @if(in_array($u->id,$team_task->days)) selected @endif value="{{$u->id}}">{{$u->name}}</option>
                @endforeach
            </select>
            <p class="text-danger d-none" id="user_validation">{{ __('Assign To filed is required.') }}</p>
        </div>

        <div class="form-group col-md-12">
            <label class="col-form-label">{{ __('Months') }}</label>
            <select class="multi-select" multiple="multiple" id="months" name="months" required>
                @foreach ($months as $u)
                <option @if(in_array($u->id,$team_task->months)) selected @endif value="{{$u->id}}">{{$u->name}}</option>
                @endforeach
            </select>
            <p class="text-danger d-none" id="user_validation">{{ __('Assign To filed is required.') }}</p>
        </div>

        <div class="form-group col-md-12">
            <label class="col-form-label">{{ __('Date') }}</label>
            <select class="multi-select" multiple="multiple" id="dates" name="dates" required>
                @foreach ($dates as $u)
                <option @if(in_array($u->id,$team_task->dates)) selected @endif value="{{$u->id}}">{{$u->name}}</option>
                @endforeach
            </select>
            <p class="text-danger d-none" id="user_validation">{{ __('Assign To filed is required.') }}</p>
        </div>
        
    </div>
</div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}
