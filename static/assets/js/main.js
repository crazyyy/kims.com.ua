"use strict";

function modalInit() {
  activeModal(), closeModal()
}

function activeModal() {
  var t = $(".contacts"),
    a = t.find(".contacts__bottom-item.contact-addresses"),
    e = $(".contacts-simple"),
    n = $(".contacts-simple__cat-item"),
    o = $(".contacts-simple__addresses-list"),
    r = e.find('.contacts-simple__column[data-column="addresses"]');
  r.perfectScrollbar(), a.on("click", function() {
    e.attr("data-active", "")
  }), n.on("click", function() {
    n.removeClass("active"), o.removeClass("active"), $(this).addClass("active"), $($(this).attr("data-tab")).addClass("active")
  })
}

function closeModal() {
  var t = $(".contacts-simple"),
    a = t.find(".main-popup__close");
  a.on("click", function() {
    t.removeAttr("data-active")
  })
}

function goToMarker(t, a) {
  var e = new google.maps.LatLng(t, a);
  map.panTo(e), map.setZoom(15)
}

function googleMapSetMarkers(t, a) {
  for (var e = 0; e < newMarker.length; e++) newMarker[e].setMap(null);
  newMarker.length = 0;
  for (var e = 0; e < a.length; e++) {
    var n = a[e],
      o = new google.maps.Marker({
        position: {
          lat: n[0],
          lng: n[1]
        },
        map: t,
        zIndex: n[2]
      });
    newMarker.push(o)
  }
}

function googleMapInit() {
  var t = 49.1898929,
    a = 31.5750698;
  null != window.current_department_latitude && (t = window.current_department_latitude), null != window.current_department_longitude && (a = window.current_department_longitude);
  var e = new google.maps.LatLng(t, a),
    n = {
      zoom: 7,
      center: e,
      scrollwheel: !0,
      disableDefaultUI: !0,
      zoomControl: !0,
      styles: styles
    };
  map = new google.maps.Map(document.getElementById("contacts-simple-map"), n), googleMapSetMarkers(map, array_markers)
}

function setDepartmentContacts(t) {
  var a = ["name", "address", "description", "phone", "email"];
  a.map(function(a) {
    $(".contacts__city-" + a).html(t[a])
  }), $(".contacts__city-image").attr("style", "background-image: url(" + window.app_url + t.image + ");");
  var e = $(".contacts__cities-item.active");
  e.length && (e.fadeIn(), setTimeout(function() {
    e.removeClass("active")
  }, 500));
  var n = $('.contacts__cities-item[data-id="' + t.id + '"]');
  n.fadeOut(), setTimeout(function() {
    n.addClass("active")
  }, 500)
}

function footerCitiesSwitcherInit() {
  var t = $(".contacts__cities-item");
  t.on("click", function() {
    var t = $(this),
      a = {
        id: t.attr("data-id"),
        name: t.attr("data-name"),
        address: t.attr("data-address"),
        description: t.attr("data-description"),
        phone: t.attr("data-phone"),
        email: t.attr("data-email"),
        image: t.attr("data-image")
      };
    setDepartmentContacts(a), $.ajax({
      url: window.lang + "/departments/" + t.attr("data-id") + "/contacts",
      type: "GET",
      dataType: "json"
    }).done(function(t) {
      setContactPopupTabs(t.contact_tabs), window.current_department_latitude = t.current_department_latitude, window.current_department_longitude = t.current_department_longitude, array_markers = t.contact_markers, googleMapInit(), modalInit()
    })
  })
}

function setContactPopupTabs(t) {
  $('[data-column="categories"]').remove(), $('[data-column="addresses"]').remove(), $(t).insertBefore(".contacts-simple__column")
}
var map, newMarker = [],
  array_markers = window.contact_markers,
  styles = [{
    featureType: "all"
  }];
$(function() {
  modalInit(), footerCitiesSwitcherInit()
}), $(window).load(function() {
  google.maps.event.addDomListener(window, "load", googleMapInit()), $(document).on("click", ".contacts-simple__addresses-title__map-marker", function() {
    var t = $(this).attr("data-latitude"),
      a = $(this).attr("data-longitude");
    goToMarker(t, a)
  })
});
"use strict";

