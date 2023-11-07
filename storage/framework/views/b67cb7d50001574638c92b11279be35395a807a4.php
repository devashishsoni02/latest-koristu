<div class="messenger-sendCard">
    <form id="message-form" method="POST" action="<?php echo e(route('send.message')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <label><i style="margin-top: 65%" class="fas fa-paperclip fa-sm"></i><input disabled='disabled' type="file" class="upload-attachment" name="file" accept=".<?php echo e(implode(', .',config('chatify.attachments.allowed_images'))); ?>, .<?php echo e(implode(', .',config('chatify.attachments.allowed_files'))); ?>"/></label>
        <textarea style="height: 39px; width: 92%; padding: 9px;" readonly='readonly' name="message" class="m-send app-scroll" placeholder="Type a message.."></textarea>
        <button disabled='disabled'><i class="fas fa-paper-plane fa-xs text-primary"></i></button>
    </form>
</div>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/vendor/Chatify/layouts/sendForm.blade.php ENDPATH**/ ?>