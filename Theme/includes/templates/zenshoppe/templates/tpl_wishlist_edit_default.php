<div id="wishlist"> <!-- begin wishlist id for styling -->

<?php if ( isset($_GET['op']) && $_GET['op']=='edit' ) { ?>
<h1><?php HEADING_TITLE_EDIT; ?></h1>

<p><?php echo TEXT_DESCRIPTION_EDIT; ?></p>
<?php } else { ?>
<h1><?php HEADING_TITLE; ?></h1>

<p><?php echo TEXT_DESCRIPTION; ?></p>
<?php } ?>

<?php if ($messageStack->size('un_wishlist_edit') > 0) { 
	echo $messageStack->output('un_wishlist_edit'); 
} ?>

<p class="inputrequirement"><?php echo FORM_REQUIRED_INFORMATION; ?></p>

<?php echo zen_draw_form('un_wishlist_edit', zen_href_link(UN_FILENAME_WISHLIST_EDIT, '', 'SSL')); ?>
<?php echo zen_draw_hidden_field('meta-process', 1); ?>
<?php echo zen_draw_hidden_field('op', $_GET['op']); ?>
<?php echo zen_draw_hidden_field('wid', $_GET['wid']); ?>
<fieldset>
	<legend><?php echo FORM_TITLE; ?></legend>
	<div class="group">

	<div class="formrow">
		<label class="block" for="required-name"><?php echo FORM_LABEL_NAME; ?><span class="inputrequirement"><?php echo UN_TEXT_FORM_FIELD_REQUIRED; ?></span></label>
		<input type="text" name="required-name" value="<?php echo $_POST['required-name']? $_POST['required-name']: $records->fields['name']; ?>" class="l" />
	</div>

	<div class="formrow">
		<label class="block" for="comment"><?php echo FORM_LABEL_COMMENT; ?></label>
		<input type="text" name="comment" value="<?php echo $_POST['comment']? $_POST['comment']: $records->fields['comment']; ?>" class="l" />
	</div>

	<div class="formrow">
		<label class="block" for="public_status"><?php echo FORM_LABEL_PUBLIC; ?></label>
		<input type="radio" name="public_status" value="1" <?php echo $_POST['public_status']? ($_POST['public_status']==1?'checked="checked"':''):($records->fields['public_status']==1?'checked="checked"':''); ?> />
		<span><?php echo FORM_LABEL_YES; ?></span>&nbsp;&nbsp;
		<input type="radio" name="public_status" value="0" <?php echo $_POST['public_status']? ($_POST['public_status']==0?'checked="checked"':''):($records->fields['public_status']==0?'checked="checked"':''); ?> />
		<span><?php echo FORM_LABEL_NO; ?></span>
	</div>
	
	</div> <!-- end group -->
</fieldset>

<div class="buttons">
<?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
<?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?>
</div>

</form>

<dl class="footnote">
<dd><?php echo TEXT_PRIVACY; ?></dd>
</dl>

</div> <!-- end (un) id for styling -->