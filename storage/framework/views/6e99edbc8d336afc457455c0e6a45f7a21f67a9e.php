<!DOCTYPE html>
<html>
<head>

    <?php echo $__env->make('partials.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->yieldPushContent('assets.top'); ?>

</head>
<body>

<?php /*page*/ ?>

<div id="game"></div>

<div class="preloader" data-active>
    <div class="preloader__wrapper">
        <div class="preloader__loader"></div>
        <div class="preloader__text"><?php echo trans('front_labels.loading'); ?></div>
    </div>
</div>

<?php echo $__env->make('partials.modules.popup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials.adv', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('partials.city', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('partials.eco', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials.contacts_popup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="wrapper">

    <?php echo $__env->make('partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div id="js-fullpage">

        <?php echo $__env->make('pages.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->make('pages.about', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->make('pages.services', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->make('pages.contacts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="modals"></div>

</div>

<?php /*page*/ ?>

<?php echo $__env->make('partials.foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>