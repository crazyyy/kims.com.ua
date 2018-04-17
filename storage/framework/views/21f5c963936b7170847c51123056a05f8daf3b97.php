<img
        width="<?php echo $width; ?>"
        height="<?php echo $height; ?>"
        class="margin-bottom-5 image_input_thumbnail <?php echo isset($image_class) ? $image_class : ''; ?>"
        src="<?php echo $image ? $image : 'http://www.placehold.it/' . $width . 'x' . $height . '/EFEFEF/AAAAAA&text=no+image'; ?>"
        data-default="<?php echo 'http://www.placehold.it/' . $width . 'x' . $height . '/EFEFEF/AAAAAA&text=no+image'; ?>"
/>

<div class="col-md-12 no-padding">
    <div class="input-group">
        <?php echo Form::text($name, $image, array_merge(['class' => 'form-control input-sm'], $params)); ?>


        <div class="input-group-addon show-elfinder-button" data-title="<?php echo app('translator')->get('labels.please_select_image'); ?>" title="<?php echo app('translator')->get('labels.select_image'); ?>" data-target="[elfinder-link='<?php echo $elfinder_link_name; ?>']">
            <i class="fa fa-folder"></i>
        </div>
        <div class="input-group-addon clear-image-button" title="<?php echo app('translator')->get('labels.clear_image'); ?>" data-target-image=".<?php echo $image_class; ?>" data-target-input="<?php echo $target_input; ?>">
            <i class="fa fa-close"></i>
        </div>
    </div>
</div>