$(document).ready(function(){
	menu_height_margin();
	filter_category_active();

});

$(window).resize(function(){
	menu_height_margin();
});

function menu_height_margin(){
	let height = $('.navbar').height();
	$('#main-content').css({ 'margin-top': ( height + 16 ) + 'px' });
	
}

function filter_category_active() {
	$('.menu-filter li').click(function() {
		$('.menu-filter li').removeClass('active');
		$(this).addClass('active');
	});
}