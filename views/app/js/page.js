$(document).ready(function(){
	menu_height_margin();
});

$(window).resize(function(){
	menu_height_margin();
});

function menu_height_margin(){
	let height = $('.navbar').height();
	$('#main-content').css({ 'margin-top': ( height + 16 ) + 'px' });
}