<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <?php echo Form::model($model, array('enctype'=>'multipart/form-data', 'role' => 'form', 'method' => 'put', 'class' => 'form-horizontal', 'route' => array('admin.user.update', $model->id))); ?>


                <?php echo $__env->make('user.partials._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo Form::close(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.editable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>