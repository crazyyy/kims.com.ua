@if ($banner->visible_items->count())
    <div class="main-popup__more-info">
        <div class="main-popup__subTitle">{!! $banner->title !!}</div>

        <ul class="main-popup__list">
            @foreach($banner->visible_items as $item)
                <li class="main-popup__item">{!! $item->text !!}</li>
            @endforeach
        </ul>
		<a href="http://kims.com.ua/uploads/pdf/Franchising_KIMS.pdf" title="Скачать" class="franchising__download" download>@lang('labels.download_pdf')</a>
    </div>
@endif