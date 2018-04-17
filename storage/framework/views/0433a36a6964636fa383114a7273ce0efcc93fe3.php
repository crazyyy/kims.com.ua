<div class="col-sm-10">
    <input class="input-sm col-xs-16 form-control ajax-field-changer <?php echo $field; ?>-text-input"
           type="text"
           data-id="<?php echo $model->id; ?>"
           data-token="<?php echo csrf_token(); ?>"
           data-url="<?php echo route('admin.' . $type . '.ajax_field', [$model->id]); ?>"
           data-field="<?php echo $field; ?>"
           value="<?php echo ($model->{$field}); ?>"
            >
</div>
