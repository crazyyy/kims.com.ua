<header class="header">
    <a href="#main" class="header__logo" title="KIMS"></a>

	<a href="http://blog.kims.com.ua" target="_blank" title="Blog" class="kims__blog"></a>

        <?php if(isset($current_department['id']) && $current_department['id'] == 1): ?>
        <a href="http://www.himstat.ru/LK.php?CompanyID=31&UseLogin=1" target="_blank" class="header__cabinet h-cab" title="Cabinet" data-active="false"><?php echo trans('front_labels.dashboard'); ?></a>
			<?php elseif(isset($current_department['id']) && $current_department['id'] == 2): ?>
        <a href="http://www.himstat.ru/LK.php?CompanyID=31&UseLogin=1" target="_blank" class="header__cabinet h-cab" title="Cabinet" data-active="true"><?php echo trans('front_labels.dashboard'); ?></a>
			<?php elseif(isset($current_department['id']) && $current_department['id'] == 7): ?>
        <a href="http://www.himstat.ru/LK.php?CompanyID=47&UseLogin=1" target="_blank" class="header__cabinet h-cab" title="Cabinet" data-active="true"><?php echo trans('front_labels.dashboard'); ?></a>
            <?php else: ?>
	    <a href="#" class="header__cabinet h-cab"  data-active="false" target="_blank"></a>
		<?php endif; ?>

    <nav class="header__nav h-nav" title="Menu">
        <div class="h-nav__title"><?php echo app('translator')->get('front_labels.menu'); ?></div>

        <ul id="js-nav" class="h-nav__list">
            <li data-menuanchor="main" class="h-nav__item"><a href="#main"><?php echo app('translator')->get('front_labels.home'); ?></a></li>
            <li data-menuanchor="about" class="h-nav__item"><a href="#about"><?php echo app('translator')->get('front_labels.about_us'); ?></a></li>
            <li data-menuanchor="services" class="h-nav__item"><a href="#services"><?php echo app('translator')->get('front_labels.services'); ?></a></li>
            <li data-menuanchor="contacts" class="h-nav__item"><a href="#contacts"><?php echo app('translator')->get('front_labels.contacts'); ?></a></li>
        </ul>
    </nav>

    <div class="header__languages h-lang" title="Languages">
        <div class="h-lang__title">
            <span data-device="mobile"><?php echo app('translator')->get('front_labels.short_' . app()->getLocale()); ?></span>
            <span data-device="desktop"><?php echo app('translator')->get('front_labels.' . app()->getLocale()); ?></span>
        </div>

        <div class="h-lang__list">
            <?php foreach(config('app.locales') as $key => $locale): ?>
                <li class="h-lang__item">
                    <a href="<?php echo localize_url(null, $locale); ?>">
                        <span data-device="mobile"><?php echo app('translator')->get('front_labels.short_' . $locale); ?></span>
                        <span data-device="desktop"><?php echo app('translator')->get('front_labels.' . $locale); ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if(isset($share) && is_file(public_path() . $share->image)): ?>
        <?php echo $__env->make('partials.promo_button', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <div class="header__contacts h-contacts">

        <div class="h-contacts__departments h-dep" title="City">
            <div class="h-dep__title" data-section="white">
                <?php if(isset($current_department) && !$current_department['default']): ?>
                    <?php echo $current_department['name']; ?>

                <?php else: ?>
                    <?php echo app('translator')->get('front_labels.department_select'); ?>
                <?php endif; ?>
            </div>

            <?php if(!empty($departments)): ?>
                <ul id="js-dep" class="h-dep__list" data-section="white" style="display: none;" data-token="<?php echo csrf_token(); ?>">
                    <?php foreach($departments as $department): ?>
                        <li data-dep="<?php echo $department->id; ?>" class="h-dep__item"
                            data-section="white"><?php echo $department->name; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>



        <a href="#contacts" class="h-contacts__link" title="Contacts"><?php echo app('translator')->get('front_labels.contacts'); ?></a>
        <a target="_blank" href="<?php echo variable('facebook_link'); ?>" title="Facebook" class="h-contacts__fb">
            <?php echo app('translator')->get('front_labels.facebook'); ?>
        </a>
		<?php if(isset($current_department['id']) && $current_department['id'] == 1): ?>
            <a href="http://www.himstat.ru/LK.php?CompanyID=31&UseLogin=1" target="_blank" class="h-contacts__cabinet h-cab" title="Cabinet" data-active="true"><?php echo trans('front_labels.dashboard'); ?></a>
		<?php elseif(isset($current_department['id']) && $current_department['id'] == 2): ?>
            <a href="http://www.himstat.ru/LK.php?CompanyID=31&UseLogin=1" target="_blank" class="h-contacts__cabinet h-cab" title="Cabinet" data-active="true"><?php echo trans('front_labels.dashboard'); ?></a>
		<?php elseif(isset($current_department['id']) && $current_department['id'] == 7): ?>
            <a href="http://www.himstat.ru/LK.php?CompanyID=47&UseLogin=1" target="_blank" class="h-contacts__cabinet h-cab" title="Cabinet" data-active="true"><?php echo trans('front_labels.dashboard'); ?></a>
        <?php else: ?>
        <a href="#" target="_blank" class="h-contacts__cabinet h-cab" data-active="false"></a>
            <?php endif; ?>
    </div>
</header>