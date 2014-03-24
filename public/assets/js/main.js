// When the DOM is ready,
$(function() {
	/*$('.beer-action input').change(function() {
		if($(this).is(':checked')) {
			$(this).parent('.beer-action').parent('.beer-item').addClass('drunk');
		} else {
			$(this).parent('.beer-action').parent('.beer-item').removeClass('drunk');
		}
	});*/

	$('form .beer-item').on('click', function(e) {
		e.preventDefault();
		var $checkbox = $(this).find(':checkbox');

		$(this).toggleClass('drunk');

		if ($(this).hasClass('drunk')) {
			$checkbox.attr('checked', 'checked');
		} else {
			$checkbox.removeAttr('checked');
		}
	});

	$('.alert .close').on('click', function(e) {
		e.preventDefault();
		$(this).parent('.alert').hide();
	});
});
