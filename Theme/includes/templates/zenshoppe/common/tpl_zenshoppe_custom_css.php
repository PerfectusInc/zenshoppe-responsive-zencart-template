<?php
/**
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
?>
<!--Query to fetch Zenshoppe values-->
<?php 
$zenshoppe_query = "SELECT * FROM " . DB_PREFIX.zenshoppe;
$zenshoppe_result = $db->Execute($zenshoppe_query);

$theme_color = $zenshoppe_result->fields['theme_color'];
$theme_color = (explode(",",$theme_color));

$logo_image = $zenshoppe_result->fields['logo_image'];

$store_address = $zenshoppe_result->fields['store_address'];
$store_contact = $zenshoppe_result->fields['store_contact'];
$store_email = $zenshoppe_result->fields['store_email'];
$store_copyright = $zenshoppe_result->fields['store_copyright'];
$store_fax = $zenshoppe_result->fields['store_fax'];
$store_skype = $zenshoppe_result->fields['store_skype'];
$store_map = $zenshoppe_result->fields['store_map'];
$newsletter_details = $zenshoppe_result->fields['newsletter_details'];
$aboutus_text = $zenshoppe_result->fields['aboutus_text'];

$facebook_link = $zenshoppe_result->fields['facebook_link'];
$twitter_link = $zenshoppe_result->fields['twitter_link'];
$pinterest_link = $zenshoppe_result->fields['pinterest_link'];
$google_link = $zenshoppe_result->fields['google_link'];
$tumblr_link = $zenshoppe_result->fields['tumblr_link'];
$linkedin_link = $zenshoppe_result->fields['linkedin_link'];
$youtube_link = $zenshoppe_result->fields['youtube_link'];

$facebook_box = $zenshoppe_result->fields['facebook_box'];
$twitter_box = $zenshoppe_result->fields['twitter_box'];

$custom_block_bg = $zenshoppe_result->fields['custom_block_bg'];
$custom_block_heading = $zenshoppe_result->fields['custom_block_heading'];
$custom_services_block_bg = $zenshoppe_result->fields['custom_services_block_bg'];

$custom_block1_icon = $zenshoppe_result->fields['custom_block1_icon'];
$custom_block2_icon = $zenshoppe_result->fields['custom_block2_icon'];
$custom_block3_icon = $zenshoppe_result->fields['custom_block3_icon'];
$custom_block4_icon = $zenshoppe_result->fields['custom_block4_icon'];
			
$custom_block1_title = $zenshoppe_result->fields['custom_block1_title'];
$custom_block2_title = $zenshoppe_result->fields['custom_block2_title'];
$custom_block3_title = $zenshoppe_result->fields['custom_block3_title'];
$custom_block4_title = $zenshoppe_result->fields['custom_block4_title'];
			
$custom_block1_subtitle = $zenshoppe_result->fields['custom_block1_subtitle'];
$custom_block2_subtitle = $zenshoppe_result->fields['custom_block2_subtitle'];
$custom_block3_subtitle = $zenshoppe_result->fields['custom_block3_subtitle'];
$custom_block4_subtitle = $zenshoppe_result->fields['custom_block4_subtitle'];

$banner1_slider = $zenshoppe_result->fields['banner1_slider'];
$banner2_slider = $zenshoppe_result->fields['banner2_slider'];
$banner3_slider = $zenshoppe_result->fields['banner3_slider'];

$banner1 = $zenshoppe_result->fields['banner1'];
$banner2 = $zenshoppe_result->fields['banner2'];
$banner3 = $zenshoppe_result->fields['banner3'];

$payment_image = $zenshoppe_result->fields['payment_image'];

$banner1_link = $zenshoppe_result->fields['banner1_link'];
$banner2_link = $zenshoppe_result->fields['banner2_link'];
$banner3_link = $zenshoppe_result->fields['banner3_link'];

$banner1_title = $zenshoppe_result->fields['banner1_title'];
$banner2_title = $zenshoppe_result->fields['banner2_title'];
$banner3_title = $zenshoppe_result->fields['banner3_title'];

$banner1_subtitle = $zenshoppe_result->fields['banner1_subtitle'];
$banner2_subtitle = $zenshoppe_result->fields['banner2_subtitle'];
$banner3_subtitle = $zenshoppe_result->fields['banner3_subtitle'];
		
$bottom_banner1 = $zenshoppe_result->fields['bottom_banner1'];
$bottom_banner2 = $zenshoppe_result->fields['bottom_banner2'];

$bottom_banner1_link = $zenshoppe_result->fields['bottom_banner1_link'];
$bottom_banner2_link = $zenshoppe_result->fields['bottom_banner2_link'];

$bottom_banner1_title = $zenshoppe_result->fields['bottom_banner1_title'];
$bottom_banner2_title = $zenshoppe_result->fields['bottom_banner2_title'];
			
$bottom_banner1_subtitle = $zenshoppe_result->fields['bottom_banner1_subtitle'];
$bottom_banner2_subtitle = $zenshoppe_result->fields['bottom_banner2_subtitle'];
?>
<?php if($this_is_home_page) { 
	$slideshow_query = "SELECT * from " . DB_PREFIX.zenshoppe_slideshow;
	$slideshow_query_result = $db->Execute($slideshow_query);
}
?>
<!--Query Ends-->
<style type="text/css">
/* Theme Color */
/*Primary Theme color*/
a:hover, #product_name a:hover, #loginForm .buttonRow.back.important > a:hover, .buttonRow.back.important > a:hover, .cartBoxTotal, #checkoutSuccessOrderLink > a:hover, #checkoutSuccessContactLink > a:hover, #checkoutSuccess a.cssButton.button_logoff:hover, #subproduct_name > a, a.table_edit_button span.cssButton.small_edit:hover, #accountDefault a:hover, .allorder_text > a:hover, #reviewsWriteProductPageLink > a:hover, #reviewsWriteReviewPageLink > a:hover, #productReviewLink > a:hover, .buttonRow.product_price > a:hover, #productReviewsDefaultProductPageLink > a:hover, #searchContent a:hover, #siteMapList a:hover, .box_heading_style h1 a:hover, .info-links > li:hover a, #navBreadCrumb li a:hover, .footer-toplinks a:hover, .banner:hover .link:hover, #cartContentsDisplay a.table_edit_button:hover, #timeoutDefaultContent a:hover, #logoffDefaultMainContent > a span.pseudolink:hover, #createAcctDefaultLoginLink > a:hover, #unsubDefault a .pseudolink:hover, .review_content > p i.fa, .gv_faq a:hover, .alert > a:hover, .reviews-list blockquote p a:hover, .reviews-list blockquote h4 a:hover, #left-column .leftBoxContainer a:hover, #right-column .rightBoxContainer a:hover, .navNextPrevList > a, .button,input[type="submit"],input[type="reset"],input[type="button"],.readmore,button, #shoppingCartDefault .buttonRow, .change_address > a, #pageThree .buttonRow.back > a, #pageFour .buttonRow.back > a, #pageTwo .buttonRow.back > a, #discountcouponInfo .content .buttonRow.forward > a, #main-slideshow .owl-controls .owl-buttons div, .centerBoxWrapper .owl-theme .owl-buttons i.fa, .brands-slider .owl-theme .owl-buttons i.fa, .bestseller-products .owl-buttons i.fa, .our-services header > h2, .top-banner h3 .banner_subtitle, .custom-banner-image h3 .banner_subtitle, .top-contact-number, .top-contact-email, #topcartinner > a > i.fa, .header-container .header .greeting a:hover, .header-container .header .cart-info .shopping_cart_link, .content.caption h2, .content.caption a, .pagination-style a, #right-column #categories li:hover a, #left-column #categories li:hover a, #left-column #cartBoxListWrapper li:hover > a, #right-column #cartBoxListWrapper li:hover > a, #right-column li a:hover, #left-column li a:hover, .sideBoxContentItem a:hover, .product_sideboxname > a:hover, .sidebox_price .productSpecialPriceSale, .sidebox_price .productSalePrice, .sidebox_price .single_price, .sidebox_price .productSpecialPrice, #left-column .leftBoxHeading a:hover, #right-column .rightBoxHeading a:hover, #reviewsContent > a:hover, .product-name-desc .product_name a:hover, .addtocart-info .cart_quantity span, .cartQuantity .fff span, .add_title, .btn.dropdown-toggle.btn-setting, #additionalimages-slider .owl-controls .owl-prev, #additionalimages-slider .owl-controls .owl-next, .item .product-actions a, .centerBoxContentsAlsoPurch .product-actions a, #specialsListing .item .product-actions a, #whatsNew .centerBoxContentsNew.centeredContent .product_price, #featuredProducts .centerBoxContentsFeatured.centeredContent .product_price, .item .product_price, .specialsDefault .centerBoxContentsSpecials.centeredContent .product_price, #specialsListing .specialsListBoxContents .product_price, #alsopurchased_products .product_price, #upcomingProducts .product_price, .productListing-data .product_name > a:hover, .newproductlisting .product_name > a:hover, .productlisting_price .productSpecialPriceSale, .productlisting_price .productSalePrice, .productlisting_price .single_price, .productlisting_price .productSpecialPrice, .brands-wrapper h2, .category-slideshow-wrapper h2, .box_heading h2, .custom-newsletter-left header > h2, #indexDefault > #horizontalTab li.resp-tab-active, .alsoPurchased header > h2, #productGeneral .productprice-amount .productSpecialPrice, #productGeneral .productprice-amount .productPriceDiscount, .product_price.total span.total_price, #reviewsWrite .productprice-amount, #reviewsInfoDefault .productprice-amount, #reviewsDefault .productprice-amount, .single_price, .breadcrumb-current, .cartTableHeading, #cartSubTotal, table#cartContentsDisplay tr th, #prevOrders .tableHeading th, #accountHistInfo .tableHeading th, #cartSubTotal, #shoppingCartDefault .buttonRow a, #checkoutShipping .change_address a, #checkoutPayment .change_address a, #checkoutConfirmDefault .change_address a, #addressBookDefault .change_address a span, #accountEditDefault .change_address a span, #accountHistoryDefault .change_address a, #accountHistInfo .change_address a, #createAcctSuccess .change_address a, #unsubDefault .change_address a, .remodal h1, .remodal-close:after, .remodal-confirm, .centerBoxWrapper .owl-theme .owl-controls .owl-buttons .disabled i.fa, .centerBoxWrapper .owl-theme .owl-controls .owl-buttons .disabled:hover  i.fa, #additionalimages-slider .owl-controls .owl-prev.disabled i.fa, #additionalimages-slider .owl-controls .owl-next.disabled i.fa, #additionalimages-slider .owl-controls .owl-prev.disabled:hover i.fa, #additionalimages-slider .owl-controls .owl-next.disabled:hover i.fa, .brands-slider .owl-controls .owl-next.disabled, .brands-slider .owl-controls .owl-next.disabled:hover i.fa, .brands-slider .owl-controls .owl-prev.disabled, .brands-slider .owl-controls .owl-prev.disabled:hover i.fa, .bestseller-products .owl-controls .owl-prev.disabled:hover i.fa, .resp-tabs-list i.fa, #centercontent-wrapper header > h4, .about-us-details header > h2, .cart_table .fa-times-circle:hover, .basketcol span.cartTitle, .cart_contentbox a:hover, #viewCart a, .cartmain > a.button, .cartmain a > div.topCartCheckout, .product-list .item:hover .info-right .product-title a, .extra-links li a:hover, .contact-us li.aboutus_mail a:hover, ul.tabs li.selected a, ul.tabs li a:hover, .prodinfo-actions .wish_link a, .prodinfo-actions .compare_link a, .about-us-details h3, #carttopcontainer .cartmain a.button, #wishlist .cssButton.button_back, .product_attribute .productSpecialPrice, .home_button .buttonRow.back.button > a, #orderTotals .amount, #indexDefault > #horizontalTab li:hover {
	color: <?php echo $theme_color[0]; ?>;
}
.navNextPrevList > a:hover, .notfound_text, #main-slideshow .owl-controls .owl-buttons div:hover, .top-contact-number .contact-icon:hover, .top-contact-email .contact-icon:hover, #topcartinner .contact-icon:hover, .cart-info .shopping_cart_icon, .header-container .header .cart-info .shopping_cart_link:hover, .header-container .header .nav-maincontainer .search-bar-icon > li > a.search-icon, .footer-top-wrapper, .btn.dropdown-toggle.btn-setting:hover, .btn.dropdown-toggle.btn-setting:focus, .btn-group .dropdown-menu, #additionalimages-slider .owl-controls .owl-prev:hover, #additionalimages-slider .owl-controls .owl-next:hover, .item .product_image .product-actions a:hover, #featuredProducts #featured-slider .product-actions a:hover, #specialsListing .item .product-actions a:hover, .centerBoxContentsAlsoPurch .product-actions a:hover, .newsletter-details #mc_embed_signup input.button:hover, .content.caption a:hover, #centercontent-wrapper #indexDefault header h2:after, .custom-content-wrapper .featured-products header > h2:after, .custom-special-products-wrapper .special-products header h2:after, .brands-slider header h2:after, .custom-newsletter-left header > h2:after, .box_heading header > h2:after, .alsoPurchased header > h2:after, .copyright .top:hover, .review-links > .buttonRow:hover, .overlay a.expand:hover, #whatsNew .item:before, .product-grid .item:before, .product-list .item:before, #tabBestSellersContent .item:before, #featuredProducts #featured-slider-inner .item:before, .specialsDefault .item:before, #specialsListing .item:before, #alsopurchased_products .centerBoxContentsAlsoPurch:before, #upcomingProducts .item:before, .remodal-close:hover, .remodal-close:active, .remodal-confirm:hover, .remodal-confirm:active, .search-bar-container, .centerBoxWrapper .owl-theme .owl-buttons > div:hover, .brands-slider .owl-theme .owl-buttons > div:hover, .bestseller-products .owl-buttons > div:hover, .contact-number-container, .contact-email-container, .our-services header > h2:after, .item .product-image .product-actions a:hover, .about-us-details header > h2:after, .about-us-left #about-us-text, #cssmenu.small-screen .submenu-button, .cartmain a > div.topCartCheckout:hover, #viewCart a:hover, .product-list .item:hover .info-right .product-title a:after, .quick-actions > div, .owl-theme .owl-controls .owl-page.active span, .owl-theme .owl-controls.clickable .owl-page:hover span, .desc-info-details, .prodinfo-actions .wish_link:hover, .prodinfo-actions .compare_link:hover, #categories > h4, .custom-services-wrapper:before, .custom-services-wrapper:after, #indexProductListCatDescription, #categoryDescription, .contact-sample-text, .store-details, .about-us-header > h2, .newsletter-details > #mc_embed_signup, .about-us-left #about-us-text, #wishlist .cssButtonHover.button_back.button_backHover {
    background: none repeat scroll 0 0 <?php echo $theme_color[0]; ?>;
}
.navNextPrevList > a, .button,input[type="submit"],input[type="reset"],input[type="button"],.readmore,button, #shoppingCartDefault .buttonRow, .change_address > a, #pageThree .buttonRow.back > a, #pageFour .buttonRow.back > a, #pageTwo .buttonRow.back > a, #discountcouponInfo .content .buttonRow.forward > a, #main-slideshow .owl-controls .owl-buttons div, .copyright .top:hover, .overlay a.expand, .content.caption a, .pagination-style .current, .pagination-style a, .pagination-style a:hover, .addtocart-info .cart_quantity span, .cartQuantity .fff span, #indexCategories #subcategory_names li, .add_title, .btn.dropdown-toggle.btn-setting, #additionalimages-slider .owl-controls .owl-prev, #additionalimages-slider .owl-controls .owl-next, .item .product-actions a, .centerBoxContentsAlsoPurch .product-actions a, #specialsListing .item .product-actions a, .btn.dropdown-toggle.btn-setting:hover, .btn.dropdown-toggle.btn-setting:focus, .review-links > .buttonRow, .remodal-close, .remodal-confirm, .search-bar-container .search-bar-form .form-search .input-text, .centerBoxWrapper .owl-theme .owl-controls .owl-buttons div.owl-prev, .brands-slider .owl-controls .owl-buttons div.owl-prev, .bestseller-products .owl-controls .owl-buttons div.owl-prev, .alsoPurchased #alsopurchased_products .owl-controls .owl-buttons div.owl-prev, .centerBoxWrapper .owl-theme .owl-controls .owl-buttons div.owl-next, .brands-slider .owl-controls .owl-buttons div.owl-next, .bestseller-products .owl-controls .owl-buttons div.owl-next, .alsoPurchased #alsopurchased_products .owl-buttons div.owl-next, .top-contact-number .contact-icon, .top-contact-email .contact-icon, #topcartinner .contact-icon, .cartmain a > div.topCartCheckout, #carttopcontainer, #viewCart a, .desc-info, .prodinfo-actions .wish_link, .prodinfo-actions .compare_link, .category-details, .contact-details, .about-us-header, .newsletter-details, .about-us-details, .newsletter-details > #mc_embed_signup, .about-us-left #about-us-text, #wishlist .cssButton.button_back, #wishlist .cssButtonHover.button_back.button_backHover, .facebook_right .facebook-content, .twitter_right .twitter-content {
    border: 1px solid <?php echo $theme_color[0]; ?>;
}
#left-column #categories > h4:after, #right-column #categories > h4:after {
	border-top: 10px solid <?php echo $theme_color[0]; ?>;	
}
#checkoutSuccess a:hover, #siteMapMainContent a:hover, .login-buttons > a:hover, blockquote .review-links a, .review-links a, .overlay a.expand, .alert > a:hover, #navBreadCrumb li:last-child a:hover {
	color: <?php echo $theme_color[0]; ?> !important;
}
.addtocart-info .cart_quantity span:hover, #indexCategories #subcategory_names li:hover, .cartQuantity .fff span:hover, .button:hover, input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover, .readmore:hover, button:hover, .billto-shipto .details:hover , .profile a:hover, #shoppingCartDefault .buttonRow:hover, .change_address:hover, .change_address > a:hover, #pageThree .buttonRow.back > a:hover, #pageFour .buttonRow.back > a:hover, #pageTwo .buttonRow.back > a:hover, #discountcouponInfo .content .buttonRow.forward > a:hover, .pagination-style .current, .pagination-style a:hover, .rectangle-list a:before, .rectangle-list a:hover:before, .header-container #nav > li.tab_active > a, .header-container #nav > li:hover > a, .header-container #nav > li > a:active, .header-container .nav > li > a:hover, .header-container .nav > li > a:focus, .header-container .header a.toggleMenu, .header-container .header a.toggleMenu:hover, .header-container #nav ul li ul a:hover, .header-container .header #nav li ul li:hover > a, .tooltip-inner, .search-bar-container .search-bar-form .form-search .input-text, #cssmenu.small-screen #menu-button, #left-column #categories > h4, #right-column #categories > h4 {
	background-color: <?php echo $theme_color[0]; ?>;
	transition: all 0.3s ease-in-out 0s;
		-moz-transition: all 0.3s ease-in-out 0s;
		-webkit-transition: all 0.3s ease-in-out 0s;
		-o-transition: all 0.3s ease-in-out 0s;
		-ms-transition: all 0.3s ease-in-out 0s;
}

