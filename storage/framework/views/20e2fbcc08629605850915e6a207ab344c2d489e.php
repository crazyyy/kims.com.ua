<div class="contact-popup main-popup">
    <div class="main-popup__wrapper">
        <div class="main-popup__title"><?php echo app('translator')->get('front_labels.lets'); ?><br><?php echo app('translator')->get('front_labels.fix_all'); ?></div>

        <form action="<?php echo route('feedback.store'); ?>" method="post" class="contact-popup__form">
            <?php echo csrf_field(); ?>


            <div class="contact-popup__form-wrapper">
				<input type="text" name="contact-сity" placeholder="<?php echo app('translator')->get('front_labels.your_city'); ?>" required>
                <input type="text" name="contact-name" placeholder="<?php echo app('translator')->get('front_labels.your_name'); ?>" required>
                <input type="text" name="contact-phone" placeholder="<?php echo app('translator')->get('front_labels.your_phone'); ?>" required>
                <input type="text" name="contact-email" placeholder="<?php echo app('translator')->get('front_labels.your_email'); ?>" required>
            </div>

            <textarea name="contact-comment" id="f-contact-comment" cols="30" rows="4" placeholder="<?php echo app('translator')->get('front_labels.your_message'); ?>"></textarea>

            <div class="contact-popup__submit">
                <button class="contact-popup__submit-button main-popup-submit" type="submit" name="contact-submit"><span><?php echo app('translator')->get('front_labels.send'); ?></span></button>
            </div>
        </form>
    </div>

    <div class="main-popup__close"></div>
</div>

<div class="contact-us-popup main-popup">
    <div class="main-popup__wrapper">
        <div class="main-popup__title">kims<br>одесса</div>

        <div class="contact-us-popup__wrapper">
            <div class="contact-us-popup__info">
                <div class="main-popup__desk">Компания «КИМС» владеет собственной крупнейшей в Украине сетью предприятий
                    бытового обслуживания, включающей в себя цеха химчистки, прачечную, мастерские по ремонту обуви, ряд приемных
                    пунктов.
                </div>

                <ul class="contact-us-popup__list">
                    <li class="contact-us-popup__item" data-contact-us="address">
                        <span>ул. Канатная, 55</span>
                        <span>ул. ещеодинадрес, 55</span>
                    </li>

                    <li class="contact-us-popup__item" data-contact-us="phone">
                        <span>(048) 777-06-06</span>
                        <span>(048) 777-06-06</span>
                    </li>

                    <li class="contact-us-popup__item" data-contact-us="mail">
                        <a href="mailto:info@kims.com.ua">info@kims.com.ua</a>
                    </li>
                </ul>
            </div>

            <div class="contact-us-popup__img" style="background-image: url('<?php echo theme_asset('images/kims-office-img.jpg'); ?>');"></div>
        </div>

        <div class="contact-us-popup__submit">
            <button class="contact-us-popup__submit-button main-popup-submit" type="submit" name="contact-submit"><span><?php echo trans('front_labels.contact_with_us'); ?></span></button>
        </div>
    </div>

    <div class="main-popup__close"></div>
</div>

<div class="franchising-popup main-popup">
    <a href="http://kims.ua" class="main-popup__more h-more" target="_blank">
      <span class="h-more__title"><?php echo trans('front_labels.to_learn_more'); ?></span>
    </a>
    <div class="main-popup__wrapper">
        <div class="main-popup__title"><span><?php echo config('app.name'); ?></span><br><?php echo app('translator')->get('front_labels.franchising'); ?></div>

        <div class="franchising-popup__wrapper">
            <div class="franchising-popup__left">
                <div class="main-popup__subTitle">
                    <?php echo app('translator')->get('front_texts.franchising_title'); ?>
                </div>

                <div class="main-popup__desk">
                    <?php echo app('translator')->get('front_texts.franchising_text'); ?>
                </div>

                <?php echo Widget::widget__banner('franchising_is'); ?>
            </div>

            <?php echo Widget::widget__banner('franchise'); ?>
        </div>
    </div>

    <div class="main-popup__close"></div>
</div>