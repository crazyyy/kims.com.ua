<?php if($banner->visible_items->count()): ?>
    <div class="a-right__fixCarousel r-fixCarousel">
        <?php if($banner->visible_items->count() > 1): ?>
            <div class="r-fixCarousel__arrows">
                <div class="r-fixCarousel__prev"></div>
                <div class="r-fixCarousel__next"></div>
            </div>
        <?php endif; ?>

        <ul class="r-fixCarousel__list">
            <?php foreach($banner->visible_items as $item): ?>
                <li class="r-fixCarousel__item">
                    <h2 class="r-fixCarousel__title"><?php echo $item->title; ?></h2>
                    <div class="r-fixCarousel__subTitle"><?php echo $item->sub_title; ?></div>
                    <div class="r-fixCarousel__desc">
                        <?php echo $item->text; ?>

                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>