(function () {
 "use strict";
jQuery(document).ready(function(){
	
	//Add Class Js to html
	jQuery('html').addClass('js');	
	
	//=================================== MENU ===================================//
	jQuery("ul.sf-menu").superfish({
					//add options here if required
				});
	
	//=================================== MOBILE MENU DROPDOWN ===================================//
	jQuery('#topnav').tinyNav({
		active: 'current-menu-item'
	});	
	
	//=================================== PRETTYPHOTO ===================================//
	jQuery('a[data-rel]').each(function() {jQuery(this).attr('rel', jQuery(this).data('rel'));});
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		animationSpeed:'slow',
		theme:'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		gallery_markup:'',
		social_tools: false,
		slideshow:2000
	});
	
	//=================================== FADE EFFECT ===================================//
	jQuery('.klasik-pfnew-img').hover(
		function() {
			jQuery(this).find('.rollover').stop().fadeTo(500, 0.6);
		},
		function() {
			jQuery(this).find('.rollover').stop().fadeTo(500, 0);
		}
	
	);
	
	jQuery('.klasik-pfnew-img').hover(
		function() {
			jQuery(this).find('.zoom').stop().fadeTo(500, 1);
		},
		function() {
			jQuery(this).find('.zoom').stop().fadeTo(500, 0);
		}
	);

});

jQuery(window).load(function() {
	runflexsliderHome();
	runflexslider();
});

//===================== For Slider Home FLEXSLIDER =====================//
function runflexsliderHome(){
	jQuery('#slideritems').flexslider({
		animation: "fade",
		touch:true,
		animationDuration: 6000,
		directionNav: false,
		smoothHeight: true,
		controlNav: true
	});
}

//=================================== FLEXSLIDER ===================================//
function runflexslider(){
	jQuery('.flexslider').flexslider({
		animation: "fade",
		touch:true,
		animationDuration: 6000,
		directionNav: false,
		smoothHeight: true,
		controlNav: true
	});
}


})(jQuery);