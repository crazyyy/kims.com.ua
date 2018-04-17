<?php if(count($model->fields)): ?>
    <?php foreach($model->fields as $field): ?>
        <div class="form-group field-row">
            <?php echo Form::label('fields_old_' . $field->id, trans('labels.' . $field->getStringType()), ['class' => 'col-md-3 control-label']); ?>


            <?php echo Form::hidden('fields[old]['.$field->id.'][type]', $field->type); ?>


            <div class="col-md-3">
                <?php echo Form::text('fields[old]['.$field->id.'][value]', $field->value, ['class' => 'form-control input-sm input-mask data-mask-'.$field->type]); ?>

            </div>
            <div class="col-md-1">
                <label data-id="<?php echo $field->id; ?>" data-name="fields[remove][]" class="remove-field-button control-label red pointer">
                    <i class="fa fa-remove"></i>
                </label>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php if(count(Request::old('fields.new'))): ?>
    <?php foreach(Request::old('fields.new') as $key => $field): ?>
        <?php if(!empty($field['type'])): ?>
            <div class="form-group field-row">
                <div class="col-md-3">
                    <?php echo Form::select('fields[new]['.$key.'][type]', $field_types, $field['type'], ['class' => 'form-control select2', 'aria-hidden' => 'true']); ?>

                </div>

                <div class="col-md-3">
                    <?php echo Form::text('fields[new]['.$key.'][value]', $field['value'], ['class' => 'form-control input-sm input-mask inputmask-'.$field['type']]); ?>

                </div>
                <div class="col-md-1">
                    <label data-id="" class="remove-field-button control-label red pointer">
                        <i class="fa fa-remove"></i>
                    </label>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<div class="form-group add-field-button-block">
    <div class="col-md-6">
        <div class="btn btn-flat btn-sm btn-primary add-field-button">
            <?php echo app('translator')->get('labels.add_new_field'); ?>

            <div class="duplicate form-group field-row">
                <div class="col-md-3">
                    <?php echo Form::select('fields[new][replaceme][type]', $field_types, null, ['class' => 'form-control select2 ',  'aria-hidden' => 'true']); ?>

                </div>

                <div class="col-md-3">
                    <?php echo Form::text('fields[new][replaceme][value]', '', ['class' => 'form-control input-sm input-mask']); ?>

                </div>

                <div class="col-md-1">
                    <label data-id="" class="remove-field-button control-label red pointer">
                        <i class="fa fa-remove"></i>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>