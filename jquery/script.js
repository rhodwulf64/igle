( function( $ ) {
$( document ).ready(function() {
$('#menuprin').prepend('');
	$('#menuprin #menu-button').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
		}
		else {
			menu.addClass('open');
		}
	});
});
} )( jQuery );
