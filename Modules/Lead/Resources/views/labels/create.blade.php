{{ Form::open(array('url' => 'labels')) }}
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-12">
                {{ Form::label('name', __('Label Name'),['class'=>'col-form-label']) }}
                {{ Form::text('name', '', array('class' => 'form-control','required'=>'required')) }}
            </div>
            <div class="form-group col-12">
                {{ Form::label('pipeline_id', __('Pipeline'),['class'=>'col-form-label']) }}
                {{ Form::select('pipeline_id', $pipelines,null, array('class' => 'form-control select2','required'=>'required')) }}
            </div>
            <div class="form-group col-12">
                {{ Form::label('name', __('Color'),['class'=>'col-form-label']) }}
                <div class="row gutters-xs">
                    @foreach($colors as $color)
                        <div class="col-auto">
                            <label class="colorinput">
                                <input name="color" type="radio" value="{{$color}}" class="colorinput-input" required>
                                <span class="colorinput-color bg-{{$color}}"></span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{__('Close')}}</button>
        <button type="submit" class="btn  btn-primary">{{__('Create')}}</button>
    </div>

{{ Form::close() }}
