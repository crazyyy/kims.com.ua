<header class="main-header">
    <div class="logo position-relative">
        <a href="<?php echo route('admin.home'); ?>" class="logo-link">
            <span class="logo-mini upper-case"><?php echo str_limit(config('app.name'), 3, ''); ?></span>

            <span class="logo-lg upper-case">
                <?php echo config('app.name'); ?>

            </span>
        </a>

        <div class="front-home-link" data-href="<?php echo route('home'); ?>" title="<?php echo app('translator')->get('labels.go_to_front'); ?>">
            <i class="fa fa-external-link"></i>
        </div>
    </div>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"><?php echo app('translator')->get('labels.toggle_navigation'); ?></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php echo $__env->make('partials.image', ['src' => $user->avatar, 'attributes' => ['width' => 160, 'height' => 160, 'class' => 'user-image']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <span class="hidden-xs"><?php echo $user->getFullName(); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <?php echo $__env->make('partials.image', ['src' => $user->avatar, 'attributes' => ['width' => 160, 'height' => 160, 'class' => 'img-circle']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <p>
                                <?php echo $user->getFullName(); ?> - <?php echo $user->groups()->first()->name; ?>

                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo route('admin.user.edit', $user->id); ?>" class="btn btn-default btn-sm btn-flat"><?php echo app('translator')->get('labels.profile'); ?></a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo route('admin.logout'); ?>" class="btn btn-default btn-sm btn-flat"><?php echo app('translator')->get('labels.sign_out'); ?></a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

