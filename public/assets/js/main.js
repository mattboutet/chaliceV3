// When the DOM is ready,
$(function() {
	
	/**
	 * AJAX beer toggle
	 */

	$('.beer-icon').on('click', function(e) {
		e.preventDefault();
		//console.log('boo');
		var beer_id   = $(this).closest('.beer-item').attr('id'),
			beer_item = $(this).closest('.beer-item'),
			$checkbox = $(this).find(':checkbox');

		beer_item.toggleClass('drunk');

		if (beer_item.hasClass('drunk')) {
			console.log(beer_id);
			$checkbox.attr('checked', 'checked');

			var ajax = $.ajax({
				url: "/Drink/" + beer_id,
				type: 'GET',
				success: function($message) {
					console.log("boop");
					alert($message);
				}
			});
		} else {
			$checkbox.removeAttr('checked');
			
			var ajax = $.ajax({
				url: "/unDrink/" + beer_id,
				type: 'GET',
				success: function($message) {
					alert($message);
				}
			});
		}
	});

	/**
	 * Notifications
	 */

	$('.alert .close').on('click', function(e) {
		e.preventDefault();
		$(this).parent('.alert').hide();
	});
	
	
	/**
	 *  Beer search
	 */

	var searchForBeer = function() {
		
		var searchName = $('.search-beers').val();
		
		// these elements match the search terms
		var matches = $('.beer-item').filter(function() {
			
			var thisBeerName = $(this).find('a').html().toLowerCase();
			searchName = searchName.toLowerCase().trim();
			
			// just do a substring match
			return (thisBeerName.indexOf(searchName) !== -1);

		});
		
		// these elements don't match the search terms
		var nonMatches = $('.beer-item').not(matches);
		
		// show matches, and hide non-matches.
		matches.show();
		nonMatches.hide();
		
		var emptyItem = $('.beer-item-empty');
		
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

