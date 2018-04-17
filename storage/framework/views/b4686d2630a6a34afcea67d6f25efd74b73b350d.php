<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo Meta::render(); ?>


        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo asset('assets/components/bootstrap/dist/css/bootstrap.min.css'); ?>"/>

        <?php /*Glyphs*/ ?>
        <link rel="stylesheet" href="<?php echo asset('assets/themes/admin/vendor/whhg-font/css/whhg.css'); ?>"/>
        <?php /*Font-Awesome*/ ?>
        <link rel="stylesheet" href="<?php echo asset('assets/components/font-awesome/css/font-awesome.min.css'); ?>"/>
        <?php /*IonIcon*/ ?>
        <link rel="stylesheet" href="<?php echo asset('assets/components/ionicons/css/ionicons.min.css'); ?>"/>

        <link rel="stylesheet" href="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/pace/pace.min.css'); ?>"/>

        <link rel="stylesheet" href="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/select2/select2.min.css'); ?>"/>

        <link rel="stylesheet" href="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/iCheck/all.css'); ?>"/>

        <link rel="stylesheet" href="<?php echo Theme::asset('vendor/adminlte/plugins/datatables/dataTables.bootstrap.css'); ?>"/>

        <link rel="stylesheet" href="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.css'); ?>"/>

        <?php /*AdminLTE*/ ?>
        <link rel="stylesheet" href="<?php echo asset('assets/themes/admin/vendor/adminlte/dist/css/AdminLTE.min.css'); ?>"/>
        <link rel="stylesheet" href="<?php echo asset('assets/themes/admin/vendor/adminlte/dist/css/skins/_all-skins.min.css'); ?>"/>

        <link rel="stylesheet" href="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/datepicker/datepicker3.css'); ?>"/>

        <link rel="stylesheet" href="<?php echo asset('assets/components/jquery-ui/themes/smoothness/jquery-ui.min.css'); ?>"/>

        <link rel="stylesheet" href="<?php echo asset('packages/barryvdh/elfinder/css/elfinder.min.css'); ?>"/>

        <link rel="stylesheet" href="<?php echo Theme::asset('css/styles.css', null, true); ?>"/>

        <script src="<?php echo asset('assets/components/jquery/dist/jquery.min.js'); ?>"></script>

        <script src="<?php echo asset('assets/components/jquery-ui/jquery-ui.min.js'); ?>"></script>

        <script src="<?php echo asset('packages/barryvdh/elfinder/js/elfinder.min.js'); ?>"></script>

        <?php $__env->startSection('assets.top'); ?>
            <?php echo $__env->make('partials.vars', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->yieldSection(); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue <?php echo !empty($body_css_class) ? $body_css_class : 'sidebar-mini'; ?>">

        <div class="wrapper">
            <?php echo $__env->yieldContent('main'); ?>
        </div>

        <?php echo $__env->make('partials.messages', [ 'messages' => $messages ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->make('partials.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php $__env->startSection('assets.bottom'); ?>
            <script src="<?php echo asset('assets/components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

            <script src="<?php echo asset('assets/components/bootbox/bootbox.js'); ?>"></script>

            <script src="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/pace/pace.min.js'); ?>"></script>

            <script src="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/select2/select2.full.min.js'); ?>"></script>

            <script src="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/iCheck/icheck.min.js'); ?>"></script>

            <script src="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/input-mask/jquery.inputmask.js'); ?>"></script>
            <script src="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/input-mask/jquery.inputmask.extensions.js'); ?>"></script>
            <script src="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>"></script>

            <script src="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
            <script src="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/datepicker/locales/bootstrap-datepicker.ru.js'); ?>"></script>

            <script src="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>

            <script src="<?php echo asset('assets/components/bootstrap-validator/dist/validator.min.js'); ?>"></script>

            <script src="<?php echo asset('assets/themes/admin/vendor/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.js'); ?>"></script>

            <script src="<?php echo asset('assets/components/datatables/media/js/jquery.dataTables.js'); ?>"></script>
            <script src="<?php echo Theme::asset('vendor/dataTables/dataTables.bootstrap.js'); ?>"></script>

            <script src="<?php echo asset('assets/themes/admin/vendor/adminlte/dist/js/app.min.js'); ?>"></script>

            <script src="<?php echo Theme::asset('js/main.js', null, true); ?>"></script>
        <?php echo $__env->yieldSection(); ?>


    </body>

</html>
