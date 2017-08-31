jQuery(document).ready(function() {

	/*******************************************
	 * HELPER FUNCTIONS *
	 *******************************************/

	/*
	 * Image lazy loading
	 * Further reading: https://www.appelsiini.net/projects/lazyload
	 * Example image tag:  <img class="lazy" data-original="img/example.jpg" width="640" height="480">
	 * Uncomment out the code below and in the index.php file to enable lazyloading
	 */

	// jQuery("img.lazy").lazyload({
	//     threshold : 200
	// });

	/*
	 * Check alt tags aren't empty for images
	 * For development use only
	 */

	// jQuery('img').each(function() {
	// 	console.log(jQuery(this).attr('alt'));
	// });


	/* Social Share */

	// mobile only, show/hide whole divisions menu

	jQuery("#jDate").text( (new Date).getFullYear() );

	
	jQuery('#share-button').on('click', function(){
		jQuery('.social-share .fastsocialshare_container').toggleClass('active');
		jQuery('.social-share #share-button').toggleClass('active-button');
		jQuery('.social-share span.cross').toggleClass('active');
		jQuery('.social-share').toggleClass('active-padding');
	})

	jQuery('span.cross').on('click', function(){
		jQuery('.social-share .fastsocialshare_container').removeClass('active');
		jQuery('.social-share #share-button').removeClass('active-button');
		jQuery('.social-share span.cross').removeClass('active');
		jQuery('.social-share').toggleClass('active-padding');
	})



	jQuery(document).on('keyup', '.input-ultra-mini' ,function() {

		if(jQuery('.input-ultra-mini').val() > 0) {
			jQuery('.proopc-task-updateqty').trigger("click");

		}

	});

	// add top menu to the main menu on phones (only with JS)
	if (jQuery('.js').length) {
		moveTopMenu();
	}

	/*******************************************
	 * RESPONSIVE NAV *
	 *******************************************/

   newsOwl();

	 featuredMachines();

	 relatedProducts();

	 jQuery("a[href='#top']").click(function() {
		 jQuery("html, body").animate({ scrollTop: 0 }, "slow");
		 return false;
	 });


	 jQuery("#top2 .total_products").html(function(index, text) {
          return text.replace('Basket empty', '0');
  });

	jQuery('.nav-btn').on('click', function() {
		jQuery('html').addClass('js-nav');
	});

	jQuery('.close-btn, .js-nav #innerwrap').on('click', function() {
		jQuery('html').removeClass('js-nav');
	});

	jQuery('.links span.search').on('click', function() {
		jQuery('.moduletable.search').toggle();

	});

	if(jQuery('#left').length) {
		moveSideBarDown();
		moveImagesUp();
	}

});



// When the window is resized
jQuery(window).resize(function() {
	w = getWindowWidth();
    if(jQuery('#left').length) {
		moveSideBarDown();
				moveImagesUp();

	}

	// add top menu to the main menu on phones (only with JS)
	if (jQuery('.js').length) {
		moveTopMenu();
	}

// Kick off one resize to fix all videos on page load
}).resize();


window.onload = function() {
w = getWindowWidth();
    if(jQuery('#left').length) {
		moveSideBarDown();
				moveImagesUp();
	}
}

function getWindowWidth() {
	return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
}

function newsOwl() {
	jQuery('.news-slide').owlCarousel({
	    loop:false,
	    margin:20,
	    nav:true,
			mouseDrag: false,
	    responsive:{
	        0:{
	            items:1
	        },
	        850:{
	            items:2
	        },
	        1200:{
	            items:3
	        },
					1400: {
						items:4
					}
	    }
	})
}

function featuredMachines() {
	jQuery('.products-slide').owlCarousel({
	    loop:false,
	    margin:20,
	    nav:true,
			mouseDrag: false,
			// autoHeight:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:2
	        },
	        1000:{
	            items:3
	        },

					1200:{
							items:4
					},
					1400: {
						items:5
					}
	    }
	})
}

function relatedProducts() {
	jQuery('.related-slide').owlCarousel({
	    loop:false,
	    margin:20,
	    nav:true,
			mouseDrag: false,
			// autoHeight:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        740:{
	            items:2
	        },
	        1000:{
	            items:3
	        },

					1360:{
							items:4
					}
	    }
	})
}


function moveSideBarDown() {
	var sb = jQuery('#left');
	if(w < 1024) {
		jQuery('#main').after(sb);
	} else {
		jQuery('#main').before(sb);
	}

}

function moveTopMenu() {
	if (w < 1024) {
		// get <li> form top menu
		jQuery('.products-menu ul.nav').appendTo('#menu').addClass('moved');
	} else if (w >= 920) {
		jQuery('#menu ul.moved').appendTo('.moduletable.products-menu').removeClass('moved');
	}
}


function moveImagesUp() {
	var sb = jQuery('.product-container .gallery');
	if(w < 1024) {
		jQuery('.product-container .general-info').after(sb);
	} else {
		jQuery('.product-container .general-info').before(sb);
	}

}
