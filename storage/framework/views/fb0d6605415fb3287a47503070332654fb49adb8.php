<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header"><?php echo app('translator')->get('labels.content'); ?></li>
            <?php if($user->hasAccess('page.read')): ?>
                <li class="<?php echo active_class('admin.page*'); ?>">
                    <a href="<?php echo route('admin.page.index'); ?>">
                        <i class="fa fa-file-text"></i>
                        <span><?php echo app('translator')->get('labels.pages'); ?></span>

                        <?php if($user->hasAccess('page.create')): ?>
                            <small class="label create-label pull-right bg-green" title="<?php echo app('translator')->get('labels.add_page'); ?>"
                                   data-href="<?php echo route('admin.page.create'); ?>">
                                <i class="fa fa-plus"></i>
                            </small>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($user->hasAccess('department.read')): ?>
                <li class="<?php echo active_class('admin.department*'); ?>">
                    <a href="<?php echo route('admin.department.index'); ?>">
                        <i class="fa fa-map-marker"></i>
                        <span><?php echo app('translator')->get('labels.departments'); ?></span>

                        <?php if($user->hasAccess('department.create')): ?>
                            <small class="label create-label pull-right bg-green" title="<?php echo app('translator')->get('labels.add_department'); ?>"
                                   data-href="<?php echo route('admin.department.create'); ?>">
                                <i class="fa fa-plus"></i>
                            </small>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($user->hasAccess('share.read')): ?>
                <li class="<?php echo active_class('admin.share*'); ?>">
                    <a href="<?php echo route('admin.share.index'); ?>">
                        <i class="fa fa-tags"></i>
                        <span><?php echo app('translator')->get('labels.shares'); ?></span>

                        <?php if($user->hasAccess('share.create')): ?>
                            <small class="label create-label pull-right bg-green" title="<?php echo app('translator')->get('labels.add_share'); ?>"
                                   data-href="<?php echo route('admin.share.create'); ?>">
                                <i class="fa fa-plus"></i>
                            </small>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($user->hasAccess('category.read')): ?>
                <li class="<?php echo active_class('admin.category*'); ?>">
                    <a href="<?php echo route('admin.category.index'); ?>">
                        <i class="fa fa-sitemap" aria-hidden="true"></i>
                        <span><?php echo app('translator')->get('labels.categories'); ?></span>

                        <?php if($user->hasAccess('category.create')): ?>
                            <small class="label create-label pull-right bg-green" title="<?php echo app('translator')->get('labels.add_category'); ?>"
                                   data-href="<?php echo route('admin.category.create'); ?>">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </small>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($user->hasAccess('product.read')): ?>
                <li class="<?php echo active_class('admin.product*'); ?>">
                    <a href="<?php echo route('admin.product.index'); ?>">
                        <i class="fa fa-cube" aria-hidden="true"></i>
                        <span><?php echo app('translator')->get('labels.products'); ?></span>

                        <?php if($user->hasAccess('product.create')): ?>
                            <small class="label create-label pull-right bg-green" title="<?php echo app('translator')->get('labels.add_product'); ?>"
                                   data-href="<?php echo route('admin.product.create'); ?>">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </small>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($user->hasAccess('import.write')): ?>
                <li class="<?php echo active_class('admin.import*'); ?>">
                    <a href="<?php echo route('admin.import.index'); ?>">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                        <span><?php echo app('translator')->get('labels.import'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($user->hasAccess('banner.read')): ?>
                <li class="<?php echo active_class('admin.banner*'); ?>">
                    <a href="<?php echo route('admin.banner.index'); ?>">
                        <i class="fa fa-picture-o"></i>
                        <span><?php echo app('translator')->get('labels.banners'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($user->hasAccess('variablevalue.read')): ?>
                <li class="<?php echo active_class('admin.variable*'); ?>">
                    <a href="<?php echo route('admin.variable.value.index'); ?>">
                        <i class="fa fa-cog"></i>
                        <span><?php echo app('translator')->get('labels.variables'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($user->hasAccess('group') || $user->hasAccess('user.read')): ?>
                <li class="header"><?php echo app('translator')->get('labels.users'); ?></li>
            <?php endif; ?>
            <?php if($user->hasAccess('user.read')): ?>
                <li class="<?php echo active_class('admin.user.index*'); ?>">
                    <a href="<?php echo route('admin.user.index'); ?>">
                        <i class="fa fa-user"></i>
                        <span><?php echo app('translator')->get('labels.users'); ?></span>

                        <?php if($user->hasAccess('user.create')): ?>
                            <small class="label create-label pull-right bg-green" title="<?php echo app('translator')->get('labels.add_user'); ?>"
                                   data-href="<?php echo route('admin.user.create'); ?>">
                                <i class="fa fa-plus"></i>
                            </small>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif; ?>
            <?php if($user->hasAccess('group')): ?>
                <li class="<?php echo active_class('admin.group.index*'); ?>">
                    <a href="<?php echo route('admin.group.index'); ?>">
                        <i class="fa fa-users"></i>
                        <span><?php echo app('translator')->get('labels.groups'); ?></span>

                        <?php if($user->hasAccess('group.create')): ?>
                            <small class="label create-label pull-right bg-green" title="<?php echo app('translator')->get('labels.add_group'); ?>"
                                   data-href="<?php echo route('admin.group.create'); ?>">
                                <i class="fa fa-plus"></i>
                            </small>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif; ?>

            <li class="header"><?php echo app('translator')->get('labels.settings'); ?></li>
            <?php if($user->hasAccess('settings.translations')): ?>
                <li class="treeview <?php echo active_class('admin.translation.index*'); ?>">
                    <a href="#">
                        <i class="fa fa-language"></i>
                        <span><?php echo app('translator')->get('labels.translations'); ?></span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php foreach($translation_groups as $group): ?>
                            <li class="<?php echo front_active_class(route('admin.translation.index', $group)); ?>">
                                <a href="<?php echo route('admin.translation.index', $group); ?>">
                                    <span><?php echo app('translator')->get('labels.translation_group_' . $group); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </section>
</aside>