<div class="col-md-3">
    <a href="<?php echo route('admin.translation.index', $group); ?>" class="btn btn-flat btn-sm btn-default"><?php echo app('translator')->get('labels.cancel'); ?> </a>
</div>

<?php if($user->hasAccess('translation.write')): ?>
    <div class="col-md-4 pull-right ta-right">
        <?php echo Form::button(trans('labels.save'), ['class' => 'btn btn-success btn-flat with-loading']); ?>

    </div>
<?php endif; ?>