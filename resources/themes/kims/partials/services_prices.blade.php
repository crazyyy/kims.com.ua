@if ($categories->count())

    <div class="services__left s-left">
        @php($p_category = $categories->where('level', 0)->first())
        <div class="services__start services-start" data-side="left">
            <div class="services-start__title">{!! $p_category->name !!}</div>
            <div class="services-start__desc">
                {!! $p_category->description !!}
            </div>
            <div class="services-start__button price-more">
                <span class="price-more__title">@lang('front_labels.learn_the_price')</span>
                <span class="price-more__desc">@lang('front_labels.learn_the_price_helper_text')</span>
            </div>
        </div>

        <ul class="s-left__list">
            @foreach($categories->where('level', 0) as $category)
                <li class="s-left__item">
                    <div class="s-left__item-title">{!! $category->name !!}</div>
                    <div class="s-left__sub">
                        @if ($categories->where('parent_id', $category->id)->where('level', 1)->count())
                            <ul class="s-left__subList">
                                @foreach($categories->where('parent_id', $category->id)->where('level', 1) as $child)
                                    <li class="s-left__subItem">
                                        <span>{!! $child->name !!}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="s-left__scroll"></div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="services__right s-right">
        <div class="services__start services-start" data-side="right">
            @php($p_category = $categories->where('level', 0)->last())
            <div class="services-start__title">{!! $p_category->name !!}</div>
            <div class="services-start__desc">
                {!! $p_category->description !!}
            </div>
            <div class="services-start__button price-more">
                <span class="price-more__title">@lang('front_labels.learn_the_price')</span>
                <span class="price-more__desc">@lang('front_labels.learn_the_price_helper_text')</span>
            </div>
        </div>
        <ul class="s-right__wrapper">
            @foreach($categories->where('level', 0) as $category)
                <li class="s-right__wrapperItem">

                    @if ($categories->where('parent_id', $category->id)->where('level', 1)->count())
                        <ul class="s-right__mainList r-mainList">
                            @foreach($categories->where('parent_id', $category->id)->where('level', 1) as $child)
                                <li class="r-mainList__item">
                                    <div class="s-right__desc">
                                        {!! $child->description !!}
                                    </div>
                                    <ul class="r-mainList__table">
                                        @if ($child->products->count())
                                            <li class="r-mainList__table-item">
                                                <table class="r-mainList__table-inner">
                                                    <caption>
                                                        {!! $child->name !!}
                                                    </caption>
                                                    @foreach($child->products as $product)
                                                        <tr>
                                                            <td>{!! $product->name !!}</td>
                                                            <td>{!! $product->priceForDepartment($current_department['id']) !!}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </li>
                                        @endif


                                        @foreach($categories->where('level', 2)->where('parent_id', $child->id) as $child_child)
                                            @if ($child_child->products->count() > 0)
                                                <li class="r-mainList__table-item">
                                                    <table class="r-mainList__table-inner">
                                                        <caption>{!! $child_child->name !!}</caption>
                                                        @foreach($child_child->products as $product)
                                                            <tr>
                                                                <td>{!! $product->name !!}</td>
                                                                <td>{!! $product->priceForDepartment($current_department['id']) !!}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

@endif