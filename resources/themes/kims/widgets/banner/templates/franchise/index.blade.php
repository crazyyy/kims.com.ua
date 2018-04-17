<div class="franchising-popup__right">
    @if ($banner->visible_items->count())
        <div class="franchising-popup__slider franchising-slider">
            <ul class="franchising-slider__list">
                @foreach($banner->visible_items as $item)
                    <li class="franchising-slider__item"
                        style="background-image: url({!! thumb($item->image, 314, 200) !!});">
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="contact-us-popup__submit">
        <button class="contact-us-popup__submit-button main-popup-submit" type="submit" name="contact-submit">
            <span>@lang('front_labels.contact_with_us')</span>
        </button>
    </div>
</div>