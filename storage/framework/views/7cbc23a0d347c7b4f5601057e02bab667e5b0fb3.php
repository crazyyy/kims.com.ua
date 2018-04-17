<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active">
            <a aria-expanded="false" href="#info" data-toggle="tab"><?php echo app('translator')->get('labels.tab_info'); ?></a>
        </li>

        <li class="<?php if($errors->has('groups')): ?> tab-with-errors <?php endif; ?>">
            <a aria-expanded="false" href="#groups" data-toggle="tab"><?php echo app('translator')->get('labels.tab_groups'); ?></a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="info">
            <?php echo $__env->make('user.tabs.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>

        <div class="tab-pane" id="groups">
            <?php echo $__env->make('user.tabs.groups', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
</div>
