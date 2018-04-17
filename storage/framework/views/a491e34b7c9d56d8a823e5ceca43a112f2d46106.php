<?php if($banner->visible_items->count()): ?>)
    <div class="a-left__main">
        <div class="a-left__desc l-carouselDesc">
            <?php foreach($banner->visible_items as $item): ?>
                <div class="l-carouselDesc__item">
                    <?php echo $item->text; ?>

                </div>
            <?php endforeach; ?>
        </div>

        <div class="a-left__img l-carouselImg">
            <?php foreach($banner->visible_items as $item): ?>
                <div class="l-carouselImg__item" style="background-image: url(<?php echo $item->image; ?>);"></div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>