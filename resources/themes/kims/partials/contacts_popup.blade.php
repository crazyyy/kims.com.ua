<div class="contacts-simple main-popup">
    <div class="main-popup__wrapper">
        <div class="main-popup__title">
            {!! config('app.name') !!}
            <br>
            <div class="contacts__city-name">
                @if (!empty($current_department))
                    {!! $current_department['name'] !!}
                @endif
            </div>
        </div>

        <ul class="contacts-simple__content">
            @include('partials.contacts_popup_tabs')
			<li class="contacts__scroll"></li>
            <li class="contacts-simple__column" data-column="map">
                <div id="contacts-simple-map" class="contacts-simple__map"></div>
            </li>
        </ul>
    </div>

    <div class="main-popup__close"></div>
</div>