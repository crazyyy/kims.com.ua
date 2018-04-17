<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="variables-table margin-top-10">

                <?php foreach($list as $item): ?>

                    <div class="box box-primary">
                        <?php echo Form::model($item, ['role' => 'form', 'method' => 'post', 'route' => ['admin.variable.value.update'], 'class' => 'variable-value-form form-horizontal']); ?>


                        <input type="hidden" name="variable_id" value="<?php echo $item->id; ?>">

                        <div class="box-body">
                            <input type="hidden" name="type" value="<?php echo $item->type; ?>">
                            <input type="hidden" name="multilingual" value="<?php echo $item->multilingual; ?>">

                            <label class="control-label col-xs-4 col-sm-3 col-md-2 text-right variable-value-label">
                                <?php echo $item->name; ?>

                            </label>

                            <div class="col-xs-12 col-sm-9 col-md-10">
                                <?php echo $__env->make('variable.types.'.$item->getStringType(), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                <div class="row form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 ">
                                        <?php echo Form::select('status', ['1' => trans('labels.status_on'), '0' => trans('labels.status_off')], null, ['id' => 'status', 'class' => 'form-control select2 input-sm', 'aria-hidden' => 'true']); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="row form-group">
                                    <?php if($user->hasAccess('variablevalue.write')): ?>
                                        <div class="col-md-4 pull-right ta-right">
                                            <?php echo Form::submit(trans('labels.save'), ['class' => 'btn btn-success btn-flat save-variable-value']); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>

                        <?php echo Form::close(); ?>

                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.editable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>