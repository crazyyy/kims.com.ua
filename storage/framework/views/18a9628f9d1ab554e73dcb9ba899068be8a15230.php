<div class="row box-footer <?php if(!empty($class)): ?> <?php echo $class; ?> <?php endif; ?>">
    <div class="col-md-3">
        <a href="<?php echo empty($back_url) ? route('admin.user.index') : $back_url; ?>" class="btn btn-flat btn-sm btn-default"><?php echo app('translator')->get('labels.cancel'); ?> </a>
    </div>


    <div class="col-md-4 pull-right ta-right">
        <?php if($user->hasAccess('user.write')): ?>
            <?php if(!isset($without_password_change)): ?>
                <a href="<?php echo route('admin.user.new_password.get', $model->id); ?>" class="btn btn-sm btn-warning margin-right btn-flat"><?php echo trans("labels.change_password"); ?></a>
            <?php endif; ?>
        <?php endif; ?>

        <?php if($user->hasAccess('user.write') || $user->hasAccess('user.create')): ?>
            <?php echo Form::submit(trans('labels.save'), array('class' => 'btn btn-success btn-flat')); ?>

        <?php endif; ?>
    </div>
</div>
