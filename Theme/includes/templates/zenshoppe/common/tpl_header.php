<?php
/**
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 @version $Id: tpl_header.php 3392 2006-04-08 15:17:37Z birdbrain $
 */
?>


<?php
	// Display all header alerts via messageStack:
  	if ($messageStack->size('header') > 0) {
    	echo $messageStack->output('header');
  	}
  	if (isset($_GET['error_message']) && zen_not_null($_GET['error_message'])) {
  		echo htmlspecialchars(urldecode($_GET['error_message']));
  	}
  	if (isset($_GET['info_message']) && zen_not_null($_GET['info_message'])) {
   		echo htmlspecialchars($_GET['info_message']);
	} else {
	}
?>
<?php
// Define some constants
$email_add = STORE_OWNER_EMAIL_ADDRESS;
$store_name = STORE_OWNER;
define( "RECIPIENT_NAME", $store_name );
define( "RECIPIENT_EMAIL", $email_add );
define( "EMAIL_SUBJECT", "Visitor Message" );
//echo RECIPIENT_EMAIL;

// Read the form values
$success = false;
$senderName = isset( $_POST['senderName'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['senderName'] ) : "";
$senderEmail = isset( $_POST['senderEmail'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['senderEmail'] ) : "";
$message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";

// If all values exist, send the email
if ( $senderName && $senderEmail && $message ) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $senderName . " <" . $senderEmail . ">";
  $success = mail( $recipient, EMAIL_SUBJECT, $message, $headers );
}
// Return an appropriate response to the browser
?>
<!--bof-header logo and navigation display-->
<?php
if (!isset($flag_disable_header) || !$flag_disable_header) {
?>
<!-- Header Container -->
<header class="header-container">
    <div class="header">
       	<div class="header-top">
           	<div class="container">
               	<div class="row">
                	<div class="right-top">
                    	<div class="col-lg-6 col-sm-6">
                           	<div class="greeting_msg">
								<?php if (SHOW_CUSTOMER_GREETING == 1) { 
                        	        if (isset($_SESSION['customer_id']) && $_SESSION['customer_first_name']) {
                            	?>
                                <span class="greeting"><?php echo "Welcome " .$_SESSION['customer_first_name'] . ' ' .
                                	$_SESSION['customer_last_name'].'&nbsp;<a class="logout" href="'.zen_href_link(FILENAME_LOGOFF, '', 'SSL').'">(Logout)</a>'; ?>
                              	</span>
                                <?php } else { ?>
                                <span class="greeting">
                                	<?php echo 'Welcome visitor you can <a class="login" href="'.zen_href_link(FILENAME_LOGIN, '', 'SSL').'">Login</a> or <a class="createaccount" href="'.zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL').'">Create an Account</a>'; ?>
                              	</span>
                                	<?php } 
                              	}?>
                          	</div>
                       	</div>
                        <div class="col-lg-6 col-sm-6">
                           	<div class="block-header top-links">
                        		<div class="btn-group">
                                	<button class="btn dropdown-toggle btn-setting" data-toggle="dropdown" type="button">
                                    	<i class="fa fa-group"></i>
                                        <span class="text-label">Account</span>
                                        <span class="fa fa-angle-down"></span>
                                  	</button>
                                    <div class="quick-setting dropdown-menu">
                                    	<ul class="links">
                                        	<li class="first">
                                            	<a class='my_account' href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>">
                                                	<i class="fa fa-user"></i><?php echo HEADER_TITLE_MY_ACCOUNT; ?>
                                              	</a>
                                          	</li>
                                            <?php 
                                            	if (STORE_STATUS == '0') 
                                                	{
                                                    if ($_SESSION['cart']->count_contents() != 0) {
                                           	?>
                                            <li>
                                            	<a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="checkout">
                                                	<i class="fa fa-suitcase"></i><?php echo HEADER_TITLE_CHECKOUT; ?>
                                           		</a>
                                         	</li>
                                            <?php } else { ?>
                                            <li>
                                            	<a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG ?>index.php?main_page=shopping_cart">
                                                	<i class="fa fa-suitcase"></i><?php echo HEADER_TITLE_CHECKOUT; ?>
                                               	</a>
                                          	</li>
                                            	<?php }
                                           	} ?>
                                            <li>
                                            	<a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG ?>index.php?main_page=shopping_cart">
                                                	<i class="fa fa-shopping-cart"></i><?php echo 'Shopping Cart'; ?>
                                              	</a>
                                           	</li>
                                           	<li>
                                                <a href="<?php echo zen_href_link(compare, '', 'SSL'); ?>">
                                                    <i class="fa fa-files-o"></i><?php echo HEADER_TITLE_COMPARE; ?>
                                                </a>
                            				</li>
                            				<li>
                                                <a href="<?php echo zen_href_link(wishlist, '', 'SSL'); ?>">
                                                    <i class="fa fa-heart-o"></i><?php echo HEADER_TITLE_WISHLIST; ?>
                                                </a>
                            				</li>

                                       	</ul>
                                   	</div>	
                              	</div>
                         	</div>
                            <div class="block-header">
                            	<div class="btn-group">
                                	<button class="btn dropdown-toggle btn-setting" data-toggle="dropdown" type="button">
                                    	<i class="fa fa-cog"></i>
                                        <span class="text-label">Setting</span>
                                        <span class="fa fa-angle-down"></span>
                                    </button>
                                    <div class="quick-setting dropdown-menu">
                                    	<!-- Language Container -->
                                        <div class="language-switcher">
                                           	<label>Language : </label>
                                            <?php include(DIR_WS_MODULES . zen_get_module_directory('header_languages.php')); ?>
                                        </div>
                                        <!-- Language Container ends -->
                                        <!-- Currency Container -->
                                        <div class="currency_top">
                                        	<label>Currency : </label>
                                            <?php include(DIR_WS_MODULES . zen_get_module_directory('header_currencies.php')); ?>
                                       	</div>
                                        <!-- Currency Container Ends -->
                                 	</div>
                               	</div>
                           	</div>
                      	</div>
                  	</div>
              	</div>
      		</div>
      	</div>
        <div class="header-bottom">
        	<div class="container">
                <div class="row">
                	<div class="logo-container col-lg-6 col-xs-8">
                    	<!-- Logo Container -->
                       	<div class="logo">
                           	<a href="index.php?main_page=index">
                       			<img alt="<?php if($logo_image!=NULL){ echo "logo"; } ?>" src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/logo/'.$logo_image;?>" />
                       		</a>
                        </div>
                        <!-- Logo Container -->
                    </div>
                    <div class="top-contact-container col-lg-6 col-xs-4 pull-right">
                    	<!-- BOF ZX AJAX Add to Cart -->
						<?php
                            // BOF AJAX Cart 
                                if (ZX_AJAX_CART_STATUS == 'true') {
                                    echo '<div id="carttopcontainer"></div>';
                                    require(DIR_WS_MODULES. 'sideboxes/'.$template_dir. '/zx_ajax_shopping_cart.php');
                                } 
                            // EOF AJAX Cart
                        ?>
                        <!-- EOF ZX AJAX Add to Cart -->
                    	<div class="top-contact-number">
                        	<span class="contact-icon" onclick="toggleNumber()">
                            	<i class="fa fa-phone fa-lg"></i>
                            </span>
                        </div>
                        <div class="top-contact-email">
                        	<span class="contact-icon" onclick="toggleEmail()">
                            	<i class="fa fa-envelope-o fa-lg"></i>
                            </span>
                        </div>
                    </div>
             	</div>
           	</div>
       	</div>
        <!-- Main Menu -->
        <div class="nav-maincontainer">
            <div class="container">
                <div class="row">
                    <div class="nav-container col-lg-11 col-xs-9">
                        <div id="cssmenu">
                            <?php require($template->get_template_dir
                            ('tpl_drop_menu.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_drop_menu.php');?>
                    	</div>
                    </div>
                    <div class="col-lg-1 navbar-right col-xs-3">
                        <ul class="search-bar-icon">
                            <li>
                                <a class="search-icon" onclick="toggleSearch()">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>
                        </ul>
                     </div>
                </div>
            </div>
        </div>
    	<!--Main Menu ends -->
        <div class="search-bar-container" style="display:none">
            <div class="container">
                <div class="row">
                    <div class="search-bar-form col-lg-12">
                        <!--Search Bar-->
                         <?php
                             $text = str_replace("ENTER SEARCH KEYWORDS HERE", "Search entire store here..", "ENTER SEARCH KEYWORDS HERE");
                             $content = "";
                             $content .= zen_draw_form('quick_find_header', zen_href_link
                                        (FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get');
                             $content .= zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT);
                             $content .= zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id();
                             $content .= '<div class="form-search">' . 
                               zen_draw_input_field('keyword', '', 'class="input-text" maxlength="30" value="'.$text.'" onfocus="if(this.value == \''.$text.'\') this.value = \'\';" onblur="if (this.value == \'\') this.value = \'' . $text . '\';"') . '<button class="button" title="Search" type="submit"><span><i class="fa fa-search"></i></span></button></div>';
                             $content .= "</form>";
                             echo($content);
                        ?>
                        <!--Search Bar Ends-->
                        <a class="close-icon" onclick="closeSearch()"><i class="fa fa-times fa-2x"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-number-container" style="display:none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                    	<div class="contact-number-details">
                        	<span class="contact-label">
                            	<i class="fa fa-hand-o-right"></i> Call Us Toll-Free 24 * 7 :
                            </span>
                            <span class="contact-number">
                            	<?php echo $store_contact; ?>
                            </span>
							<a class="close-icon" onclick="closeNumber()"><i class="fa fa-times fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-email-container" style="display:none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                    	<div class="contact-email-details">
                        	<span class="contact-label">
                            	<i class="fa fa-hand-o-right"></i> Drop Us an Email :
                            </span>
                            <span class="contact-number">
                            	<?php echo $store_email; ?>
                            </span>
							<a class="close-icon" onclick="closeEmail()"><i class="fa fa-times fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>    
</header><!-- header-container End-->
<?php if (!$this_is_home_page) { ?>
	<div id="headerpic">
		<?php
        	if (SHOW_BANNERS_GROUP_SET3 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET3)) {
            	if ($banner->RecordCount() > 0) {
        ?>
		<div id="bannerThree" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
		<?php
            }
          }
        ?>
	</div>
		<?php } ?>
    <?php } ?>