#centercontent-wrapper header > h4:after, .productListing-odd:hover, .productListing-even:hover, .newproductlisting:hover {
    border-bottom: 1px dashed <?php echo $theme_color[0]; ?>;
}
#centercontent-wrapper header > h4:after {
	border-bottom: 1px solid <?php echo $theme_color[0]; ?>;
}
.tooltip.top .tooltip-arrow{
	border-top:5px solid <?php echo $theme_color[0]; ?>;
}
.tooltip.left .tooltip-arrow{
	border-left:5px solid <?php echo $theme_color[0]; ?>;
}
.tooltip.bottom .tooltip-arrow{
	border-bottom:5px solid <?php echo $theme_color[0]; ?>;
}
.tooltip.right .tooltip-arrow{
	border-right:5px solid <?php echo $theme_color[0]; ?>;
}
.cart-info .shopping_cart_link {
	border-top-color: <?php echo $theme_color[0]; ?>;
	border-right-color: transparent;
	border-bottom-color: <?php echo $theme_color[0]; ?>;
	border-left-color:<?php echo $theme_color[0]; ?>;
}
.cart-info .shopping_cart_icon {
    border-top-color: <?php echo $theme_color[0]; ?>;
	border-right-color: <?php echo $theme_color[0]; ?>;
	border-bottom-color: <?php echo $theme_color[0]; ?>;
	border-left-color: transparent;
}
.header-container .header .cart-info .shopping_cart_link:hover {
    border-color: <?php echo $theme_color[0]; ?>;
}
/*Sideboxes*/
#right-column #categories li:hover a, #left-column #categories li:hover a, #left-column #cartBoxListWrapper li:hover > a, #right-column #cartBoxListWrapper li:hover > a {
	border-left:2px solid <?php echo $theme_color[0]; ?>;
}
.rectangle-list a:hover:after{
	left: -.5em;
	border-left-color: <?php echo $theme_color[0]; ?>;				
}
#nav li > ul {
    border-top: 2px solid <?php echo $theme_color[0]; ?>;
}
/*Primary Color Ends*/

