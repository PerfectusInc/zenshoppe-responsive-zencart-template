<?php 
if ( !$_SESSION['customer_id'] ) {
	$_SESSION['navigation']->set_snapshot();
	zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

if ( UN_ALLOW_MULTIPLE_WISHLISTS!==true ) {
	zen_redirect(zen_href_link(UN_FILENAME_WISHLIST, '', 'SSL'));
}

// Get wishlist class and instantiate
require_once(DIR_WS_CLASSES . 'wishlist_class.php');
$oWishlist = new un_wishlist($_SESSION['customer_id']);

// Use specified wishlist if wid set, else use default wishlist
$id = isset($_REQUEST['wid']) ? (int) $_REQUEST['wid'] : '';
if ( ! un_is_empty($id) ) {
	$oWishlist->setWishlistId($id);
	if ( ! $oWishlist->hasPermission() ) {
		zen_redirect(zen_href_link(UN_FILENAME_WISHLISTS, '', 'SSL'));
	}
} else {
	$id = $oWishlist->getDefaultWishlistId();
}

// Process
if ( un_check_html_form('wishlist_move') ) {
	for ($i=0; $i<sizeof($_POST['products_id']); $i++) {
		
		if ( in_array($_POST['products_id'][$i], (is_array($_POST['select']) ? $_POST['select'] : array())) ) {
			$oWishlist->moveProduct((int)$_POST['products_id'][$i], (int)$_POST['wishlists_id']);
		}
		
	}
}
require(DIR_WS_MODULES . 'require_languages.php');
$breadcrumb->add(NAVBAR_TITLE);