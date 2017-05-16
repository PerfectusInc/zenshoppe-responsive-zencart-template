<?php
/**
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_footer.php 3183 2006-03-14 07:58:59Z birdbrain $
 */
require(DIR_WS_MODULES . zen_get_module_directory('footer.php'));
?>
<?php
if (!$flag_disable_footer) {
	$cat_slide = "select * from ".DB_PREFIX."manufacturers ORDER BY RAND()";
	$manufactureimage = $db->Execute($cat_slide);
	if ($this_is_home_page)
		{
			$show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_MAIN);
?>
<?php
	while(!$show_display_category->EOF) {
		if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MAIN_FEATURED_PRODUCTS') { 
?>

<!-- Index Featured Products Wrapper -->
<div class="custom-content-wrapper">
   	<div class="container">
	    <div class="featured-products">
           	<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<?php require($template->get_template_dir('tpl_modules_featured_products.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_products.php'); ?>
        		</div>
            </div>                   
       	</div>
	</div>
</div>
<!-- Index Featured Products Wrapper Ends -->
<?php
	} 
		$show_display_category->MoveNext();
	}
?>

<!-- Custom Bottom Banner Container -->
<div class="custom-banner-container">
   	<div class="container">
       	<div class="custom-banner-block">
           	<div class="row">
               	<div class="custom-banner">
                	<div class="custom-banner-image col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="custom-banner-image-top">
                            <div class="image">
                           		<img alt="content-banner" src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, 
									$current_page_base,'images').'/banners/'.$bottom_banner1; ?>" />
                               	<h3><?php echo $bottom_banner1_title; ?><br/>
                                   	<span class="banner_subtitle"><?php echo $bottom_banner1_subtitle; ?></span>
                                </h3>
                                <div class="overlay">
                                   	<a class="expand" href="<?php echo $bottom_banner1_link; ?>">+</a>
                            	</div>
                            </div>
                    	</div>
                 	</div>
                    <div class="custom-banner-image col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="custom-banner-image-top">
                           	<div class="image">
                   				<img alt="content-banner" src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, 
									$current_page_base,'images').'/banners/'.$bottom_banner2; ?>" />
                        		<h3><?php echo $bottom_banner2_title; ?><br/>
                                	<span class="banner_subtitle"><?php echo $bottom_banner2_subtitle; ?></span>
                                </h3>
                                <div class="overlay">
                                   	<a class="expand" href="<?php echo $bottom_banner2_link; ?>">+</a>
                                </div>
                            </div>
                      	</div>
                    </div>
            	</div>
           	</div>
      	</div>
  	</div>
