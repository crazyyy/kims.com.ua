<?php $__env->startSection('main'); ?>
    <?php echo $__env->make('partials.navigation', array( 'user' => $user ), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('partials.sidebar', array( 'user' => $user ), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="content-wrapper">
        <?php echo $__env->make('partials.content_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <section class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>