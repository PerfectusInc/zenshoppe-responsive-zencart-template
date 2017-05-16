<?php
/** 
 * displays add to wishlist sidebox
 *
 * @author untitled 
 * @version 0.1
 * @since 0.1
 * @access public
 * @copyright untitled
 *
 * code based on tell_a_friend.php. copyright info included below.
 *
 */
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: tell_a_friend.php 290 2004-09-15 19:48:26Z wilt $
//
$display = false;
if ( isset($_GET['products_id']) && zen_products_id_valid($_GET['products_id']) && (UN_MODULE_WISHLISTS_ENABLED) ) {
	if ( !preg_match('/^wishlist/',$_GET['main_page']) ) {
		$display = true;
	}
}

if ( $display == true ) {
	$tpl_module_body = 'tpl_wishlist.php';
	require($template->get_template_dir($tpl_module_body, DIR_WS_TEMPLATE, $current_page_base, 'sideboxes') . '/' . $tpl_module_body);
	$title =  UN_BOX_HEADING_WISHLIST;
	if ( UN_DB_SIDEBOX_LINK_HEADER == 'true' ) {
		$title_link = UN_FILENAME_WISHLIST;
	} else {
		$title_link = false;
	}
	$left_corner = false;
	$right_corner = false;
	$right_arrow = false;
	require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
}