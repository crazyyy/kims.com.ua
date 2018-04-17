<?php if($banner->visible_items->count()): ?>
    <div class="main-popup__more-info">
        <div class="main-popup__subTitle"><?php echo $banner->title; ?></div>

        <ul class="main-popup__list">
            <?php foreach($banner->visible_items as $item): ?>
                <li class="main-popup__item"><?php echo $item->text; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>