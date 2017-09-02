$(document).ready(function(){

	var sliderCount = $('.emergente-slider li').length;
	var sliderStart = 1;
	var width = 0;
	var current = 5;

	$('.emergente-slider li').each(function(i,e){
		$('.slider-pagination').append('<li><img src="'+$(e).children('img').attr('src')+'" alt="'+$(e).children('img').attr('src')+'" /></li>');
	});

	$('.emergente-slider li').first().show();

	$('.slider-pagination li').click(SliderMove);
	$('.arrow-controls .esNext').click(NextSlider);
	$('.arrow-controls .esPrev').click(PrevSlider);

	

	function SliderMove(e){
		e.preventDefault();
		let slider_this = $(this).index() + 1;
		moveSliderTo(slider_this);
	}

	function NextSlider(e){
		e.preventDefault();
		if (sliderStart < sliderCount) sliderStart++;
		else sliderStart = 1;
		
		moveSliderTo(sliderStart);
	}

	function PrevSlider(e) {
		e.preventDefault();
		if (sliderStart <= 1) sliderStart = sliderCount;
		else sliderStart--;
		moveSliderTo(sliderStart);
		
	}

	function moveSliderTo(numSlider) {
		$('.emergente-slider li').hide();
		$('.emergente-slider li:nth-child('+numSlider+')').fadeIn('slow');
	}

	$('.pag .thNext').click(function(e){
		e.preventDefault();
		
		if (current < sliderCount) {
			width = width + $('.slider-pagination li:first-child').width() + 5;
			$('.slider-pagination').animate({
				'margin-left': -width+'px'
			});

			current++;
		}

	});

	$('.pag .thPrev').click(function(e){
		e.preventDefault();
	
		if (current > 5) {
			width = width - $('.slider-pagination li:first-child').width() - 5;
			
			$('.slider-pagination').animate({
				'margin-left': -width+'px'
			});
			current--;
		}
		
	});


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



	Resizing();
	$(window).resize(function() {
		Resizing();
	});

});

