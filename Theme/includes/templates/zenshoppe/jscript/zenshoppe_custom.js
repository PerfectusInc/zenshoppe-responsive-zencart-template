// JavaScript Document
/**
* @author Elegant Design Hub
* @author website www.elegantdesignhub.com
* @copyright Copyright 2013-2014 Elegant Design Hub
* JS Document
*/
//Scroll to top Script
var jq=jQuery.noConflict();jq(function(){jq.fn.scrollToTop=function(){jq(this).hide().removeAttr("href");if(jq(window).scrollTop()!="0"){jq(this).fadeIn("slow")}var a=jq(this);jq(window).scroll(function(){if(jq(window).scrollTop()>"350"){jq(a).fadeIn("slow")}else{jq(a).fadeOut("slow")}});jq(this).click(function(){jq("html, body").animate({scrollTop:0},"slow")})}});jq(function(){jq("#w2b-StoTop").scrollToTop()});var acc=jQuery.noConflict();acc(document).ready(function(){acc(".accordian-content").hide();acc(".accordian-header:first").addClass("active").next().show();acc(".accordian-header").click(function(){if(acc(this).next().is(":hidden")){acc(".accordian-header").removeClass("active").next().slideUp();acc(this).toggleClass("active").next().slideDown()}return false})});
/*Image Hover*/
	
/*Product Quantity*/
var sap = jQuery.noConflict();
sap('.sp-plus').on('click', function(){
 var oldVal = sap('.quantity-input').val();
    var newVal = (parseInt(sap('.quantity-input').val(),10) +1);
  sap('.quantity-input').val(newVal);
});

sap('.sp-minus').on('click', function(){
 var oldVal = sap('.quantity-input').val();
    var newVal = (parseInt(sap('.quantity-input').val(),10) -1);
    if (oldVal > 1) {
            var newVal = parseFloat(oldVal) - 1;
        } else {
            var newVal = 1;
        }
  sap('.quantity-input').val(newVal);
});



var $ = jQuery.noConflict();
/*Various Carousels*/
$(document).ready(function() {
      var owl = $(".specials-slider");
      owl.owlCarousel({
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [1400,4], //5 items between 1400px and 1025px
      itemsDesktopSmall : [1199,3], // 3 items betweem 1024px and 901px
      itemsTablet: [767,2], //2 items between 900 and 481;
      itemsMobile : [480,1], //1 item between 480 and 0;
	  rewindNav: false,
	  navigation : true, // itemsMobile disabled - inherit from itemsTablet option
      pagination:true
	  });
	  
	  var owl = $("#featured-slider");
      owl.owlCarousel({
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [1400,4], //5 items between 1400px and 1025px
      itemsDesktopSmall : [1199,3], // 3 items betweem 1024px and 901px
      itemsTablet: [767,2], //2 items between 900 and 481;
      itemsMobile : [480,1], //1 item between 480 and 0;
	  rewindNav: true,
	  autoPlay: true,
	  stopOnHover: true,
	  slideSpeed: 300,
	  paginationSpeed: 1000,
	  rewindSpeed: 1200,
	  navigation : true, // itemsMobile disabled - inherit from itemsTablet option
      pagination:true
	  });
	  
	  var owl = $("#banner-slider");
      owl.owlCarousel({
		singleItem:true,
	  	rewindNav: true,
	  	autoPlay: true,
	  	stopOnHover: false,
	  	slideSpeed: 300,
	  	paginationSpeed: 1000,
	  	rewindSpeed: 1200,
	  	navigation : false, // itemsMobile disabled - inherit from itemsTablet option
      	pagination:true
	  });
	  
	  var owl = $("#sidebox-featured-slider");
      owl.owlCarousel({
		singleItem:true,
	  	rewindNav: true,
	  	autoPlay: true,
	  	stopOnHover: false,
	  	slideSpeed: 300,
	  	paginationSpeed: 1000,
	  	rewindSpeed: 1200,
	  	navigation : false, // itemsMobile disabled - inherit from itemsTablet option
      	pagination:true
	  });

	  var owl = $("#sidebox-special-slider");
      owl.owlCarousel({
		singleItem:true,
	  	rewindNav: true,
	  	autoPlay: true,
	  	stopOnHover: false,
	  	slideSpeed: 300,
	  	paginationSpeed: 1000,
	  	rewindSpeed: 1200,
	  	navigation : false, // itemsMobile disabled - inherit from itemsTablet option
      	pagination:true
	  });
	  
	  var owl = $("#sidebox-new-slider");
      owl.owlCarousel({
		singleItem:true,
	  	rewindNav: true,
	  	autoPlay: true,
	  	stopOnHover: false,
	  	slideSpeed: 300,
	  	paginationSpeed: 1000,
	  	rewindSpeed: 1200,
	  	navigation : false, // itemsMobile disabled - inherit from itemsTablet option
      	pagination:true
	  });
	  	  
	  var owl = $("#new-slider");
      owl.owlCarousel({
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [1400,4], //5 items between 1400px and 1025px
      itemsDesktopSmall : [1199,3], // 3 items betweem 1024px and 901px
      itemsTablet: [767,2], //2 items between 900 and 481;
      itemsMobile : [480,1], //1 item between 480 and 0;
	  rewindNav: false,
	  navigation : true, // itemsMobile disabled - inherit from itemsTablet option
      pagination:true
	  });
	  /*-----------------------------------*/
	  var owl = $("#special-slider-inner");
      owl.owlCarousel({
      items : 3, //10 items above 1000px browser width
      itemsDesktop : [1400,3], //5 items between 1400px and 1025px
      itemsDesktopSmall : [1199,2], // 3 items betweem 1024px and 901px
      itemsTablet: [900,2], //2 items between 900 and 481;
      itemsMobile : [480,1], //1 item between 480 and 0;
	  rewindNav: false,
	  navigation : true, // itemsMobile disabled - inherit from itemsTablet option
      pagination:false
	  });
	  
	  var owl = $("#alsopurchased_products");
      owl.owlCarousel({
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [1400,3], //5 items between 1400px and 1025px
      itemsDesktopSmall : [1199,3], // 3 items betweem 1024px and 901px
      itemsTablet: [900,2], //2 items between 900 and 481;
      itemsMobile : [480,1], //1 item between 480 and 0;
	  rewindNav: false,
	  navigation : true, // itemsMobile disabled - inherit from itemsTablet option
      pagination:false
	  });
	  /*----------------------------*/
	  var owl = $("#additionalimages-slider");
      owl.owlCarousel({
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [1400,3], //5 items between 1000px and 901px
      itemsDesktopSmall : [1024,3], // 3 items betweem 900px and 601px
      itemsTablet: [900,3], //2 items between 600 and 0;
      itemsMobile : [480,2],
	  rewindNav: false,
	  navigation : true, // itemsMobile disabled - inherit from itemsTablet option
      pagination:false
	  });
	  
	  var owl = $(".brands");
      owl.owlCarousel({
       itemsCustom : [
			[0, 1],
			[320, 2],
			[567, 3],
			[900, 4],
			[1024, 5],
			[1400, 6],
			[1600, 7],
		],
	  rewindNav: false,
	  navigation : true, // itemsMobile disabled - inherit from itemsTablet option
      pagination:false
	  });
	  /*-----------------------------------*/

});

