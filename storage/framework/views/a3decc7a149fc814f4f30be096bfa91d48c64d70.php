<div class="form-group required <?php if($errors->has('layout_position')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('layout_position', trans('labels.layout_position'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3">
        <?php echo Form::text('layout_position', null, ['class' => 'form-control input-sm', 'aria-hidden' => 'true', 'required' => true]); ?>


        <?php echo $errors->first('layout_position', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php if($errors->has('class')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('class', trans('labels.class'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3">
        <?php echo Form::text('class', null, ['class' => 'form-control input-sm', 'aria-hidden' => 'true']); ?>


        <?php echo $errors->first('class', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group required <?php if($errors->has('show_title')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('show_title', trans('labels.show_title'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::select('show_title', ['0' => trans('labels.no'), '1' => trans('labels.yes')], null, ['class' => 'form-control select2 input-sm', 'aria-hidden' => 'true', 'required' => true]); ?>


        <?php echo $errors->first('show_title', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group required <?php if($errors->has('status')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('status', trans('labels.status'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::select('status', ['1' => trans('labels.status_on'), '0' => trans('labels.status_off')], null, ['class' => 'form-control select2 input-sm', 'aria-hidden' => 'true', 'required' => true]); ?>


        <?php echo $errors->first('status', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group required <?php if($errors->has('position')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('position', trans('labels.position'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::text('position', $model->position ?: 0, ['class' => 'form-control input-sm', 'aria-hidden' => 'true', 'required' => true]); ?>


        <?php echo $errors->first('position', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group required <?php if($errors->has('template')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('template', trans('labels.template'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::select('template', $templates, null, ['class' => 'form-control select2 input-sm', 'aria-hidden' => 'true', 'required' => true]); ?>


        <?php echo $errors->first('template', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>