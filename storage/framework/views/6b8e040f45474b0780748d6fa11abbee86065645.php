<table class="table table-bordered">
    <tbody>
    <tr>
        <th class="text-center"><?php echo app('translator')->get('labels.department'); ?></th>
        <th class="text-center"><?php echo app('translator')->get('labels.price'); ?> (<?php echo app('translator')->get('labels.department_price_helper_text'); ?>)</th>
    </tr>

    <?php foreach($departments as $department): ?>
        <tr>
            <td>
                <div class="margin-top-5">
                    <?php echo $department->name; ?>

                </div>
            </td>
            <td class="text-center">
                <div class="form-group required <?php if($errors->has($locale.'.price.'.$department->id)): ?> has-error <?php endif; ?>">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-xs-push-0 col-sm-push-3 col-md-push-4">
                        <input type="text"
                               class="form-control input-sm text-center"
                               name="<?php echo $locale; ?>[price][<?php echo $department->id; ?>]"
                               id="<?php echo $locale; ?>_price_<?php echo $department->id; ?>"
                               required="required"
                               value="<?php echo old($locale.'.price.'.$department->id) ?: $model->priceForDepartment($department->id, $locale); ?>">
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>