/*Tooltip*/
$(document).ready(function(){
    $(".product_image a, .custom-block .overlay > a").tooltip({
        placement : 'top'
    });
	$(".product-actions a, .prodinfo-actions .wish_link a, .prodinfo-actions .compare_link a").tooltip({
        placement : 'top'
    });
	$(".arrow-down a").tooltip({
        placement : 'left'
    });
	$("header h4 .navNextPrevList a").tooltip({
        placement : 'top'
    });
	$(".product-details-review .smallProductImage a").tooltip({
        placement : 'top'
    });
	$(".product-details-review .product-review-default h4 a").tooltip({
        placement : 'top'
    });
	$("a.compare_remove, #wishlist .extendedDelete a, .product-details-review .product-review-default p a").tooltip({
        placement : 'top'
    });
	$(".social_bookmarks li, .dFilterClear a, a.clear_all_filters").tooltip({
        placement : 'top'
    });
});

/*Select2 JS*/
$(document).ready(function() { 
	    $("#select-filter_id").select2({
			width:"element"
    	});
    	$("#select-alpha_filter_id").select2({
    		width:"element"
    	});
		$("#select-zone_country_id").select2({
    		width:"element"
    	});
		$("#disp-order-sorter").select2({
    		width:"element"
    	});
		$("#select-categories_id").select2({
    		width:"element"
    	});
		$("#select-manufacturers_id").select2({
    		width:"element"
    	});
		$("#select-manufacturers_id").select2({
    		width:"element"
    	});
		$(".product_attributes select, #select-zone_id, .dFilterDrop").select2({
    		width:"element"
    	});
});

/*Menu JS*/
$("#cssmenu").menumaker({
  title: "",
  format: "multitoggle"
 });
   
   $(document).ready(function() {
    $('a.moduleBox').click(function() { // show selected module(s)
    // variables
      var popID = $(this).attr('rel');
      var popNAV = $(this).attr('class');
    // clear out menu styles and apply active
      $('a.moduleBox').css('background', '');
      $(this).css('background', '');
    // hide all wrappers and display the one selected
      $('.centerBoxWrapper').hide();
      // check if all or single selection
      if (popID != 'viewAll') {
        $('#' + popID).show();
      } else {
       $('.centerBoxWrapper').show();
      }
    });
	
	$('a.navOne').click(function() {
		$('a.navOne').addClass('active');
		$('a.navTwo').removeClass('active');
		$('a.navThree').removeClass('active');
	});
	
	$('a.navTwo').click(function() {
		$('a.navOne').removeClass('active');
		$('a.navTwo').addClass('active');
		$('a.navThree').removeClass('active');
	});
	
	$('a.navThree').click(function() {
		$('a.navOne').removeClass('active');
		$('a.navTwo').removeClass('active');
		$('a.navThree').addClass('active');
	});
	
  });

