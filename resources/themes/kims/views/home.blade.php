<!DOCTYPE html>
<html>
<head>

    @include('partials.head')

    @stack('assets.top')

</head>
<body>

{{--page--}}

<div id="game"></div>

<div class="preloader" data-active>
    <div class="preloader__wrapper">
        <div class="preloader__loader"></div>
        <div class="preloader__text">{!! trans('front_labels.loading') !!}</div>
    </div>
</div>

@include('partials.modules.popup')

@include('partials.adv')
@include('partials.city')
@include('partials.eco')

@include('partials.contacts_popup')

<div class="wrapper">

    @include('partials.header')

    <div id="js-fullpage">

        @include('pages.main')

        @include('pages.about')

        @include('pages.services')

        @include('pages.contacts')
    </div>

    @include('partials.footer')

    <div class="modals"></div>

</div>

{{--page--}}

@include('partials.foot')

</body>
</html>