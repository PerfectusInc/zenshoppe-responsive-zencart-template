<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_shipping_adresss.<br />
 * Allows customer to change the shipping address.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_shipping_address_default.php 4852 2006-10-28 06:47:45Z drbyte $
 */
?>
<div class="centerColumn" id="checkoutShipAddressDefault">

	<?php echo zen_draw_form('checkout_address', zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL'), 'post', 'onsubmit="return check_form_optional(checkout_address);"'); ?>
    <header>
        <h4 id="checkoutShipAddressDefaultHeading"><?php echo HEADING_TITLE; ?></h4>
    </header>
	<?php if ($messageStack->size('checkout_address') > 0) echo $messageStack->output('checkout_address'); ?>
	<?php
  		if ($process == false || $error == true) {
	?>
	<div class="content">
        <h4><?php echo TITLE_SHIPPING_ADDRESS; ?></h4>
        <div class="row checkout-ship-address">
        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 current-address">
            	<address class="back"><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['sendto'], true, ' ', '<br />'); ?></address>
        	</div>
    		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 current-address-text">
    			<div class="alert alert-info"><?php if ($addresses_count < MAX_ADDRESS_BOOK_ENTRIES) echo TEXT_CREATE_NEW_SHIPPING_ADDRESS; ?></div>
    		</div>
		</div>
    </div>
	<?php
         if ($addresses_count < MAX_ADDRESS_BOOK_ENTRIES) {
    ?>
    <?php
    /**
     * require template to display new address form
     */
      require($template->get_template_dir('tpl_modules_checkout_new_address.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_checkout_new_address.php');
    ?>
	<?php
        }
        if ($addresses_count > 1) {
    ?>
	<div class="content">
		<h4><?php echo TABLE_HEADING_ADDRESS_BOOK_ENTRIES; ?></h4>
			<?php
                  require($template->get_template_dir('tpl_modules_checkout_address_book.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_checkout_address_book.php');
            ?>
	</div>
	<?php
         }
      }
    ?>
    <div class="row checkout-shipping-button">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7">
            <div class="buttonRow back">
                <?php echo TITLE_CONTINUE_CHECKOUT_PROCEDURE . ' ' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?>
            </div>
            <?php
			  if ($process == true) {
			?>
			<div class="buttonRow back">
				<?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
			</div>
			<?php
			  }
			?>
		</div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5">
            <div class="buttonRow forward">
                <?php echo zen_draw_hidden_field('action', 'submit') . zen_image_submit(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT); ?>
            </div>
        </div>
	</div>
</form>
</div>