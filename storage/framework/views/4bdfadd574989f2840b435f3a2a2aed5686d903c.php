<div class="eco-popup main-popup">
    <div class="main-popup__wrapper">

        <div class="main-popup__title"><span><?php echo config('app.name'); ?></span><br>ЭКО ПРОЕКТ</div>

        <div class="eco-popup__wrapper">
            <div class="eco-popup__left">
				<video width="100%" height="auto" controls="controls" poster="uploads/eco/himchistka_eco.jpg">
					<source src="uploads/video/eco_press.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
					<source src="uploads/video/eco_press.webm" type='video/webm; codecs="vp8, vorbis"' />
				</video>
            </div>
			<div class="eco-popup__right">
				<div class="eco-popup__subTitle">
					<?php echo app('translator')->get('front_texts.eco_title'); ?>
                </div>
                <div class="main-popup__desk">
					<strong><?php echo app('translator')->get('front_texts.eco_text-1'); ?></strong>
					<br><br>
					<?php echo app('translator')->get('front_texts.eco_text-2'); ?>
					<br><br>
					<?php echo app('translator')->get('front_texts.eco_text-4'); ?>
                </div>
			</div>
        </div>



		<h4 class="eco-popup__subTitle">Сдавайте пакеты в наши приемные пункты по адресам в Одессе:</h4>

		<div class="eco-popup__wrapper">
			<div class="eco-popup__left-addresses">
					<p class="eco-popup__desk">ул. Канатная, 55</p>
					<p class="eco-popup__desk">пл. 10 Апреля "Сады победы"</p>
					<p class="eco-popup__desk">ул. Люстдорфская дорога, 5</p>
					<p class="eco-popup__desk">ул. Ак. Глушко, 14/4 (рынок "Киевский")</p>
					<p class="eco-popup__desk">ул. Ришельевская, 27</p>
					<p class="eco-popup__desk">ул. Греческая, 46</p>
					<p class="eco-popup__desk">ул. Гастелло, 50</p>
			</div>
			<div class="eco-popup__right-video">
				<video width="100%" height="auto" controls="controls" poster="">
					<source src="uploads/video/eco_prom.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
					<source src="uploads/video/eco_prom.webm" type='video/webm; codecs="vp8, vorbis"' />
				</video>
			</div>
		</div>

		<div class="main-popup__desk"><br><strong><?php echo app('translator')->get('front_texts.eco_text-5'); ?></strong></div>

	</div>

	<div class="main-popup__close"></div>

</div>