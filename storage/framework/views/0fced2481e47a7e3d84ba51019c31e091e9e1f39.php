<div class="section contacts">
    <div class="contacts__wrapper">
        <div class="contacts__inner">
            <div class="contacts__top">
                <div class="contacts__city">
                    <div class="contacts__city-image"
                         style="background-image: <?php if(!empty($current_department)): ?> url(<?php echo url($current_department['image']); ?>) <?php else: ?> none <?php endif; ?>">
                    </div>
                    <div class="contacts__city-title">
                        <?php echo config('app.name'); ?><br/>
                        <span class="contacts__city-name">
                            <?php if(!empty($current_department)): ?>
                                <?php echo $current_department['name']; ?>

                            <?php endif; ?>
                        </span>
                    </div>
                </div>

                <?php if(!empty($departments)): ?>
                    <ul class="contacts__cities-list">
                        <?php foreach($departments as $department): ?>
                            <li class="contacts__cities-item <?php if(!empty($current_department) && $department->id == $current_department['id']): ?> active <?php endif; ?>"
                                data-image="<?php echo $department->image; ?>"
                                data-name="<?php echo $department->name; ?>"
                                data-address="<?php echo $department->address; ?>"
                                data-description="<?php echo $department->description; ?>"
                                data-phone="<?php echo $department->phone; ?>"
                                data-email="<?php echo $department->email; ?>"
                                data-id="<?php echo $department->id; ?>">
                                <?php echo $department->name; ?>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="contacts__desc contacts__city-description">
                <?php if(!empty($current_department)): ?>
                    <?php echo $current_department['description']; ?>

                <?php endif; ?>
            </div>

            <ul class="contacts__info">
                <li class="contacts__info-item contacts__city-address" data-info="address">
                    <?php if(!empty($current_department)): ?>
                        <?php echo $current_department['address']; ?>

                    <?php endif; ?>
                </li>
                <li class="contacts__info-item contacts__city-email" data-info="email">
                    <?php if(!empty($current_department)): ?>
                        <?php echo $current_department['email']; ?>

                    <?php endif; ?>
                </li>
                <li class="contacts__info-item contacts__city-phone" data-info="phone">
                    <?php if(!empty($current_department)): ?>
                        <?php echo $current_department['phone']; ?>

                    <?php endif; ?>
                </li>
            </ul>

            <div class="contacts__bottom">
                <button class="contacts__bottom-item contact-with-us" type="button">
                    <span><?php echo app('translator')->get('front_labels.contact_with_us'); ?></span>
                </button>
                <button class="contacts__bottom-item contact-addresses" type="button">
                    <span><?php echo app('translator')->get('front_labels.departments_address'); ?></span>
                </button>
                <button class="contacts__bottom-item contact-franchise contacts__more-popup c-more-popup" type="button">
                    <span><?php echo app('translator')->get('front_labels.franchise'); ?></span>
                </button>
            </div>
        </div>
    </div>

</div>