</div>
<!-- Custom Bottom Banner Container Ends -->
<!-- Custom Content Wrapper -->
<div class="custom-services-wrapper">
   	<div class="container">
	    <div class="our-services">
           	<div class="row">
   		        <header>
        	        <?php echo $custom_block_heading; ?>
                </header>
                <div class="our-services-details">
                   	<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            	        <div class="custom-block free-shipping">
                           	<span class="block-image">
                               	<i class="<?php echo $custom_block1_icon; ?>"></i>
                            </span>
                            <span class="block-content">
                               	<span class="block-title">
                                   	<?php echo $custom_block1_title; ?>
                                </span>
                			</span>
                            <div class="overlay">
                            	<h4><?php echo $custom_block1_title; ?></h4>
                                	<?php $custom_block1_subtitle_short = ltrim(substr($custom_block1_subtitle, 0, 90) . '');?>
                            	<p class="service-details"><?php echo $custom_block1_subtitle_short; ?></p>
                                <a data-remodal-target="modal-1" data-original-title="View Details" data-toggle="tooltip">
                                	Know More
                                </a>
                            </div>
                            <div class="remodal" data-remodal-id="modal-1" data-remodal-options="hashTracking: false">
                                <h1><?php echo $custom_block1_title; ?></h1>
                                <p>
                                    <?php echo $custom_block1_subtitle; ?>
                                </p>
                                <br>
                                <a class="remodal-confirm" href="#">OK</a>
                            </div>
                     	</div>
                  	</div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    	<div class="custom-block secure-payment"> 
                        	<span class="block-image">
                            	<i class="<?php echo $custom_block2_icon; ?>"></i>
                            </span>
                            <span class="block-content">
                            	<span class="block-title">
                                	<?php echo $custom_block2_title; ?>
                                </span>
                            </span>
                            <div class="overlay">
                            	<h4><?php echo $custom_block2_title; ?></h4>
                                	<?php $custom_block2_subtitle_short = ltrim(substr($custom_block2_subtitle, 0, 90) . '');?>
                            	<p class="service-details"><?php echo $custom_block2_subtitle_short; ?></p>
                                <a data-remodal-target="modal-2" data-original-title="View Details" data-toggle="tooltip">
                                	Know More
                               	</a>
                            </div>
                            <div class="remodal" data-remodal-id="modal-2" data-remodal-options="hashTracking: false">
                                <h1><?php echo $custom_block2_title; ?></h1>
                                <p>
                                    <?php echo $custom_block2_subtitle; ?>
                                </p>
                                <br>
                                <a class="remodal-confirm" href="#">OK</a>
                            </div>
                        </div>
                   	</div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    	<div class="custom-block return-policy"> 
                        	<span class="block-image">
                            	<i class="<?php echo $custom_block3_icon; ?>"></i>
                            </span>
                            <span class="block-content">
                            	<span class="block-title">
                                	<?php echo $custom_block3_title; ?>
                                </span>
                          	</span>
                            <div class="overlay">
                            	<h4><?php echo $custom_block3_title; ?></h4>
                                	<?php $custom_block3_subtitle_short = ltrim(substr($custom_block3_subtitle, 0, 90) . '');?>
                            	<p class="service-details"><?php echo $custom_block3_subtitle_short; ?></p>
                                <a data-remodal-target="modal-3" data-original-title="View Details" data-toggle="tooltip">
                                	Know More
                                </a>
                            </div>
                            <div class="remodal" data-remodal-id="modal-3" data-remodal-options="hashTracking: false">
                                <h1><?php echo $custom_block3_title; ?></h1>
                                <p>
                                    <?php echo $custom_block3_subtitle; ?>
                                </p>
                                <br>
                                <a class="remodal-confirm" href="#">OK</a>
                            </div>
                     	</div>
                  	</div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    	<div class="custom-block orders"> 
                        	<span class="block-image">
                            	<i class="<?php echo $custom_block4_icon; ?>"></i>
                           	</span>
                            <span class="block-content">
                            	<span class="block-title">
                                	<?php echo $custom_block4_title; ?>
                                </span>
                          	</span>
                            <div class="overlay">
                            	<h4><?php echo $custom_block4_title; ?></h4>
                                	<?php $custom_block4_subtitle_short = ltrim(substr($custom_block4_subtitle, 0, 90) . '');?>
                            	<p class="service-details"><?php echo $custom_block4_subtitle_short; ?></p>
                                <a data-remodal-target="modal-4" data-original-title="View Details" data-toggle="tooltip">
                                	Know More
                               	</a>
                            </div>
                            <div class="remodal" data-remodal-id="modal-4" data-remodal-options="hashTracking: false">
                                <h1><?php echo $custom_block4_title; ?></h1>
                                <p>
                                    <?php echo $custom_block4_subtitle; ?>
                                </p>
                                <br>
                                <a class="remodal-confirm" href="#">OK</a>
                            </div>
                      	</div>
                 	</div>
				</div>
        	</div>                   
       	</div>
	</div>
</div>
<!-- Custom Content Wrapper Ends -->
<!-- Brands Slider Wrapper -->
<div class="brands-wrapper">
	<div class="container">
    	<div class="brands-slider">
           	<div class="row">
               	<div class="col-lg-12">
       		        <header>
            	        <h2>Our Partners</h2>
                	</header>
					<div class="row">
                        <div class="brands owl-carousel owl-theme">
                            <?php 
                                while (!$manufactureimage->EOF) {
                                //print_r($manufactureimage);
                                    $manufacturers_image = $manufactureimage->fields['manufacturers_image'];
                                    $manufacturers_id = $manufactureimage->fields['manufacturers_id'];
                            ?>
                            <div class="item">
                                <img src="images/<?php echo $manufacturers_image;?>" alt="" width="<?php echo SMALL_IMAGE_WIDTH; 	
                                    ?>" />
                            </div>
                            <?php $manufactureimage->MoveNext();
                            } ?>
                        </div>
            		</div>
                </div>
           	</div>
       	</div>
	</div>
