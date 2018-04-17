<div class="form-group required <?php if($errors->has('latitude')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('latitude', trans('labels.latitude'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::text('latitude', null, ['placeholder' => trans('labels.latitude'), 'class' => 'form-control input-sm', 'aria-hidden' => 'true', 'required' => true]); ?>


        <?php echo $errors->first('latitude', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group required <?php if($errors->has('longitude')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('longitude', trans('labels.longitude'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::text('longitude', null, ['placeholder' => trans('labels.longitude'), 'class' => 'form-control input-sm', 'aria-hidden' => 'true', 'required' => true]); ?>


        <?php echo $errors->first('longitude', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php if($errors->has('email')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('email', trans('labels.email'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::email('email', null, ['placeholder' => trans('labels.email'), 'class' => 'form-control input-sm', 'aria-hidden' => 'true']); ?>


        <?php echo $errors->first('email', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php if($errors->has('phone')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('phone', trans('labels.phone'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::text('phone', null, ['placeholder' => trans('labels.several phone'), 'class' => 'form-control input-sm', 'aria-hidden' => 'true']); ?>


        <?php echo $errors->first('phone', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php if($errors->has('image')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('image', trans('labels.image'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-7 col-md-4 col-lg-4">
        <?php echo Form::imageInput('image', $model->image); ?>


        <?php echo $errors->first('image', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group required <?php if($errors->has('status')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('status', trans('labels.status'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::select('status', ['1' => trans('labels.status_on'), '0' => trans('labels.status_off')], null, ['class' => 'form-control select2 input-sm', 'aria-hidden' => 'true']); ?>


        <?php echo $errors->first('status', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>