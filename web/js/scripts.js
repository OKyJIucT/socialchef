$(document).ready(function () {
	//CUSTOM FORM ELEMENTS
	$('select, input[type=radio],input[type=checkbox],input[type=file]').uniform();

	//MOBILE MENU
	$('#menu').slicknav();

	//SCROLL TO TOP BUTTON
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300,
	//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
	//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
	//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) {
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
				scrollTop: 0 ,
			}, scroll_top_duration
		);
	});

	//MY PROFILE TABS 
	$('.tab-content').hide().first().show();
	$('.tabs li:first').addClass("active");

	$('.tabs a').on('click', function (e) {
		e.preventDefault();
		$(this).closest('li').addClass("active").siblings().removeClass("active");
		$($(this).attr('href')).show().siblings('.tab-content').hide();
	});

	var hash = $.trim( window.location.hash );
	if (hash) $('.tab-nav a[href$="'+hash+'"]').trigger('click');

	//ALERTS
	$('.close').on('click', function (e) {
		e.preventDefault();
		$(this).closest('.alert').hide(400);
	});
});