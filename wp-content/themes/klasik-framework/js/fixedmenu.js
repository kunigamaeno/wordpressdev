(function () {
 "use strict";
jQuery(document).ready(function(){
	
		// Sticky menu
		jQuery(document).ready(function() {
			var stickyNavTop = jQuery('.fixedmenu').offset().top;
			
			var stickyNav = function(){
			var scrollTop = jQuery(window).scrollTop();
				 
			if (scrollTop > stickyNavTop) { 
				jQuery('.fixedmenu').addClass('sticky');
			} else {
				jQuery('.fixedmenu').removeClass('sticky'); 
			}
			};
			
			stickyNav();
			
			jQuery(window).scroll(function() {
				stickyNav();
			});
		});

});



})(jQuery);