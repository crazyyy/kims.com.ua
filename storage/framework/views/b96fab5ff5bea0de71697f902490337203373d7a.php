<div class="box-body table-responsive no-padding">
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <?php foreach(config('app.locales') as $key => $locale): ?>
                    <li <?php if($key == 0): ?> class="active" <?php endif; ?>>
                        <a aria-expanded="false" href="#tab_price_<?php echo $locale; ?>" data-toggle="tab">
                            <i class="flag flag-<?php echo $locale; ?>"></i>
                            <?php echo app('translator')->get('labels.tab_'.$locale); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="tab-content">
                <?php foreach(config('app.locales') as $key => $locale): ?>
                    <div class="tab-pane fade in <?php if($key == 0): ?> active <?php endif; ?>" id="tab_price_<?php echo $locale; ?>">
                        <?php echo $__env->make('views.product.partials.price_locale', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>