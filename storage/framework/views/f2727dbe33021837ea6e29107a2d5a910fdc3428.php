<div class="tab-pane active" id="settings">
    <div class="form-group required <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
        <?php echo Form::label('name', trans('labels.fio'), ['class' => 'col-md-3 control-label']); ?>


        <div class="col-md-5">
            <?php echo Form::text('name', null, ['placeholder' => trans('labels.fio'), 'required' => true, 'class' => 'form-control input-sm']); ?>


            <?php echo $errors->first('name', '<p class="help-block error">:message</p>'); ?>

        </div>
    </div>

    <div class="form-group required <?php if($errors->has('email')): ?> has-error <?php endif; ?>">
        <?php echo Form::label('email', trans('labels.email'), ['class' => 'col-md-3 control-label']); ?>


        <div class="col-md-3">
            <?php echo Form::text('email', null, ['placeholder' => trans('labels.email'), 'required' => true, 'class' => 'form-control input-sm']); ?>


            <?php echo $errors->first('email', '<p class="help-block error">:message</p>'); ?>

        </div>
    </div>

    <div class="form-group <?php if($errors->has('phone')): ?> has-error <?php endif; ?>">
        <?php echo Form::label('phone', trans('labels.phone'), ['class' => 'col-md-3 control-label']); ?>


        <div class="col-md-3">
            <?php echo Form::text('phone', null, ['placeholder' => trans('labels.phone'), 'class' => 'form-control input-sm inputmask-2']); ?>


            <?php echo $errors->first('phone', '<p class="help-block error">:message</p>'); ?>

        </div>
    </div>

    <?php if(empty($model->id)): ?>
        <div class="form-group <?php if($errors->has('password')): ?> has-error <?php endif; ?>">
            <?php echo Form::label('password', trans('labels.password'), ['class' => 'col-md-3 control-label']); ?>


            <div class="col-md-3">
                <?php echo Form::text('password', null, ['placeholder' => trans('labels.password'), 'required' => true, 'class' => 'form-control input-sm']); ?>


                <?php echo $errors->first('password', '<p class="help-block error">:message</p>'); ?>

            </div>
        </div>

        <div class="form-group <?php if($errors->has('password_confirmation')): ?> has-error <?php endif; ?>">
            <?php echo Form::label('password_confirmation', trans('labels.password_confirmation'), ['class' => 'col-md-3 control-label']); ?>


            <div class="col-md-3">
                <?php echo Form::text('password_confirmation', null, ['placeholder' => trans('labels.password_confirmation'), 'required' => true, 'class' => 'form-control input-sm']); ?>


                <?php echo $errors->first('password_confirmation', '<p class="help-block error">:message</p>'); ?>

            </div>
        </div>
    <?php endif; ?>

    <div class="form-group required <?php if($errors->has('activated')): ?> has-error <?php endif; ?>">
        <?php echo Form::label('activated', trans('labels.activated'), ['class' => 'col-md-3 control-label']); ?>


        <div class="col-xs-3">
            <?php echo Form::select('activated', ['0' => trans('labels.no'), '1' => trans('labels.yes'),], null, ['class' => 'form-control select2 input-sm', 'aria-hidden' => 'true', 'required' => true]); ?>


            <?php echo $errors->first('activated', '<p class="help-block error">:message</p>'); ?>

        </div>
    </div>

    <div class="form-group <?php if($errors->has('gender')): ?> has-error <?php endif; ?>">
        <?php echo Form::label('gender', trans('labels.gender'), ['class' => 'col-md-3 control-label']); ?>


        <div class="col-md-3">
            <?php echo Form::select('gender', $genders, null, ['class' => 'form-control select2',  'aria-hidden' => 'true']); ?>


            <?php echo $errors->first('gender', '<p class="help-block error">:message</p>'); ?>

        </div>
    </div>

    <div class="form-group <?php if($errors->has('birthday')): ?> has-error <?php endif; ?>">
        <?php echo Form::label('birthday', trans('labels.birthday'), ['class' => 'col-md-3 control-label']); ?>


        <div class="col-md-3">
            <div class="input-group">
                <?php echo Form::text('birthday', null, ['placeholder' => trans('labels.birthday'), 'class' => 'form-control input-sm inputmask-birthday datepicker-birthday']); ?>

                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            </div>

            <?php echo $errors->first('birthday', '<p class="help-block error">:message</p>'); ?>

        </div>
    </div>

    <?php echo $__env->make('partials.tabs.fields', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>
