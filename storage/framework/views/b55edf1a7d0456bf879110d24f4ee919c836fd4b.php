<div class="box-body table-responsive no-padding">
    <table class="table table-hover duplication">
        <tbody>
        <tr>
            <th class="col-md-3"><?php echo trans('labels.image'); ?></th>
            <th><?php echo trans('labels.name'); ?></th>
            <th class="col-sm-1 col-md-1 col-lg-1"><?php echo trans('labels.status'); ?><span class="required">*</span></th>
            <th class="col-sm-1 col-md-1 col-lg-1"><?php echo trans('labels.position'); ?><span class="required">*</span></th>
            <th><?php echo trans('labels.delete'); ?></th>
        </tr>

        <?php if(count($model->items)): ?>
            <?php foreach($model->items as $item): ?>
                <tr class="duplication-row">
                    <td>
                        <div class="form-group <?php if($errors->has('items.old.' .$item->id. '.image')): ?> has-error <?php endif; ?>">
                            <?php echo Form::imageInput('items[old][' .$item->id. '][image]', $item->image); ?>


                            <?php echo $errors->first('items.old.' .$item->id. '.image', '<p class="help-block error">:message</p>'); ?>

                        </div>
                    </td>
                    <td class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <?php foreach(config('app.locales') as $key => $locale): ?>
                                <li <?php if($key == 0): ?> class="active" <?php endif; ?>>
                                    <a aria-expanded="false" href="#tab_item_locale_old_<?php echo $locale; ?>_<?php echo $item->id; ?>" data-toggle="tab">
                                        <i class="flag flag-<?php echo $locale; ?>"></i>
                                        <?php echo app('translator')->get('labels.tab_'.$locale); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="tab-content">
                            <?php foreach(config('app.locales') as $key => $locale): ?>
                                <div class="tab-pane fade in <?php if($key == 0): ?> active <?php endif; ?>" id="tab_item_locale_old_<?php echo $locale; ?>_<?php echo $item->id; ?>">
                                    <?php echo $__env->make('views.banner.tabs.item_locale', ['id' => $item->id, 'key' => 'old'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group required <?php if($errors->has('items.old.' .$item->id. '.status')): ?> has-error <?php endif; ?>">
                            <?php echo Form::select('items[old][' .$item->id. '][status]', ['1' => trans('labels.status_on'), '0' => trans('labels.status_off')], $item->status, ['id' => 'items.old.' .$item->id. '.position', 'class' => 'form-control select2 input-sm', 'aria-hidden' => 'true', 'required' => true]); ?>

                        </div>
                    </td>
                    <td>
                        <div class="form-group required <?php if($errors->has('items.old.' .$item->id. '.position')): ?> has-error <?php endif; ?>">
                            <?php echo Form::text('items[old][' .$item->id. '][position]', $item->position, ['id' => 'items.old.' .$item->id. '.position', 'class' => 'form-control input-sm']); ?>

                        </div>
                    </td>
                    <td class="coll-actions">
                        <a class="btn btn-flat btn-danger btn-xs action exist destroy" data-id="<?php echo $item->id; ?>" data-name="items[remove][]"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if(count(old('items.new'))): ?>
            <?php foreach(old('items.new') as $item_key => $item): ?>
                <?php if($item_key !== 'replaseme'): ?>
                    <tr class="duplication-row">
                        <td>
                            <div class="form-group <?php if($errors->has('items.new.' .$item_key. '.image')): ?> has-error <?php endif; ?>">
                                <?php echo Form::imageInput('items[new][' .$item_key. '][image]', $item['image']); ?>


                                <?php echo $errors->first('items.new.' .$item_key. '.image', '<p class="help-block error">:message</p>'); ?>

                            </div>
                        </td>
                        <td class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <?php foreach(config('app.locales') as $key => $locale): ?>
                                    <li <?php if($key == 0): ?> class="active" <?php endif; ?>>
                                        <a aria-expanded="false" href="#tab_item_locale_new_<?php echo $locale; ?>_<?php echo $item_key; ?>" data-toggle="tab">
                                            <i class="flag flag-<?php echo $locale; ?>"></i>
                                            <?php echo app('translator')->get('labels.tab_'.$locale); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <div class="tab-content">
                                <?php foreach(config('app.locales') as $key => $locale): ?>
                                    <div class="tab-pane fade in <?php if($key == 0): ?> active <?php endif; ?>" id="tab_item_locale_new_<?php echo $locale; ?>_<?php echo $item_key; ?>">
                                        <?php echo $__env->make('views.banner.tabs.item_locale', ['id' => $item_key, 'key' => 'new'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </td>
                        <td>
                            <div class="form-group required <?php if($errors->has('items.new.' .$item_key. '.status')): ?> has-error <?php endif; ?>">
                                <?php echo Form::select('items[new][' .$item_key. '][status]', ['1' => trans('labels.status_on'), '0' => trans('labels.status_off')], $item['status'], ['id' => 'items.new.' .$item_key. '.status', 'class' => 'form-control select2 input-sm', 'aria-hidden' => 'true', 'required' => true]); ?>

                            </div>
                        </td>
                        <td>
                            <div class="form-group required <?php if($errors->has('items.new.' .$item_key. '.position')): ?> has-error <?php endif; ?>">
                                <?php echo Form::text('items[new][' .$item_key. '][position]', $item['position'], ['id' => 'items.new.' .$item_key. '.position', 'class' => 'form-control input-sm']); ?>

                            </div>
                        </td>
                        <td class="coll-actions">
                            <a class="btn btn-flat btn-danger btn-xs action destroy"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <tr class="duplication-button">
            <td colspan="6" class="text-center">
                <a title="<?php echo app('translator')->get('labels.add_one_more'); ?>" class="btn btn-flat btn-primary btn-sm action create"><i class="glyphicon glyphicon-plus"></i></a>
            </td>
        </tr>

        <tr class="duplication-row duplicate">
            <td>
                <div class="form-group">
                    <?php echo Form::imageInput('', '', ['data-related-image' => 'itemsnewreplasemeimage', 'data-name' => 'items[new][replaseme][image]']); ?>

                </div>
            </td>
            <td class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <?php foreach(config('app.locales') as $key => $locale): ?>
                        <li <?php if($key == 0): ?> class="active" <?php endif; ?>>
                            <a aria-expanded="false" href="#tab_item_locale_new_<?php echo $locale; ?>_replaseme" data-toggle="tab">
                                <i class="flag flag-<?php echo $locale; ?>"></i>
                                <?php echo app('translator')->get('labels.tab_'.$locale); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="tab-content">
                    <?php foreach(config('app.locales') as $key => $locale): ?>
                        <div class="tab-pane fade in <?php if($key == 0): ?> active <?php endif; ?>" id="tab_item_locale_new_<?php echo $locale; ?>_replaseme">
                            <div class="form-group required">
                                <input data-name="items[new][replaseme][<?php echo $locale; ?>][title]" placeholder="<?php echo app('translator')->get('labels.banner_title'); ?>" class="form-control input-sm">
                            </div>

                            <div class="form-group required">
                                <input data-name="items[new][replaseme][<?php echo $locale; ?>][sub_title]" placeholder="<?php echo app('translator')->get('labels.sub_title'); ?>" class="form-control input-sm">
                            </div>

                            <div>
                                <textarea data-name="items[new][replaseme][<?php echo $locale; ?>][text]" placeholder="<?php echo app('translator')->get('labels.text'); ?>" rows="2" class="form-control input-sm"></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </td>
            <td>
                <div class="form-group required">
                    <select class="form-control select2 input-sm" data-required="required" aria-hidden="true" data-name="items[new][replaseme][status]">
                        <option selected="selected" value="1"><?php echo app('translator')->get('labels.status_on'); ?></option>
                        <option value="0"><?php echo app('translator')->get('labels.status_off'); ?></option>
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group required">
                    <input data-name="items[new][replaseme][position]" value="0" data-required="required" class="form-control input-sm">
                </div>
            </td>
            <td class="coll-actions">
                <a class="btn btn-flat btn-danger btn-xs action destroy"><i class="fa fa-remove"></i></a>
            </td>
        </tr>

        </tbody>
    </table>
</div>