function InfoBubble(t) {
  this.extend(InfoBubble, google.maps.OverlayView), this.tabs_ = [], this.activeTab_ = null, this.baseZIndex_ = 100, this.isOpen_ = !1;
  var e = t || {};
  void 0 == e.backgroundColor && (e.backgroundColor = this.BACKGROUND_COLOR_), void 0 == e.borderColor && (e.borderColor = this.BORDER_COLOR_), void 0 == e.borderRadius && (e.borderRadius = this.BORDER_RADIUS_), void 0 == e.borderWidth && (e.borderWidth = this.BORDER_WIDTH_), void 0 == e.padding && (e.padding = this.PADDING_), void 0 == e.arrowPosition && (e.arrowPosition = this.ARROW_POSITION_), void 0 == e.disableAutoPan && (e.disableAutoPan = !1), void 0 == e.disableAnimation && (e.disableAnimation = !1), void 0 == e.minWidth && (e.minWidth = this.MIN_WIDTH_), void 0 == e.shadowStyle && (e.shadowStyle = this.SHADOW_STYLE_), void 0 == e.arrowSize && (e.arrowSize = this.ARROW_SIZE_), void 0 == e.arrowStyle && (e.arrowStyle = this.ARROW_STYLE_), void 0 == e.closeSrc && (e.closeSrc = this.CLOSE_SRC_), this.buildDom_(), this.setValues(e)
}
window.InfoBubble = InfoBubble, InfoBubble.prototype.ARROW_SIZE_ = 15, InfoBubble.prototype.ARROW_STYLE_ = 0, InfoBubble.prototype.SHADOW_STYLE_ = 1, InfoBubble.prototype.MIN_WIDTH_ = 50, InfoBubble.prototype.ARROW_POSITION_ = 50, InfoBubble.prototype.PADDING_ = 10, InfoBubble.prototype.BORDER_WIDTH_ = 1, InfoBubble.prototype.BORDER_COLOR_ = "#ccc", InfoBubble.prototype.BORDER_RADIUS_ = 10, InfoBubble.prototype.BACKGROUND_COLOR_ = "#fff", InfoBubble.prototype.CLOSE_SRC_ = "https://maps.gstatic.com/intl/en_us/mapfiles/iw_close.gif", InfoBubble.prototype.extend = function(t, e) {
  return function(t) {
    for (var e in t.prototype) this.prototype[e] = t.prototype[e];
    return this
  }.apply(t, [e])
}, InfoBubble.prototype.buildDom_ = function() {
  var t = this.bubble_ = document.createElement("DIV");
  t.style.position = "absolute", t.style.zIndex = this.baseZIndex_;
  var e = this.tabsContainer_ = document.createElement("DIV");
  e.style.position = "relative";
  var o = this.close_ = document.createElement("IMG");
  o.style.position = "absolute", o.style.border = 0, o.style.zIndex = this.baseZIndex_ + 1, o.style.cursor = "pointer", o.src = this.get("closeSrc");
  var i = this;
  google.maps.event.addDomListener(o, "click", function() {
    i.close(), google.maps.event.trigger(i, "closeclick")
  });
  var n = this.contentContainer_ = document.createElement("DIV");
  n.style.overflowX = "auto", n.style.overflowY = "auto", n.style.cursor = "default", n.style.clear = "both", n.style.position = "relative";
  var s = this.content_ = document.createElement("DIV");
  n.appendChild(s);
  var r = this.arrow_ = document.createElement("DIV");
  r.style.position = "relative";
  var b = this.arrowOuter_ = document.createElement("DIV"),
    a = this.arrowInner_ = document.createElement("DIV"),
    h = this.getArrowSize_();
  b.style.position = a.style.position = "absolute", b.style.left = a.style.left = "50%", b.style.height = a.style.height = "0", b.style.width = a.style.width = "0", b.style.marginLeft = this.px(-h), b.style.borderWidth = this.px(h), b.style.borderBottomWidth = 0;
  var l = this.bubbleShadow_ = document.createElement("DIV");
  l.style.position = "absolute", t.style.display = l.style.display = "none", t.appendChild(this.tabsContainer_), t.appendChild(o), t.appendChild(n), r.appendChild(b), r.appendChild(a), t.appendChild(r);
  var p = document.createElement("style");
  p.setAttribute("type", "text/css"), this.animationName_ = "_ibani_" + Math.round(1e4 * Math.random());
  var d = "." + this.animationName_ + "{-webkit-animation-name:" + this.animationName_ + ";-webkit-animation-duration:0.5s;-webkit-animation-iteration-count:1;}@-webkit-keyframes " + this.animationName_ + " {from {-webkit-transform: scale(0)}50% {-webkit-transform: scale(1.2)}90% {-webkit-transform: scale(0.95)}to {-webkit-transform: scale(1)}}";
  p.textContent = d, document.getElementsByTagName("head")[0].appendChild(p)
}, InfoBubble.prototype.setBackgroundClassName = function(t) {
  this.set("backgroundClassName", t)
}, InfoBubble.prototype.setBackgroundClassName = InfoBubble.prototype.setBackgroundClassName, InfoBubble.prototype.backgroundClassName_changed = function() {
  this.content_.className = this.get("backgroundClassName")
}, InfoBubble.prototype.backgroundClassName_changed = InfoBubble.prototype.backgroundClassName_changed, InfoBubble.prototype.setTabClassName = function(t) {
  this.set("tabClassName", t)
}, InfoBubble.prototype.setTabClassName = InfoBubble.prototype.setTabClassName, InfoBubble.prototype.tabClassName_changed = function() {
  this.updateTabStyles_()
}, InfoBubble.prototype.tabClassName_changed = InfoBubble.prototype.tabClassName_changed, InfoBubble.prototype.getArrowStyle_ = function() {
  return parseInt(this.get("arrowStyle"), 10) || 0
}, InfoBubble.prototype.setArrowStyle = function(t) {
  this.set("arrowStyle", t)
}, InfoBubble.prototype.setArrowStyle = InfoBubble.prototype.setArrowStyle, InfoBubble.prototype.arrowStyle_changed = function() {
  this.arrowSize_changed()
}, InfoBubble.prototype.arrowStyle_changed = InfoBubble.prototype.arrowStyle_changed, InfoBubble.prototype.getArrowSize_ = function() {
  return parseInt(this.get("arrowSize"), 10) || 0
}, InfoBubble.prototype.setArrowSize = function(t) {
  this.set("arrowSize", t)
}, InfoBubble.prototype.setArrowSize = InfoBubble.prototype.setArrowSize, InfoBubble.prototype.arrowSize_changed = function() {
  this.borderWidth_changed()
}, InfoBubble.prototype.arrowSize_changed = InfoBubble.prototype.arrowSize_changed, InfoBubble.prototype.setArrowPosition = function(t) {
  this.set("arrowPosition", t)
}, InfoBubble.prototype.setArrowPosition = InfoBubble.prototype.setArrowPosition, InfoBubble.prototype.getArrowPosition_ = function() {
  return parseInt(this.get("arrowPosition"), 10) || 0
}, InfoBubble.prototype.arrowPosition_changed = function() {
  var t = this.getArrowPosition_();
  this.arrowOuter_.style.left = this.arrowInner_.style.left = t + "%", this.redraw_()
}, InfoBubble.prototype.arrowPosition_changed = InfoBubble.prototype.arrowPosition_changed, InfoBubble.prototype.setZIndex = function(t) {
  this.set("zIndex", t)
}, InfoBubble.prototype.setZIndex = InfoBubble.prototype.setZIndex, InfoBubble.prototype.getZIndex = function() {
  return parseInt(this.get("zIndex"), 10) || this.baseZIndex_
}, InfoBubble.prototype.zIndex_changed = function() {
  var t = this.getZIndex();
  this.bubble_.style.zIndex = this.baseZIndex_ = t, this.close_.style.zIndex = t + 1
}, InfoBubble.prototype.zIndex_changed = InfoBubble.prototype.zIndex_changed, InfoBubble.prototype.setShadowStyle = function(t) {
  this.set("shadowStyle", t)
}, InfoBubble.prototype.setShadowStyle = InfoBubble.prototype.setShadowStyle, InfoBubble.prototype.getShadowStyle_ = function() {
  return parseInt(this.get("shadowStyle"), 10) || 0
}, InfoBubble.prototype.shadowStyle_changed = function() {
  var t = this.getShadowStyle_(),
    e = "",
    o = "",
    i = "";
  switch (t) {
    case 0:
      e = "none";
      break;
    case 1:
      o = "40px 15px 10px rgba(33,33,33,0.3)", i = "transparent";
      break;
    case 2:
      o = "0 0 2px rgba(33,33,33,0.3)", i = "rgba(33,33,33,0.35)"
  }
  this.bubbleShadow_.style.boxShadow = this.bubbleShadow_.style.webkitBoxShadow = this.bubbleShadow_.style.MozBoxShadow = o, this.bubbleShadow_.style.backgroundColor = i, this.isOpen_ && (this.bubbleShadow_.style.display = e, this.draw())
}, InfoBubble.prototype.shadowStyle_changed = InfoBubble.prototype.shadowStyle_changed, InfoBubble.prototype.showCloseButton = function() {
  this.set("hideCloseButton", !1)
}, InfoBubble.prototype.showCloseButton = InfoBubble.prototype.showCloseButton, InfoBubble.prototype.hideCloseButton = function() {
  this.set("hideCloseButton", !0)
}, InfoBubble.prototype.hideCloseButton = InfoBubble.prototype.hideCloseButton, InfoBubble.prototype.hideCloseButton_changed = function() {
  this.close_.style.display = this.get("hideCloseButton") ? "none" : ""
}, InfoBubble.prototype.hideCloseButton_changed = InfoBubble.prototype.hideCloseButton_changed, InfoBubble.prototype.setBackgroundColor = function(t) {
  t && this.set("backgroundColor", t)
}, InfoBubble.prototype.setBackgroundColor = InfoBubble.prototype.setBackgroundColor, InfoBubble.prototype.backgroundColor_changed = function() {
  var t = this.get("backgroundColor");
  this.contentContainer_.style.backgroundColor = t, this.arrowInner_.style.borderColor = t + " transparent transparent", this.updateTabStyles_()
}, InfoBubble.prototype.backgroundColor_changed = InfoBubble.prototype.backgroundColor_changed, InfoBubble.prototype.setBorderColor = function(t) {
  t && this.set("borderColor", t)
}, InfoBubble.prototype.setBorderColor = InfoBubble.prototype.setBorderColor, InfoBubble.prototype.borderColor_changed = function() {
  var t = this.get("borderColor"),
    e = this.contentContainer_,
    o = this.arrowOuter_;
  e.style.borderColor = t, o.style.borderColor = t + " transparent transparent", e.style.borderStyle = o.style.borderStyle = this.arrowInner_.style.borderStyle = "solid", this.updateTabStyles_()
}, InfoBubble.prototype.borderColor_changed = InfoBubble.prototype.borderColor_changed, InfoBubble.prototype.setBorderRadius = function(t) {
  this.set("borderRadius", t)
}, InfoBubble.prototype.setBorderRadius = InfoBubble.prototype.setBorderRadius, InfoBubble.prototype.getBorderRadius_ = function() {
  return parseInt(this.get("borderRadius"), 10) || 0
}, InfoBubble.prototype.borderRadius_changed = function() {
  var t = this.getBorderRadius_(),
    e = this.getBorderWidth_();
  this.contentContainer_.style.borderRadius = this.contentContainer_.style.MozBorderRadius = this.contentContainer_.style.webkitBorderRadius = this.bubbleShadow_.style.borderRadius = this.bubbleShadow_.style.MozBorderRadius = this.bubbleShadow_.style.webkitBorderRadius = this.px(t), this.tabsContainer_.style.paddingLeft = this.tabsContainer_.style.paddingRight = this.px(t + e), this.redraw_()
}, InfoBubble.prototype.borderRadius_changed = InfoBubble.prototype.borderRadius_changed, InfoBubble.prototype.getBorderWidth_ = function() {
  return parseInt(this.get("borderWidth"), 10) || 0
}, InfoBubble.prototype.setBorderWidth = function(t) {
  this.set("borderWidth", t)
}, InfoBubble.prototype.setBorderWidth = InfoBubble.prototype.setBorderWidth, InfoBubble.prototype.borderWidth_changed = function() {
  var t = this.getBorderWidth_();
  this.contentContainer_.style.borderWidth = this.px(t), this.tabsContainer_.style.top = this.px(t), this.updateArrowStyle_(), this.updateTabStyles_(), this.borderRadius_changed(), this.redraw_()
}, InfoBubble.prototype.borderWidth_changed = InfoBubble.prototype.borderWidth_changed, InfoBubble.prototype.updateArrowStyle_ = function() {
  var t = this.getBorderWidth_(),
    e = this.getArrowSize_(),
    o = this.getArrowStyle_(),
    i = this.px(e),
    n = this.px(Math.max(0, e - t)),
    s = this.arrowOuter_,
    r = this.arrowInner_;
  this.arrow_.style.marginTop = this.px(-t), s.style.borderTopWidth = i, r.style.borderTopWidth = n, 0 == o || 1 == o ? (s.style.borderLeftWidth = i, r.style.borderLeftWidth = n) : s.style.borderLeftWidth = r.style.borderLeftWidth = 0, 0 == o || 2 == o ? (s.style.borderRightWidth = i, r.style.borderRightWidth = n) : s.style.borderRightWidth = r.style.borderRightWidth = 0, o < 2 ? (s.style.marginLeft = this.px(-e), r.style.marginLeft = this.px(-(e - t))) : s.style.marginLeft = r.style.marginLeft = 0, 0 == t ? s.style.display = "none" : s.style.display = ""
}, InfoBubble.prototype.setPadding = function(t) {
  this.set("padding", t)
}, InfoBubble.prototype.setPadding = InfoBubble.prototype.setPadding, InfoBubble.prototype.setCloseSrc = function(t) {
  t && this.close_ && (this.close_.src = t)
}, InfoBubble.prototype.setCloseSrc = InfoBubble.prototype.setCloseSrc, InfoBubble.prototype.getPadding_ = function() {
  return parseInt(this.get("padding"), 10) || 0
}, InfoBubble.prototype.padding_changed = function() {
  var t = this.getPadding_();
  this.contentContainer_.style.padding = this.px(t), this.updateTabStyles_(), this.redraw_()
}, InfoBubble.prototype.padding_changed = InfoBubble.prototype.padding_changed, InfoBubble.prototype.px = function(t) {
  return t ? t + "px" : t
}, InfoBubble.prototype.addEvents_ = function() {
  var t = ["mousedown", "mousemove", "mouseover", "mouseout", "mouseup", "mousewheel", "DOMMouseScroll", "touchstart", "touchend", "touchmove", "dblclick", "contextmenu", "click"],
    e = this.bubble_;
  this.listeners_ = [];
  for (var o, i = 0; o = t[i]; i++) this.listeners_.push(google.maps.event.addDomListener(e, o, function(t) {
    t.cancelBubble = !0, t.stopPropagation && t.stopPropagation()
  }))
}, InfoBubble.prototype.onAdd = function() {
  this.bubble_ || this.buildDom_(), this.addEvents_();
  var t = this.getPanes();
  t && (t.floatPane.appendChild(this.bubble_), t.floatShadow.appendChild(this.bubbleShadow_)), google.maps.event.trigger(this, "domready")
}, InfoBubble.prototype.onAdd = InfoBubble.prototype.onAdd, InfoBubble.prototype.setBubbleOffset = function(t, e) {
  this.bubbleOffsetX = parseInt(t), this.bubbleOffsetY = parseInt(e)
}, InfoBubble.prototype.getBubbleOffset = function() {
  return {
    x: this.bubbleOffsetX || 0,
    y: this.bubbleOffsetY || 0
  }
}, InfoBubble.prototype.draw = function() {
  var t = this.getProjection();
  if (t) {
    var e = this.get("position");
    if (!e) return void this.close();
    var o = 0;
    this.activeTab_ && (o = this.activeTab_.offsetHeight);
    var i = this.getAnchorHeight_(),
      n = this.getArrowSize_(),
      s = this.getArrowPosition_();
    s /= 100;
    var r = t.fromLatLngToDivPixel(e),
      b = this.contentContainer_.offsetWidth,
      a = this.bubble_.offsetHeight;
    if (b) {
      var h = r.y - (a + n) + this.getBubbleOffset().y;
      i && (h -= i);
      var l = r.x - b * s + this.getBubbleOffset().x;
      this.bubble_.style.top = this.px(h), this.bubble_.style.left = this.px(l);
      var p = parseInt(this.get("shadowStyle"), 10);
      switch (p) {
        case 1:
          this.bubbleShadow_.style.top = this.px(h + o - 1), this.bubbleShadow_.style.left = this.px(l), this.bubbleShadow_.style.width = this.px(b), this.bubbleShadow_.style.height = this.px(this.contentContainer_.offsetHeight - n);
          break;
        case 2:
          b = .8 * b, i ? this.bubbleShadow_.style.top = this.px(r.y) : this.bubbleShadow_.style.top = this.px(r.y + n), this.bubbleShadow_.style.left = this.px(r.x - b * s), this.bubbleShadow_.style.width = this.px(b), this.bubbleShadow_.style.height = this.px(2)
      }
    }
  }
}, InfoBubble.prototype.draw = InfoBubble.prototype.draw, InfoBubble.prototype.onRemove = function() {
  this.bubble_ && this.bubble_.parentNode && this.bubble_.parentNode.removeChild(this.bubble_), this.bubbleShadow_ && this.bubbleShadow_.parentNode && this.bubbleShadow_.parentNode.removeChild(this.bubbleShadow_);
  for (var t, e = 0; t = this.listeners_[e]; e++) google.maps.event.removeListener(t)
}, InfoBubble.prototype.onRemove = InfoBubble.prototype.onRemove, InfoBubble.prototype.isOpen = function() {
  return this.isOpen_
}, InfoBubble.prototype.isOpen = InfoBubble.prototype.isOpen, InfoBubble.prototype.close = function() {
  this.bubble_ && (this.bubble_.style.display = "none", this.bubble_.className = this.bubble_.className.replace(this.animationName_, "")), this.bubbleShadow_ && (this.bubbleShadow_.style.display = "none", this.bubbleShadow_.className = this.bubbleShadow_.className.replace(this.animationName_, "")), this.isOpen_ = !1
}, InfoBubble.prototype.close = InfoBubble.prototype.close, InfoBubble.prototype.open = function(t, e) {
  var o = this;
  window.setTimeout(function() {
    o.open_(t, e)
  }, 0)
}, InfoBubble.prototype.open_ = function(t, e) {
  this.updateContent_(), t && this.setMap(t), e && (this.set("anchor", e), this.bindTo("anchorPoint", e), this.bindTo("position", e)), this.bubble_.style.display = this.bubbleShadow_.style.display = "";
  var o = !this.get("disableAnimation");
  o && (this.bubble_.className += " " + this.animationName_, this.bubbleShadow_.className += " " + this.animationName_), this.redraw_(), this.isOpen_ = !0;
  var i = !this.get("disableAutoPan");
  if (i) {
    var n = this;
    window.setTimeout(function() {
      n.panToView()
    }, 200)
  }
}, InfoBubble.prototype.open = InfoBubble.prototype.open, InfoBubble.prototype.setPosition = function(t) {
  t && this.set("position", t)
}, InfoBubble.prototype.setPosition = InfoBubble.prototype.setPosition, InfoBubble.prototype.getPosition = function() {
  return this.get("position")
}, InfoBubble.prototype.getPosition = InfoBubble.prototype.getPosition, InfoBubble.prototype.position_changed = function() {
  this.draw()
}, InfoBubble.prototype.position_changed = InfoBubble.prototype.position_changed, InfoBubble.prototype.panToView = function() {
  var t = this.getProjection();
  if (t && this.bubble_) {
    var e = this.getAnchorHeight_(),
      o = this.bubble_.offsetHeight + e,
      i = this.get("map"),
      n = i.getDiv(),
      s = n.offsetHeight,
      r = this.getPosition(),
      b = t.fromLatLngToContainerPixel(i.getCenter()),
      a = t.fromLatLngToContainerPixel(r),
      h = b.y - o,
      l = s - b.y,
      p = h < 0,
      d = 0;
    p && (h *= -1, d = (h + l) / 2), a.y -= d, r = t.fromContainerPixelToLatLng(a), i.getCenter() != r && i.panTo(r)
  }
}, InfoBubble.prototype.panToView = InfoBubble.prototype.panToView, InfoBubble.prototype.htmlToDocumentFragment_ = function(t) {
  t = t.replace(/^\s*([\S\s]*)\b\s*$/, "$1");
  var e = document.createElement("DIV");
  if (e.innerHTML = t, 1 == e.childNodes.length) return e.removeChild(e.firstChild);
  for (var o = document.createDocumentFragment(); e.firstChild;) o.appendChild(e.firstChild);
  return o
}, InfoBubble.prototype.removeChildren_ = function(t) {
  if (t)
    for (var e; e = t.firstChild;) t.removeChild(e)
}, InfoBubble.prototype.setContent = function(t) {
  this.set("content", t)
}, InfoBubble.prototype.setContent = InfoBubble.prototype.setContent, InfoBubble.prototype.getContent = function() {
  return this.get("content")
}, InfoBubble.prototype.getContent = InfoBubble.prototype.getContent, InfoBubble.prototype.updateContent_ = function() {
  if (this.content_) {
    this.removeChildren_(this.content_);
    var t = this.getContent();
    if (t) {
      "string" == typeof t && (t = this.htmlToDocumentFragment_(t)), this.content_.appendChild(t);
      for (var e, o = this, i = this.content_.getElementsByTagName("IMG"), n = 0; e = i[n]; n++) google.maps.event.addDomListener(e, "load", function() {
        o.imageLoaded_()
      })
    }
    this.redraw_()
  }
}, InfoBubble.prototype.imageLoaded_ = function() {
  var t = !this.get("disableAutoPan");
  this.redraw_(), !t || 0 != this.tabs_.length && 0 != this.activeTab_.index || this.panToView()
}, InfoBubble.prototype.updateTabStyles_ = function() {
  if (this.tabs_ && this.tabs_.length) {
    for (var t, e = 0; t = this.tabs_[e]; e++) this.setTabStyle_(t.tab);
    this.activeTab_.style.zIndex = this.baseZIndex_;
    var o = this.getBorderWidth_(),
      i = this.getPadding_() / 2;
    this.activeTab_.style.borderBottomWidth = 0, this.activeTab_.style.paddingBottom = this.px(i + o)
  }
}, InfoBubble.prototype.setTabStyle_ = function(t) {
  var e = this.get("backgroundColor"),
    o = this.get("borderColor"),
    i = this.getBorderRadius_(),
    n = this.getBorderWidth_(),
    s = this.getPadding_(),
    r = this.px(-Math.max(s, i)),
    b = this.px(i),
    a = this.baseZIndex_;
  t.index && (a -= t.index);
  var h = {
    cssFloat: "left",
    position: "relative",
    cursor: "pointer",
    backgroundColor: e,
    border: this.px(n) + " solid " + o,
    padding: this.px(s / 2) + " " + this.px(s),
    marginRight: r,
    whiteSpace: "nowrap",
    borderRadiusTopLeft: b,
    MozBorderRadiusTopleft: b,
    webkitBorderTopLeftRadius: b,
    borderRadiusTopRight: b,
    MozBorderRadiusTopright: b,
    webkitBorderTopRightRadius: b,
    zIndex: a,
    display: "inline"
  };
  for (var l in h) t.style[l] = h[l];
  var p = this.get("tabClassName");
  void 0 != p && (t.className += " " + p)
}, InfoBubble.prototype.addTabActions_ = function(t) {
  var e = this;
  t.listener_ = google.maps.event.addDomListener(t, "click", function() {
    e.setTabActive_(this)
  })
}, InfoBubble.prototype.setTabActive = function(t) {
  var e = this.tabs_[t - 1];
  e && this.setTabActive_(e.tab)
}, InfoBubble.prototype.setTabActive = InfoBubble.prototype.setTabActive, InfoBubble.prototype.setTabActive_ = function(t) {
  if (!t) return this.setContent(""), void this.updateContent_();
  var e = this.getPadding_() / 2,
    o = this.getBorderWidth_();
  if (this.activeTab_) {
    var i = this.activeTab_;
    i.style.zIndex = this.baseZIndex_ - i.index, i.style.paddingBottom = this.px(e), i.style.borderBottomWidth = this.px(o)
  }
  t.style.zIndex = this.baseZIndex_, t.style.borderBottomWidth = 0, t.style.marginBottomWidth = "-10px", t.style.paddingBottom = this.px(e + o), this.setContent(this.tabs_[t.index].content), this.updateContent_(), this.activeTab_ = t, this.redraw_()
}, InfoBubble.prototype.setMaxWidth = function(t) {
  this.set("maxWidth", t)
}, InfoBubble.prototype.setMaxWidth = InfoBubble.prototype.setMaxWidth, InfoBubble.prototype.maxWidth_changed = function() {
  this.redraw_()
}, InfoBubble.prototype.maxWidth_changed = InfoBubble.prototype.maxWidth_changed, InfoBubble.prototype.setMaxHeight = function(t) {
  this.set("maxHeight", t)
}, InfoBubble.prototype.setMaxHeight = InfoBubble.prototype.setMaxHeight, InfoBubble.prototype.maxHeight_changed = function() {
  this.redraw_()
}, InfoBubble.prototype.maxHeight_changed = InfoBubble.prototype.maxHeight_changed, InfoBubble.prototype.setMinWidth = function(t) {
  this.set("minWidth", t)
}, InfoBubble.prototype.setMinWidth = InfoBubble.prototype.setMinWidth, InfoBubble.prototype.minWidth_changed = function() {
  this.redraw_()
}, InfoBubble.prototype.minWidth_changed = InfoBubble.prototype.minWidth_changed, InfoBubble.prototype.setMinHeight = function(t) {
  this.set("minHeight", t)
}, InfoBubble.prototype.setMinHeight = InfoBubble.prototype.setMinHeight, InfoBubble.prototype.minHeight_changed = function() {
  this.redraw_()
}, InfoBubble.prototype.minHeight_changed = InfoBubble.prototype.minHeight_changed, InfoBubble.prototype.addTab = function(t, e) {
  var o = document.createElement("DIV");
  o.innerHTML = t, this.setTabStyle_(o), this.addTabActions_(o), this.tabsContainer_.appendChild(o), this.tabs_.push({
    label: t,
    content: e,
    tab: o
  }), o.index = this.tabs_.length - 1, o.style.zIndex = this.baseZIndex_ - o.index, this.activeTab_ || this.setTabActive_(o), o.className = o.className + " " + this.animationName_, this.redraw_()
}, InfoBubble.prototype.addTab = InfoBubble.prototype.addTab, InfoBubble.prototype.updateTab = function(t, e, o) {
  if (!(!this.tabs_.length || t < 0 || t >= this.tabs_.length)) {
    var i = this.tabs_[t];
    void 0 != e && (i.tab.innerHTML = i.label = e), void 0 != o && (i.content = o), this.activeTab_ == i.tab && (this.setContent(i.content), this.updateContent_()), this.redraw_()
  }
}, InfoBubble.prototype.updateTab = InfoBubble.prototype.updateTab, InfoBubble.prototype.removeTab = function(t) {
  if (!(!this.tabs_.length || t < 0 || t >= this.tabs_.length)) {
    var e = this.tabs_[t];
    e.tab.parentNode.removeChild(e.tab), google.maps.event.removeListener(e.tab.listener_), this.tabs_.splice(t, 1), e = null;
    for (var o, i = 0; o = this.tabs_[i]; i++) o.tab.index = i;
    e.tab == this.activeTab_ && (this.tabs_[t] ? this.activeTab_ = this.tabs_[t].tab : this.tabs_[t - 1] ? this.activeTab_ = this.tabs_[t - 1].tab : this.activeTab_ = void 0, this.setTabActive_(this.activeTab_)), this.redraw_()
  }
}, InfoBubble.prototype.removeTab = InfoBubble.prototype.removeTab, InfoBubble.prototype.getElementSize_ = function(t, e, o) {
  var i = document.createElement("DIV");
  i.style.display = "inline", i.style.position = "absolute", i.style.visibility = "hidden", "string" == typeof t ? i.innerHTML = t : i.appendChild(t.cloneNode(!0)), document.body.appendChild(i);
  var n = new google.maps.Size(i.offsetWidth, i.offsetHeight);
  return e && n.width > e && (i.style.width = this.px(e), n = new google.maps.Size(i.offsetWidth, i.offsetHeight)), o && n.height > o && (i.style.height = this.px(o), n = new google.maps.Size(i.offsetWidth, i.offsetHeight)), document.body.removeChild(i), i = null, n
}, InfoBubble.prototype.redraw_ = function() {
  this.figureOutSize_(), this.positionCloseButton_(), this.draw()
}, InfoBubble.prototype.figureOutSize_ = function() {
  var t = this.get("map");
  if (t) {
    var e = this.getPadding_(),
      o = (this.getBorderWidth_(), this.getBorderRadius_(), this.getArrowSize_()),
      i = t.getDiv(),
      n = 2 * o,
      s = i.offsetWidth - n,
      r = i.offsetHeight - n - this.getAnchorHeight_(),
      b = 0,
      a = this.get("minWidth") || 0,
      h = this.get("minHeight") || 0,
      l = this.get("maxWidth") || 0,
      p = this.get("maxHeight") || 0;
    l = Math.min(s, l), p = Math.min(r, p);
    var d = 0;
    if (this.tabs_.length)
      for (var u, f = 0; u = this.tabs_[f]; f++) {
        var y = this.getElementSize_(u.tab, l, p),
          _ = this.getElementSize_(u.content, l, p);
        a < y.width && (a = y.width), d += y.width, h < y.height && (h = y.height), y.height > b && (b = y.height), a < _.width && (a = _.width), h < _.height && (h = _.height)
      } else {
        var c = this.get("content");
        if ("string" == typeof c && (c = this.htmlToDocumentFragment_(c)), c) {
          var _ = this.getElementSize_(c, l, p);
          a < _.width && (a = _.width), h < _.height && (h = _.height)
        }
      }
    l && (a = Math.min(a, l)), p && (h = Math.min(h, p)), a = Math.max(a, d), a == d && (a += 2 * e), o = 2 * o, a = Math.max(a, o), a > s && (a = s), h > r && (h = r - b), this.tabsContainer_ && (this.tabHeight_ = b, this.tabsContainer_.style.width = this.px(d)), this.contentContainer_.style.width = this.px(a), this.contentContainer_.style.height = this.px(h)
  }
}, InfoBubble.prototype.getAnchorHeight_ = function() {
  var t = this.get("anchor");
  if (t) {
    var e = this.get("anchorPoint");
    if (e) return -1 * e.y
  }
  return 0
}, InfoBubble.prototype.anchorPoint_changed = function() {
  this.draw()
}, InfoBubble.prototype.anchorPoint_changed = InfoBubble.prototype.anchorPoint_changed, InfoBubble.prototype.positionCloseButton_ = function() {
  var t = (this.getBorderRadius_(), this.getBorderWidth_()),
    e = 2,
    o = 2;
  this.tabs_.length && this.tabHeight_ && (o += this.tabHeight_), o += t, e += t;
  var i = this.contentContainer_;
  i && i.clientHeight < i.scrollHeight && (e += 15), this.close_.style.right = this.px(e), this.close_.style.top = this.px(o)
};
"use strict";

