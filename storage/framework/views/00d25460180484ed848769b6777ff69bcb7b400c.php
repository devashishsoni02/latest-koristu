
<?php if(!empty(\Auth::user()->avatar)): ?>
    <div class="avatar av-l" style="background-image: url('<?php echo e(get_file(Auth::user()->avatar)); ?>');">
    </div>
<?php else: ?>
    <div class="avatar av-l"
         style="background-image: url('<?php echo e(get_file('uploads/users-avatar/avatar.png')); ?>');">
    </div>
<?php endif; ?>
<p class="info-name"><?php echo e(config('chatify.name')); ?></p>
<div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation"><i class="ti ti-trash"></i> <?php echo e(__('Delete Conversation')); ?></a>
</div>

<div class="messenger-infoView-shared">
    <p class="messenger-title"><?php echo e(__('shared photos')); ?></p>
    <div class="shared-photos-list"></div>
</div>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/vendor/Chatify/layouts/info.blade.php ENDPATH**/ ?>