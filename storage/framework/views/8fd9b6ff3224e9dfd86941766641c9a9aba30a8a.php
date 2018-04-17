<div class="form-group required <?php if($errors->has($locale.'.name')): ?> has-error <?php endif; ?>">
    <?php echo Form::label($locale . '[name]', trans('labels.name'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-7 col-md-10">
        <?php echo Form::text($locale.'[name]', isset($model->translate($locale)->name) ? $model->translate($locale)->name : '', ['placeholder'=> trans('labels.name'), 'required' => true, 'class' => 'form-control input-sm name_'.$locale]); ?>


        <?php echo $errors->first($locale.'.name', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>