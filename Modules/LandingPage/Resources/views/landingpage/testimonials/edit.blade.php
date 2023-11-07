{{Form::model(null, array('route' => array('testimonials_update', $key), 'method' => 'POST','enctype' => "multipart/form-data")) }}

    <div class="modal-body">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Title', __('Title'), ['class' => 'form-label']) }}
                    {{ Form::text('testimonials_title',$testimonial['testimonials_title'], ['class' => 'form-control ','required'=>'required', 'placeholder' => __('Enter Title')]) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Star', __('Star'), ['class' => 'form-label']) }}
                    {{ Form::number('testimonials_star',$testimonial['testimonials_star'], ['class' => 'form-control ', 'min'=>'1', 'max'=>'5','required'=>'required', 'placeholder' => __('Enter Star')]) }}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('Description', __('Description'), ['class' => 'form-label']) }}
                    {{ Form::textarea('testimonials_description', $testimonial['testimonials_description'], ['class' => 'summernote-simple form-control', 'placeholder' => __('Enter Description'), 'id'=>'summernote-simple','required'=>'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('User', __('User'), ['class' => 'form-label']) }}
                    {{ Form::text('testimonials_user',$testimonial['testimonials_user'], ['class' => 'form-control ', 'placeholder' => __('Enter User Name'),'required'=>'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Designation', __('Designation'), ['class' => 'form-label']) }}
                    {{ Form::text('testimonials_designation',$testimonial['testimonials_designation'], ['class' => 'form-control ', 'placeholder' => __('Enter Designation'),'required'=>'required']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('User Avtar', __('User Avtar'), ['class' => 'form-label']) }}
                    <input type="file" name="testimonials_user_avtar" class="form-control">
                </div>
            </div>


        </div>
    </div>
    <div class="modal-footer">
        <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
        <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
    </div>

{{ Form::close() }}
<script>
    if ($(".summernote-simple").length) {
         $('.summernote-simple').summernote({
             dialogsInBody: !0,
             minHeight: 200,
             toolbar: [
                 ['style', ['style']],
                 ["font", ["bold", "italic", "underline", "clear", "strikethrough"]],
                 ['fontname', ['fontname']],
                 ['color', ['color']],
                 ["para", ["ul", "ol", "paragraph"]],
             ]
         });
     }
 </script>