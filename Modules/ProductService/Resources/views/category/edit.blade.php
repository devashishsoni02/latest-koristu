{{ Form::model($category, ['route' => ['category.update', $category->id], 'method' => 'PUT']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('name', __('Category Name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control font-style', 'required' => 'required']) }}
        </div>
       
        <div class="form-group col-md-12">
            {{ Form::label('color', __('Category Color'), ['class' => 'form-label']) }}
            {{ Form::color('color', null, ['class' => 'form-control jscolor', 'required' => 'required']) }}
            <p class="small">{{ __('For chart representation') }}</p>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}