</div>
<!-- Brands Slider Wrapper Ends -->
<?php } ?>
<!-- Footer Wrapper -->
<div class="footer-wrapper">
	<!-- Footer Top Wrapper -->
    <div class="footer-top-wrapper">
        <div class="container"> 
        	<div class="footer-top">
            	<div class="custom-newsletter-block">
					<div class="row">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        	<div class="social-title-wrapper">
                            	<header>
                            		<h2 class="social-title">Follow Us</h2>
                            		<h4>Stay Connected with Us</h4>
                                </header>
                            </div>
                        </div>
                  	</div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        	<div class="social-wrapper">
                            	<ul class="social_bookmarks">                                
                                	<?php if($facebook_link != NULL) {?>
                                    <li class="facebook" data-original-title="Facebook" data-toggle="tooltip">
                                    	<a href="http://www.facebook.com/<?php echo $facebook_link;?>" target="_blank">
                                            <i class="fa fa-facebook fa-lg"></i>
                                        </a>
                                  	</li>
                                    <?php } ?>
                                    <?php if($twitter_link != NULL) {?>
                                    <li class="twitter" data-original-title="Twitter" data-toggle="tooltip">
                                    	<a href="http://www.twitter.com/<?php echo $twitter_link;?>" target="_blank">
                                            <i class="fa fa-twitter fa-lg"></i>
                                      	</a>
                                  	</li>
                                    <?php } ?>                     
                                    <?php if($pinterest_link != NULL) {?>
                                    <li class="pinterest" data-original-title="Pinterest" data-toggle="tooltip">
                                    	<a href="http://pinterest.com/<?php echo $pinterest_link;?>" target="_blank">
                                            <i class="fa fa-pinterest fa-lg"></i>
                                      	</a>
                                  	</li>
                                    <?php } ?>
                                    <?php if($google_link != NULL) {?>
                                    <li class="google_plus" data-original-title="Google Plus" data-toggle="tooltip">
                                    	<a href="<?php echo $google_link; ?>" target="_blank">
                                            <i class="fa fa-google-plus fa-lg"></i>
                                       	</a>
                                   	</li>
                                    <?php } ?>
                                    <?php if($tumblr_link != NULL) {?>
                                    <li class="tumblr" data-original-title="Tumblr" data-toggle="tooltip">
                                    	<a href="<?php echo $tumblr_link; ?>" target="_blank">
                                            <i class="fa fa-tumblr fa-lg"></i>
                                      	</a>
                                  	</li>
                                    <?php } ?>
                                    <?php if($linkedin_link != NULL) {?>
                                    <li class="linkedin" data-original-title="LinkedIn" data-toggle="tooltip">
                                    	<a href="<?php echo $linkedin_link; ?>" target="_blank">
                                          	<i class="fa fa-linkedin fa-lg"></i>
                                       	</a>
                                  	</li>
                                    <?php } ?>
                                    <?php if($youtube_link != NULL) {?>
                                    <li class="youtube" data-original-title="Youtube" data-toggle="tooltip">
                                    	<a href="<?php echo $youtube_link; ?>" target="_blank">
                                            <i class="fa fa-youtube fa-lg"></i>
                                       	</a>
                                   	</li>
                                    <?php } ?>
                                </ul>
                            </div>
                       	</div>
                   	</div>
            	</div>
       		</div>
    	</div>
   	</div>
    <!-- Footer Top Wrapper Ends -->
	<div class="footer-bottom">
    	<div class="container">
        	<div class="row">
            	<div class="footer-container">
                    <!-- Extra Details Link Column -->
                    <div class="extra-details col-lg-4 col-md-4 col-sm-4 col-xs-12">
                       	<header>
                           	<h2>Information</h2>
                        </header>
                        <ul class="extra-links">
                        <?php if (DEFINE_SHIPPINGINFO_STATUS <= 1) { ?>
                    	    <li>
                        	    <a href="<?php echo zen_href_link(FILENAME_SHIPPING."&pg=information"); ?>">
                            	    <?php echo HEADER_TITLE_SHIPPING_INFO; ?>
                                </a>
                        	</li>
                        <?php } ?>
                        <?php if (DEFINE_PRIVACY_STATUS <= 1)  { ?>
                        	<li>
                            	<a href="<?php echo zen_href_link(FILENAME_PRIVACY."&pg=information"); ?>">
                                    <?php echo HEADER_TITLE_PRIVACY_POLICY; ?>
                                </a>
                           	</li>
                       	<?php } ?>
                        <?php if (DEFINE_CONDITIONS_STATUS <= 1) { ?>
                        	<li>
                            	<a href="<?php echo zen_href_link(FILENAME_CONDITIONS."&pg=information"); ?>">
                                    <?php echo HEADER_TITLE_CONDITIONS_OF_USE; ?>
                                </a>
                          	</li>
                       	<?php } ?>
                        <?php if (DEFINE_SITE_MAP_STATUS <= 1) { ?>
                        	<li>
                            	<a href="<?php echo zen_href_link(FILENAME_SITE_MAP."&pg=information"); ?>">
                                    <?php echo HEADER_TITLE_SITE_MAP; ?>
                                </a>
                        	</li>
                      	<?php } ?>
                        <?php if (MODULE_ORDER_TOTAL_GV_STATUS == 'true') { ?>
                        	<li>
                            	<a href="<?php echo zen_href_link(FILENAME_GV_FAQ."&pg=information", '', 'NONSSL'); ?>">
                                    <?php echo HEADER_TITLE_GV_FAQ; ?>
                              	</a>
                          	</li>
                        <?php } ?>
                  	</ul>
               	</div>
                    <!-- Extra Details Link Column Ends -->
                    <!-- My Account Column -->
                    <div class="account col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <header>
                            <h2>Account</h2>
                        </header>
                        <ul class="extra-links">
                            <li>
                                <a href="<?php echo zen_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'); ?>">
                                    Order History
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'); ?>">
                                    Address Book
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>">
                                    <?php echo HEADER_TITLE_MY_ACCOUNT; ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo zen_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'); ?>">
                                    Change Password
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>">                                    Create Account
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- My Account Column Ends -->
                    <!-- Contact Us Column -->
                    <div class="contact-us col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <header>
                            <h2>Contact Us</h2>
                        </header>
                        <ul>
                        	<li>
                            	<i class="fa fa-map-marker fa-lg"></i>
                                <?php echo $store_address; ?>
                            </li>
                            <?php if($store_contact != NULL) {?>
                            <li class="aboutus_phone">
                                <i class="fa fa-phone fa-lg"></i>
                                <span class="contact-title">Call Us : </span><?php echo $store_contact; ?>
                            </li>
                            <?php } ?>
                            <?php if($store_email != NULL) {?>
                            <li class="aboutus_mail">
                                <i class="fa fa-envelope fa-lg"></i> 
                                <span class="contact-title">Email Us : </span><a href="mailto:<?php echo $store_email; ?>">
									<?php echo $store_email; ?></a>
                            </li>
                            <?php } ?>
                            <?php if($store_fax != NULL) {?>
                            <li class="aboutus_fax">
                                <i class="fa fa-print fa-lg"></i> 
                                <span class="contact-title">Fax : </span><?php echo $store_fax; ?>
                            </li>
                            <?php } ?>    
                            <?php if($store_fax != NULL) {?>
                            <li class="aboutus_skype">
                                <i class="fa fa-skype fa-lg"></i> 
                                <span class="contact-title">Skype : </span><?php echo $store_skype; ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- Contact Us Column ends -->
                </div>
            </div>
        </div>        
    </div>
    <!--Copyright Row -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <?php if($store_copyright != NULL) { ?>
                <div class="copyright-wrapper col-lg-8 col-md-8 col-sm-8 pull-left">
                    <div class="copyright-text">
                        <p>&copy; <?php echo $store_copyright; ?></p>
                    </div>
                </div>
                <?php } ?>
                <div class="payment-wrapper col-lg-4 col-md-4 col-sm-4 pull-right">
                	<div class="payment">
                		<div class="payment-image">
                			<a href="#">
                				<img alt="<?php if($payment_image!=NULL){ echo "payment-image"; } ?>" src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/banners/'.$payment_image;?>" />
                			</a>
                		</div>
                	</div>
                </div>
                <a id="w2b-StoTop" class="top" style="display: block;"><i class="fa fa-angle-double-up fa-2x"></i></a>
            </div>
        </div>
    </div>
    <!--CopyRight Row Ends -->
</div>
<!-- Footer Wrapper Ends -->
<?php
} // flag_disable_footer
?>

