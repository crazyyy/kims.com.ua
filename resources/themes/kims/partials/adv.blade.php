<div class="adv-popup main-popup">

    <div class="adv-popup__wrapper">
		<img src="{!! isset($share->image) ? url($share->image) : '' !!}" alt="Promo" class="adv-popup__image">
	</div>

	<div class="adv-popup__tab">
		<div class="adv-popup__desk">
		</div>
	</div>

    <div class="adv-popup__close">
        <div class="adv-popup__close-inner">
			{!! trans('labels.close') !!}
		</div>
    </div>
</div>