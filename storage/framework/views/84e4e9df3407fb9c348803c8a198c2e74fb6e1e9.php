<?php if($item->multilingual): ?>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <?php foreach(config('app.locales') as $key => $locale): ?>
                <li <?php if($key == 0): ?> class="active" <?php endif; ?>>
                    <a aria-expanded="false" href="#tab_<?php echo $item->id; ?>_<?php echo $locale; ?>" data-toggle="tab">
                        <i class="flag flag-<?php echo $locale; ?>"></i>
                        <?php echo app('translator')->get('labels.tab_'.$locale); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="tab-content">
            <?php foreach(config('app.locales') as $key => $locale): ?>
                <div class="tab-pane fade in <?php if($key == 0): ?> active <?php endif; ?>" id="tab_<?php echo $item->id; ?>_<?php echo $locale; ?>">
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <?php echo Form::text($locale.'[text]', isset($item->translate($locale)->text) ? $item->translate($locale)->text : '', ['id' => $locale.'_text', 'placeholder' => trans('labels.text'), 'required' => true, 'class' => 'form-control input-sm']); ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php else: ?>

    <div class="row form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
            <?php echo Form::text('value', null, ['id' => 'value', 'placeholder' => trans('labels.value'), 'required' => true, 'class' => 'form-control input-sm']); ?>

        </div>
    </div>

<?php endif; ?>