<!-- Left Boxes -->
<?php if($newsletter_details != NULL) { ?>
<!-- Newsletter Box -->
<div class="custom-newsletter-left hidden-xs hidden-sm hidden-md">
	<div class="newsletter-icon"><i class="fa fa-envelope fa-lg"></i></div>
    <div class="newsletter-details">
    	<header>
        	<h2>Newsletter</h2>
        </header>
	    <!-- Begin MailChimp Signup Form -->
    	<?php echo $newsletter_details; ?>
    	<!--End mc_embed_signup-->
    </div>
</div>
<!-- Newsletter Box Ends -->
<?php } ?>

<?php if($aboutus_text != NULL) { ?>
<!-- About Box -->
<div class="about-us-left hidden-xs hidden-sm hidden-md">
	<div class="about-us-icon"><i class="fa fa-info fa-lg"></i></div>
    <div class="about-us-details">
    	<header>
        	<h2>About Us</h2>
        </header>
        <div id="about-us-text"><?php echo $aboutus_text; ?></div>
    </div>
</div>
<!-- About Box Ends -->
<?php } ?>
<!-- Left Boxes Ends -->

<!-- Right Boxes -->
<?php if($facebook_box != NULL) { ?>
<!-- Facebook Like Box -->
<div class="facebook_right hidden-xs hidden-sm hidden-md">
	<div class="facebook-icon"><i class="fa fa-facebook fa-lg"></i></div>
    <div class="facebook-content">
    	<div class="fb-like-box" data-href="https://www.facebook.com/<?php echo $facebook_box; ?>" data-width="280" data-height="380" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true">
        </div>
    </div>
</div>
<!-- Facebook Like Box Ends -->
<?php } ?>
<?php if($twitter_box != NULL) { ?>
<!-- Twitter Box -->
<div class="twitter_right hidden-xs hidden-sm hidden-md">
	<div class="twitter-icon"><i class="fa fa-twitter fa-lg"></i></div>
	<div class="twitter-content">
        <?php echo $twitter_box; ?>
	</div>
</div>
<!-- Twitter Box Ends -->
<?php } ?>
<!-- Right Boxes Ends -->

