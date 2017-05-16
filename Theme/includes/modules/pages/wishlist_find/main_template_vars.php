<?php 
// Get wishlist class and instantiate
require_once(DIR_WS_CLASSES . 'wishlist_class.php');
$oWishlist = new un_wishlist();

$structure = array(
	array(
		'label'			=>	UN_TABLE_HEADING_PRODUCTS,
		'field'			=>	'pd.products_name',
		'column_order'	=>	1,
		'default'		=>	true,
		'sortable'		=>	true,
		'command'		=>	'product',
	),
	array(
		'label'			=>	UN_TABLE_HEADING_PRICE,
		'field'			=>	'p.products_price',
		'column_order'	=>	2,
		'default'		=>	false,
		'sortable'		=>	true,
		'align'			=>	'right',
		'command'		=>	'price',
	),
	array(
		'label'			=>	UN_TEXT_PRIORITY,
		'field'			=>	'p2w.priority',
		'column_order'	=>	3,
		'default'		=>	false,
		'sortable'		=>	true,
		'align'			=>	'center',
		'command'		=>	'field_value',
	),
	array(
		'label'			=>	UN_TEXT_COMMENT,
		'field'			=>	'p2w.comment',
		'column_order'	=>	4,
		'default'		=>	false,
		'sortable'		=>	false,
		'command'		=>	'field_value',
		),
	);
$structure_addcart = array(
	array(
		'label'			=>	UN_TABLE_HEADING_BUY_NOW,
		'field'			=>	'',
		'column_order'	=>	5,
		'default'		=>	false,
		'sortable'		=>	false,
		'align'			=>	'center',
		'command'		=>	'addcart_multi',
		),
	);
if (UN_ALLOW_MULTIPLE_PRODUCTS_CART_COMPACT) $structure = array_merge($structure, $structure_addcart);
$error = true;
if ( isset($_GET['wid']) && !un_is_empty($_GET['wid']) ) {

	$oWishlist->setWishlistId($_GET['wid']);
	$customers = $oWishlist->getCustomerData();
	
	if ( $customers->RecordCount() == 1 ) {
		$error = false;
		#$wid = $customers->fields['customers_id'];
		$wid = $_GET['wid'];
		$customers_name = un_get_fullname($customers->fields['customers_firstname'], $customers->fields['customers_lastname'], $customers->fields['customers_email_address']);
	} else {
		$error = true;
		$message = TEXT_CUSTOMER_ID_NOT_FOUND;
	}
	
} else {

	if ( $_POST['meta-process']==1 && (!un_is_empty($_POST['firstname']) || !un_is_empty($_POST['lastname']) || !un_is_empty($_POST['email'])) ) {
		
		$aArgs['firstname'] = (isset($_POST['firstname']) && ! un_is_empty($_POST['firstname']) ? $_POST['firstname'] : '%');
		$aArgs['lastname'] = (isset($_POST['lastname']) && ! un_is_empty($_POST['lastname']) ? $_POST['lastname'] : '%');
		$aArgs['email'] = (isset($_POST['email']) && ! un_is_empty($_POST['email']) ? $_POST['email'] : '%');
		$records = $oWishlist->findWishlists($aArgs);
		
		if ( $records->RecordCount() == 1 ) {
			$error = false;
			#$wid = $records->fields['customers_id'];
			$wid = $records->fields['id'];
			$customers_name = un_get_fullname($records->fields['customers_firstname'], $records->fields['customers_lastname'], $records->fields['customers_email_address']);
		} elseif ( $records->RecordCount() > 1 ) {
			$error = true;
			$message = $records->RecordCount() . TEXT_RESULT_RECORDS_FOUND;
		} else {
			$error = true;
			$message = TEXT_CUSTOMER_EMAIL_NOT_FOUND;
		}	
	}	
}

if ( $error === false ) {

	// set wishlist id
	$oWishlist->setWishlistId($wid);
	
	// Sort columns as defined
	$oWishlist->setStructure($structure);
	$products_query = $oWishlist->getProductsQuery();
	$aSortOptions = $oWishlist->getSortOptions(isset($_GET['sort'])? $_GET['sort']: '');

$defaultview = UN_DEFAULT_LIST_VIEW;
if ($defaultview == 'extended') {
	$defaultview = 'e';
} else {
	$defaultview = 's';
}
if ( !isset($_REQUEST['layout']) && ($defaultview == 's') ) $whatpage = 1;
if ( !isset($_REQUEST['layout']) && ($defaultview == 'e') ) $whatpage = 2;
if ( isset($_REQUEST['layout']) && $_REQUEST['layout'] == 's' ) $whatpage = 1;
if ( isset($_REQUEST['layout']) && $_REQUEST['layout'] == 'e' ) $whatpage = 2;
//echo $whatpage;
switch ($whatpage) {
	case '1' :
			$listing_split = new splitPageResults($products_query, UN_MAX_DISPLAY_COMPACT);
			$tpl_page_body = 'tpl_wishlist_find_s.php';
			break;
	case '2' :
			$listing_split = new splitPageResults($products_query, UN_MAX_DISPLAY_EXTENDED);
			$tpl_page_body = 'tpl_wishlist_find_default.php';
			break;
	default :
			$listing_split = new splitPageResults($products_query, UN_MAX_DISPLAY_COMPACT);
			$tpl_page_body = 'tpl_wishlist_find_s.php';
			break;
		}
} else {
	$tpl_page_body = 'tpl_wishlist_find_form.php';
}	
require($template->get_template_dir($tpl_page_body, DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/' . $tpl_page_body);