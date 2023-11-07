{{ Form::open(array('route' => array('review_update', $key), 'method'=>'post', 'enctype' => "multipart/form-data")) }}
    <div class="modal-body">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('Header Tag', __('Header Tag'), ['class' => 'form-label']) }}
                    {{ Form::text('review_header_tag',$review['review_header_tag'], ['class' => 'form-control ', 'placeholder' => __('Enter Header Tag'),'required'=>'required']) }}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('Heading', __('Heading'), ['class' => 'form-label']) }}
                    {{ Form::text('review_heading',$review['review_heading'], ['class' => 'form-control ', 'placeholder' => __('Enter Heading'),'required'=>'required']) }}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('Description', __('Description'), ['class' => 'form-label']) }}
                    {{ Form::textarea('review_description',$review['review_description'], ['class' => 'ckdescription form-control', 'placeholder' => __('Enter Description'), 'id'=>'','required'=>'required']) }}
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group">
                    {{ Form::label('Live Demo button Link', __('Live Demo button Link'), ['class' => 'form-label']) }}
                    {{ Form::text('review_live_demo_link',$review['review_live_demo_link'], ['class' => 'form-control', 'placeholder' => __('Enter Link')]) }}
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('Live Demo Button Text', __('Live Demo Button Text'), ['class' => 'form-label']) }}
                    {{ Form::text('review_live_demo_button_text',$review['review_live_demo_button_text'], ['class' => 'form-control', 'placeholder' => __('Enter Button Text')]) }}
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