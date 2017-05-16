<?php 
// Sort columns as defined
$wishlist = $oWishlist->getWishlist();
$products_query = $oWishlist->getProductsQuery();
$aSortOptions = $oWishlist->getSortOptions(isset($_GET['sort'])? $_GET['sort']: '');
$dispatch = $oWishlist->getDispatch();
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
		'command'		=>	'priority_menu_s',
	),
	array(
		'label'			=>	UN_TEXT_REMOVE,
		'field'			=>	'',
		'column_order'	=>	4,
		'default'		=>	false,
		'sortable'		=>	false,
		'align'			=>	'center',
		'command'		=>	'deletewish_checkbox',
		),
	);
if (!UN_ALLOW_MULTIPLE_PRODUCTS_CART_COMPACT) $oWishlist->setStructure($structure);

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
			$tpl_page_body = 'tpl_wishlist_s.php';
			break;
	case '2' :
			$listing_split = new splitPageResults($products_query, UN_MAX_DISPLAY_EXTENDED);
			$tpl_page_body = 'tpl_wishlist_default.php';
			break;
	default :
			$listing_split = new splitPageResults($products_query, UN_MAX_DISPLAY_COMPACT);
			$tpl_page_body = 'tpl_wishlist_s.php';
			break;
		}
	
// 	if ( !isset($_REQUEST['layout']) && ($defaultview == 's') ) {
// 	$listing_split = new splitPageResults($products_query, UN_MAX_DISPLAY_COMPACT);
// 	$tpl_page_body = 'tpl_wishlist_s.php';	
// 	} else {
// 		if ( isset($_REQUEST['layout']) && $_REQUEST['layout'] == 's' ) {
// 			$listing_split = new splitPageResults($products_query, UN_MAX_DISPLAY_COMPACT);
// 			$tpl_page_body = 'tpl_wishlist_s.php';	
// 		} else {
// 			$listing_split = new splitPageResults($products_query, UN_MAX_DISPLAY_EXTENDED);
// 			$tpl_page_body = 'tpl_wishlist_default.php';
// 		}
// }
require($template->get_template_dir($tpl_page_body, DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/' . $tpl_page_body);