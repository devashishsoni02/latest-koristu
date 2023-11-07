<script src="<?php echo e(asset('js/pusher.min.js')); ?>"></script>
<script >
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = false;

  var pusher = new Pusher("<?php echo e(config('chatify.pusher.key')); ?>", {
    encrypted: true,
    cluster: "<?php echo e(config('chatify.pusher.options.cluster')); ?>",
    authEndpoint: '<?php echo e(route("pusher.auth")); ?>',
    auth: {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }
  });
</script>
<script src="<?php echo e(asset('js/chatify/code.js')); ?>"></script>
<script>
  // Messenger global variable - 0 by default
  messenger = "<?php echo e(@$id); ?>";
</script>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/vendor/Chatify/layouts/footerLinks.blade.php ENDPATH**/ ?>