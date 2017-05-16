<?php

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

switch ($_GET['action']) {
// Add item to wishlist
		case 'add_product':
		global $messageStack;
		//print_r($_POST['id']);
		if ( ($_POST['wishlist'] == 'yes') || ($_POST['wishlist_x']) ) {
			if ( $_SESSION['cart']->get_quantity($_GET['products_id']) == 1 ){
			$_SESSION['cart']->remove($_GET['products_id']);
			} else {
				$quantnow = $_SESSION['cart']->get_quantity($_GET['products_id']);
				//$quantity = $quantnow - 1;
				$_SESSION['cart']->update_quantity($_GET['products_id'], $quantnow, $_POST['id']);
			}
				if (!$_SESSION['customer_id']) {
    				$_SESSION['navigation']->set_snapshot();
    				zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
					}
				if ($_SESSION['customer_id'] && isset($_GET['products_id'])) {
				//deal with attributes
				//if ( is_array($_POST['id']) ) $attributes = serialize( $_POST['id'] );
				(is_array($_POST['id']) ? $attributes = serialize( $_POST['id'] ) : $attributes = '');
				 //$attributes = implode(':', $_POST['id']);
				//echo $attributes;
				//$attributes = unserialize( $attributes );
				//print_r($array);
				//$messageStack->add_session('header', "'".$attributes."'", 'success');
				// use wishlist class
				require_once(DIR_WS_CLASSES . 'wishlist_class.php');
				$oWishlist = new un_wishlist($_SESSION['customer_id']);
				$oWishlist->addProduct((int)$_GET['products_id'], $attributes);
			}
				if ( DISPLAY_WISHLIST == 'true' ) {
				zen_redirect(zen_href_link(UN_FILENAME_WISHLIST));
      		} else {
	      		$messageStack->add_session('header', SUCCESS_ADDED_TO_WISHLIST_PRODUCT, 'success');
      			zen_redirect(zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']));
      			
			}	
		}
		//print_r($_POST);
		
		break;
		
		case 'wishlist_add_product':
		global $messageStack;
			if (!$_SESSION['customer_id']) {
    			$_SESSION['navigation']->set_snapshot();
    			zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
			}
			if ($_SESSION['customer_id'] && isset($_GET['products_id'])) {

				// use wishlist class
				require_once(DIR_WS_CLASSES . 'wishlist_class.php');
				$oWishlist = new un_wishlist($_SESSION['customer_id']);
				$oWishlist->addProduct($_GET['products_id']);
				
			}
			if ( DISPLAY_WISHLIST == 'true' ) {
				zen_redirect(zen_href_link(UN_FILENAME_WISHLIST));
      		} else {
	      		$messageStack->add_session('header', SUCCESS_ADDED_TO_WISHLIST_PRODUCT, 'success');
      			zen_redirect(zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']));
			}
			break;

// Remove item from wishlist
		case 'un_remove_wishlist':
			if ($_SESSION['customer_id'] && isset($_GET['products_id'])) {

				// use wishlist class
				require_once(DIR_WS_CLASSES . 'wishlist_class.php');
				$oWishlist = new un_wishlist($_SESSION['customer_id']);
				$oWishlist->removeProduct($_GET['products_id']);
				
			}
			zen_redirect(zen_href_link(UN_FILENAME_WISHLIST));
			break;

// Update wishlist							
		case 'un_update_wishlist':
			$cart_updated = false;
			for ($i=0; $i<sizeof($_POST['products_id']); $i++) {
			(is_array($_POST['id']) ? $attributes = serialize( $_POST['id'] ) : $attributes = '');
				// use wishlist class
				require_once(DIR_WS_CLASSES . 'wishlist_class.php');
				$oWishlist = new un_wishlist($_SESSION['customer_id']);
				$oWishlist->updateProduct((int)$_POST['products_id'][$i], $attributes, (int)$_POST['wishlist_quantity'][$i], (int)$_POST['priority'][$i], $_POST['comment'][$i]);
				
				if ( in_array($_POST['products_id'][$i], (is_array($_POST['add_to_cart']) ? $_POST['add_to_cart'] : array())) && $_POST['wishlist_quantity'][$i] != 0 ) {
					$cart_updated = true;
					$_SESSION['cart']->add_cart($_POST['products_id'][$i], $_SESSION['cart']->get_quantity(zen_get_uprid($_POST['products_id'][$i], ''))+$_POST['wishlist_quantity'][$i], '');
				}
				if ( in_array($_POST['products_id'][$i], (is_array($_POST['wishlist_delete']) ? $_POST['wishlist_delete'] : array())) or $_POST['wishlist_quantity'][$i] == 0 ) {
					$oWishlist->removeProduct((int)$_POST['products_id'][$i]);
				}
				
			}
			if ( $cart_updated == true ) {
				zen_redirect(zen_href_link($goto, zen_get_all_get_params($parameters)));
			} else {
				zen_redirect(zen_href_link(UN_FILENAME_WISHLIST, zen_get_all_get_params($parameters)));
			}
			break;
}

?>