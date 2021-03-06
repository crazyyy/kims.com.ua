<?php echo $__env->make('banner.partials._buttons', ['class' => 'buttons-top'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="row">
    <div class="col-md-12">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <?php foreach(config('app.locales') as $key => $locale): ?>
                    <li <?php if($key == 0): ?> class="active" <?php endif; ?>>
                        <a aria-expanded="false" href="#tab_<?php echo $locale; ?>" data-toggle="tab">
                            <i class="flag flag-<?php echo $locale; ?>"></i>
                            <?php echo app('translator')->get('labels.tab_'.$locale); ?>
                        </a>
                    </li>
                <?php endforeach; ?>

                <li>
                    <a aria-expanded="false" href="#general" data-toggle="tab"><?php echo app('translator')->get('labels.tab_general'); ?></a>
                </li>

                <li>
                    <a aria-expanded="false" href="#items" data-toggle="tab"><?php echo app('translator')->get('labels.tab_items'); ?></a>
                </li>
            </ul>

            <div class="tab-content">
                <?php foreach(config('app.locales') as $key => $locale): ?>
                    <div class="tab-pane fade in <?php if($key == 0): ?> active <?php endif; ?>" id="tab_<?php echo $locale; ?>">
                        <?php echo $__env->make('views.banner.tabs.locale', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                <?php endforeach; ?>

                <div class="tab-pane" id="general">
                    <?php echo $__env->make('banner.tabs.general', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>

                <div class="tab-pane" id="items">
                    <?php echo $__env->make('banner.tabs.items', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div>
        </div>

    </div>
</div>

<?php echo $__env->make('banner.partials._buttons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>