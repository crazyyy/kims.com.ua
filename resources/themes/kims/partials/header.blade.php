<header class="header">
    <a href="#main" class="header__logo" title="KIMS"></a>

	<a href="http://blog.kims.com.ua" target="_blank" title="Blog" class="kims__blog"></a>

        @if(isset($current_department['id']) && $current_department['id'] == 1)
        <a href="http://www.himstat.ru/LK.php?CompanyID=31&UseLogin=1" target="_blank" class="header__cabinet h-cab" title="Cabinet" data-active="false">{!! trans('front_labels.dashboard') !!}</a>
			@elseif(isset($current_department['id']) && $current_department['id'] == 2)
        <a href="http://www.himstat.ru/LK.php?CompanyID=31&UseLogin=1" target="_blank" class="header__cabinet h-cab" title="Cabinet" data-active="true">{!! trans('front_labels.dashboard') !!}</a>
			@elseif(isset($current_department['id']) && $current_department['id'] == 7)
        <a href="http://www.himstat.ru/LK.php?CompanyID=47&UseLogin=1" target="_blank" class="header__cabinet h-cab" title="Cabinet" data-active="true">{!! trans('front_labels.dashboard') !!}</a>
            @else
	    <a href="#" class="header__cabinet h-cab"  data-active="false" target="_blank"></a>
		@endif

    <nav class="header__nav h-nav" title="Menu">
        <div class="h-nav__title">@lang('front_labels.menu')</div>

        <ul id="js-nav" class="h-nav__list">
            <li data-menuanchor="main" class="h-nav__item"><a href="#main">@lang('front_labels.home')</a></li>
            <li data-menuanchor="about" class="h-nav__item"><a href="#about">@lang('front_labels.about_us')</a></li>
            <li data-menuanchor="services" class="h-nav__item"><a href="#services">@lang('front_labels.services')</a></li>
            <li data-menuanchor="contacts" class="h-nav__item"><a href="#contacts">@lang('front_labels.contacts')</a></li>
        </ul>
    </nav>

    <div class="header__languages h-lang" title="Languages">
        <div class="h-lang__title">
            <span data-device="mobile">@lang('front_labels.short_' . app()->getLocale())</span>
            <span data-device="desktop">@lang('front_labels.' . app()->getLocale())</span>
        </div>

        <div class="h-lang__list">
            @foreach (config('app.locales') as $key => $locale)
                <li class="h-lang__item">
                    <a href="{!! localize_url(null, $locale) !!}">
                        <span data-device="mobile">@lang('front_labels.short_' . $locale)</span>
                        <span data-device="desktop">@lang('front_labels.' . $locale)</span>
                    </a>
                </li>
            @endforeach
        </div>
    </div>

    @if(isset($share) && is_file(public_path() . $share->image))
        @include('partials.promo_button')
    @endif

    <div class="header__contacts h-contacts">

        <div class="h-contacts__departments h-dep" title="City">
            <div class="h-dep__title" data-section="white">
                @if(isset($current_department) && !$current_department['default'])
                    {!! $current_department['name'] !!}
                @else
                    @lang('front_labels.department_select')
                @endif
            </div>

            @if(!empty($departments))
                <ul id="js-dep" class="h-dep__list" data-section="white" style="display: none;" data-token="{!! csrf_token() !!}">
                    @foreach($departments as $department)
                        <li data-dep="{!! $department->id !!}" class="h-dep__item"
                            data-section="white">{!! $department->name !!}</li>
                    @endforeach
                </ul>
            @endif
        </div>



        <a href="#contacts" class="h-contacts__link" title="Contacts">@lang('front_labels.contacts')</a>
        <a target="_blank" href="{!! variable('facebook_link') !!}" title="Facebook" class="h-contacts__fb">
            @lang('front_labels.facebook')
        </a>
		@if(isset($current_department['id']) && $current_department['id'] == 1)
            <a href="http://www.himstat.ru/LK.php?CompanyID=31&UseLogin=1" target="_blank" class="h-contacts__cabinet h-cab" title="Cabinet" data-active="true">{!! trans('front_labels.dashboard') !!}</a>
		@elseif(isset($current_department['id']) && $current_department['id'] == 2)
            <a href="http://www.himstat.ru/LK.php?CompanyID=31&UseLogin=1" target="_blank" class="h-contacts__cabinet h-cab" title="Cabinet" data-active="true">{!! trans('front_labels.dashboard') !!}</a>
		@elseif(isset($current_department['id']) && $current_department['id'] == 7)
            <a href="http://www.himstat.ru/LK.php?CompanyID=47&UseLogin=1" target="_blank" class="h-contacts__cabinet h-cab" title="Cabinet" data-active="true">{!! trans('front_labels.dashboard') !!}</a>
        @else
        <a href="#" target="_blank" class="h-contacts__cabinet h-cab" data-active="false"></a>
            @endif
    </div>
</header>