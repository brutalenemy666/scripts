;(function($, window, document, undefined) {
	var $win = $(window);
	var $doc = $(document);

	$doc.ready(function() {
		$('input.number').inputNumber();
	});

	$.fn.inputNumber = function() {
		var $elements = this;

		$elements.each(function() {
			var $this = $(this);

			if ( is_processed($this) ) {
				return;
			};

			item_wrap( $this );
		});

		function is_processed( item ) {
			return item.parents('.crb-number').length;
		}

		function item_wrap( item ) {
			item
				.replaceWith("<span class=\"crb-number\"> \
								<span class=\"button subtraction\">-</span> \
								" + item[0].outerHTML + " \
								<span class=\"button summation\">+</span> \
							</span>");
		}

		if ( window.inputNumberInitialized!==true ) {
			window.inputNumberInitialized = true;

			$doc
				.on('keyup', 'span.crb-number input', function() {
					var $this = $(this),
						value = $this.val() || '';


					if ( !$this.val().match(/^\d+$/) ) {
						$this.val(0);
					};
				})
				.on('click', 'span.crb-number span.button', function(e) {
					var $this = $(this),
						$input = $this.parent().find('input'),
						current_number = parseInt($input.val()) || 0;

					if ( $this.hasClass('subtraction') && current_number > 0 ) {
						current_number--;
					} else if ( $this.hasClass('summation') ) {
						current_number++;
					};

					current_number = Math.abs(current_number);

					$input
						.val(current_number)
						.change();
				});
		};
	};
	
})(jQuery, window, document);