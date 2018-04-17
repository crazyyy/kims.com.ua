@if ($banner->visible_items->count()))
    <div class="a-left__main">
        <div class="a-left__desc l-carouselDesc">
            @foreach($banner->visible_items as $item)
                <div class="l-carouselDesc__item">
                    {!! $item->text !!}
                </div>
            @endforeach
        </div>

        <div class="a-left__img l-carouselImg">
            @foreach($banner->visible_items as $item)
                <div class="l-carouselImg__item" style="background-image: url({!! $item->image !!});"></div>
            @endforeach
        </div>
    </div>
@endif