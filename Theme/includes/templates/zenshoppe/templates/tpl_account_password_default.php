<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_password.<br />
 * Allows customer to change their password
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_password_default.php 2896 2006-01-26 19:10:56Z birdbrain $
 */
?>
<div class="centerColumn" id="accountPassword">
	<?php echo zen_draw_form('account_password', zen_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'), 'post', 'onsubmit="return check_form(account_password);"') . zen_draw_hidden_field('action', 'process'); ?>
    <header>
        <h4><?php echo HEADING_TITLE; ?></h4>
    </header>
	<div class="content">
		<div class="alert-text forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div> 
		<?php if ($messageStack->size('account_password') > 0) echo $messageStack->output('account_password'); ?>
			<label class="inputLabel" for="password-current">
				<?php echo ENTRY_PASSWORD_CURRENT; ?>
				<?php echo zen_not_null(ENTRY_PASSWORD_CURRENT_TEXT) ? '<span class="alert-text">' . ENTRY_PASSWORD_CURRENT_TEXT . '</span>': ''; ?>
            </label>
			<?php echo zen_draw_password_field('password_current','','id="password-current"'); ?>
			<br class="clearBoth" />
			<label class="inputLabel" for="password-new">
				<?php echo ENTRY_PASSWORD_NEW; ?>
				<?php echo zen_not_null(ENTRY_PASSWORD_NEW_TEXT) ? '<span class="alert-text">' . ENTRY_PASSWORD_NEW_TEXT . '</span>': ''; ?>
            </label>
			<?php echo zen_draw_password_field('password_new','','id="password-new"'); ?>
            <br class="clearBoth" />
			<label class="inputLabel" for="password-confirm">
				<?php echo ENTRY_PASSWORD_CONFIRMATION; ?>
				<?php echo zen_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="alert-text">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''; ?>
            </label>
			<?php echo zen_draw_password_field('password_confirmation','','id="password-confirm"'); ?>
	</div>
	<div class="next-prev">
		<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?></div>
 		<div class="buttonRow back change_address">
			<?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
        </div>
	</div>
</form>
</div>
