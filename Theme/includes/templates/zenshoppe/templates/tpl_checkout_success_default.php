<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_success.<br />
 * Displays confirmation details after order has been successfully processed.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_success_default.php 16435 2010-05-28 09:34:32Z drbyte $
 */
?>
<div class="centerColumn" id="checkoutSuccess">
	<header>
    	<h4 id="checkoutSuccessHeading"><?php echo HEADING_TITLE; ?></h4>
    </header>
    <div class="alert alert-success alert-dismissable">
    	<?php echo TEXT_THANKS_FOR_SHOPPING; ?>
		<div id="checkoutSuccessOrderNumber"><?php echo TEXT_YOUR_ORDER_NUMBER . $zv_orders_id; ?></div>
    </div>
    <!--bof logoff-->
    <div class="alert alert-info alert-dismissable">
		<?php
			if (isset($_SESSION['customer_guest_id'])) {
				echo TEXT_CHECKOUT_LOGOFF_GUEST;
			} elseif (isset($_SESSION['customer_id'])) {
				echo TEXT_CHECKOUT_LOGOFF_CUSTOMER;
			}
		?>
        <div class="buttonRow forward">
        	<a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo zen_image_button(BUTTON_IMAGE_LOG_OFF , BUTTON_LOG_OFF_ALT); ?>
            </a>
        </div>
	</div>
    <div class="alert alert-info alert-dismissable">
    	<?php echo TEXT_SEE_ORDERS .'<br/>'. TEXT_CONTACT_STORE_OWNER;?>
	</div>
    <!--bof -gift certificate- send or spend box-->
	<?php
    // only show when there is a GV balance
      if ($customer_has_gv_balance ) {
    ?>
	<div id="sendSpendWrapper">
		<?php require($template->get_template_dir('tpl_modules_send_or_spend.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_send_or_spend.php'); ?>
	</div>
	<?php
      }
    ?>
	<!--eof -gift certificate- send or spend box-->
	<!--eof logoff-->
	<div class="content">
		<?php if (DEFINE_CHECKOUT_SUCCESS_STATUS >= 1 and DEFINE_CHECKOUT_SUCCESS_STATUS <= 2) { ?>
			<div id="checkoutSuccessMainContent">
				<?php
				/**
				 * require the html_defined text for checkout success
				 */
				  require($define_page);
				?>
			</div>
		<?php } ?>
		<!-- bof payment-method-alerts -->
		<?php
        	if (isset($_SESSION['payment_method_messages']) && $_SESSION['payment_method_messages'] != '') {
        ?>
            <div>
                <?php echo $_SESSION['payment_method_messages']; ?>
            </div>
		<?php
        }
        ?>
        <!-- eof payment-method-alerts -->
	</div>
		<?php
        /**
         * The following creates a list of checkboxes for the customer to select if they wish to be included in product-notification
         * announcements related to products they've just purchased.
         **/
            if ($flag_show_products_notification == true) {
        ?>
	<div class="content">
		<div id="csNotifications">
			<h4><?php echo TEXT_NOTIFY_PRODUCTS; ?></h4>
			<?php echo zen_draw_form('order', zen_href_link(FILENAME_CHECKOUT_SUCCESS, 'action=update', 'SSL')); ?>
			<?php foreach ($notificationsArray as $notifications) { ?>
            	<?php echo zen_draw_checkbox_field('notify[]', $notifications['products_id'], true, 'id="notify-' . $notifications['counter'] . '"') ;?>
            	<label class="checkboxLabel" for="<?php echo 'notify-' . $notifications['counter']; ?>">
					<?php echo $notifications['products_name']; ?>
                </label>
            	<br />
            <?php } ?>
            <div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_UPDATE, BUTTON_UPDATE_ALT); ?></div>
            </form>
		</div>
	</div>
            <?php
                }
            ?>
	<!--eof -product notifications box-->
	<!--bof -product downloads module-->
	<?php
      if (DOWNLOAD_ENABLED == 'true') require($template->get_template_dir('tpl_modules_downloads.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_downloads.php');
    ?>
    <!--eof -product downloads module-->
</div>
