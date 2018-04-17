@if ($banner->visible_items->count())
    <div class="a-right__fixCarousel r-fixCarousel">
        @if ($banner->visible_items->count() > 1)
            <div class="r-fixCarousel__arrows">
                <div class="r-fixCarousel__prev"></div>
                <div class="r-fixCarousel__next"></div>
            </div>
        @endif

        <ul class="r-fixCarousel__list">
            @foreach($banner->visible_items as $item)
                <li class="r-fixCarousel__item">
                    <h2 class="r-fixCarousel__title">{!! $item->title !!}</h2>
                    <div class="r-fixCarousel__subTitle">{!! $item->sub_title !!}</div>
                    <div class="r-fixCarousel__desc">
                        {!! $item->text !!}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif