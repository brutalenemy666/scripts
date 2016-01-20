;(function($, window, document, undefined) {
	var $win = $(window);

	$win.on('load', function() {
		$scrollToSection();
	});

	$scrollToSection = function() {
		// <a href="#section-id-attr">anchor text</a>
		// <div id="section-id-attr"> content </div> 
		var $links = $('a.scroll-to'),
			selector_pattern = /^(\.|#)[^\s]+$/;

		$links.on('click', function( event ) {
			event.preventDefault();

			var $this = $(this),
				selector = $this.attr('href');

			scrollToElement(selector);
		});

		function scrollToElement( item_selector ) {
			if ( !item_selector || !selector_pattern.test(item_selector) ) {
				return;
			};

			var $target = $(item_selector);

			if ( !$target.length ) {
				return;
			};

			$('html, body').animate({
				scrollTop : $target.offset().top
			});
		}
	}
})(jQuery, window, document);