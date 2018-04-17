<li class="contacts-simple__column" data-column="categories">
    <ul class="contacts-simple__cat-list">
        @php($i = 0)
        @foreach($department_items_groups as $group => $items)
            <li class="contacts-simple__cat-item @if ($i == 0) active @endif"
                data-tab=".address-tab-{!! $i !!}">
                @lang('front_labels.'.$group)
            </li>
            @php($i++)
        @endforeach
    </ul>
</li>

<li class="contacts-simple__column" data-column="addresses">
    @php($i = 0)
    @foreach($department_items_groups as $group => $items)
        <ul class="contacts-simple__addresses-list address-tab-{!! $i !!} @if ($i == 0) active @endif">
            @foreach($items as $item)
                <li class="contacts-simple__addresses-item">
                    <div class="contacts-simple__addresses-title">
                        {!! $item->address !!}
						@if ($item->phones)
						@lang('front_labels.phone_short'): {!! $item->getPhones() !!}
                        @endif
                        @if ($item->latitude && $item->longitude)
                            <span class="contacts-simple__addresses-title__map-marker"
                                  data-latitude="{!! $item->latitude !!}"
                                  data-longitude="{!! $item->longitude !!}">
                                @lang('front_labels.on map')
                            </span>
                        @endif
                    </div>

                    <div class="contacts-simple__addresses-content">
                        @if ($item->description)
                            {!! $item->description !!}
                            <br/><br/>
                        @endif
                        @if ($item->work_schedule)
                            @lang('front_labels.work_schedule'):
                            <br/>
                            {!! $item->getWorkSchedule() !!}
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
        @php($i++)
    @endforeach
</li>