/*Banner Hover*/
$(document).ready(function(){
        if (Modernizr.touch) {
            // show the close overlay button
            $(".close-overlay").removeClass("hidden");
            // handle the adding of hover class when clicked
            $(".image").click(function(e){
                if (!$(this).hasClass("hover")) {
                    $(this).addClass("hover");
                }
            });
            // handle the closing of the overlay
            $(".close-overlay").click(function(e){
                e.preventDefault();
                e.stopPropagation();
                if ($(this).closest(".image").hasClass("hover")) {
                    $(this).closest(".image").removeClass("hover");
                }
            });
        } else {
            // handle the mouseenter functionality
            $(".image").mouseenter(function(){
                $(this).addClass("hover");
            })
            // handle the mouseleave functionality
            .mouseleave(function(){
                $(this).removeClass("hover");
            });
        }
    });

/*Toggle Search*/
function toggleSearch(){
jQuery(function($) {
$('.search-bar-container').fadeToggle( "fast", "linear" );
});
} 

function closeSearch(){
jQuery(function($) {
$('.search-bar-container').css("display", "none");
});
}

/*Toggle Contact Number*/
function toggleNumber(){
jQuery(function($) {
$('.contact-number-container').fadeToggle( "fast", "linear" );
});
} 
function closeNumber(){
jQuery(function($) {
$('.contact-number-container').css("display", "none");
});
}

/*Toggle Contact Email*/
function toggleEmail(){
jQuery(function($) {
$('.contact-email-container').fadeToggle( "fast", "linear" );
});
} 
function closeEmail(){
jQuery(function($) {
$('.contact-email-container').css("display", "none");
});
} 

/*Facebook JS*/
(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

/*Twitter JS*/
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

$(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true,   // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);

                $name.text($tab.text());

                $info.show();
            }
        });

        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
    });

/*OWL CAROUSEL*/
$(document).ready(function () {

	var dragging = true;
	var owlElementID = '#main-slideshow';

	function fadeInReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3").stop().delay(800).animate({ opacity: 0 }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3").css({ opacity: 0 });
        }
    }
    
    function fadeInDownReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3").stop().delay(800).animate({ opacity: 0, top: "-15px" }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3").css({ opacity: 0, top: "-15px" });
        }
    }
    
    function fadeInUpReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3").stop().delay(800).animate({ opacity: 0, top: "15px" }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3").css({ opacity: 0, top: "15px" });
        }
    }
    
    function fadeInLeftReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3").stop().delay(800).animate({ opacity: 0, left: "15px" }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3").css({ opacity: 0, left: "15px" });
        }
    }
    
    function fadeInRightReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3").stop().delay(800).animate({ opacity: 0, left: "-15px" }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3").css({ opacity: 0, left: "-15px" });
        }
    }
    
    function fadeIn() {
        $(owlElementID + " .active .caption .fadeIn-1").stop().delay(500).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeIn-2").stop().delay(700).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeIn-3").stop().delay(1000).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
    }
    
    function fadeInDown() {
        $(owlElementID + " .active .caption .fadeInDown-1").stop().delay(500).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInDown-2").stop().delay(900).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInDown-3").stop().delay(1300).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
    }
    
    function fadeInUp() {
        $(owlElementID + " .active .caption .fadeInUp-1").stop().delay(500).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInUp-2").stop().delay(700).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInUp-3").stop().delay(1000).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
    }
    
    function fadeInLeft() {
        $(owlElementID + " .active .caption .fadeInLeft-1").stop().delay(500).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInLeft-2").stop().delay(700).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInLeft-3").stop().delay(1000).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
    }
    
    function fadeInRight() {
        $(owlElementID + " .active .caption .fadeInRight-1").stop().delay(500).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInRight-2").stop().delay(700).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInRight-3").stop().delay(1000).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
    }

    $("#main-slideshow").owlCarousel({
		autoPlay: true,
        stopOnHover: true,
        navigation: true,
        pagination: true,
        singleItem: true,
        addClassActive: true,
		slideSpeed: 400,
	  	paginationSpeed: 400,
		rewindNav: true,
		pagination:false,
        transitionStyle: "backSlide",

		afterInit: function() {
            fadeIn();
            fadeInDown();
            fadeInUp();
            fadeInLeft();
            fadeInRight();
        },
            
        afterMove: function() {
            fadeIn();
            fadeInDown();
            fadeInUp();
            fadeInLeft();
            fadeInRight();
            
        },
        
        afterUpdate: function() {
            fadeIn();
            fadeInDown();
            fadeInUp();
            fadeInLeft();
            fadeInRight();
        },
        
        startDragging: function() {
            dragging = true;
        },
        
        afterAction: function() {
            fadeInReset();
            fadeInDownReset();
            fadeInUpReset();
            fadeInLeftReset();
            fadeInRightReset();
            dragging = false;

        }
	});

});

$(window).bind("load", function () {
    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(1000).fadeOut('slow'); // will fade out the white DIV that covers the website.
    //$('body').delay(1000).css({'overflow-x': 'hidden'}).css({'overflow-y': 'auto'});
    //checkContactForm();

  });