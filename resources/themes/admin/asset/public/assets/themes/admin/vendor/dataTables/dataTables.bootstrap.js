/* Set the defaults for DataTables initialisation */
$.extend( $.fn.dataTableExt.oStdClasses, {
	"sWrapper": "dataTables_wrapper form form-inline"
} );

$.extend(true, $.fn.dataTable.defaults, {
    "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>" + "t" + "<'row'<'col-sm-6'i><'col-sm-6'p>>",
    "oLanguage": {
        "sLengthMenu": "_MENU_ records per page"
    }
});


$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
	return {
		"iStart":         oSettings._iDisplayStart,
		"iEnd":           oSettings.fnDisplayEnd(),
		"iLength":        oSettings._iDisplayLength,
		"iTotal":         oSettings.fnRecordsTotal(),
		"iFilteredTotal": oSettings.fnRecordsDisplay(),
		"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
		"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
	};
};


/* Default class modification */
$.extend($.fn.dataTableExt.oStdClasses, {
    "sWrapper": "dataTables_wrapper form-inline",
    "sFilterInput": "form-control input-sm",
    "sLengthSelect": "form-control input-sm"
});


/* API method to get paging information */
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
	return {
		"iStart":         oSettings._iDisplayStart,
		"iEnd":           oSettings.fnDisplayEnd(),
		"iLength":        oSettings._iDisplayLength,
		"iTotal":         oSettings.fnRecordsTotal(),
		"iFilteredTotal": oSettings.fnRecordsDisplay(),
		"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
		"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
	};
};


/* Bootstrap style pagination control */
$.extend( $.fn.dataTableExt.oPagination, {
	"bootstrap": {
		"fnInit": function( oSettings, nPaging, fnDraw ) {
			var oLang = oSettings.oLanguage.oPaginate;
			var fnClickHandler = function ( e ) {
				e.preventDefault();
				if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
					fnDraw( oSettings );
				}
			};

			$(nPaging).addClass('pagination').append(
				'<ul>'+
					'<li class="prev disabled"><a href="#">'+oLang.sPrevious+'</a></li>'+
					'<li class="next disabled"><a href="#">'+oLang.sNext+'</a></li>'+
				'</ul>'
			);
			var els = $('a', nPaging);
			$(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
			$(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
		},

		"fnUpdate": function ( oSettings, fnDraw ) {
			var iListLength = 5;
			var oPaging = oSettings.oInstance.fnPagingInfo();
			var an = oSettings.aanFeatures.p;
			var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

			if ( oPaging.iTotalPages < iListLength) {
				iStart = 1;
				iEnd = oPaging.iTotalPages;
			}
			else if ( oPaging.iPage <= iHalf ) {
				iStart = 1;
				iEnd = iListLength;
			} else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
				iStart = oPaging.iTotalPages - iListLength + 1;
				iEnd = oPaging.iTotalPages;
			} else {
				iStart = oPaging.iPage - iHalf + 1;
				iEnd = iStart + iListLength - 1;
			}

			for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
				// Remove the middle elements
				$('li:gt(0)', an[i]).filter(':not(:last)').remove();

				// Add the new list items and their event handlers
				for ( j=iStart ; j<=iEnd ; j++ ) {
					sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
					$('<li '+sClass+'><a href="#">'+j+'</a></li>')
						.insertBefore( $('li:last', an[i])[0] )
						.bind('click', function (e) {
							e.preventDefault();
							oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
							fnDraw( oSettings );
						} );
				}

				// Add / remove disabled classes from the static elements
				if ( oPaging.iPage === 0 ) {
					$('li:first', an[i]).addClass('disabled');
				} else {
					$('li:first', an[i]).removeClass('disabled');
				}

				if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
					$('li:last', an[i]).addClass('disabled');
				} else {
					$('li:last', an[i]).removeClass('disabled');
				}
			}
		}
	}
} );

