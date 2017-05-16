<?php

/** 
 * displays add to wishlist sidebox
 */


$content = '';
if ( $_SESSION['customer_id'] ) {

	$content .= zen_draw_form('wishlist_sidebox', zen_href_link(UN_FILENAME_WISHLIST, '', 'NONSSL'), 'get');
	$content .= zen_draw_hidden_field('main_page', UN_FILENAME_WISHLIST);
	$content .= zen_hide_session_id();
	$content .= zen_draw_hidden_field('action','un_add_wishlist');
	$content .= zen_draw_hidden_field('products_id', (int)$_GET['products_id']);
	$content .= '<div align="center">';
	$content .= zen_image_submit(UN_BUTTON_IMAGE_WISHLIST_ADD, UN_BUTTON_WISHLIST_ADD_ALT);
	//$content .= '<input type="submit" value="' . UN_BUTTON_WISHLIST_ADD_ALT . '" />';
	$content .= '<br />';
	$content .= UN_BOX_WISHLIST_ADD_TEXT;
	$content .= '</div>';
	$content .= '</form>';

} else {

	$content .= '<div>';
	$content .= UN_BOX_WISHLIST_LOGIN_TEXT;
	$content .= '</div>';

}

?>