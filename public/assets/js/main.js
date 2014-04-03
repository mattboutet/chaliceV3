// When the DOM is ready,
$(function() {
	
	/**
	 * AJAX beer toggle
	 */

	$('.beer-icon').on('click', function(e) {
		e.preventDefault();

		var $checkbox   = $(this).find(':checkbox'),
			beer_id     = $(this).closest('.beer-item').attr('id'),
			beer_item   = $(this).closest('.beer-item'),
			beer_cb     = beer_item.find('.beer-cb'),
			list_label  = beer_cb.find('.label-info'),
			saved_label = beer_cb.find('.label-success');

		beer_item.toggleClass('drunk');

		if (beer_item.hasClass('drunk')) {
			console.log(beer_id);
			$checkbox.attr('checked', 'checked');

			var ajax = $.ajax({
				url: "/Drink/" + beer_id,
				type: 'GET',
				success: function($message) {
					console.log("drank!");
					list_label.hide();
					saved_label.fadeIn(100).fadeOut(1000, function() {
						list_label.fadeIn(150);
					});
				}
			});
		} else {
			$checkbox.removeAttr('checked');
			
			var ajax = $.ajax({
				url: "/unDrink/" + beer_id,
				type: 'GET',
				success: function($message) {
					console.log("undrank!");
					list_label.hide();
					saved_label.fadeIn(100).fadeOut(1000, function() {
						list_label.fadeIn(150);
					});
				}
			});
		}
	});

	/**
	 * Beer info accordions
	 */

	$('.beer-toggle').on('click', function(e) {
		e.preventDefault();

		var	beer_item = $(this).closest('.beer-item'),
			beer_info = beer_item.find('.beer-info');

		beer_info.slideToggle('fast');
	});

	/**
	 * Notifications
	 */

	$('.alert .close').on('click', function(e) {
		e.preventDefault();
		$(this).parent('.alert').hide();
	});
	
	
	/**
	 *  Beer search. Strip out style names if user is trying to search.
	 * Not ideal.  Better if it'd keep style names if a beer in the style matches.
	 * not sure how to accomplish this?  me-no-speekey-jquery.
	 */

	var searchForBeer = function() {
		
		var searchName = $('.search-beers').val();
		
		// these elements match the search terms
		var matches = $('.beer-item').filter(function() {
			
			var upperBeerName = $(this).find('h3').text();
			
			if (typeof upperBeerName != "undefined") {
				var thisBeerName = upperBeerName.toLowerCase();
			}
			searchName = searchName.toLowerCase().trim();
			
			// just do a substring match
			return (thisBeerName.indexOf(searchName) !== -1);

		});
		
		// these elements don't match the search terms
		var nonMatches = $('.beer-item').not(matches);
		
		// show matches, and hide non-matches.
		matches.show();
		nonMatches.hide();
		
		var emptyItem = $('.beer-none');
		
		if (matches.length == 0) {
			emptyItem.show();
		} else {
			emptyItem.hide();
		}
		
	}
	
	// attach beer search events
	$('.search-beers').on('keyup change focus', searchForBeer);
	
	// hop to the beer search input right away!
	$('.search-beers').first().focus();
	
});

