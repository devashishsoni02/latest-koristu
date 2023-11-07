{{Form::model(null, array('route' => array('feature_update', $key), 'method' => 'POST','enctype' => "multipart/form-data")) }}
<div class="modal-body">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('Heading', __('Heading'), ['class' => 'form-label']) }}
                {{ Form::text('feature_heading',$feature['feature_heading'], ['class' => 'form-control ', 'placeholder' => __('Enter Heading'),'required'=>'required'])  }}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('Description', __('Description'), ['class' => 'form-label']) }}
                {{ Form::textarea('feature_description', $feature['feature_description'], ['class' => 'ckdescription form-control', 'placeholder' => __('Enter Description'), 'id'=>'','required'=>'required']) }}
            </div>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                {{ Form::label('More', __('More Details Link'), ['class' => 'form-label']) }}
                {{ Form::text('feature_more_details_link',$feature['feature_more_details_link'], ['class' => 'form-control ', 'placeholder' => __('Enter Details Link'),'required'=>'required']) }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('More Details Link Button Text', __('More Details Link Button Text'), ['class' => 'form-label']) }}
                {{ Form::text('feature_more_details_button_text',$feature['feature_more_details_button_text'], ['class' => 'form-control', 'placeholder' => __('Enter Button Text')]) }}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('Logo', __('Logo'), ['class' => 'form-label']) }}
                <div class="logo-content mt-4 pb-5">
                    <img id="image" src="{{ get_file($feature['feature_logo'])}}"
                        class="small-logo"  style="filter: drop-shadow(2px 3px 7px #011C4B);">
                </div>
                <input type="file" name="feature_logo" class="form-control" required>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}

<script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
 <script src="{{ asset('Modules/LandingPage/Resources/assets/js/editorplaceholder.js') }}"></script>
 <script>
     $(document).ready(function() {
         $.each($('.ckdescription'), function(i, editor) {
             CKEDITOR.replace(editor, {
                 // contentsLangDirection: 'rtl',
                 extraPlugins: 'editorplaceholder',
                 editorplaceholder: editor.placeholder
             });
         });
     });
 </script>