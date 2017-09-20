//console.log();
(function() {
	$(".rslides_home").responsiveSlides({
	  	auto: true,             // Boolean: Animate automatically, true or false
	  	speed: 4000,            // Integer: Speed of the transition, in milliseconds
	  	timeout: 6000,          // Integer: Time between slide transitions, in milliseconds
	  	pager: false,           // Boolean: Show pager, true or false
	  	nav: false,             // Boolean: Show navigation, true or false
	  	random: false,          // Boolean: Randomize the order of the slides, true or false
	  	pause: false,           // Boolean: Pause on hover, true or false
	  	pauseControls: false,   // Boolean: Pause when hovering controls, true or false
	  	prevText: "Siguiente",  // String: Text for the "previous" button
	  	nextText: "Anterior",   // String: Text for the "next" button
	  	maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
	  	navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
	  	manualControls: "",     // Selector: Declare custom pager navigation
	  	namespace: "rslides",   // String: Change the default namespace used
	  	before: function(){},   // Function: Before callback
	  	after: function(){}     // Function: After callback
	});
})();

(function() {
	
	$(window).resize(function(){
		body_condition();
	});
		
	body_condition();

	function responsive_menu(){
		var landscape = window.matchMedia("(orientation: landscape)").matches ? 40 : 0;

		
		var menu = {
			width: ($('.navigation-menu').outerWidth() / 2),
			height: ($('.navigation-menu').outerHeight() / 2)
		}
		
		$('.navigation-menu').css({
			'left': 'calc(50% - '+menu.width+'px)',
			'top': (($('body').height() / 2) - menu.height) +  landscape +'px'
		});
		
	}
	function body_condition(){
		if ($('body').width() <= 991) {
			responsive_menu();
		}
	}
	
})();
