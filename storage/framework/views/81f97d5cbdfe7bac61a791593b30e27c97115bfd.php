<section class="content-header">
    <?php if(!empty($page_title)): ?>
        <h1><?php echo $page_title; ?></h1>
    <?php endif; ?>

    <?php echo $__env->make('partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</section>