<!-- Zenshoppe JS Files -->
<!-- Google Jquery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Google Jquery Ends -->
<?php if ($this_is_home_page) { ?>
	<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/jquery.easing.1.3.js'?>" type="text/javascript"></script>
    <script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/jquery.remodal.js'?>" type="text/javascript"></script>
	<script type="text/javascript">
    	$(document).on('open', '.remodal', function () {
        console.log('open');
		});
	
		$(document).on('opened', '.remodal', function () {
			console.log('opened');
		});
	
		$(document).on('close', '.remodal', function () {
			console.log('close');
		});
	
		$(document).on('closed', '.remodal', function () {
			console.log('closed');
		});
	
		$(document).on('confirm', '.remodal', function () {
			console.log('confirm');
		});
	
		$(document).on('cancel', '.remodal', function () {
			console.log('cancel');
		});
	
	//    You can open or close it like this:
	//    $(function () {
	//        var inst = $.remodal.lookup[$('[data-remodal-id=modal]').data('remodal')];
	//        inst.open();
	//        inst.close();
	//    });
	
		//  Or init in this way:
		var inst = $('[data-remodal-id=modal2]').remodal();
		//  inst.open();
    </script>
<?php }	?> 
<!-- Menu Maker JS -->
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/menumaker.js'?>" type="text/javascript"></script>
<!-- Menu Maker JS Ends -->
<!-- Select Dropdown JS -->
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/select2.js'?>" type="text/javascript"></script>

<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/easyResponsiveTabs.js'?>" type="text/javascript"></script>

<!-- Select Dropdown JS Ends -->
<!-- Light Box Zoom for Homepage -->
<script src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/lightbox.min.js'?>" type="text/javascript"></script>
<!-- Light Box Zoom for Homepage -->
<!-- Bootstrap JS -->
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/bootstrap.js'?>" type="text/javascript"></script>
<!-- Bootstrap JS Ends -->
<!-- Browser Selector JS -->
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/css_browser_selector.js'?>" type="text/javascript"></script>
<!-- Browser Selector JS Ends -->
<!-- Zenshoppe Custom JS -->
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/zenshoppe_custom.js'?>" type="text/javascript"></script>
<!-- Zenshoppe Custom JS Ends -->
<!-- Tab JS -->
<script src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/tabcontent.js'?>" type="text/javascript"></script>
<!-- Tab JS Ends -->
<!--Owl Slider-->
<script src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/owl.carousel.js'?>" type="text/javascript"></script>
<!--Owl Slider Ends-->
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/modernizr.js'?>" type="text/javascript"></script>
<!-- JQuery Lightbox JS and Cloud Zoom JS-->  
<?php if (in_array($current_page_base,explode(",",'product_info,product_reviews_info,product_reviews,product_reviews_write'))) { ?>
<script src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/jscript_jquery_1-4-4.js'?>" type="text/javascript"></script>
<script src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'jscript').'/cloud-zoom.1.0.3.js'?>" type="text/javascript"></script>
<script type="text/javascript">
//Cloud Zoom
var cld = jQuery.noConflict();
cld('#zoom01, .cloud-zoom-gallery').CloudZoom();
</script>
<?php } ?>
<!-- JQuery Lightbox JS and Cloud Zoom JS Ends--> 