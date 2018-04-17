<div class="status-button">
    <input type="checkbox" class="status-toggler <?php echo $field; ?>-checkbox-input"
           data-id="<?php echo $model->id; ?>"
           data-token="<?php echo csrf_token(); ?>"
           data-field="<?php echo $field; ?>"
           data-url="<?php echo route('admin.' . $type . '.ajax_field', ['id' => $model->id]); ?>"
           data-value="<?php echo $model->{$field} == true ? false : true; ?>"
            <?php echo ($model->{$field} ? 'checked="checked"' : ''); ?> />
</div>
