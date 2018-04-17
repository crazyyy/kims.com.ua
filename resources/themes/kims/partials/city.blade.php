@if(!isset($current_department) || $current_department['default'])
<div class="city-switch main-popup" data-active>
    @else
        <div class="city-switch main-popup">
            @endif


    <div class="main-popup__wrapper">

        <div class="main-popup__title">{!! trans('front_labels.choose') !!}<br>{!! trans('front_labels.city') !!}</div>

        <div class="city-switch__table" data-token="{!! csrf_token() !!}">


            @foreach($departments as $key => $department)

                @if($key % 3 == 0)
                    <div class="city-switch__row">
                @endif

            <div class="city-switch__item" data-dep="{!! $department->id !!}">
                {!! $department->name !!}
            </div>

                @if($key % 3 == 2 || $key == ( count($departments) -1) )
                    </div>
                @endif

            @endforeach

        </div>

    </div>

    <div class="main-popup__close"></div>
</div>