/*Secondary Color*/
body, a, a:active, a:visited, #checkoutSuccessOrderLink > a, #checkoutSuccessContactLink > a, #checkoutSuccess a.cssButton.button_logoff, #checkoutSuccess a, #checkoutSuccess a:active, #checkoutSuccess a:visited, .product_title h3, .accordian-header.active, #product_name a, #timeoutDefaultContent a, #reviewsWriteReviewer, .bold.user_reviewer, .reviews-list span.date, #loginForm .buttonRow.back.important > a, #logoffDefaultMainContent > a span.pseudolink, .buttonRow.back.important > a, .notfound_title, #createAcctDefaultLoginLink > a, #indexDefaultHeading, #siteMapMainContent a, #siteMapMainContent a:active, #siteMapMainContent a:visited, #unsubDefault a .pseudolink, #unsubDefault a .pseudolink:active, #unsubDefault a .pseudolink:visited, .products_more:active, .products_more:visited, .products_more, #centercontent-wrapper h1, span.title, .current-step, .checkout-steps, #productReviewLink > a, #indexCategories #subcategory_names li:first-child, #reviewsWriteProductPageLink > a, #reviewsWriteReviewPageLink > a, .review_content > p, #productReviewsDefaultProductPageLink > a, .gv_faq a, .gv_faq a:visited, .gv_faq a:active, .alert > a, .alert > a:active, .alert > a:visited, .reviews-list blockquote p a, .reviews-list blockquote p a:active, .reviews-list blockquote p a:visited, .reviews-list blockquote h4 a, .reviews-list blockquote h4 a:active, a.table_edit_button span.cssButton.small_edit, #accountDefault a, .allorder_text > a, .allorder_text > a:active, .allorder_text > a:visited, .buttonRow.product_price > a, .content_box .bold.user_reviewer > strong, .content_box .date.user_reviewdate > strong, #reviewsContent > a, #searchContent a, .accordian-header, .jsn-mainnav.navbar .nav > li > a, .box_heading_style h1 a, ul.tabs li a, .info-links a, .info-links a:active, .info-links a:visited, #siteMapList a, #siteMapList a:active, #siteMapList a:visited, #cartContentsDisplay a.table_edit_button, #cartContentsDisplay a.table_edit_button:active, #cartContentsDisplay a.table_edit_button:visited, .header-container .header a, .greeting, .item .product_image .hover_info a:active, .header-top, #right-column li a, #left-column li a, .sideBoxContentItem a, .product_sideboxname > a, #right-column li a:active, #left-column li a:active, .sideBoxContentItem a:active, .product_sideboxname > a:active, #right-column li a:visited, #left-column li a:visited, .sideBoxContentItem a:visited, .product_sideboxname > a:visited, .header-container #nav ul li ul a, .header-container .header #nav li ul a, #navBreadCrumb li, #navBreadCrumb li a, .product-name-desc .product_name > a, .product-name-desc .product_name > a:active, .product_name > a:visited, .productListing-data .product_name > a, .newproductlisting .product_name > a, #left-column .leftBoxContainer a, #right-column .rightBoxContainer a, #reviewsWrite .productprice-amount .normalprice, #reviewsInfoDefault .productprice-amount .normalprice, #reviewsDefault .productprice-amount .normalprice, .normalprice, .productSpecialPriceSale, ul.tabs li a, .remodal, .extra-links li a, .contact-us .fa, .contact-us li.aboutus_mail a, .mail > a, .footer-wrapper, #indexDefault > #horizontalTab li, .cart_contentbox a:link, .cart_contentbox a:active, .cart_contentbox a:visited, #cartBoxListWrapper, .info-right .product-title a {
	color: <?php echo $theme_color[1]; ?>;
}
#left-column h4, #right-column h4, .info-right .product-title a:after, .owl-theme .owl-controls .owl-page span {
	background: none repeat scroll 0 0 <?php echo $theme_color[1]; ?>;
}
input[type="text"],input[type="password"],input[type="email"],input[type="url"],textarea,select{
	color:<?php echo $theme_color[1]; ?>;
}
#left-column h4:after, #right-column h4:after {
	border-top: 10px solid <?php echo $theme_color[1]; ?>;	
}
.login-buttons > a, .current-step > a, .checkout-steps > a, .alert > a, #navBreadCrumb li:last-child a {
	color: <?php echo $theme_color[1]; ?> !important;
}
/* Custom Background*/
.custom-content-wrapper {
	background:url("<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/background/'.$custom_block_bg;?>") repeat fixed 0 0 rgba(0, 0, 0, 0);
}
.custom-services-wrapper {
    background: url("<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/background/'.$custom_services_block_bg;?>") no-repeat fixed 0 0 #000000;
}

.display-mode ul .grid, .display-mode ul .list, .copyright .top {
    border: 1px solid <?php echo $theme_color[0]; ?>;
    color: #0099cc;
}
.display-mode ul .grid, .display-mode ul .list:hover, .display-mode ul .grid:hover {
	background: none repeat scroll 0 0 <?php echo $theme_color[0]; ?>;
	color:#FFFFFF;
}
<?php if((isset($_GET['view'])) && ($_GET['view']=='rows')){ ?>
.display-mode ul .grid, .display-mode ul .list {
    border: 1px solid <?php echo $theme_color[0]; ?>;
    color: #0099cc;
	background:none;
}
.display-mode ul .list, .display-mode ul .list:hover, .display-mode ul .grid:hover {
	background: none repeat scroll 0 0 <?php echo $theme_color[0]; ?>;
	color:#FFFFFF;
}
<?php } ?>
/* Theme Color Ends*/
<?php if($this_is_home_page) {?>
	.main-breadcrumb{display:none}
	.main-top{padding:0}
<?php } ?>
</style>