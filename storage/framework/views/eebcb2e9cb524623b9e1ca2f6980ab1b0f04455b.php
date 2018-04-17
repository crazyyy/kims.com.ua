<?php echo $__env->make('user.partials._buttons', ['class' => 'buttons-top'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <?php echo $__env->make('partials.tabs.user_avatar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <h3 class="profile-username text-center"><?php echo $model->getFullName(); ?></h3>

                <?php if(!empty($model->groups()->first())): ?>
                    <p class="text-muted text-center"><?php echo $model->groups()->first()->name; ?> </p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <?php echo $__env->make('user.partials._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</div>

<?php echo $__env->make('user.partials._buttons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