/* Bootstrap style pagination control */
$.extend( $.fn.dataTableExt.oPagination, {
	"bootstrap_full": {
		"fnInit": function( oSettings, nPaging, fnDraw ) {
			var oLang = oSettings.oLanguage.oPaginate;
			var fnClickHandler = function ( e ) {
				e.preventDefault();
				if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
					fnDraw( oSettings );
				}
			};

			$(nPaging).addClass('pagination').append(
				'<ul>'+
					'<li class="first disabled"><a href="#">'+oLang.sFirst+'</a></li>'+
					'<li class="prev disabled"><a href="#">'+oLang.sPrevious+'</a></li>'+
					'<li class="next disabled"><a href="#">'+oLang.sNext+'</a></li>'+
					'<li class="last disabled"><a href="#">'+oLang.sLast+'</a></li>'+
				'</ul>'
			);
			var els = $('a', nPaging);
			$(els[0]).bind( 'click.DT', { action: "first" }, fnClickHandler );
			$(els[1]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
			$(els[2]).bind( 'click.DT', { action: "next" }, fnClickHandler );
			$(els[3]).bind( 'click.DT', { action: "last" }, fnClickHandler );
		},

		"fnUpdate": function ( oSettings, fnDraw ) {
			var iListLength = 5;
			var oPaging = oSettings.oInstance.fnPagingInfo();
			var an = oSettings.aanFeatures.p;
			var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

			if ( oPaging.iTotalPages < iListLength) {
				iStart = 1;
				iEnd = oPaging.iTotalPages;
			}
			else if ( oPaging.iPage <= iHalf ) {
				iStart = 1;
				iEnd = iListLength;
			} else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
				iStart = oPaging.iTotalPages - iListLength + 1;
				iEnd = oPaging.iTotalPages;
			} else {
				iStart = oPaging.iPage - iHalf + 1;
				iEnd = iStart + iListLength - 1;
			}

			for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
				// Remove the middle elements
				$('li', an[i]).filter(":not(.first)").filter(":not(.last)").filter(":not(.prev)").filter(":not(.next)").remove();

				// Add the new list items and their event handlers
				for ( j=iStart ; j<=iEnd ; j++ ) {
					sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
					$('<li '+sClass+'><a href="#">'+j+'</a></li>')
						.insertBefore( $('li.next', an[i])[0] )
						.bind('click', function (e) {
							e.preventDefault();
							oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
							fnDraw( oSettings );
						} );
				}

				// Add / remove disabled classes from the static elements
				if ( oPaging.iPage === 0 ) {
					$('li.first', an[i]).addClass('disabled');
					$('li.prev', an[i]).addClass('disabled');
				} else {
					$('li.prev', an[i]).removeClass('disabled');
					$('li.first', an[i]).removeClass('disabled');
				}

				if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
					$('li.last', an[i]).addClass('disabled');
					$('li.next', an[i]).addClass('disabled');
				} else {
					$('li.next', an[i]).removeClass('disabled');
					$('li.last', an[i]).removeClass('disabled');
				}
			}
		}
	}
} );


/*
 * TableTools Bootstrap compatibility
 * Required TableTools 2.1+
 */
if ( $.fn.DataTable.TableTools ) {
	// Set the classes that TableTools uses to something suitable for Bootstrap
	$.extend( true, $.fn.DataTable.TableTools.classes, {
		"container": "DTTT btn-group",
		"buttons": {
			"normal": "btn",
			"disabled": "disabled"
		},
		"collection": {
			"container": "DTTT_dropdown dropdown-menu",
			"buttons": {
				"normal": "",
				"disabled": "disabled"
			}
		},
		"print": {
			"info": "DTTT_print_info modal"
		},
		"select": {
			"row": "active"
		}
	} );

	// Have the collection use a bootstrap compatible dropdown
	$.extend( true, $.fn.DataTable.TableTools.DEFAULTS.oTags, {
		"collection": {
			"container": "ul",
			"button": "li",
			"liner": "a"
		}
	} );
}

$.extend($.fn.dataTableExt.oPagination, {bootstrap_alt: {fnInit: function (d, e, b) {
    var c = d.oLanguage.oPaginate, a = function (a) {
        a.preventDefault();
        d.oApi._fnPageChange(d, a.data.action) && b(d)
    };
    $(e).addClass("pagination").append('<ul class="pagination pagination-sm"><li class="first disabled"><a href="#">&lt;&lt; ' + c.sFirst + '</a></li><li class="prev disabled"><a href="#">&lt; ' + c.sPrevious + '</a></li><li class="next disabled"><a href="#">' + c.sNext + ' &gt;</a></li><li class="last disabled"><a href="#">' + c.sLast + " &gt;&gt;</a></li></ul>");
    e = $("a", e);
    $(e[0]).bind("click.DT", {action: "first"}, a);
    $(e[1]).bind("click.DT", {action: "previous"}, a);
    $(e[2]).bind("click.DT", {action: "next"}, a);
    $(e[3]).bind("click.DT", {action: "last"}, a)
}, fnUpdate: function (d, e) {
    var b = d.oInstance.fnPagingInfo(), c = d.aanFeatures.p, a, g, i, f, h;
    a = Math.floor(2.5);
    5 > b.iTotalPages ? (f = 1, h = b.iTotalPages) : b.iPage <= a ? (f = 1, h = 5) : b.iPage >= b.iTotalPages - a ? (f = b.iTotalPages - 5 + 1, h = b.iTotalPages) : (f = b.iPage - a + 1, h = f + 5 - 1);
    a = 0;
    for (iLen = c.length; a < iLen; a++) {
        $("li", c[a]).filter(":not(.first)").filter(":not(.last)").filter(":not(.prev)").filter(":not(.next)").remove();
        var j = $(c[a]).find(".next");
        for (g = f; g <= h; g++)i = g == b.iPage + 1 ? 'class="active"' : "", $("<li " + i + '><a href="#">' + g + "</a></li>").insertBefore(j).bind("click", function (a) {
            a.preventDefault();
            d._iDisplayStart = (parseInt($("a", this).text(), 10) - 1) * b.iLength;
            e(d)
        });
        0 === b.iPage ? ($("li.first", c[a]).addClass("disabled"), $("li.prev", c[a]).addClass("disabled")) : ($("li.first", c[a]).removeClass("disabled"), $("li.prev", c[a]).removeClass("disabled"));
        b.iPage === b.iTotalPages - 1 || 0 === b.iTotalPages ? ($("li.next", c[a]).addClass("disabled"), $("li.last", c[a]).addClass("disabled")) : ($("li.next", c[a]).removeClass("disabled"), $("li.last", c[a]).removeClass("disabled"))
    }
}}});

//// хак, чтоб сделать фильтр красивеньким
//$(function(){
//    $('#list_filter input').addClass('form-control');
//});