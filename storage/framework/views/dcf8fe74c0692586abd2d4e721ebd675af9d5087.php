<?php $__env->startSection('assets.top'); ?>
    @parent
    <script src="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/ckeditor/ckeditor.js'); ?>"></script>

    <script src="<?php echo asset('assets/components/sysTranslit/js/jquery.synctranslit.min.js'); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>