<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">

                <?php echo Form::open(['route' => 'admin.import.import', 'class' => 'form', 'role' => 'form', 'enctype'=>'multipart/form-data', 'method' => 'post']); ?>


                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-push-4">
                            <div class="form-group text-center <?php if($errors->has('price_file')): ?> has-error <?php endif; ?>">
                                <h5><?php echo Form::label('price_file', trans('labels.select_a_file'), ['class' => 'control-label col-sm-12 margin-bottom-20']); ?></h5>

                                <?php echo Form::file('price_file', ['style' => 'margin: 0px auto; display: block;']); ?>


                                <?php echo $errors->first('price_file', '<p class="help-block error position-relative">:message</p>'); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="col-sm-2 col-sm-push-5">
                        <div class="btn btn-block btn-flat btn-success with-loading">
                            <?php echo app('translator')->get('labels.import'); ?>
                        </div>
                    </div>
                </div>

                <?php echo Form::close(); ?>


            </div>

            <?php if(isset($import_success)): ?>
                <?php if(empty($import_errors)): ?>
                    <div class="callout callout-success">
                        <p><?php echo app('translator')->get('messages.import success'); ?></p>
                    </div>
                <?php else: ?>
                    <div class="callout callout-warning">
                        <p><?php echo app('translator')->get('messages.import loaded'); ?></p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(!empty($import_errors)): ?>
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo app('translator')->get('labels.errors'); ?></h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="<?php echo app('translator')->get('labels.collapse'); ?>" data-original-title="<?php echo app('translator')->get('labels.collapse'); ?>">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="<?php echo app('translator')->get('labels.hide'); ?>" data-original-title="<?php echo app('translator')->get('labels.hide'); ?>">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <div class="box-body">
                        <?php foreach($import_errors as $error): ?>
                            <p class="help-block error position-relative"><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.editable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>