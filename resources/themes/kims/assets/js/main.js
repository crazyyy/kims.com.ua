'use strict';

/* ----- GLOBAL VARIABLES ----- */


/* ----- end GLOBAL VARIABLES ----- */


/* ----- FUNCTION DECLARATION ----- */

// INIT PAGE

function initPage() {
    var pollutants_list = ['tomato', 'drink', 'nature', 'meat'];

    var main_class = pollutants_list[Math.floor(Math.random()*pollutants_list.length)];

    $('#main_section').addClass(main_class).find('.main-icon').addClass('icon-' + main_class)
}
// end INIT PAGE


/* ----- end FUNCTION DECLARATION ----- */


/* ----- DOCUMENT READY ----- */

$(function() {

    /* ----- INIT PAGE ----- */


    initPage();
    priceSection();

    /* ----- end INIT PAGE ----- */


    /* ----- CLICK ACTIONS ----- */

    $('.h-nav').on('click', function() {
        let $navList = $(this).find('.h-nav__list');

        $navList.slideToggle('fast');
    });

    (function depNavigation() {
        let $hDep = $('.h-dep'),
            $title = $hDep.find('.h-dep__title'),
            $list = $hDep.find('.h-dep__list'),
            $cab = $('.h-contacts__cabinet, .header__cabinet');
			$franch = $('.header__franchise'),

        $title.on('click', function() {
            // $list.slideToggle('fast');
            let $citySwitch = $('.city-switch.main-popup');
            $citySwitch.attr('data-active', '');
        });

        $list.on('click', '.h-dep__item', function() {
            let text = $(this).text();

            $title.text(text);
            $list.slideToggle('fast');
            $.fn.fullpage.moveTo('contacts');
            var token = $(this).parent('ul#js-dep').data('token');
            $.ajax({
                url: window.location.pathname + '/ajax-reload-prices',
                type: 'POST',
                data:{id: $(this).data('dep'), _token: token}
            }).done(function(data){
                $('.services').html(data.html);
                if(data.share != null) {
                    $('.adv-popup img').attr('src', data.share);
                    $('div.header__prom').show();
                } else {
                    $('div.header__prom').hide();
                }
                priceSection();
            });


        });
    }());

    $('.h-lang').on('click', function() {
        let $navList = $(this).find('.h-lang__list');

        $navList.slideToggle('fast');
    });

    $('.main__fix.m-fix').on('click', function(e) {
        e.preventDefault();

        $.fn.fullpage.moveTo('contacts');
    });

    /*$('.game__skip-btn').on('click', function(e) {
     let $game = $(this).closest('.game');

     e.preventDefault();

     $game.attr('data-inactive', '');
     });*/

    $('.r-headerList').on('click', 'li', function() {
        let $self = $(this),
            $siblings = $self.siblings(),
            $mainItem = $('.r-mainList').children().eq($self.index()),
            $mainSiblings = $mainItem.siblings();

        $self.attr('data-active', '');
        $siblings.removeAttr('data-active');
        $mainItem.attr('data-active', '');
        $mainSiblings.removeAttr('data-active');
    });

    function priceSection() {
        let $services = $('.section.services'),
            $leftPart = $services.find('.services__left.s-left'),
            $rightPart = $services.find('.services__right.s-right'),
            $startSides = $services.find('.services__start.services-start'),
            $leftList = $leftPart.find('.s-left__list'),
            $rightWrapper = $rightPart.find('.s-right__wrapper'),
            $rightWrapperItems = $rightPart.find('.s-right__wrapperItem'),
            $allSubItems = $leftList.find('.s-left__subItem'),
            currMain = 0,
            currSub = 0;

        function init() {
            let $current = $leftList.find('.s-left__item').eq(currMain),
                $currentSubItem = $current.find('.s-left__subList .s-left__subItem').eq(currSub);

            $services.attr('data-active', '');
            $leftList.attr('data-active', '');
            $rightWrapper.attr('data-active', '');

            $current.attr('data-active', '');
            $currentSubItem.attr('data-active', '');
            $rightWrapperItems.eq(currMain).attr('data-active', '');
            $rightWrapperItems.eq(currMain).find('.r-mainList__item').eq(currSub).attr('data-active', '');

            $('.s-left__subList').perfectScrollbar({
                suppressScrollX: true
            });

        }

        $startSides.on('click', '.services-start__button', function() {
            let $that = $(this),
                $parent = $that.closest('.services-start'),
                parentSide = $parent.attr('data-side');


            if (parentSide === 'left') {
                currMain = 0;
            } else {
                currMain = 1;
            }

            $startSides.attr('data-active', 'false');

            init();
        });

        $leftList.on('click', '.s-left__item-title', function() {
            let $that = $(this),
                $parent = $that.parent(),
                $parentSiblings = $parent.siblings(),
                parentIndex = $parent.index(),
                $subList = $parent.find('.s-left__subList');

            $allSubItems.removeAttr('data-active');

            $parentSiblings.removeAttr('data-active');
            $parent.attr('data-active', '');

            $subList.children().eq(0).attr('data-active', '');
            currSub = 0;


            $rightWrapperItems.removeAttr('data-active');
            $rightWrapperItems.find('.r-mainList__item').removeAttr('data-active');

            $rightWrapperItems.eq(parentIndex).attr('data-active', '');
            $rightWrapperItems.eq(parentIndex).find('.r-mainList__item').eq(currSub).attr('data-active', '');

            currMain = parentIndex;

            $subList.perfectScrollbar('update', {
                suppressScrollX: true
            });

        });

        $leftList.on('click', '.s-left__subItem', function() {
            let $that = $(this),
                thatIndex = $that.index(),
                $parent = $that.closest('.s-left__item'),
                parentIndex = $parent.index();

            $allSubItems.removeAttr('data-active');
            $that.attr('data-active', '');

            $rightWrapperItems.removeAttr('data-active');
            $rightWrapperItems.find('.r-mainList__item').removeAttr('data-active');

            $rightWrapperItems.eq(parentIndex).attr('data-active', '');
            $rightWrapperItems.eq(parentIndex).find('.r-mainList__item').eq(thatIndex).attr('data-active', '');

            currMain = parentIndex;
            currSub = thatIndex;
        });
        $('.r-mainList__table').perfectScrollbar();

        $('.s-left__scroll').on('click', function() {
            let $that = $(this),
                $subList = $that.siblings('.s-left__subList');

            $subList.animate({
                scrollTop: $subList.scrollTop() + 20
            }, 50);
        });
    }

    (function contactPopup() {
        let $contactPopup = $('.contact-popup.main-popup'),
            $contactPopupOpen = $('.contact-with-us'),
            $contactPopupClose = $contactPopup.find('.main-popup__close'),
            $contactUsForm = $contactPopup.find('.contact-popup__form');

        $contactUsForm.on('submit', function(e) {
            // ENTER YOUR CODE

            e.preventDefault();

            $contactPopup.removeAttr('data-active');
        });

        $contactPopupOpen.on('click', function() {
            $contactPopup.attr('data-active', '');
        });

        $contactPopupClose.on('click', function() {
            $contactPopup.removeAttr('data-active');
        });
    }());

    (function franchisingPopup() {
        let $contactPopup = $('.contact-popup.main-popup'),
            $franchisingOpen = $('.contacts__more-popup.c-more-popup'),
            $franchisingPopup = $('.franchising-popup.main-popup'),
            $franchisingPopupClose = $franchisingPopup.find('.main-popup__close'),
            $franchisingSubmit = $franchisingPopup.find('.contact-us-popup__submit-button.main-popup-submit'),
            $franchisingSlider = $franchisingPopup.find('.franchising-slider__list');

        $franchisingOpen.on('click', function() {
            $franchisingPopup.attr('data-active', '');
        });

        $franchisingPopupClose.on('click', function() {
            $franchisingPopup.removeAttr('data-active');
        });

        $franchisingSubmit.on('click', function() {
            $franchisingPopup.removeAttr('data-active');
            $contactPopup.attr('data-active', '');
        });

        $franchisingSlider.slick({
            infinite: true,
            autoplay: true,
            speed: 500,
            fade: true,
            arrows: false,
            cssEase: 'linear',
            dots: true,
            dotsClass: 'franchising-slider__dots'
        });
    }());

    (function advPopup() {
        let $advPopup = $('.adv-popup.main-popup'),
            $closeButton = $advPopup.find('.adv-popup__close');

        $(document).on('click', '.header__prom', function() {
            $advPopup.attr('data-active', '');
        });

        $closeButton.on('click', function() {
            $advPopup.removeAttr('data-active');
        });
    }());

    (function citySwitch() {
        let $citySwitch = $('.city-switch .main-popup'),
            $closeButton = $citySwitch.find('.main-popup__close'),
            $list = $citySwitch.find('.city-switch__table'),
            $cab = $('.h-contacts__cabinet, .header__cabinet');


        $closeButton.on('click', function() {
            $citySwitch.removeAttr('data-active');
        });

        $list.on('click', 'div.city-switch__item', function() {


           let odessa_link = 'http://www.himstat.ru/LK.php?CompanyID=31&UseLogin=1',
		       kyiv_link = 'http://www.himstat.ru/LK.php?CompanyID=31&UseLogin=1',
               dnepr_link = 'http://www.himstat.ru/LK.php?CompanyID=47&UseLogin=1',
               sstart = $('.services-start__button');

           sstart.css('pointer-events', 'none');

            var token = $list.data('token');
            var text = $(this).text();

            $('.preloader').attr('data-active', '');

            $.ajax({
                url: window.lang + '/ajax-reload-prices',
                type: 'POST',
                dataType: 'json',
                data:{id: $(this).data('dep'), _token: token}
            }).done(function(data){
                $('.preloader').removeAttr('data-active');

                $('.services').html(data.html);
                $('div.header__prom').remove();
                if(data.share != null) {
                    $('.adv-popup img').attr('src', data.share);
                    $('div.header__contacts').before(data.promo_button);
                }
                priceSection();
                $('div.h-dep__title').html(text);
                sstart.css('pointer-events', '');

                //map center
                window.current_department_latitude = data.current_department_latitude || window.current_department_latitude;
                window.current_department_longitude = data.current_department_longitude || window.current_department_longitude;

                //update department contacts
                let department = {
                    'id': data.department.id,
                    'name': data.department.name,
                    'address': data.department.address,
                    'description': data.department.description,
                    'phone': data.department.phone,
                    'email': data.department.email,
                    'image': data.department.image
                };
                setDepartmentContacts(department);

                //update contacts popup tabs
                setContactPopupTabs(data.contact_tabs);

                //update contacts popup map markers
                array_markers = data.contact_markers;
                googleMapInit();

                //init contacts popup
                modalInit();
            });

            if ($(this).data('dep') > 0) {

                switch ($(this).data('dep')) {
                    case 1:
                        $cab.attr('href', odessa_link);
                        $cab.attr('data-active', 'true');
                        break;

					case 2:
                        $cab.attr('href', kyiv_link);
                        $cab.attr('data-active', 'true');
                        break;

                    case 7:
                        $cab.attr('href', dnepr_link);
                        $cab.attr('data-active', 'true');
                        break;

                    default:
                        $cab.attr('data-active', 'false');
                        break;
                }


            } else {
                $cab.attr('data-active', 'false');
            }

            $citySwitch.removeAttr('data-active');
        });
    }());
    /* ----- end CLICK ACTIONS ----- */


    /* ----- HOVER ACTIONS ------ */

    $('.r-headerList').on('mouseenter', 'li', function() {
        let $self = $(this);

        $self.attr('data-hover', '');
    });

    $('.r-headerList').on('mouseleave', 'li', function() {
        let $self = $(this);

        $self.removeAttr('data-hover', '');
    });

    /* ----- end HOVER ACTIONS ------ */


    /* ----- FULL PAGE PLUGIN ----- */

$('#js-fullpage').fullpage( {

        menu: '#js-nav',
        anchors: ['main', 'about', 'services', 'contacts'],

        verticalCentered: false,

        sectionSelector: '.section',

        afterLoad: function(index, anchorLink) {
        let $header = $('.header'),
        $headerLogo = $header.find('.header__logo'),
        $kimsBlog = $header.find('.kims__blog'),
        $headerCab = $header.find('.header__cabinet'),
        $headerRightCab = $header.find('.h-contacts__cabinet'),
        $headerNav = $header.find('.header__nav'),
        $headerNavTitle = $headerNav.find('.h-nav__title'),
        $headerNavList = $headerNav.find('.h-nav__list'),
        $headerNavListItems = $headerNavList.find('.h-nav__item'),
        $headerLang = $header.find('.header__languages'),
        $headerLangTitle = $headerLang.find('.h-lang__title'),
        $headerLangList = $headerLang.find('.h-lang__list'),
        $headerLangListItems = $headerLangList.find('.h-lang__item'),
        $depNav = $header.find('.h-dep'),
        $depNavTitle = $depNav.find('.h-dep__title'),
        $depNavList = $depNav.find('.h-dep__list'),
        $depNavListItems = $depNavList.find('.h-dep__item'),
        $headerLink = $header.find('.h-contacts__link'),
        $headerFb = $header.find('.h-contacts__fb'),
        $footerCopy = $('.footer__copy'),
        $footerAuthor = $('.footer__author'),
        $headerProm = $('.header__prom');

        switch (anchorLink) {
        case 'main':
        $headerLogo.attr('data-section', 'others');
        $kimsBlog.attr('data-section', 'others');
        $headerCab.attr('data-section', 'others');
        $headerNavTitle.attr('data-section', 'others');
        $headerNavList.attr('data-section', 'others');
        $headerNavListItems.attr('data-section', 'others');
        $headerLangTitle.attr('data-section', 'others');
        $headerLangList.attr('data-section', 'others');
        $headerLangListItems.attr('data-section', 'others');
        $depNavTitle.attr('data-section', 'others');
        $depNavList.attr('data-section', 'others');
        $depNavListItems.attr('data-section', 'others');
        $headerLink.attr('data-section', 'others');
        $headerFb.attr('data-section', 'others');
        $footerCopy.attr('data-section', 'others');
        $footerAuthor.attr('data-section', 'others');
        $headerRightCab.attr('data-section', 'others');
        $headerProm.attr('data-section', 'white');

        $.fn.fullpage.setAutoScrolling(true);

        break;

        case 'about':
        $headerLogo.attr('data-section', 'white');
        $kimsBlog.attr('data-section', 'white');
        $headerCab.attr('data-section', 'white');
        $headerNavTitle.attr('data-section', 'white');
        $headerNavList.attr('data-section', 'white');
        $headerNavListItems.attr('data-section', 'white');
        $headerLangTitle.attr('data-section', 'white');
        $headerLangList.attr('data-section', 'white');
        $headerLangListItems.attr('data-section', 'white');
        $depNavTitle.attr('data-section', 'others');
        $depNavList.attr('data-section', 'others');
        $depNavListItems.attr('data-section', 'others');
        $headerLink.attr('data-section', 'others');
        $headerFb.attr('data-section', 'others');
        $headerRightCab.attr('data-section', 'others');
        $footerCopy.attr('data-section', 'white');
        $footerAuthor.attr('data-section', 'others');
        $headerProm.attr('data-section', 'white');

        $.fn.fullpage.setAutoScrolling(true);

        break;

        case 'services':
        $headerLogo.attr('data-section', 'others');
        $kimsBlog.attr('data-section', 'others');
        $headerCab.attr('data-section', 'others');
        $headerNavTitle.attr('data-section', 'others');
        $headerNavList.attr('data-section', 'others');
        $headerNavListItems.attr('data-section', 'others');
        $headerLangTitle.attr('data-section', 'others');
        $headerLangList.attr('data-section', 'others');
        $headerLangListItems.attr('data-section', 'others');
        $depNavTitle.attr('data-section', 'white');
        $depNavList.attr('data-section', 'white');
        $depNavListItems.attr('data-section', 'white');
        $headerLink.attr('data-section', 'white');
        $headerFb.attr('data-section', 'white');
        $headerRightCab.attr('data-section', 'white');
        $footerCopy.attr('data-section', 'others');
        $footerAuthor.attr('data-section', 'white');
        $headerProm.attr('data-section', 'blue');

        $.fn.fullpage.setAutoScrolling(true);

        break;

        case 'contacts':
        $headerLogo.attr('data-section', 'white');
        $kimsBlog.attr('data-section', 'white');
        $headerCab.attr('data-section', 'white');
        $headerNavTitle.attr('data-section', 'white');
        $headerNavList.attr('data-section', 'white');
        $headerNavListItems.attr('data-section', 'white');
        $headerLangTitle.attr('data-section', 'white');
        $headerLangList.attr('data-section', 'white');
        $headerLangListItems.attr('data-section', 'white');
        $depNavTitle.attr('data-section', 'white');
        $depNavList.attr('data-section', 'white');
        $depNavListItems.attr('data-section', 'white');
        $headerRightCab.attr('data-section', 'white');
        $headerLink.attr('data-section', 'map');
        $headerFb.attr('data-section', 'map');
        $footerCopy.attr('data-section', 'white');
        $footerAuthor.attr('data-section', 'map');
        $headerProm.attr('data-section', 'blue');

        $.fn.fullpage.setAutoScrolling(false);

        break;
        }
     }
   });

    /* ----- end FULL PAGE PLUGIN ----- */

    /* ----- CAROUSELS ----- */

    $('.l-carouselDesc').slick({
        adaptiveHeight: true,
        autoplay: true,
        autoplaySpeed: 7000,
        arrows: false,
        asNavFor: $('.l-carouselImg'),
        fade: true,
        speed: 500
    });

    $('.l-carouselImg').slick({
        autoplay: true,
        autoplaySpeed: 7000,
        arrows: false,
        asNavFor: $('.l-carouselDesc'),
        dots: true,
        dotsClass: 'l-carouselImg__dots',
        fade: true,
        speed: 500
    });

    $('.r-fixCarousel__list').slick({
        autoplay: true,
        autoplaySpeed: 7000,
        arrows: true,
        dots: true,
        dotsClass: 'r-fixCarousel__dots',
        speed: 500,
        prevArrow: '.r-fixCarousel__prev',
        nextArrow: '.r-fixCarousel__next',
        fade: true,
        infinite: false
    });

    /* ----- end CAROUSELS ----- */

});

/* ----- end DOCUMENT READY ----- */


/* ----- WINDOW READY ----- */

$(window).load(function() {

    setTimeout(function() {
        $('.preloader').removeAttr('data-active');
    }, 1000);

});

/* ----- end WINDOW READY ----- */