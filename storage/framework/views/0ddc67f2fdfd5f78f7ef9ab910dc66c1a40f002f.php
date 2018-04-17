<div class="form-group required <?php if($errors->has($locale.'.image')): ?> has-error <?php endif; ?>">
    <?php echo Form::label($locale . '[image]', trans('labels.image'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-7 col-md-10">
        <?php echo Form::imageInput($locale.'[image]', isset($model->translate($locale)->image) ? $model->translate($locale)->image : null); ?>


        <?php echo $errors->first($locale.'.image', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group required <?php if($errors->has($locale.'.name')): ?> has-error <?php endif; ?>">
    <?php echo Form::label($locale . '[name]', trans('labels.name'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-7 col-md-10">
        <?php echo Form::text($locale.'[name]', isset($model->translate($locale)->name) ? $model->translate($locale)->name : '', ['placeholder'=> trans('labels.name'), 'required' => true, 'class' => 'form-control input-sm name_'.$locale]); ?>


        <?php echo $errors->first($locale.'.name', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php if($errors->has($locale . '[description]')): ?> has-error <?php endif; ?>">
    <?php echo Form::label($locale . '[description]', trans('labels.description'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-8 col-sm-7 col-md-10">
        <?php echo Form::textarea($locale . '[description]', isset($model->translate($locale)->description) ? $model->translate($locale)->description : '', ['rows' => '3', 'placeholder' => trans('labels.description'), 'class' => 'form-control input-sm content_' . $locale]); ?>


        <?php echo $errors->first($locale . '[description]', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>
<?php echo $__env->make('partials.tabs.ckeditor', ['id' => $locale . '[description]'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>