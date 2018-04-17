<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <?php echo Form::open(array('route' => ['admin.user.new_password.post', $model->id], 'class' => 'form-horizontal', 'method'=>'post')); ?>


                <?php echo $__env->make('user.partials._buttons', ['without_password_change' => true, 'class' => 'buttons-top', 'back_url' => route('admin.user.edit', $model->id)], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group required <?php if($errors->has('password')): ?> has-error <?php endif; ?>">
                                <?php echo Form::label('password', trans('labels.password'), ['class' => "col-xs-2 control-label"]); ?>


                                <div class="col-xs-3">
                                    <?php echo Form::text('password', null, ['placeholder' => trans('labels.password'), 'class' => 'form-control input-sm', 'required' => true]); ?>


                                    <?php echo $errors->first('password', '<p class="help-block error">:message</p>'); ?>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group required <?php if($errors->has('password_confirmation')): ?> has-error <?php endif; ?>">
                                <?php echo Form::label('password_confirmation', trans('labels.password_confirmation'), ['class' => "col-xs-2 control-label"]); ?>


                                <div class="col-xs-3">
                                    <?php echo Form::text('password_confirmation', null, ['placeholder' => trans('labels.password_confirmation'), 'class' => 'form-control input-sm', 'required' => true]); ?>


                                    <?php echo $errors->first('password_confirmation', '<p class="help-block error">:message</p>'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo $__env->make('user.partials._buttons', ['without_password_change' => true, 'back_url' => route('admin.user.edit', $model->id)], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo Form::close(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.editable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>