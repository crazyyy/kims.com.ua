<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">@lang('labels.content')</li>
            @if ($user->hasAccess('page.read'))
                <li class="{!! active_class('admin.page*') !!}">
                    <a href="{!! route('admin.page.index') !!}">
                        <i class="fa fa-file-text"></i>
                        <span>@lang('labels.pages')</span>

                        @if ($user->hasAccess('page.create'))
                            <small class="label create-label pull-right bg-green" title="@lang('labels.add_page')"
                                   data-href="{!! route('admin.page.create') !!}">
                                <i class="fa fa-plus"></i>
                            </small>
                        @endif
                    </a>
                </li>
            @endif

            @if ($user->hasAccess('department.read'))
                <li class="{!! active_class('admin.department*') !!}">
                    <a href="{!! route('admin.department.index') !!}">
                        <i class="fa fa-map-marker"></i>
                        <span>@lang('labels.departments')</span>

                        @if ($user->hasAccess('department.create'))
                            <small class="label create-label pull-right bg-green" title="@lang('labels.add_department')"
                                   data-href="{!! route('admin.department.create') !!}">
                                <i class="fa fa-plus"></i>
                            </small>
                        @endif
                    </a>
                </li>
            @endif

            @if ($user->hasAccess('share.read'))
                <li class="{!! active_class('admin.share*') !!}">
                    <a href="{!! route('admin.share.index') !!}">
                        <i class="fa fa-tags"></i>
                        <span>@lang('labels.shares')</span>

                        @if ($user->hasAccess('share.create'))
                            <small class="label create-label pull-right bg-green" title="@lang('labels.add_share')"
                                   data-href="{!! route('admin.share.create') !!}">
                                <i class="fa fa-plus"></i>
                            </small>
                        @endif
                    </a>
                </li>
            @endif

            @if ($user->hasAccess('category.read'))
                <li class="{!! active_class('admin.category*') !!}">
                    <a href="{!! route('admin.category.index') !!}">
                        <i class="fa fa-sitemap" aria-hidden="true"></i>
                        <span>@lang('labels.categories')</span>

                        @if ($user->hasAccess('category.create'))
                            <small class="label create-label pull-right bg-green" title="@lang('labels.add_category')"
                                   data-href="{!! route('admin.category.create') !!}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </small>
                        @endif
                    </a>
                </li>
            @endif

            @if ($user->hasAccess('product.read'))
                <li class="{!! active_class('admin.product*') !!}">
                    <a href="{!! route('admin.product.index') !!}">
                        <i class="fa fa-cube" aria-hidden="true"></i>
                        <span>@lang('labels.products')</span>

                        @if ($user->hasAccess('product.create'))
                            <small class="label create-label pull-right bg-green" title="@lang('labels.add_product')"
                                   data-href="{!! route('admin.product.create') !!}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </small>
                        @endif
                    </a>
                </li>
            @endif

            @if ($user->hasAccess('import.write'))
                <li class="{!! active_class('admin.import*') !!}">
                    <a href="{!! route('admin.import.index') !!}">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                        <span>@lang('labels.import')</span>
                    </a>
                </li>
            @endif

            @if ($user->hasAccess('banner.read'))
                <li class="{!! active_class('admin.banner*') !!}">
                    <a href="{!! route('admin.banner.index') !!}">
                        <i class="fa fa-picture-o"></i>
                        <span>@lang('labels.banners')</span>
                    </a>
                </li>
            @endif

            @if ($user->hasAccess('variablevalue.read'))
                <li class="{!! active_class('admin.variable*') !!}">
                    <a href="{!! route('admin.variable.value.index') !!}">
                        <i class="fa fa-cog"></i>
                        <span>@lang('labels.variables')</span>
                    </a>
                </li>
            @endif

            @if ($user->hasAccess('group') || $user->hasAccess('user.read'))
                <li class="header">@lang('labels.users')</li>
            @endif
            @if ($user->hasAccess('user.read'))
                <li class="{!! active_class('admin.user.index*') !!}">
                    <a href="{!! route('admin.user.index') !!}">
                        <i class="fa fa-user"></i>
                        <span>@lang('labels.users')</span>

                        @if ($user->hasAccess('user.create'))
                            <small class="label create-label pull-right bg-green" title="@lang('labels.add_user')"
                                   data-href="{!! route('admin.user.create') !!}">
                                <i class="fa fa-plus"></i>
                            </small>
                        @endif
                    </a>
                </li>
            @endif
            @if ($user->hasAccess('group'))
                <li class="{!! active_class('admin.group.index*') !!}">
                    <a href="{!! route('admin.group.index') !!}">
                        <i class="fa fa-users"></i>
                        <span>@lang('labels.groups')</span>

                        @if ($user->hasAccess('group.create'))
                            <small class="label create-label pull-right bg-green" title="@lang('labels.add_group')"
                                   data-href="{!! route('admin.group.create') !!}">
                                <i class="fa fa-plus"></i>
                            </small>
                        @endif
                    </a>
                </li>
            @endif

            <li class="header">@lang('labels.settings')</li>
            @if ($user->hasAccess('settings.translations'))
                <li class="treeview {!! active_class('admin.translation.index*') !!}">
                    <a href="#">
                        <i class="fa fa-language"></i>
                        <span>@lang('labels.translations')</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        @foreach($translation_groups as $group)
                            <li class="{!! front_active_class(route('admin.translation.index', $group)) !!}">
                                <a href="{!! route('admin.translation.index', $group) !!}">
                                    <span>@lang('labels.translation_group_' . $group)</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        </ul>
    </section>
</aside>