<li class="contacts-simple__column" data-column="categories">
    <ul class="contacts-simple__cat-list">
        <?php ($i = 0); ?>
        <?php foreach($department_items_groups as $group => $items): ?>
            <li class="contacts-simple__cat-item <?php if($i == 0): ?> active <?php endif; ?>"
                data-tab=".address-tab-<?php echo $i; ?>">
                <?php echo app('translator')->get('front_labels.'.$group); ?>
            </li>
            <?php ($i++); ?>
        <?php endforeach; ?>
    </ul>
</li>

<li class="contacts-simple__column" data-column="addresses">
    <?php ($i = 0); ?>
    <?php foreach($department_items_groups as $group => $items): ?>
        <ul class="contacts-simple__addresses-list address-tab-<?php echo $i; ?> <?php if($i == 0): ?> active <?php endif; ?>">
            <?php foreach($items as $item): ?>
                <li class="contacts-simple__addresses-item">
                    <div class="contacts-simple__addresses-title">
                        <?php echo $item->address; ?>

                        <?php if($item->latitude && $item->longitude): ?>
                            <span class="contacts-simple__addresses-title__map-marker"
                                  data-latitude="<?php echo $item->latitude; ?>"
                                  data-longitude="<?php echo $item->longitude; ?>">
                                <?php echo app('translator')->get('front_labels.on map'); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="contacts-simple__addresses-content">
                        <?php if($item->description): ?>
                            <?php echo $item->description; ?>

                            <br/><br/>
                        <?php endif; ?>
                        <?php if($item->phones): ?>
                            <?php echo app('translator')->get('front_labels.phone_short'); ?>: <?php echo $item->getPhones(); ?>

                            <br/><br/>
                        <?php endif; ?>
                        <?php if($item->work_schedule): ?>
                            <?php echo app('translator')->get('front_labels.work_schedule'); ?>:
                            <br/>
                            <?php echo $item->getWorkSchedule(); ?>

                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php ($i++); ?>
    <?php endforeach; ?>
</li>