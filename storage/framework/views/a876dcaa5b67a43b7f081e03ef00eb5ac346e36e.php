<div class="form-group required <?php if($errors->has('department_id')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('department_id', trans('labels.department'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3">
        <?php echo Form::select('department_id', $departments, null, ['class' => 'form-control select2 input-sm', 'aria-hidden' => 'true']); ?>


        <?php echo $errors->first('department_id', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group required <?php if($errors->has('status')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('status', trans('labels.status'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::select('status', ['1' => trans('labels.status_on'), '0' => trans('labels.status_off')], null, ['class' => 'form-control select2 input-sm', 'aria-hidden' => 'true']); ?>


        <?php echo $errors->first('status', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>