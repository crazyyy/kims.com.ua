<div class="form-group <?php if($errors->has('category_id')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('category_id', trans('labels.parent_category'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::select('category_id', $categories, null, ['class' => 'form-control select2 input-sm', 'aria-hidden' => 'true']); ?>


        <?php echo $errors->first('category_id', '<p class="help-block error">:message</p>'); ?>

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
        <?php echo Form::text('position', $model->position ?: 0, ['placeholder' => trans('labels.position'), 'class' => 'form-control input-sm', 'required' => true]); ?>


        <?php echo $errors->first('position', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>