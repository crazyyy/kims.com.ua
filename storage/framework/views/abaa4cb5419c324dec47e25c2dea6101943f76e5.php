<?php if($categories->count()): ?>

    <div class="services__left s-left">
        <?php ($p_category = $categories->where('level', 0)->first()); ?>
        <div class="services__start services-start" data-side="left">
            <div class="services-start__title"><?php echo $p_category->name; ?></div>
            <div class="services-start__desc">
                <?php echo $p_category->description; ?>

            </div>
            <div class="services-start__button price-more">
                <span class="price-more__title"><?php echo app('translator')->get('front_labels.learn_the_price'); ?></span>
                <span class="price-more__desc"><?php echo app('translator')->get('front_labels.learn_the_price_helper_text'); ?></span>
            </div>
        </div>

        <ul class="s-left__list">
            <?php foreach($categories->where('level', 0) as $category): ?>
                <li class="s-left__item">
                    <div class="s-left__item-title"><?php echo $category->name; ?></div>
                    <div class="s-left__sub">
                        <?php if($categories->where('parent_id', $category->id)->where('level', 1)->count()): ?>
                            <ul class="s-left__subList">
                                <?php foreach($categories->where('parent_id', $category->id)->where('level', 1) as $child): ?>
                                    <li class="s-left__subItem">
                                        <span><?php echo $child->name; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <div class="s-left__scroll"></div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="services__right s-right">
        <div class="services__start services-start" data-side="right">
            <?php ($p_category = $categories->where('level', 0)->last()); ?>
            <div class="services-start__title"><?php echo $p_category->name; ?></div>
            <div class="services-start__desc">
                <?php echo $p_category->description; ?>

            </div>
            <div class="services-start__button price-more">
                <span class="price-more__title"><?php echo app('translator')->get('front_labels.learn_the_price'); ?></span>
                <span class="price-more__desc"><?php echo app('translator')->get('front_labels.learn_the_price_helper_text'); ?></span>
            </div>
        </div>
        <ul class="s-right__wrapper">
            <?php foreach($categories->where('level', 0) as $category): ?>
                <li class="s-right__wrapperItem">

                    <?php if($categories->where('parent_id', $category->id)->where('level', 1)->count()): ?>
                        <ul class="s-right__mainList r-mainList">
                            <?php foreach($categories->where('parent_id', $category->id)->where('level', 1) as $child): ?>
                                <li class="r-mainList__item">
                                    <div class="s-right__desc">
                                        <?php echo $child->description; ?>

                                    </div>
                                    <ul class="r-mainList__table">
                                        <?php if($child->products->count()): ?>
                                            <li class="r-mainList__table-item">
                                                <table class="r-mainList__table-inner">
                                                    <caption>
                                                        <?php echo $child->name; ?>

                                                    </caption>
                                                    <?php foreach($child->products as $product): ?>
                                                        <tr>
                                                            <td><?php echo $product->name; ?></td>
                                                            <td><?php echo $product->priceForDepartment($current_department['id']); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </table>
                                            </li>
                                        <?php endif; ?>


                                        <?php foreach($categories->where('level', 2)->where('parent_id', $child->id) as $child_child): ?>
                                            <?php if($child_child->products->count() > 0): ?>
                                                <li class="r-mainList__table-item">
                                                    <table class="r-mainList__table-inner">
                                                        <caption><?php echo $child_child->name; ?></caption>
                                                        <?php foreach($child_child->products as $product): ?>
                                                            <tr>
                                                                <td><?php echo $product->name; ?></td>
                                                                <td><?php echo $product->priceForDepartment($current_department['id']); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </table>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>