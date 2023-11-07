
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="id" content="<?php echo e($id); ?>">
<meta name="messenger-color" content="<?php echo e($messengerColor); ?>">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<meta name="url" content="<?php echo e(url('').'/'.config('chatify.routes.prefix')); ?>" data-user="<?php echo e(Auth::user()->id); ?>">

<link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
<link href="<?php echo e(asset('css/chatify/style.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/chatify/'.$dark_mode.'.mode.css')); ?>" rel="stylesheet" />


<script src="<?php echo e(asset('js/chatify/font.awesome.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/chatify/autosize.js')); ?>"></script>
<script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>


<?php echo $__env->make('Chatify::layouts.messengerColor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/vendor/Chatify/layouts/headLinks.blade.php ENDPATH**/ ?>