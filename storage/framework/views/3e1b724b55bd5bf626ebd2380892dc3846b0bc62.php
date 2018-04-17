<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="translations-table">

                        <form action="<?php echo route('admin.translation.update', $group); ?>" method="post" role="form"
                              class="without-js-validation">

                            <?php echo csrf_field(); ?>


                            <input type="hidden" name="page" value="<?php echo $page; ?>">

                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td colspan="<?php echo count($locales) + 1; ?>">
                                        <?php echo $__env->make('translation.partials.buttons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="<?php echo count($locales) + 1; ?>">
                                        <?php echo $list->links(); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <th class="col-sm-3"><?php echo app('translator')->get('labels.key'); ?></th>

                                    <?php foreach($locales as $locale): ?>
                                        <th class="col-sm-3"><?php echo trans('labels.tab_' . $locale); ?></th>
                                    <?php endforeach; ?>
                                </tr>
                                </tbody>

                                <?php foreach($list as $key => $items): ?>
                                    <tr>
                                        <td class="col-sm-3">
                                            <?php echo $key; ?>

                                        </td>

                                        <?php foreach($locales as $locale): ?>
                                            <td class="col-sm-3 form-group
                                            <?php if($errors->has($locale.'.'.$key) || empty($items[$locale])): ?> has-error <?php endif; ?>">
                                            <textarea
                                                    name="<?php echo $locale; ?>[<?php echo $key; ?>]"
                                                    id="<?php echo $locale; ?>_<?php echo str_replace(' ', '_', $key); ?>"
                                                    class="form-control input-sm"
                                            ><?php echo isset($items[$locale]) ? $items[$locale] : null; ?></textarea>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>

                                <tr>
                                    <td colspan="<?php echo count($locales) + 1; ?>">
                                        <?php echo $list->links(); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="<?php echo count($locales) + 1; ?>">
                                        <?php echo $__env->make('translation.partials.buttons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </td>
                                </tr>
                            </table>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.listable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>