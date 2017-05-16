<?php
/**
 * also_purchased_products.php
 *
 * @package modules
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: also_purchased_products.php 5369 2006-12-23 10:55:52Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
if (isset($_GET['products_id']) && SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS > 0 && MIN_DISPLAY_ALSO_PURCHASED > 0) {

  $also_purchased_products = $db->Execute(sprintf(SQL_ALSO_PURCHASED, (int)$_GET['products_id'], (int)$_GET['products_id']));

  $num_products_ordered = $also_purchased_products->RecordCount();

  $row = 0;
  $col = 0;
  $list_box_contents = array();
  $title = '';

  // show only when 1 or more and equal to or greater than minimum set in admin
  if ($num_products_ordered >= MIN_DISPLAY_ALSO_PURCHASED && $num_products_ordered > 0) {
    if ($num_products_ordered < SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS) {
      $col_width = floor(100/$num_products_ordered);
    } else {
      $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS);
    }

    while (!$also_purchased_products->EOF) {
		$products_price = zen_get_products_display_price($also_purchased_products->fields['products_id']);
      $also_purchased_products->fields['products_name'] = zen_get_products_name($also_purchased_products->fields['products_id']);
	  $products_name = $also_purchased_products->fields['products_name'];
		$products_name = ltrim(substr($products_name, 0, 30) . '');
	
      $products_description = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($also_purchased_products->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION); //To Display Product Desc 
	$products_description = ltrim(substr($products_description, 0, 150) . '..'); //Trims and Limits the desc
	
	if (UN_MODULE_WISHLISTS_ENABLED) { $wishlist_link= '<div class="wish_link"><a class="wishlink" href="' . zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $also_purchased_products->fields['products_id'] . '&action=wishlist_add_product') . '"><i class="fa fa-heart-o fa-lg"></i><span>Add to Wishlist</span></a></div><div class="compare_link"><a class="addtocompare" href="javascript: compareNew('.$also_purchased_products->fields['products_id'].', \'add\')"><i class="fa fa-files-o fa-lg"></i><span>Add to Compare</span></a></div>';}else{ $wishlist_link='';}
		$addtocartbtn = zen_get_buy_now_button($also_purchased_products->fields['products_id']);
			if($addtocartbtn!=NULL){
				$addtocartbtn ='<div class="add_to_cart_link"><a class="sold_out"><i class="fa fa-ban fa-lg"></i></a>'.$addtocartbtn.'</div>';
			}
			else {
				$addtocartbtn = zen_get_buy_now_button($also_purchased_products->fields['products_id'],'<div class="add_to_cart_link"><a class="add-to-cart" href= '.zen_href_link(zen_get_info_page($also_purchased_products->fields['products_id']), 'cPath=' . $productsInCategory[$also_purchased_products->fields['products_id']] . '&products_id=' . $also_purchased_products->fields['products_id']). '><i class="fa fa-shopping-cart fa-lg"></i><span>Add to Cart</span></a></div>');
			}
	  $list_box_contents[$row][$col] = array('params' => 'class="centerBoxContentsAlsoPurch"',
      'text' => (($also_purchased_products->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '
	  		<div class="productinfo-wrapper">
				<div class="product_image">
	  				<a href="' . zen_href_link(zen_get_info_page($also_purchased_products->fields['products_id']), 'products_id=' . $also_purchased_products->fields['products_id']) . '">' . zen_image(DIR_WS_IMAGES . $also_purchased_products->fields['products_image'], $also_purchased_products->fields['products_name'], MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '</a>') . 
					'<div class="overlay">
						<div class="product-actions">
							<a class="zoom-button" data-lightbox="alsopurchased-products" data-toggle="tooltip" data-original-title="View Image" href="' . DIR_WS_IMAGES . $also_purchased_products->fields['products_image'] . '">' . '<i class="fa fa-expand fa-lg"></i></a>
							<a class="detailbutton-wrapper" data-toggle="tooltip" data-original-title="Product Detail" href="' . zen_href_link(zen_get_info_page($also_purchased_products->fields['products_id']), 'cPath=' . $productsInCategory[$also_purchased_products->fields['products_id']] . '&products_id=' . $also_purchased_products->fields['products_id']) . '"><i class="fa fa-link fa-lg"></i></a>
						</div>
						<div class="quick-actions"><div class="add_to_cart_link">'.$addtocartbtn.'</div>'.$wishlist_link.'
						</div>
					</div>
				</div>
				<div class="product-name-desc">
					<div class="product_name">
						<a href="' . zen_href_link(zen_get_info_page($also_purchased_products->fields['products_id']), 'products_id=' . $also_purchased_products->fields['products_id']) . '">' . $products_name . '</a>
					</div>
					<div class="product_price">' . $products_price . '</div>
				</div>
			</div>');

      $col ++;
      if ($col > (SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS - 1)) {
        $col = 0;
        $row ++;
      }
      $also_purchased_products->MoveNext();
    }
  }
  if ($also_purchased_products->RecordCount() > 0 && $also_purchased_products->RecordCount() >= MIN_DISPLAY_ALSO_PURCHASED) {
    $title = '<header><h2>' . TEXT_ALSO_PURCHASED_PRODUCTS . '</h2></header>';
    $zc_show_also_purchased = true;
  }
}
?>