function initPage() {
  var t = ["tomato", "drink", "nature", "meat"],
    a = t[Math.floor(Math.random() * t.length)];
  $("#main_section").addClass(a).find(".main-icon").addClass("icon-" + a)
}
$(function() {
  function t() {
    function t() {
      var t = n.find(".s-left__item").eq(d),
        e = t.find(".s-left__subList .s-left__subItem").eq(l);
      a.attr("data-active", ""), n.attr("data-active", ""), o.attr("data-active", ""), t.attr("data-active", ""), e.attr("data-active", ""), s.eq(d).attr("data-active", ""), s.eq(d).find(".r-mainList__item").eq(l).attr("data-active", ""), $(".s-left__subList").perfectScrollbar({
        suppressScrollX: !0
      })
    }
    var a = $(".section.services"),
      e = a.find(".services__left.s-left"),
      i = a.find(".services__right.s-right"),
      r = a.find(".services__start.services-start"),
      n = e.find(".s-left__list"),
      o = i.find(".s-right__wrapper"),
      s = i.find(".s-right__wrapperItem"),
      c = n.find(".s-left__subItem"),
      d = 0,
      l = 0;
    r.on("click", ".services-start__button", function() {
      var a = $(this),
        e = a.closest(".services-start"),
        i = e.attr("data-side");
      d = "left" === i ? 0 : 1, r.attr("data-active", "false"), t()
    }), n.on("click", ".s-left__item-title", function() {
      var t = $(this),
        a = t.parent(),
        e = a.siblings(),
        i = a.index(),
        r = a.find(".s-left__subList");
      c.removeAttr("data-active"), e.removeAttr("data-active"), a.attr("data-active", ""), r.children().eq(0).attr("data-active", ""), l = 0, s.removeAttr("data-active"), s.find(".r-mainList__item").removeAttr("data-active"), s.eq(i).attr("data-active", ""), s.eq(i).find(".r-mainList__item").eq(l).attr("data-active", ""), d = i, r.perfectScrollbar("update", {
        suppressScrollX: !0
      })
    }), n.on("click", ".s-left__subItem", function() {
      var t = $(this),
        a = t.index(),
        e = t.closest(".s-left__item"),
        i = e.index();
      c.removeAttr("data-active"), t.attr("data-active", ""), s.removeAttr("data-active"), s.find(".r-mainList__item").removeAttr("data-active"), s.eq(i).attr("data-active", ""), s.eq(i).find(".r-mainList__item").eq(a).attr("data-active", ""), d = i, l = a
    }), $(".r-mainList__table").perfectScrollbar(), $(".s-left__scroll").on("click", function() {
      var t = $(this),
        a = t.siblings(".s-left__subList");
      a.animate({
        scrollTop: a.scrollTop() + 20
      }, 50)
    })
  }
  initPage(), t(), $(".h-nav").on("click", function() {
      var t = $(this).find(".h-nav__list");
      t.slideToggle("fast")
    }),
    function() {
      var a = $(".h-dep"),
        e = a.find(".h-dep__title"),
        i = a.find(".h-dep__list");
      $(".h-contacts__cabinet, .header__cabinet");
      e.on("click", function() {
        var t = $(".city-switch.main-popup");
        t.attr("data-active", "")
      }), i.on("click", ".h-dep__item", function() {
        var a = $(this).text();
        e.text(a), i.slideToggle("fast"), $.fn.fullpage.moveTo("contacts");
        var r = $(this).parent("ul#js-dep").data("token");
        $.ajax({
          url: window.location.pathname + "/ajax-reload-prices",
          type: "POST",
          data: {
            id: $(this).data("dep"),
            _token: r
          }
        }).done(function(a) {
          $(".services").html(a.html), null != a.share ? ($(".adv-popup img").attr("src", a.share), $("div.header__prom").show()) : $("div.header__prom").hide(), t()
        })
      })
    }(), $(".h-lang").on("click", function() {
      var t = $(this).find(".h-lang__list");
      t.slideToggle("fast")
    }), $(".main__fix.m-fix").on("click", function(t) {
      t.preventDefault(), $.fn.fullpage.moveTo("contacts")
    }), $(".r-headerList").on("click", "li", function() {
      var t = $(this),
        a = t.siblings(),
        e = $(".r-mainList").children().eq(t.index()),
        i = e.siblings();
      t.attr("data-active", ""), a.removeAttr("data-active"), e.attr("data-active", ""), i.removeAttr("data-active")
    }),
    function() {
      var t = $(".contact-popup.main-popup"),
        a = $(".contact-with-us"),
        e = t.find(".main-popup__close"),
        i = t.find(".contact-popup__form");
      i.on("submit", function(a) {
        a.preventDefault(), t.removeAttr("data-active")
      }), a.on("click", function() {
        t.attr("data-active", "")
      }), e.on("click", function() {
        t.removeAttr("data-active")
      })
    }(),
    function() {
      var t = $(".contact-popup.main-popup"),
        a = $(".contacts__more-popup.c-more-popup"),
        e = $(".franchising-popup.main-popup"),
        i = e.find(".main-popup__close"),
        r = e.find(".contact-us-popup__submit-button.main-popup-submit"),
        n = e.find(".franchising-slider__list");
      a.on("click", function() {
        e.attr("data-active", "")
      }), i.on("click", function() {
        e.removeAttr("data-active")
      }), r.on("click", function() {
        e.removeAttr("data-active"), t.attr("data-active", "")
      }), n.slick({
        infinite: !0,
        autoplay: !0,
        speed: 500,
        fade: !0,
        arrows: !1,
        cssEase: "linear",
        dots: !0,
        dotsClass: "franchising-slider__dots"
      })
    }(),
    function() {
      var t = $(".adv-popup.main-popup"),
        a = t.find(".adv-popup__close");
      $(document).on("click", ".header__prom", function() {
        t.attr("data-active", "")
      }), a.on("click", function() {
        t.removeAttr("data-active")
      })
    }(),
    function() {
      var t = $(".eco-popup.main-popup"),
        a = t.find(".main-popup__close");
      $(document).on("click", ".eco_project", function() {
        t.attr("data-active", "")
      }), a.on("click", function() {
        t.removeAttr("data-active")
      })
    }(),
    function() {
      var a = $(".city-switch.main-popup"),
        e = a.find(".main-popup__close"),
        i = a.find(".city-switch__table"),
        r = $(".h-contacts__cabinet, .header__cabinet");
      e.on("click", function() {
        a.removeAttr("data-active")
      }), i.on("click", "div.city-switch__item", function() {
        var e = "http://www.himstat.ru/LK.php?CompanyID=31&UseLogin=1",
          q = "http://www.himstat.ru/LK.php?CompanyID=31&UseLogin=1",
          n = "http://www.himstat.ru/LK.php?CompanyID=47&UseLogin=1",
          o = $(".services-start__button");
        o.css("pointer-events", "none");
        var s = i.data("token"),
          c = $(this).text();
        if ($(".preloader").attr("data-active", ""), $.ajax({
            url: window.lang + "/ajax-reload-prices",
            type: "POST",
            dataType: "json",
            data: {
              id: $(this).data("dep"),
              _token: s
            }
          }).done(function(a) {
            $(".preloader").removeAttr("data-active"), $(".services").html(a.html), $("div.header__prom").remove(), null != a.share && ($(".adv-popup img").attr("src", a.share), $("div.header__contacts").before(a.promo_button)), t(), $("div.h-dep__title").html(c), o.css("pointer-events", ""), window.current_department_latitude = a.current_department_latitude || window.current_department_latitude, window.current_department_longitude = a.current_department_longitude || window.current_department_longitude;
            var e = {
              id: a.department.id,
              name: a.department.name,
              address: a.department.address,
              description: a.department.description,
              phone: a.department.phone,
              email: a.department.email,
              image: a.department.image
            };
            setDepartmentContacts(e), setContactPopupTabs(a.contact_tabs), array_markers = a.contact_markers, googleMapInit(), modalInit()
          }), $(this).data("dep") > 0) switch ($(this).data("dep")) {
          case 2:
            r.attr("href", e), r.attr("data-active", "true");
            break;
          case 7:
            r.attr("href", n), r.attr("data-active", "true");
            break;
          default:
            r.attr("data-active", "false")
        } else r.attr("data-active", "false");
        a.removeAttr("data-active")
      })
    }(), $(".r-headerList").on("mouseenter", "li", function() {
      var t = $(this);
      t.attr("data-hover", "")
    }), $(".r-headerList").on("mouseleave", "li", function() {
      var t = $(this);
      t.removeAttr("data-hover", "")
    }), $("#js-fullpage").fullpage({
      menu: "#js-nav",
      anchors: ["main", "about", "services", "contacts"],
      verticalCentered: !1,
      sectionSelector: ".section",
      afterLoad: function(t, a) {
        var e = $(".header"),
          i = e.find(".header__logo"),
          r = e.find(".header__cabinet"),
          n = e.find(".h-contacts__cabinet"),
          o = e.find(".header__nav"),
          s = o.find(".h-nav__title"),
          c = o.find(".h-nav__list"),
          d = c.find(".h-nav__item"),
          l = e.find(".header__languages"),
          _ = l.find(".h-lang__title"),
          p = l.find(".h-lang__list"),
          h = p.find(".h-lang__item"),
          f = e.find(".h-dep"),
          u = f.find(".h-dep__title"),
          v = f.find(".h-dep__list"),
          m = v.find(".h-dep__item"),
          w = e.find(".h-contacts__link"),
          g = e.find(".h-contacts__fb"),
          b = $(".footer__copy"),
          k = $(".footer__author"),
          A = $(".header__prom");
        switch (t) {
          case "main":
            i.attr("data-section", "others"), r.attr("data-section", "others"), s.attr("data-section", "others"), c.attr("data-section", "others"), d.attr("data-section", "others"), _.attr("data-section", "others"), p.attr("data-section", "others"), h.attr("data-section", "others"), u.attr("data-section", "others"), v.attr("data-section", "others"), m.attr("data-section", "others"), w.attr("data-section", "others"), g.attr("data-section", "others"), b.attr("data-section", "others"), k.attr("data-section", "others"), n.attr("data-section", "others"), A.attr("data-section", "white"), $.fn.fullpage.setAutoScrolling(!0);
            break;
          case "about":
            i.attr("data-section", "white"), r.attr("data-section", "white"), s.attr("data-section", "white"), c.attr("data-section", "white"), d.attr("data-section", "white"), _.attr("data-section", "white"), p.attr("data-section", "white"), h.attr("data-section", "white"), u.attr("data-section", "others"), v.attr("data-section", "others"), m.attr("data-section", "others"), w.attr("data-section", "others"), g.attr("data-section", "others"), n.attr("data-section", "others"), b.attr("data-section", "white"), k.attr("data-section", "others"), A.attr("data-section", "white"), $.fn.fullpage.setAutoScrolling(!0);
            break;
          case "services":
            i.attr("data-section", "others"), r.attr("data-section", "others"), s.attr("data-section", "others"), c.attr("data-section", "others"), d.attr("data-section", "others"), _.attr("data-section", "others"), p.attr("data-section", "others"), h.attr("data-section", "others"), u.attr("data-section", "white"), v.attr("data-section", "white"), m.attr("data-section", "white"), w.attr("data-section", "white"), g.attr("data-section", "white"), n.attr("data-section", "white"), b.attr("data-section", "others"), k.attr("data-section", "white"), A.attr("data-section", "blue"), $.fn.fullpage.setAutoScrolling(!0);
            break;
          case "contacts":
            i.attr("data-section", "white"), r.attr("data-section", "white"), s.attr("data-section", "white"), c.attr("data-section", "white"), d.attr("data-section", "white"), _.attr("data-section", "white"), p.attr("data-section", "white"), h.attr("data-section", "white"), u.attr("data-section", "white"), v.attr("data-section", "white"), m.attr("data-section", "white"), n.attr("data-section", "white"), w.attr("data-section", "map"), g.attr("data-section", "map"), b.attr("data-section", "white"), k.attr("data-section", "map"), A.attr("data-section", "blue"), $.fn.fullpage.setAutoScrolling(!0);
            break
        }
      }
    }), $(".l-carouselDesc").slick({
      adaptiveHeight: !0,
      autoplay: !0,
      autoplaySpeed: 7e3,
      arrows: !1,
      asNavFor: $(".l-carouselImg"),
      fade: !0,
      speed: 500
    }), $(".l-carouselImg").slick({
      autoplay: !0,
      autoplaySpeed: 7e3,
      arrows: !1,
      asNavFor: $(".l-carouselDesc"),
      dots: !0,
      dotsClass: "l-carouselImg__dots",
      fade: !0,
      speed: 500
    }), $(".r-fixCarousel__list").slick({
      autoplay: !0,
      autoplaySpeed: 7e3,
      arrows: !0,
      dots: !0,
      dotsClass: "r-fixCarousel__dots",
      speed: 500,
      prevArrow: ".r-fixCarousel__prev",
      nextArrow: ".r-fixCarousel__next",
      fade: !0,
      infinite: !1
    })
}), $(window).load(function() {
  setTimeout(function() {
    $(".preloader").removeAttr("data-active")
  }, 1e3)
});
