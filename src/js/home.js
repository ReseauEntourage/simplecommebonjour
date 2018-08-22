$(document).ready(function(){

	$('.accueil .fleche').on('click', function(){
		$('html, body').animate( { scrollTop: $(window).height() }, 500 );
		});

	$('.modal .close').on('click', function(){
		toggleModal(true);
	});

	$(window).scroll(function() {
		var offset = $('.chapitres').length ? ($('.chapitres').offset().top + 40) : $('.menu').offset().top ;
		var screen_width = $(window).width();
		var height = $(window).scrollTop();

		if (height >= offset) {
			// toggleModal();
			
			if (screen_width > 768){
				$('.menu').addClass('active');
				$('.chapitres').addClass('active');
			};
		} else if (height < offset) {
			$('.menu').removeClass('active');
			$('.chapitres').removeClass('active');
		};
		if (height > 10){
			$('.menu_burger').addClass('active');
		} else {
			$('.menu_burger').removeClass('active');
		};
	});

});