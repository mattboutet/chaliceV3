// When the DOM is ready,
$(function() {
	$('.alert .close').on('click', function(e) {
		e.preventDefault();
		$(this).parent('.alert').hide();
	});
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
