<div id="wishlist"> <!-- begin wishlist id for styling -->

<h1><?php echo HEADING_TITLE; ?></h1>

<p><?php echo TEXT_DESCRIPTION; ?></p>

<?php if ($messageStack->size('wishlist_email') > 0) { 
	echo $messageStack->output('wishlist_email'); 
} ?>

<p class="inputrequirement"><?php echo FORM_REQUIRED_INFORMATION; ?></p>

<?php echo zen_draw_form('wishlist_email', zen_href_link(UN_FILENAME_WISHLIST_EMAIL, 'action=process', 'SSL')); ?>
<?php echo zen_draw_hidden_field('wid', $id); ?>
<fieldset>
	<legend><?php echo FORM_TITLE; ?></legend>
	<div class="group">

	<div class="formrow">
		<label class="block" for="to_email_address"><?php echo FORM_LABEL_EMAIL . ' <span class="inputrequirement">' . UN_TEXT_FORM_FIELD_REQUIRED . '</span>'; ?></label>
		<?php echo zen_draw_input_field('to_email_address', '', 'class="l"'); ?>
	</div>
	
	<div class="formrow">
		<label class="block" for="message"><?php echo FORM_LABEL_MESSAGE; ?></label>
		<?php echo zen_draw_textarea_field('message', 40, 8, sprintf(FORM_DEFAULT_BODY, STORE_NAME, $from_name)); ?> 
	</div>
	
	</div> <!-- end group -->
</fieldset>

<div class="buttons">
<?php echo '<a href="' . zen_href_link(UN_FILENAME_WISHLIST, zen_get_all_get_params(), 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
<?php echo zen_image_submit(BUTTON_IMAGE_TELLAFRIEND, BUTTON_TELL_A_FRIEND_ALT, 'class="button-l"'); ?>
</div>

</form>

<dl class="footnote">
<dd><?php echo TEXT_PRIVACY_EMAIL; ?></dd>
<dd><?php echo TEXT_MESSAGE_FROM; ?></dd>
</dl>

</div> <!-- end (un) id for styling -->