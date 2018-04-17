<?php if(is_array($item)): ?>
    <div class="form-group">
        <div class="form-group">
            <?php echo Form::text('items['.$key.'][' . $id . '][' . $locale. '][title]', $item[$locale]['title'], ['id' => 'items.'.$key.'.' . $id . '.' . $locale. '.title', 'placeholder' => trans('labels.banner_title'), 'class' => 'form-control input-sm']); ?>

        </div>

        <div class="form-group">
            <?php echo Form::text('items['.$key.'][' . $id . '][' . $locale. '][sub_title]', $item[$locale]['sub_title'], ['id' => 'items.'.$key.'.' . $id . '.' . $locale. '.sub_title', 'placeholder' => trans('labels.sub_title'), 'class' => 'form-control input-sm']); ?>

        </div>

        <div class="form-group <?php if($errors->has('items.'.$key.'.' .$id. '.'. $locale .'.text')): ?> has-error <?php endif; ?>">
            <?php echo Form::textarea('items['.$key.'][' . $id . '][' . $locale. '][text]', $item[$locale]['text'], ['id' => 'items.'.$key.'.' . $id . '.' . $locale. '.text', 'placeholder' => trans('labels.text'), 'rows' => 2, 'class' => 'form-control input-sm']); ?>


            <?php echo $errors->first('items.new.' .$id. '.text', '<p class="help-block error">:message</p>'); ?>

        </div>
    </div>
<?php else: ?>
    <div class="form-group">
        <div class="form-group">
            <?php echo Form::text('items['.$key.'][' . $id . '][' . $locale. '][title]', isset($item->translate($locale)->title) ? $item->translate($locale)->title : '', ['id' => 'items.'.$key.'.' . $id . '.' . $locale. '.title', 'placeholder' => trans('labels.banner_title'), 'class' => 'form-control input-sm']); ?>

        </div>

        <div class="form-group">
            <?php echo Form::text('items['.$key.'][' . $id . '][' . $locale. '][sub_title]', isset($item->translate($locale)->sub_title) ? $item->translate($locale)->sub_title: '', ['id' => 'items.'.$key.'.' . $id . '.' . $locale. '.sub_title', 'placeholder' => trans('labels.sub_title'), 'class' => 'form-control input-sm']); ?>

        </div>

        <div class="form-group <?php if($errors->has('items.'.$key.'.' .$id. '.'. $locale .'.text')): ?> has-error <?php endif; ?>">
            <?php echo Form::textarea('items['.$key.'][' . $id . '][' . $locale. '][text]', isset($item->translate($locale)->text) ? $item->translate($locale)->text : '', ['id' => 'items.'.$key.'.' . $id . '.' . $locale. '.text', 'placeholder' => trans('labels.text'), 'rows' => 2, 'class' => 'form-control input-sm']); ?>


            <?php echo $errors->first('items.new.' .$id. '.text', '<p class="help-block error">:message</p>'); ?>

        </div>
    </div>
<?php endif; ?>