<?php echo Form::open(array("route" => array("admin." . $type . ".destroy", $model->id), "method" => "delete", 'class' => 'pull-left')); ?>


    <?php if($user->hasAccess((isset($access) ? $access : $type).'.read')): ?>
        <a class="btn btn-info btn-sm btn-flat" href="<?php echo route('admin.' . $type . '.edit', array($model->id)); ?>"
           title="<?php echo trans('labels.edit'); ?>">
            <i class="fa fa-pencil"></i>
        </a>&nbsp;
    <?php endif; ?>

    <?php if($user->hasAccess((isset($access) ? $access : $type).'.delete')): ?>
        <a class="btn btn-danger btn-sm btn-flat" href="javascript:void(0);" title="<?php echo trans('labels.delete'); ?>"
           onclick="return dialog('<?php echo trans('labels.deleting_record'); ?>', '<?php echo trans('messages.delete_record'); ?>',  $(this).closest('form'));">
            <i class="fa fa-trash"></i>
        </a>&nbsp;
    <?php endif; ?>

    <?php if(isset($front_link) && $front_link === true ): ?>
        <a class="btn btn-primary btn-sm btn-flat" href="<?php echo $model->getUrl(); ?>" title="<?php echo app('translator')->get('labels.go_to_front'); ?>" target="_blank">
            <i class="fa fa-external-link"></i>
        </a>
    <?php endif; ?>

<?php echo Form::close(); ?>