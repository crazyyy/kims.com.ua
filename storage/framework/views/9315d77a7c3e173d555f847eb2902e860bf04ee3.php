<div class="form-group required <?php if($errors->has('slug')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('slug', trans('labels.slug'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-7 col-md-4">
        <?php echo Form::text('slug', null, ['placeholder' => trans('labels.slug'), 'required' => true, 'class' => 'form-control input-sm']); ?>


        <?php echo $errors->first('slug', '<p class="help-block error">:message</p>'); ?>

    </div>

    <a href="#" class="btn btn-success btn-flat btn-xs margin-top-4 slug-generate"><?php echo trans('labels.generate'); ?></a>
</div>

<div class="form-group <?php if($errors->has('parent_id')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('parent_id', trans('labels.page_parent_id'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::select('parent_id', $parents, null, array('class' => 'form-control select2 input-sm', 'aria-hidden' => 'true')); ?>


        <?php echo $errors->first('parent_id', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group required <?php if($errors->has('status')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('status', trans('labels.status'), array('class' => 'control-label col-xs-4 col-sm-3 col-md-2')); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::select('status', ['1' => trans('labels.status_on'), '0' => trans('labels.status_off')], null, array('class' => 'form-control select2 input-sm', 'aria-hidden' => 'true')); ?>


        <?php echo $errors->first('status', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php if($errors->has('position')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('position', trans('labels.position'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <?php echo Form::text('position', $model->position ?: 0, ['placeholder' => trans('labels.position'), 'class' => 'form-control input-sm']); ?>


        <?php echo $errors->first('position', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php if($errors->has('image')): ?> has-error <?php endif; ?>">
    <?php echo Form::label('image', trans('labels.image'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']); ?>


    <div class="col-xs-12 col-sm-7 col-md-4">
        <?php echo Form::imageInput('image', $model->image); ?>


        <?php echo $errors->first('image', '<p class="help-block error">:message</p>'); ?>

    </div>
</div>