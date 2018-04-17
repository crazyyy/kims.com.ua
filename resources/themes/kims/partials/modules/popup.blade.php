<div class="contact-popup main-popup">
    <div class="main-popup__wrapper">
        <div class="main-popup__title">@lang('front_labels.lets')<br>@lang('front_labels.fix_all')</div>

        <form action="{!! route('feedback.store') !!}" method="post" class="contact-popup__form">
            {!! csrf_field() !!}

            <div class="contact-popup__form-wrapper">
				<input type="text" name="contact-сity" placeholder="@lang('front_labels.your_city')" required>
                <input type="text" name="contact-name" placeholder="@lang('front_labels.your_name')" required>
                <input type="text" name="contact-phone" placeholder="@lang('front_labels.your_phone')" required>
                <input type="text" name="contact-email" placeholder="@lang('front_labels.your_email')" required>
            </div>

            <textarea name="contact-comment" id="f-contact-comment" cols="30" rows="4" placeholder="@lang('front_labels.your_message')"></textarea>

            <div class="contact-popup__submit">
                <button class="contact-popup__submit-button main-popup-submit" type="submit" name="contact-submit"><span>@lang('front_labels.send')</span></button>
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

            <div class="contact-us-popup__img" style="background-image: url('{!! theme_asset('images/kims-office-img.jpg') !!}');"></div>
        </div>

        <div class="contact-us-popup__submit">
            <button class="contact-us-popup__submit-button main-popup-submit" type="submit" name="contact-submit"><span>{!! trans('front_labels.contact_with_us') !!}</span></button>
        </div>
    </div>

    <div class="main-popup__close"></div>
</div>

<div class="franchising-popup main-popup">
    <a href="http://kims.ua" class="main-popup__more h-more" target="_blank">
      <span class="h-more__title">{!! trans('front_labels.to_learn_more') !!}</span>
    </a>
    <div class="main-popup__wrapper">
        <div class="main-popup__title"><span>{!! config('app.name') !!}</span><br>@lang('front_labels.franchising')</div>

        <div class="franchising-popup__wrapper">
            <div class="franchising-popup__left">
                <div class="main-popup__subTitle">
                    @lang('front_texts.franchising_title')
                </div>

                <div class="main-popup__desk">
                    @lang('front_texts.franchising_text')
                </div>

                @widget__banner('franchising_is')
            </div>

            @widget__banner('franchise')
        </div>
    </div>

    <div class="main-popup__close"></div>
</div>