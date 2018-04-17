<?php $__env->startSection('assets.top'); ?>
    @parent

    <link rel="stylesheet" href="<?php echo asset('assets/components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css'); ?>"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('assets.bottom'); ?>
    @parent

    <script src="<?php echo asset('assets/components/bootstrap-switch/dist/js/bootstrap-switch.min.js'); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>