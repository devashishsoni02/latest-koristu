<?php echo e(Form::open(['route' => ['send.test.mail'], 'enctype' => 'multipart/form-data', 'id' => 'test-mail-form'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name" class="form-label"><?php echo e(__('Email')); ?></label>
                <input class="form-control" placeholder="<?php echo e(__('Enter Email')); ?>" required="required" name="email"
                    type="text" id="name">
                <input type="hidden" name="mail_driver" value="<?php echo e($data['mail_driver']); ?>" />
                <input type="hidden" name="mail_host" value="<?php echo e($data['mail_host']); ?>" />
                <input type="hidden" name="mail_port" value="<?php echo e($data['mail_port']); ?>" />
                <input type="hidden" name="mail_username" value="<?php echo e($data['mail_username']); ?>" />
                <input type="hidden" name="mail_password" value="<?php echo e($data['mail_password']); ?>" />
                <input type="hidden" name="mail_from_address" value="<?php echo e($data['mail_from_address']); ?>" />
                <input type="hidden" name="mail_encryption" value="<?php echo e($data['mail_encryption']); ?>" />
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <button class="btn btn-primary pull-right" type="button" id="test-send-mail"><?php echo e(__('send')); ?></button>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/settings/test_mail.blade.php ENDPATH**/ ?>