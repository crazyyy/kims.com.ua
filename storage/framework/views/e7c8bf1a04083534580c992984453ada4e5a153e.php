<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <?php echo Form::open(array('enctype'=>'multipart/form-data', 'route' => 'admin.user.store', 'class' => 'form-horizontal')); ?>


                <?php echo $__env->make('user.partials._form', ['without_password_change' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo Form::close(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.editable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>