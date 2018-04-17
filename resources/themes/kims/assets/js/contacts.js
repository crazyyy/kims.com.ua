'use strict';

/* ----- GLOBAL VARIABLES ----- */
var map;

//---init mas for visible all markers
var newMarker = [];

//---marker's

var array_markers = window.contact_markers;

//---color's
var styles = [
    {
        featureType: 'all',
    }
];

/* ----- end GLOBAL VARIABLES ----- */


/* ----- FUNCTION DECLARATION ----- */

function modalInit() {
    activeModal();
    closeModal();
}

function activeModal() {
    let $contacts = $('.contacts'),
        $depsButtons = $contacts.find('.contacts__bottom-item.contact-addresses'),
        $modal = $('.contacts-simple'),
        $tabsControl = $('.contacts-simple__cat-item'),
        $tabsContent = $('.contacts-simple__addresses-list'),
        $addresses = $modal.find('.contacts-simple__column[data-column="addresses"]');

    $addresses.perfectScrollbar();

    $depsButtons.on('click', function () {
        $modal.attr('data-active', '');
    });

    $tabsControl.on('click', function () {
        $tabsControl.removeClass('active');
        $tabsContent.removeClass('active');

        $(this).addClass('active');
        $($(this).attr('data-tab')).addClass('active')
    });
}

function closeModal() {
    let $modal = $('.contacts-simple'),
        $closeButton = $modal.find('.main-popup__close');

    $closeButton.on('click', function () {
        $modal.removeAttr('data-active');
    });
}

/* GOOGLE MAPS */
function goToMarker(latitude, longitude) {
    let location = new google.maps.LatLng(latitude, longitude);

    map.panTo(location);
    map.setZoom(15);
}

function googleMapSetMarkers(map, markers_array) {

    for (var i = 0; i < newMarker.length; i++) {
        newMarker[i].setMap(null);
    }
    newMarker.length = 0;

    //---bind each marker to infowindow
    for (var i = 0; i < markers_array.length; i++) {
        var marker_array_item = markers_array[i];

        //---init marker
        var marker = new google.maps.Marker({
            position: {
                lat: marker_array_item[0],
                lng: marker_array_item[1]
            },
            map: map,
            zIndex: marker_array_item[2]
        });

        //---create mas for visible all markers
        newMarker.push(marker);
    }
}

function googleMapInit() {
    let _latitude = 49.1898929;
    let _longitude = 31.5750698;

    if (window.current_department_latitude != null) {
        _latitude = window.current_department_latitude;
    }
    if (window.current_department_longitude != null) {
        _longitude = window.current_department_longitude;
    }
    
    let location_default = new google.maps.LatLng(_latitude, _longitude);

    let mapOptions = {
        zoom: 7,
        center: location_default,
        scrollwheel: true,
        disableDefaultUI: true,
        zoomControl: true,
        styles: styles
    };

    //---init map
    map = new google.maps.Map(document.getElementById('contacts-simple-map'), mapOptions);

    googleMapSetMarkers(map, array_markers);
}

/* end GOOGLE MAPS */

function setDepartmentContacts(department) {
    let keys = ['name', 'address', 'description', 'phone', 'email'];

    keys.map(function (key) {
        $('.contacts__city-' + key).html(department[key]);
    });

    $('.contacts__city-image').attr('style', 'background-image: url(' + window.app_url + department['image'] + ');');

    let $active_city = $('.contacts__cities-item.active');
    if ($active_city.length) {
        $active_city.fadeIn();
        setTimeout(function () {
            $active_city.removeClass('active');
        }, 500);
    }

    let $city = $('.contacts__cities-item[data-id="' + department['id'] + '"]');
    $city.fadeOut();
    setTimeout(function () {
        $city.addClass('active');
    }, 500);
}

function footerCitiesSwitcherInit() {
    let $cities = $('.contacts__cities-item');

    $cities.on('click', function () {
        let $that = $(this);

        let department = {
            'id': $that.attr('data-id'),
            'name': $that.attr('data-name'),
            'address': $that.attr('data-address'),
            'description': $that.attr('data-description'),
            'phone': $that.attr('data-phone'),
            'email': $that.attr('data-email'),
            'image': $that.attr('data-image')
        };

        // update footer department info
        setDepartmentContacts(department);

        $.ajax({
            url: window.lang + '/departments/' + $that.attr('data-id') + '/contacts',
            type: 'GET',
            dataType: 'json',
        }).done(function(data){
            //update contacts popup tabs
            setContactPopupTabs(data.contact_tabs);

            window.current_department_latitude = data.current_department_latitude;
            window.current_department_longitude = data.current_department_longitude;

            //update contacts popup map markers
            array_markers = data.contact_markers;
            googleMapInit();

            //init contacts popup
            modalInit();
        });
    });
}

function setContactPopupTabs(tabsHtml) {
    $('[data-column="categories"]').remove();
    $('[data-column="addresses"]').remove();

    $(tabsHtml).insertBefore('.contacts-simple__column');
}

/* ----- end FUNCTION DECLARATION ----- */


/* ----- DOCUMENT READY ----- */

$(function () {

    modalInit();
    footerCitiesSwitcherInit();

});

/* ----- end DOCUMENT READY ----- */


/* ----- WINDOW READY ----- */

$(window).load(function () {

    /* ----- GOOGLEMAPS ----- */

    google.maps.event.addDomListener(window, 'load', googleMapInit());


    /* ----- end GOOGLEMAPS ----- */

    $(document).on("click", '.contacts-simple__addresses-title__map-marker', function () {
        let latitude = $(this).attr('data-latitude');
        let longitude = $(this).attr('data-longitude');

        goToMarker(latitude, longitude);
    });

});

/* ----- end WINDOW READY ----- */