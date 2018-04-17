<div class="section contacts">
    <div class="contacts__wrapper">
        <div class="contacts__inner">
            <div class="contacts__top">
                <div class="contacts__city">
                    <div class="contacts__city-image"
                         style="background-image: @if(!empty($current_department)) url({!! url($current_department['image']) !!}) @else none @endif">
                    </div>
                    <div class="contacts__city-title">
                        {!! config('app.name') !!}<br/>
                        <span class="contacts__city-name">
                            @if (!empty($current_department))
                                {!! $current_department['name'] !!}
                            @endif
                        </span>
                    </div>
                </div>

                @if(!empty($departments))
                    <ul class="contacts__cities-list">
                        @foreach($departments as $department)
                            <li class="contacts__cities-item @if (!empty($current_department) && $department->id == $current_department['id']) active @endif"
                                data-image="{!! $department->image !!}"
                                data-name="{!! $department->name !!}"
                                data-address="{!! $department->address !!}"
                                data-description="{!! $department->description !!}"
                                data-phone="{!! $department->phone !!}"
                                data-email="{!! $department->email !!}"
                                data-id="{!! $department->id !!}">
                                {!! $department->name !!}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="contacts__desc contacts__city-description">
                @if (!empty($current_department))
                    {!! $current_department['description'] !!}
                @endif
            </div>

            <ul class="contacts__info">
                <li class="contacts__info-item contacts__city-address" data-info="address">
                    @if (!empty($current_department))
                        {!! $current_department['address'] !!}
                    @endif
                </li>
                <li class="contacts__info-item contacts__city-email" data-info="email">
                    @if (!empty($current_department))
                        {!! $current_department['email'] !!}
                    @endif
                </li>
                <li class="contacts__info-item contacts__city-phone" data-info="phone">
                    @if (!empty($current_department))
                        {!! $current_department['phone'] !!}
                    @endif
                </li>
            </ul>

            <div class="contacts__bottom">
                <button class="contacts__bottom-item contact-with-us" type="button">
                    <span>@lang('front_labels.contact_with_us')</span>
                </button>
                <button class="contacts__bottom-item contact-addresses" type="button">
                    <span>@lang('front_labels.departments_address')</span>
                </button>
                <button class="contacts__bottom-item contact-franchise contacts__more-popup c-more-popup" type="button">
                    <span>@lang('front_labels.franchise')</span>
                </button>
            </div>
        </div>
    </div>

</div>