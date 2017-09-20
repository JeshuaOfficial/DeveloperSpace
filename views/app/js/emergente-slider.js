(function(document, window, $){
	'use strict';

	$(document).ready(function(){
		var options = {
			sliderCount: $('.emergente-slider li').length,
			sliderStart: 1,
			width: 0,
			current: 5,
			slides: $('.emergente-slider li')
		};

		options.slides.first().show();

		options.slides.each(function(i,e){
			$('.slider-pagination').append('<li><img src="'+$(e).children('img').attr('src')+'" alt="'+$(e).children('img').attr('src')+'" /></li>');
		});

		Resizing();


		$('.slider-pagination li').click(function(e){
			e.defaultPrevented;
			var slider_this = $(this).index() + 1;
			moveSliderTo(slider_this);
		});


		$('.arrow-controls .esNext').click(function(e){
			e.defaultPrevented;
			if (options.sliderStart < options.sliderCount) options.sliderStart++;
			else options.sliderStart = 1;
			
			moveSliderTo(options.sliderStart);
		});

		$('.arrow-controls .esPrev').click(function(e){
			e.defaultPrevented;
			if (options.sliderStart <= 1) options.sliderStart = options.sliderCount;
			else options.sliderStart--;
			moveSliderTo(options.sliderStart);
		});


		$('.pag .thNext').click(function(e){
			e.defaultPrevented;
			
			if (options.current < options.sliderCount) {
				options.width = options.width + $('.slider-pagination li:first-child').width() + 5;
				$('.slider-pagination').animate({
					'margin-left': - options.width+'px'
				});

				options.current++;
			}

		});


		$('.pag .thPrev').click(function(e){
			e.defaultPrevented;
		
			if (options.current > 5) {
				options.width = options.width - $('.slider-pagination li:first-child').width() - 5;
				
				$('.slider-pagination').animate({
					'margin-left': - options.width+'px'
				});
				options.current--;
			}
			
		});

	});


	$(window).on('resize', function(){
		Resizing();
	});




	function moveSliderTo(numSlider) {
		$('.emergente-slider li').hide();
		$('.emergente-slider li:nth-child('+numSlider+')').fadeIn('slow');
	}

	function Resizing() {
		$('.slider-pagination li').css({
			'width': Math.round( (($('.emg-pag').width() / 5 ) - 5) )+ 'px'
		});

		/*let windows_height = $(window).height(), 
			navbar_height = $('.navbar').height(),
			categories_height = $('.menu-categories-filter').outerHeight();
		$('.emergente-sliderShow').css({
			'height': (windows_height - navbar_height - categories_height) + 'px'
		});*/
	}



})(document,window,jQuery);