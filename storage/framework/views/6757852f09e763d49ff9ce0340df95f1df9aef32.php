<div class="box-body">
    <?php foreach($groups as $key => $group_name): ?>
        <div class="form-group col-sm-12">
            <label class="checkbox-label" for="'groups[<?php echo $key; ?>]'">
                <?php echo Form::checkbox('groups['.$key.']', $key,
                !empty($user_groups) ? in_array($key, $user_groups) :
                    Request::old('groups['.$key.']') ?: false,
                array('class' => 'square')); ?>


                <span class="title"><?php echo $group_name; ?></span>
            </label>
        </div>
    <?php endforeach; ?>

    <?php if($errors->has('groups')): ?>
        <div class="row has-error">
            <div class="col-xs-12">
                <?php echo $errors->first('groups', '<p class="help-block error">:message</p>'); ?>

            </div>
        </div>
    <?php endif; ?>
</div>
