<div class="form-group required <?php if($errors->has($locale.'.title')): ?> has-error <?php endif; ?>">
    <?php echo Form::label($locale . '[title]', trans('labels.title'), ['class' => 'control-label col-xs-12 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-6 col-md-6">
        <?php echo Form::text($locale.'[title]', isset($model->translate($locale)->title) ? $model->translate($locale)->title : '', ['placeholder'=> trans('labels.title'), 'required' => true, 'class' => 'form-control input-sm title_'.$locale]); ?>


        <?php echo $errors->first($locale.'.title', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>