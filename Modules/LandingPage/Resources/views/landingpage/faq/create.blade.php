{{ Form::open(array('route' => 'faq_store', 'method'=>'post', 'enctype' => "multipart/form-data")) }}
    <div class="modal-body">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('question', __('Question'), ['class' => 'form-label']) }}
                    {{ Form::text('faq_questions',null, ['class' => 'form-control ', 'placeholder' => __('Enter Question'),'required'=>'required']) }}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('answer', __('Answer'), ['class' => 'form-label']) }}
                    {{ Form::textarea('faq_answer', null, ['class' => 'summernote-simple form-control', 'placeholder' => __('Enter Answer'), 'id'=>'summernote-simple','required'=>'required'])}}
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
