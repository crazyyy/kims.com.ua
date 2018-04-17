<div class="form-group required <?php if($errors->has('type')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('type', trans('labels.type'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::select('type', $types, null, ['id' => 'type', 'class' => 'form-control select2 input-sm', 'aria-hidden' => 'true', 'required' => true]); ?>


        <?php echo $errors->first('type', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group required <?php if($errors->has('key')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('key', trans('labels.key'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-7 col-md-4">
        <?php echo Form::text('key', null, ['placeholder' => trans('labels.key'), 'required' => true, 'class' => 'form-control input-sm']); ?>


        <?php echo $errors->first('key', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group required <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('name', trans('labels.name'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-7 col-md-4">
        <?php echo Form::text('name', null, ['placeholder' => trans('labels.name'), 'required' => true, 'class' => 'form-control input-sm']); ?>


        <?php echo $errors->first('name', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php if($errors->has('description')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('description', trans('labels.description'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-9 col-md-10">
        <?php echo Form::text('description', null, ['placeholder' => trans('labels.description'), 'class' => 'form-control input-sm']); ?>


        <?php echo $errors->first('description', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group required <?php if($errors->has('multilingual')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('multilingual', trans('labels.multilingual'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::select('multilingual', ['0' => trans('labels.status_off'), '1' => trans('labels.status_on')], null, ['class' => 'form-control select2 input-sm', 'aria-hidden' => 'true']); ?>


        <?php echo $errors->first('multilingual', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>