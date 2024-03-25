/*! jquery.showmore - v0.0.1 - BY Pedro Gomes - FTKODE*/
(function($) {
	function ellipsis($elem) {
		var timer;
		var delay = 500;
		$strSize = 0;
		if($elem.attr('data-size')) $strSize = $elem.attr('data-size');

		//check if empty the strSize
		// if($strSize < 1) $strSize = 30;
		$strSize = 500;
		// console.log($strSize);

		$elem.each(function(index) {
			var html = $(this).html();
			if (html.length > $strSize) {
				element = '<span class="min-text">' + html.substr(0, $strSize) + '</span><span style="display:none" class="full-text">' + html + '</span><a class="more-text text-orange mls options-link">...</a>';
			} else {
				element = html;
			}

			$(this).html(element);

		});

		$elem.parent("td").hover(function() {
			// on mouse in, start a timeout

			timer = setTimeout(function() {
				$elem.closest('span').find('.min-text').hide();
				$elem.find(".more-text").html('');
				$elem.closest('span').find('.full-text').show();
			}, delay);
		}, function() {
			// on mouse out, cancel the timer
			clearTimeout(timer);
		});


		$elem.parent("td").mouseleave(function() {
			$('span').find('.full-text').hide();
			$(".more-text").html("...");
			$('span').find('.min-text').show();
		});
	}


	$.fn.ellipsis = function(options) {
		return this.each(function() {
			var $elem = $(this);

			ellipsis($elem);
		});
	};
})(jQuery);
