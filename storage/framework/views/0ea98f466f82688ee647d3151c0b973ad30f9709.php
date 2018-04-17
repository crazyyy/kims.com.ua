<?php $__env->startSection('content'); ?>
    <div><?php echo app('translator')->get('front_messages.admin email message about new feedback'); ?></div>

    <br>
	<div><b><?php echo app('translator')->get('labels.city'); ?>:</b> <?php echo $city; ?></div>
    <div><b><?php echo app('translator')->get('labels.user'); ?>:</b> <?php echo $fio; ?></div>
    <div><b><?php echo app('translator')->get('labels.phone'); ?>:</b> <?php echo $phone; ?></div>
    <div><b><?php echo app('translator')->get('labels.email'); ?>:</b> <?php echo $email; ?></div>
    <div><b><?php echo app('translator')->get('labels.message'); ?>:</b> <?php echo $user_message; ?></div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>