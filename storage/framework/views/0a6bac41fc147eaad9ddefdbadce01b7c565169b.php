<div class="image-block">
    <div class="text-muted input-sm image-top-helper">
        <?php echo app('translator')->get('labels.click_on_image_to_select_avatar'); ?>
    </div>

    <div class="preview-image profile-user-img img-circle"
         id="preview_image">

        <?php echo $__env->make('partials.image', ['src' => $model->avatar, 'attributes' => ['width' => 128, 'height' => 128, 'class' => 'img-responsive img-circle']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo Form::file('avatar', ['onchange' => 'loadImagePreview(this, \'preview_image\')']); ?>

    </div>

    <div class="text-muted input-sm remove-image <?php if(!$model->avatar): ?> hidden <?php endif; ?>" data-preview_id="preview_image" data-image_input_id="avatar">
        <?php echo app('translator')->get('labels.remove_avatar'); ?>
    </div>

    <?php echo Form::hidden('avatar', $model->avatar, ['id' => 'avatar']); ?>

</div>