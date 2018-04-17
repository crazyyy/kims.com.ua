<div class="box-body table-responsive no-padding">
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                @foreach (config('app.locales') as $key => $locale)
                    <li @if ($key == 0) class="active" @endif>
                        <a aria-expanded="false" href="#tab_price_{!! $locale !!}" data-toggle="tab">
                            <i class="flag flag-{!! $locale !!}"></i>
                            @lang('labels.tab_'.$locale)
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach (config('app.locales') as $key => $locale)
                    <div class="tab-pane fade in @if ($key == 0) active @endif" id="tab_price_{!! $locale !!}">
                        @include('views.product.partials.price_locale')
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>