<div id="main_section" class="section main">
    <div class="main__happened m-happened">
        <h1 class="m-happened__title">
            <?php echo app('translator')->get('front_labels.main_spot'); ?><!--
                --><span class="m-happened__tooltip <?php if(app()->getLocale() == 'uk'): ?> uk <?php endif; ?>"><!--
                --><?php echo app('translator')->get('front_labels.main_spot_char'); ?><i class="main-icon"></i><span
                        class="m-happened__tooltipWrapper">
                <?php echo app('translator')->get('front_texts.happened a spot top description'); ?>
                </span></span>сь<br/><?php echo app('translator')->get('front_labels.spot'); ?>?
        </h1>

        <div class="m-happened__desc">
            <?php echo app('translator')->get('front_texts.happened a spot bottom description'); ?>
        </div>

        <a href="#about" class="m-happened__more h-more">
            <span class="h-more__title"><?php echo app('translator')->get('front_labels.to_learn_more'); ?></span>
            <span class="h-more__desc"><?php echo app('translator')->get('front_texts.to learn more description'); ?></span>
        </a>
    </div>

    <div id="item_image" class="main__fix m-fix">
        <div class="m-fix__inner">
            <a href="#contacts" class="m-fix__wrapper">
                <span class="m-fix__title"><?php echo app('translator')->get('front_labels.fix_now'); ?></span>

              <span class="m-fix__desc">
                  <?php echo app('translator')->get('front_texts.fix now description'); ?>
              </span>
            </a>
        </div>
    </div>
<?php echo $__env->make('partials.eco_button', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>