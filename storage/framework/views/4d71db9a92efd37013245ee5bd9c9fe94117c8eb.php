<div class="contacts-simple main-popup">
    <div class="main-popup__wrapper">
        <div class="main-popup__title">
            <?php echo config('app.name'); ?>

            <br>
            <div class="contacts__city-name">
                <?php if(!empty($current_department)): ?>
                    <?php echo $current_department['name']; ?>

                <?php endif; ?>
            </div>
        </div>

        <ul class="contacts-simple__content">
            <?php echo $__env->make('partials.contacts_popup_tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <li class="contacts-simple__column" data-column="map">
                <div id="contacts-simple-map" class="contacts-simple__map"></div>
            </li>
        </ul>
    </div>

    <div class="main-popup__close"></div>
</div>