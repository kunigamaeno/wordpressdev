(function ($) {
	
	/* Slider */
	
	$('.carousel').carousel();
	
		/* Slider Touch Support */
		
		$(".carousel").swiperight(function() {
			 $(this).carousel('prev');
		});
		
		$(".carousel").swipeleft(function() {
			$(this).carousel('next');
		}); 
	
	
	/* Animate link to the top */
	
	$("a[href='#top']").click(function() {
	  $("html, body").animate({ scrollTop: 0 }, "slow");
	  return false;
	});
	
	/* Activate gallery */
	
	$('.gallery').magnificPopup({
        gallery:{enabled:true},
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
        // other options
    });	
	
}(jQuery));
