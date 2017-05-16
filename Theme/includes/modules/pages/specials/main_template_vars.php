<?php
/**
 * Specials
 *
 * @package page
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: main_template_vars.php 18802 2011-05-25 20:23:34Z drbyte $
 */

if (MAX_DISPLAY_SPECIAL_PRODUCTS > 0 ) {
  $specials_query_raw = "SELECT p.products_id, p.products_image, pd.products_name,
                          p.master_categories_id
                         FROM (" . TABLE_PRODUCTS . " p
                         LEFT JOIN " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                         LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                         WHERE p.products_id = s.products_id and p.products_id = pd.products_id and p.products_status = '1'
                         AND s.status = 1
                         AND pd.language_id = :languagesID
                         ORDER BY s.specials_date_added DESC";

  $specials_query_raw = $db->bindVars($specials_query_raw, ':languagesID', $_SESSION['languages_id'], 'integer');
  $specials_split = new splitPageResults($specials_query_raw, MAX_DISPLAY_SPECIAL_PRODUCTS);
  $specials = $db->Execute($specials_split->sql_query);
  $row = 0;
  $col = 0;
  $list_box_contents = array();
  $title = '';

  $num_products_count = $specials->RecordCount();
  if ($num_products_count) {
    if ($num_products_count < SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS || SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS==0 ) {
      $col_width = floor(100/$num_products_count);
    } else {
      $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS);
    }

    $list_box_contents = array();
    while (!$specials->EOF) {

      $products_price = zen_get_products_display_price($specials->fields['products_id']);
	  
	 //$products_description_hover = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($specials->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION); //To Display Product Desc on Hover
	//$products_description_hover = ltrim(substr($products_description_hover, 0, 115) . '...'); //Trims and Limits the desc on hover
	
	$products_description = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($specials->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION); //To Display Product Desc 
	$products_description = ltrim(substr($products_description, 0, 150) . '..'); //Trims and Limits the desc
	
	
	//Productname Trim 
	//$products_name_hover = $specials->fields['products_name'];
	//$products_name_hover = ltrim(substr($products_name_hover, 0, 50) . '...');
	
	$products_name = $specials->fields['products_name'];
	$products_name = ltrim(substr($products_name, 0, 25) . '');
	
			/*Wishlist Links*/
			if (UN_MODULE_WISHLISTS_ENABLED) { $wishlist_link_grid= '<div class="wish_link"><a class="wishlink" href="' . zen_href_link('wishlist', 'products_id=' . $specials->fields['products_id'] . '&action=wishlist_add_product') . '"><i class="fa fa-heart-o fa-lg"></i><span>Add to Wishlist</span></a></div>';}else{ $wishlist_link_grid='';}
		  	/*Wishlist Links Ends*/
			
		  	/*Add to Cart Button*/
			$addtocartbtn = zen_get_buy_now_button($specials->fields['products_id']);
			if($addtocartbtn!=NULL){
				$addtocartbtn ='<div class="add_to_cart_link"><a class="sold_out"><i class="fa fa-ban fa-lg"></i></a>'.$addtocartbtn.'</div>';
			}
			else {
				$addtocartbtn = zen_get_buy_now_button($specials->fields['products_id'],'<div class="add_to_cart_link"><a class="add-to-cart" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $specials->fields['products_id']) . '"><i class="fa fa-shopping-cart fa-lg"></i><span>Add to Cart</span></a></div>');
			}
		
			if(mb_special_product($specials->fields['products_id'])==1){
				$ribbon='<div class="ribbon special"></div>';
			}
			elseif(mb_new_product($specials->fields['products_id'])==1){
				$ribbon='<div class="ribbon new"></div>';
			}
			else {
			}
	
      //$specials->fields['products_name'] = zen_get_products_name($specials->fields['products_id']);
      $list_box_contents[$row][$col] = array('params' => 'class="specialsListBoxContents col-xs-12 col-sm-6 col-lg-4"',
                                             'text' => '
	<div class="item">
		<div class="productinfo-wrapper grid-view">
            <div class="product_image">'.$ribbon.'
				<a href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($specials->fields['master_categories_id']) . '&products_id=' . $specials->fields['products_id']) . '">' . (($specials->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : zen_image(DIR_WS_IMAGES . $specials->fields['products_image'], $specials->fields['products_name'], MEDIUM_IMAGE_HEIGHT, MEDIUM_IMAGE_WIDTH) . '</a>
				<div class="overlay">
					<div class="product-actions">
						<a class="zoom-button" data-lightbox="special-listing-products" data-toggle="tooltip" data-original-title="View Image" href="' . DIR_WS_IMAGES . $specials->fields['products_image'] . '">' . '<i class="fa fa-expand fa-lg"></i></a>
						<a class="detailbutton-wrapper" data-toggle="tooltip" data-original-title="Product Detail" href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . $productsInCategory[$specials->fields['products_id']] . '&products_id=' . $specials->fields['products_id']) . '"><i class="fa fa-link fa-lg"></i></a>
					</div>
					<div class="quick-actions">
						'.$addtocartbtn.$wishlist_link_grid.'
						<div class="compare_link">
							<a class="comparelink" href="javascript: compareNew('.$specials->fields['products_id'].',\'add\')"><i class="fa fa-files-o fa-lg"></i><span>Add to Compare</span></a>
						</div>
					</div>
				</div>
			</div>
			<div class="product-name-desc">
				<div class="product_name">').
					'<a href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . $productsInCategory[$specials->fields['products_id']] . '&products_id=' . $specials->fields['products_id']) . '">' . $products_name . '</a>
				</div>
				<div class="product_price">' . $products_price . '</div>
			</div>
		</div>
	</div>');
      $col ++;
      if ($col > (SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS - 1)) {
        $col = 0;
        $row ++;
      }
      $specials->MoveNext();
    }
    require($template->get_template_dir('tpl_specials_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_specials_default.php');
  }
}
