<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_time_out_default.php 6620 2007-07-17 05:52:19Z drbyte $
 */
?>
<div class="centerColumn" id="timeoutDefault">
<?php
    if ($_SESSION['customer_id']) {
?>
	<header>
		<h4 id="timeoutDefaultHeading"><?php echo NAVBAR_TITLE; ?></h4>
	</header>
	<div class="content">
		<div id="timeoutDefaultContent">
			<?php echo HEADING_TITLE_LOGGED_IN; ?>
			<?php echo TEXT_INFORMATION_LOGGED_IN; ?>
		</div>
	</div>
<?php
  } else {
?>
    <header>
        <h4 id="timeoutDefaultHeading"><?php echo NAVBAR_TITLE; ?></h4>
    </header>
	<div id="timeoutDefaultContent" class="alert alert-danger alert-dismissable"><?php echo HEADING_TITLE; ?></div>
	<div id="timeoutDefaultContent" class="alert alert-info alert-dismissable"><?php echo TEXT_INFORMATION; ?></div>
	<?php echo zen_draw_form('login', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>

	<div class="content">
		<h4><?php echo HEADING_RETURNING_CUSTOMER; ?></h4>
		<div class="timeout_email">
			<label class="inputLabel" for="login-email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
			<?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="login-email-address"'); ?>
		</div>
		<br class="clearBoth" />
		<div class="timeout_password">
			<label class="inputLabel" for="login-password"><?php echo ENTRY_PASSWORD; ?></label>
			<?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password') . ' id="login-password"'); ?>
		</div>	
		<br class="clearBoth" />
		<?php echo zen_draw_hidden_field('securityToken', $_SESSION['securityToken']); ?>
    	<br class="clearBoth" />
		<div class="buttonRow forward timeoutbuttons">
			<?php echo zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT); ?>
        	<?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?>
        </div>
		<div class="buttonRow back important">
			
        </div>
	</div>
	</form>
<?php
 }
 ?>
</div>
