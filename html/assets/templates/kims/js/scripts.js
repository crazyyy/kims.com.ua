$(document).ready(function(){

		// close drop after click;
	$('body, .city_selected strong').click(function(){
		$('.city_choice').removeClass('drop');
	});

		// выбор города;
	$('.city_selected p').click(function(){
		$(this).parents('.city_choice').toggleClass('drop');
	});
	$('.city_choice li').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
		var pointText = $(this).children().text();
		$(this).parents('table').find('.city_selected span').text(pointText);
		$('.city_choice').removeClass('drop');
		$this = $(this).index();
		$(this).parents('.rightBox').find('.box_wrap .box').hide().eq($this).show();
	});
	$('.city_choice table').click(function(e){
		e.stopPropagation();
	});
	var indexOfCity = $('.city_choice li.active').index();
	$('header .box_wrap .box').eq(indexOfCity).show();

	if (indexOfCity == 0 || indexOfCity == 2) $('header .link-panel').show();
		
		// меню;
	$('.box_nagigation > ul > li').each(function(){
		$('.box_nagigation > ul > li').slice(0,3).wrapAll('<ul />');
	});
	$('.box_nagigation > ul ul').unwrap();
	$('.box_nagigation ul').show();

		// валидация формы;
	$('.submit a').click(function(){
		$('input,textarea').each(function(){
			var dt = $(this).attr('data-type');
			switch(dt) {
				case 'email':
					if (!$(this).val() || !$(this).val().match(/.+@.+\..+/)) {
						$(this).addClass('error');
					}
					$('input[data-type=email]').bind('keyup change',function(e){
						checkChangeEmail(e);
					});
				case 'name':
					if (!$(this).val()) {
						$(this).addClass('error');
					}
					$('input[data-type=name]').bind('keyup change',function(e){
						checkChange(e);
					});
				case 'textarea':
					if (!$(this).val()) {
						$(this).addClass('error');
					}
					$('textarea[data-type=textarea]').bind('keyup change',function(e){
						checkChange(e);
					});
			} // switch end
		});
		if (!$('input,textarea').hasClass('error')) {
			/*$.ajax({
				type: "POST",
				url: location.href,
				data: $(this).serialize(),
				success: function(){
					$('<p class="message">Спасибо, ваше сообщение отправлено!</p>').appendTo($('form'));
					$('input,textarea').val('');
					setTimeout(function(){
						$('.message').fadeOut(200);
					}, 3000);
				}
			});*/
			$.post(location.href, $(this).parents('form').find(':input').serialize(), function() {
				$('<p class="message">Спасибо, ваше сообщение отправлено!</p>').appendTo($('form'));
				$('input,textarea').val('');
				setTimeout(function(){
					$('.message').fadeOut(200);
				}, 3000);
			});
		}
		return false;
	});


		// стили для таблицы;
	$('.content table tr+tr td+td').addClass('price');
	$('.price').each(function(){
		var text = $(this).text();
		var textsplit = text.split(',');
		//$(this).html(textsplit[0]+'<span>,'+textsplit[1]+'</span>');
		if ( textsplit[1] == undefined ) {
			$(this).html(textsplit[0]);
		} else {
			$(this).html(textsplit[0]+'<span>,'+textsplit[1]+'</span>');
		}
	});



		// УСЛУГИ И ЦЕНЫ;

			// ховер;
	$('.srv_prices_nav li').not('.active').children('ins').hover(function(){
		$(this).siblings('span').css('border','0');
	}, function(){
		$(this).siblings('span').attr('style','');
	});

			// левая навигация;
	$('.srv_prices_wrap .left_nav span').click(function(){
		$this = $(this).parent().index();
		$(this).parent().addClass('active').siblings().removeClass('active').closest('.wrap').find('.table_inner').hide().eq($this).show();
	});

			// главная навигация;
	$('.srv_prices_nav li').click(function(){
		var dataType = $(this).attr('data-type');
		location.hash = dataType;
		$this = $(this).index();
		$(this).addClass('active').siblings().removeClass('active').closest('.srv_prices_wrap').find('.main_table_wrap_inner').hide().eq($this).show();
	});

	 // hash табы;
	var locHash = location.hash.replace('#','');
	if ($('.srv_prices_wrap').length) {
		$('.srv_prices_nav li[data-type='+locHash+']').click();
	}


		// АДРЕСА И ФИЛИАЛЫ;

			// левая навигация;
	$('.addresses_wrap .left_nav span').click(function(){
		$this = $(this).parent().index();
		$(this).parent().addClass('active').siblings().removeClass('active').closest('.wrap').find('.table_inner').hide().eq($this).show();
	});




});

	// функции проверки value у полей;
function checkChange(e) {
	if ( !$(e.target).val() ) {
		$(e.target).addClass('error');
	} else {
		$(e.target).removeClass('error');
	}
}
function checkChangeEmail(e) {
	if ( !$(e.target).val() || !$(e.target).val().match(/.+@.+\..+/) ) {
		$(e.target).addClass('error');
	} else {
		$(e.target).removeClass('error');
	}
}