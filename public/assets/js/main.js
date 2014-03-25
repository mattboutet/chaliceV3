// When the DOM is ready,
$(function() {
	
	$('.alert .close').on('click', function(e) {
		e.preventDefault();
		$(this).parent('.alert').hide();
	});
	
	
	// beer search innards
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

$('.beer-action').on('click', function(e){
	e.preventDefault();
	//alert('boo');
	var beerID = this.id;
	
	var $checkbox = $(this).find(':checkbox');

	$(this).toggleClass('drunk');
	if ($(this).hasClass('drunk')) {
			
		$checkbox.attr('checked', 'checked');
		//alert($beerID);
		var ajax = $.ajax({
			url: "/Drink/" + beerID,
			type: 'GET',
			success: function ($message){
					alert($message);
			}
		})
	} else {
		$checkbox.removeAttr('checked');
		var ajax = $.ajax({
			url: "/unDrink/" + beerID,
			type: 'GET',
			success: function ($message){
					alert($message);
			}
		})
	}
});

