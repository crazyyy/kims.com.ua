<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-106416765-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-106416765-1');
</script>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.6">

<?php echo Meta::render(); ?>


<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="<?php echo asset('assets/components/fullpage.js/dist/jquery.fullpage.css'); ?>"/>
<link rel="stylesheet" href="<?php echo asset('assets/components/slick-carousel/slick/slick.css'); ?>"/>
<link rel="stylesheet" href="<?php echo asset('assets/components/perfect-scrollbar/css/perfect-scrollbar.min.css'); ?>"/>

<link rel="stylesheet" href="<?php echo Theme::asset('css/styles.css', null, true); ?>"/>

<script type="text/javascript" src="<?php echo asset('assets/components/jquery/dist/jquery.js'); ?>"></script>

<script language="JavaScript" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>


<?php echo $__env->make('partials.vars', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>