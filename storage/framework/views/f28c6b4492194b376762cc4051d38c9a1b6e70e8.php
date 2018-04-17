<?php if(!isset($current_department) || $current_department['default']): ?>
<div class="city-switch main-popup" data-active>
    <?php else: ?>
        <div class="city-switch main-popup">
            <?php endif; ?>


    <div class="main-popup__wrapper">

        <div class="main-popup__title"><?php echo trans('front_labels.choose'); ?><br><?php echo trans('front_labels.city'); ?></div>

        <div class="city-switch__table" data-token="<?php echo csrf_token(); ?>">


            <?php foreach($departments as $key => $department): ?>

                <?php if($key % 3 == 0): ?>
                    <div class="city-switch__row">
                <?php endif; ?>

            <div class="city-switch__item" data-dep="<?php echo $department->id; ?>">
                <?php echo $department->name; ?>

            </div>

                <?php if($key % 3 == 2 || $key == ( count($departments) -1) ): ?>
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>

        </div>

    </div>

    <div class="main-popup__close"></div>
</div>