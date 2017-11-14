if ($(window).width() <= 575) {
	$(document).click(function () {
		$('body').css('overflow-y', '');
	});
	$('.notifications').click(function () {
		var overflowY = 'hidden'; 
		if ($('body').css('overflow-y') == 'hidden') {
			overflowY = '';
		}
		$('body').css('overflow-y', overflowY);
	});
	$('.user-action').click(function () {
		$('body').css('overflow-y', '');
	});
}
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
}), $("#btn-upload").on("change", function () {
    var o = $(this).val().replace(/.*(\/|\\)/, "");
    $("#file-upload").val(o).css("color", "#657786")
});

// $(function () {
// 	$(window).scroll(function () {
// 		var scroll = $(this).scrollTop();
// 		if (scroll > 0) {
// 			$('#header').addClass('fixed');
// 		} else {
// 			$('#header').removeClass('fixed');
// 		}
// 	});
// });

$(function () {
	$('textarea').each(function () {
		this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px; overflow-y: hidden;');
	}).on('input', function () {
		this.style.height = 'auto';
		this.style.height = (this.scrollHeight) + 'px';
	});
});

$(function () {
	$('.area-responses').hide();
	$('.write-responses').click(function () {
		$(this).hide();
		$('.area-responses').show();
		$('textarea').focus();
	});
	$('.cancel').click(function () {
		$('.area-responses').hide();
		$('.write-responses').show();
	});
});

// $(function () {
// 	var sticky = $('.sticky');
// 	var stickyrStopper = $('.post-footer');
// 	var offsetSticky = sticky.offset().top;
// 	var generalSidebarHeight = sticky.innerHeight();
// 	var stickyTop = sticky.offset().top;
// 	var stickOffset = 150;
// 	var stickyStopperPosition = stickyrStopper.offset().top;
// 	var stopPoint = stickyStopperPosition - generalSidebarHeight - stickOffset;
// 	var diff = stopPoint + stickOffset;

//     $(window).scroll(function () {
//       	var windowTop = $(window).scrollTop();

//       	if (stopPoint < windowTop) {
//       		sticky.css({ position: 'absolute', top: diff, opacity: 0 });
//       	} else if (stickyTop < windowTop + stickOffset) {
//       		sticky.css({ position: 'fixed', top: offsetSticky, width: '160px', opacity: 1 });
//       	} else {
//       		sticky.css({ position: 'fixed', top: offsetSticky, opacity: 0 });
//       	}
//     });
// });

$(function () {
	$("#datatable").dataTable();
})

