<?php echo $__env->make('variable.partials._buttons', ['class' => 'buttons-top'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<div class="box box-primary">
    <div class="box-body">
        <div class="variables-table margin-top-10">

            <?php echo $__env->make('variable.tabs.general', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>
    </div>
</div>

<?php echo $__env->make('variable.partials._buttons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>