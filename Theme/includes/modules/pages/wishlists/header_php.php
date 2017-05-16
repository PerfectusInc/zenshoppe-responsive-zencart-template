<?php 			
if ( !$_SESSION['customer_id'] ) {
	$_SESSION['navigation']->set_snapshot();
	zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

if ( !UN_ALLOW_MULTIPLE_WISHLISTS ) {
	//zen_redirect(zen_href_link(UN_FILENAME_WISHLIST, '', 'SSL'));
}

require(DIR_WS_MODULES . 'require_languages.php');
$breadcrumb->add(NAVBAR_TITLE);

// Get wishlist class and instantiate
require_once(DIR_WS_CLASSES . 'wishlist_class.php');
$oWishlist = new un_wishlist($_SESSION['customer_id']);

// check for id
if ( isset($_GET['wid']) && !un_is_empty($_GET['wid']) ) {
    
    $id = (int)$_GET['wid'];
    $op = $_GET['op'];
    
    // assign wishlist id
    $oWishlist->setWishlistId($id);
    
    // check operation type
    if (!strcmp($op, 'del')) {
        
        // try delete wishlist and redirect
        $success = $oWishlist->deleteWishlist();
        if ( $success===true ) {
			zen_redirect(zen_href_link(UN_FILENAME_WISHLISTS, zen_get_all_get_params(array('op', 'wid')), 'SSL'));
		}
        
    } elseif (!strcmp($op, 'act')) {
        
        // try to make publice
        $success = $oWishlist->makePublic();
        if ( $success===true ) {
			zen_redirect(zen_href_link(UN_FILENAME_WISHLISTS, zen_get_all_get_params(array('op', 'wid')), 'SSL'));
		}
        
    } elseif (!strcmp($op, 'deact')) {
        
        // try to make private
        $success = $oWishlist->makePrivate();
        if ( $success===true ) {
			zen_redirect(zen_href_link(UN_FILENAME_WISHLISTS, zen_get_all_get_params(array('op', 'wid')), 'SSL'));
		}
		
    } elseif (!strcmp($op, 'default')) {
        
        // try to make private
        $success = $oWishlist->makeDefault();
        if ( $success===true ) {
			zen_redirect(zen_href_link(UN_FILENAME_WISHLISTS, zen_get_all_get_params(array('op', 'wid')), 'SSL'));
		}		
    }
}
// Get records
$records = $oWishlist->getWishlists();