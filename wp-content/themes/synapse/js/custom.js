

jQuery(document).ready( function() {
	jQuery('#searchicon').click(function() {
		jQuery('#jumbosearch').fadeIn();
		jQuery('#jumbosearch input').focus();
	});
	jQuery('#jumbosearch .closeicon').click(function() {
		jQuery('#jumbosearch').fadeOut();
	});
	jQuery('body').keydown(function(e){
	    
	    if(e.keyCode == 27){
	        jQuery('#jumbosearch').fadeOut();
	    }
	});
		
	jQuery('#site-navigation ul.menu').slicknav({
		label: 'Menu',
		duration: 1000,
		prependTo:'#slickmenu'
	});	
	
	if (jQuery("article").hasClass("item")) {
		jQuery('.site-main').flexImages({rowHeight: 300, object: 'img'});
	}
	
	function adjustSocial() {
		if (jQuery(window).width() > 767 ) {
			var social = jQuery(".social-icons").offset().left;
			var menu = jQuery("#site-navigation").width() + 85;
			if ( social  <= menu  ) {
				jQuery(".social-icons").css("width","100%");
			}
			else {
				jQuery(".social-icons").css("width","auto");
			}
		}
	}	
	
	adjustSocial();
	jQuery(window).resize(adjustSocial);
	
});


/*


	if ( jQuery( window ).width() > 767 ) {
		jQuery(function(){
				jQuery.stellar({
			});
		}); 
	}	
    
*/

// Swiper Slider Coverflow		
jQuery(function(){
  var myCoverflow = jQuery('.swiper-container').swiper({
    pagination: '.swiper-pagination',
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    slideToClickedSlide: true,
    paginationClickable: true,
    loop: true,
    coverflow: {
	        rotate: 50,
	        stretch: 0,
	        depth: 100,
	        modifier: 1,
	        slideShadows : true
	    }
    });
    
    //myCoverflow.slideTo(3, 0, false);
    
});

jQuery(function(){
  var myCoverflow = jQuery('.swiper-container-posts').swiper({
    pagination: '.swiper-pagination',
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    slideToClickedSlide: true,
    paginationClickable: true,
    loop: true,
    coverflow: {
	        rotate: 50,
	        stretch: 0,
	        depth: 100,
	        modifier: 1,
	        slideShadows : true
	    }
    });
    
    //myCoverflow.slideTo(3, 0, false);
    
});

//Featured Products - CUbe
jQuery(function(){
  var mySwiper = jQuery('.fp-container').swiper({
        pagination: '.swiper-pagination',
        effect: 'cube',
        grabCursor: true,
        paginationClickable: true,
        loop: true,
        pagination: false,
        nextButton: '.sbnc',
        prevButton: '.sbpc',
        cube: {
            shadow: false,
            slideShadows: true,
            shadowOffset: 12,
            shadowScale: 0.64
        }
        });
    });

jQuery(function(){
  var mySwiper = jQuery('.fposts-container').swiper({
        pagination: '.swiper-pagination',
        effect: 'cube',
        grabCursor: true,
        paginationClickable: true,
        loop: true,
        pagination: false,
        nextButton: '.sbncp',
        prevButton: '.sbpcp',
        cube: {
            shadow: false,
            slideShadows: true,
            shadowOffset: 12,
            shadowScale: 0.64
        }
        });
    });

//SLIDER
jQuery(function(){
  var mySlider = jQuery('.slider-container').swiper({
        pagination: '.swiper-pagination',
        paginationClickable: true,
        nextButton: '.slidernext',
        prevButton: '.sliderprev',
        spaceBetween: 30,
        autoplay: 6500,
        speed: 1000,
        effect: 'fade'
    });		
});	

//SLIDER POSTS
jQuery(function(){
  var myPostsSlider = jQuery('.swiper-posts-slider').swiper({
        slidesPerView: 4,
        paginationClickable: true,
        spaceBetween: 15, 
        pagination: '.swiper-pagination-x',
        nextButton: '.nb',
        prevButton: '.pb',
        breakpoints: {
            1024: {
                slidesPerView: 4,
            },
            820: {
                slidesPerView: 3,
            },
            700: {
                slidesPerView: 2,
            },
            500: {
                slidesPerView: 1,
                spaceBetween: 10
            }
        }
    });		
});	
	