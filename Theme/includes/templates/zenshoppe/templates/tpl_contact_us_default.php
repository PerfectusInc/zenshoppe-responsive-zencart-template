<head><title>Contact Us</title></head>
<?php 
$zenshoppe_query = "SELECT * FROM " . DB_PREFIX.zenshoppe;
$zenshoppe_result = $db->Execute($zenshoppe_query);
$store_map = $zenshoppe_result->fields['store_map'];
$store_contact = $zenshoppe_result->fields['store_contact'];
$store_email = $zenshoppe_result->fields['store_email'];
$store_fax = $zenshoppe_result->fields['store_fax'];
$store_skype = $zenshoppe_result->fields['store_skype'];
?>
<span class="breadcrumb-title"><?php echo $var_pageDetails->fields['pages_title']; ?></span>
<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=contact_us.<br />
 * Displays contact us page form.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_contact_us_default.php 18695 2011-05-04 05:24:19Z drbyte $
 */
?>
<div class="centerColumn" id="contactUsDefault">
	<?php echo zen_draw_form('contact_us', zen_href_link(FILENAME_CONTACT_US, 'action=send')); ?>
    <header>
		<h4 id="contactus-heading"><?php echo HEADING_TITLE; ?></h4>
	</header>
    <?php
  		if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
	?>
		<div class="alert alert-success alert-dismissable"><?php echo TEXT_SUCCESS; ?></div>
	<?php
  		} 
	?>
    <?php if ($messageStack->size('contact') > 0) echo $messageStack->output('contact'); ?>
    <div class="contact-details">
        <div class="contact-info">
    		<div class="row">
				<?php if($store_map != NULL) { ?>
            	<div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                	<div class="contact-map">
                    	<?php echo $store_map; ?>
                    </div>
                </div>
                <?php
					}
				?>
                <div class="<?php if($store_map != NULL) { ?>col-lg-3 col-md-3 col-sm-6 col-xs-12 <?php } else { ?> col-lg-12 <?php } ?>">
                	<div class="store-details">
                    	<div class="store-address">
                        	<h4>Store Address</h4>
							<?php echo nl2br(STORE_NAME_ADDRESS); ?>
                        </div>
                        <div class="store-contact">
                        	<h4>Store Contact</h4>
                            <div class="store-contact-us">
                            	<span class="store-icon"><i class="fa fa-phone fa-lg"></i></span>
                            	<span class="store-value"><?php echo $store_contact; ?></span>
                        	</div>
                            <div class="store-contact-us">
                            	<span class="store-icon"><i class="fa fa-envelope fa-lg"></i></span>
                            	<span class="store-value"><?php echo $store_email; ?></span>
                        	</div>
                            <div class="store-contact-us">
                            	<span class="store-icon"><i class="fa fa-print fa-lg"></i></span>
                            	<span class="store-value"><?php echo $store_fax; ?></span>
                        	</div>
                            <div class="store-contact-us">
                            	<span class="store-icon"><i class="fa fa-skype fa-lg"></i></span>
                            	<span class="store-value"><?php echo $store_skype; ?></span>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   	</div>
	<div class="row">
    	<div class="static-content col-lg-3 col-md-3 col-sm-6 col-xs-12">
        	<div class="contact-sample-text">
			<?php if (DEFINE_CONTACT_US_STATUS >= '1' and DEFINE_CONTACT_US_STATUS <= '2') { ?>
				<?php
				/**
				 * require html_define for the contact_us page
				 */
				  require($define_page); 
				?>
          	<?php
			  }
			?>
            </div>
		</div>
    	<div class="store-contact-form col-lg-9 col-md-9 col-sm-6 col-xs-12">
			<?php
            // show dropdown if set
                if (CONTACT_US_LIST !=''){
            ?>
            <label class="inputLabel" for="send-to"><?php echo SEND_TO_TEXT; ?></label>
            <?php echo zen_draw_pull_down_menu('send_to',  $send_to_array, 0, 'id="send-to"') . '<span class="alert-text">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>
            <br class="clearBoth" />
            <?php
                }
            ?>
            <div class="row sender-name-email">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 sender-name">
                    <label><?php echo ENTRY_NAME . '<span class="alertrequired">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
                    <?php echo zen_draw_input_field('contactname', $name, ' size="40" id="contactname"') ; ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 sender-email" for="email-address">
                    <label><?php echo ENTRY_EMAIL . '<span class="alertrequired">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
                    <?php echo zen_draw_input_field('email', ($email_address), ' size="40" id="email-address"') ; ?>
                </div>
            </div>
        	<br class="clearBoth" />
            <div class="row message-detail">
                <div class="col-lg-12 contactus-message" for="enquiry">
                    <label><?php echo ENTRY_ENQUIRY . '<span class="alertrequired">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
                    <?php echo zen_draw_textarea_field('enquiry', '30', '7', $enquiry, ' id="enquiry"'); ?>
                </div>
            </div>
            <div class="row contactus-sendbutton">
                <div class="col-lg-12">
                    <div class="alert-text forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
                    <?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?>
                </div>
            </div>
		</div>
	</div>
</form>
</div>