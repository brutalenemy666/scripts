;(function($, window, document, undefined) {
	var $win = $(window);

	$win.on('load', function() {
		$loadMoreContent();
	});

	var $loadMoreContent = function( options ) {
		var can_proceed = true;

		var options = jQuery.extend({
			offset: 450, // offset in pixels
			more_link_selector: 'a.link-more',
			preloader_animation: '.preloader',
			content_container_selector: '.ajax-load-container'
		}, options);

		if ( !options.more_link_selector || !options.content_container_selector ) {
			return;
		};

		var $more_link = $(options.more_link_selector),
			$items_container = $(options.content_container_selector),
			$preloader = $(options.preloader_animation);

		if ( !$more_link.length || !$items_container.length ) {
			return;
		};

		doOnScroll();

		$win.on('scroll', function(){
			doOnScroll();
		});

		function doOnScroll() {
			if ( !can_proceed ) {
				return;
			};

			if ( !canLoadContent() ) {
				return;
			};

			can_proceed = false;
			showPreloader();

			loadMoreContent();
		}

		function loadMoreContent() {
			if ( !$more_link.length ) {
				return;
			};

			link = $more_link.attr('href');

			if ( !link ) {
				return;
			};

			$.get(link, function(data) {
				var $content_to_add = $(options.content_container_selector + " > *", data),
					$next_link = $(options.more_link_selector, data);

				if ( $next_link.length ) {
					$more_link.attr('href', $next_link.attr('href') );
				} else {
					$more_link.remove();
				};

				$items_container.append( $content_to_add );

				can_proceed = true;
				hidePreloader();

				doOnScroll(); // try for another load
			});
		}

		function canLoadContent() {
			return $(window).scrollTop() >= $(document).height() - $(window).height() - options.offset;
		}

		function hasPreloader() {
			return $preloader.length;
		}

		function showPreloader() {
			if ( !hasPreloader() ) {
				return;
			};

			$preloader.fadeIn();
		}

		function hidePreloader() {
			if ( !hasPreloader() ) {
				return;
			};

			$preloader.fadeOut();
		}
	}
})(jQuery, window, document);