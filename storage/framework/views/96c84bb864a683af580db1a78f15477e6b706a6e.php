<div class="row box-footer <?php if(!empty($class)): ?> <?php echo $class; ?> <?php endif; ?>">
    <div class="col-md-3">
        <a href="<?php echo empty($back_url) ? route('admin.banner.index') : $back_url; ?>" class="btn btn-flat btn-sm btn-default"><?php echo app('translator')->get('labels.cancel'); ?> </a>
    </div>

    <?php if($user->hasAccess('banner.write') || $user->hasAccess('banner.create')): ?>
        <div class="col-md-4 pull-right ta-right">
            <?php echo Form::submit(trans('labels.save'), array('class' => 'btn btn-success btn-flat')); ?>

        </div>
    <?php endif; ?>
</div>
