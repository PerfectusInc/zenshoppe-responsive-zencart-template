<?php
// Save for later functions.  
// Derived from Zen Cart logic by that Software Guy.
// Some portions Copyright 2003-2007 Zen Cart Development Team

// called from shopping cart template to replicate get_contents().
 

function get_mb_template_configvalues($keys,$lang_id=0)
{
	global $db;
    $tr_qry = "SELECT * FROM ".TABLE_ZENSHOPPE_TEMPLATE_CONFIG." WHERE mb_keys='".$keys."' and languages_id='".$lang_id."'";
	$tr_config = $db->Execute($tr_qry);
	return $tr_config->fields['mb_values'];
}
function update_mb_template_configvalues($key,$value,$lang_id)
{
	global $db;
	$chk_keys = "select * from ".TABLE_ZENSHOPPE_TEMPLATE_CONFIG." WHERE mb_keys='".$key."' and languages_id='".$lang_id."'";
	$res_chk_keys = $db->Execute($chk_keys);
	$numsrows_chek_keys = $res_chk_keys->RecordCount();
	if($numsrows_chek_keys==0)
	{
	     $tr_qry = "INSERT INTO ".TABLE_ZENSHOPPE_TEMPLATE_CONFIG."(languages_id,mb_keys,mb_values) VALUES('".$lang_id."','".$key."','".$value."')";
	}else
	{
		 $tr_qry = "UPDATE ".TABLE_ZENSHOPPE_TEMPLATE_CONFIG." set mb_values='".$value."'  WHERE mb_keys='".$key."' and languages_id='".$lang_id."'";
	}
	$tr_config = $db->Execute($tr_qry);
	return array("$keys"=>"$value");
}
////// Get ul li
 function mb_get_categories($categories_array = '', $parent_id = '0', $indent = '') {
    global $db;

    if (!is_array($categories_array)) $categories_array = array();

    $categories_query = "select c.categories_id, cd.categories_name
                         from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                         where parent_id = '" . (int)$parent_id . "'
                         and c.categories_id = cd.categories_id
                         and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                         order by sort_order, cd.categories_name";

    $categories = $db->Execute($categories_query);

    while (!$categories->EOF) {
      $categories_array[] = array('id' => $categories->fields['categories_id'],
                                  'text' => $indent . $categories->fields['categories_name']);

      if ($categories->fields['categories_id'] != $parent_id) {
        $categories_array = zen_get_categories($categories_array, $categories->fields['categories_id'], $indent . '&nbsp;&nbsp;');
      }
      $categories->MoveNext();
    }

    return $categories_array;
  }

function mb_special_product($prod_id)
{
	global $db;
	$listing_sql="select p.products_id, p.products_image, pd.products_name, p.master_categories_id
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = s.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = '1' and s.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p.products_id='".$prod_id."' ";
	$listing_res = $db->Execute($listing_sql);
	return $listing_res->RecordCount();
	
}

function mb_featured_product($prod_id)
{
	global $db;
	$featured_sql="select p.products_id, p.products_image, pd.products_name, p.master_categories_id
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_FEATURED . " s on p.products_id = s.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = s.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = '1' and s.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p.products_id='".$prod_id."' ";
	$featured_res = $db->Execute($featured_sql);
	return $featured_res->RecordCount();
	
}

function mb_new_product($prod_id)
{
	global $db;
	$display_limit = zen_get_new_date_range();
	$new_products_query = "select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name,
                                p.products_date_added, p.products_price, p.products_type, p.master_categories_id
                           from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           where p.products_id = pd.products_id
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                           and   p.products_status = 1 and p.products_id='".$prod_id."'".$display_limit;
	$listing_res = $db->Execute($new_products_query);
	return $listing_res->RecordCount();
	
}
function mb_specials_product($prod_id)
{
	global $db;
	 $specials_index_query = "select p.products_id, p.products_image, pd.products_name, p.master_categories_id
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = s.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = '1' and s.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p.products_id='".$prod_id."'";
		$listing_res = $db->Execute($specials_index_query);
	return $listing_res->RecordCount();
}
function mb_discount_product($products_id) {
    global $db, $currencies;

    $free_tag = "";
    $call_tag = "";

// 0 = normal shopping
// 1 = Login to shop
// 2 = Can browse but no prices
    // verify display of prices
      switch (true) {
        case (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == ''):
        // customer must be logged in to browse
        return '';
        break;
        case (CUSTOMERS_APPROVAL == '2' and $_SESSION['customer_id'] == ''):
        // customer may browse but no prices
        return TEXT_LOGIN_FOR_PRICE_PRICE;
        break;
        case (CUSTOMERS_APPROVAL == '3' and TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM != ''):
        // customer may browse but no prices
        return TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM;
        break;
        case ((CUSTOMERS_APPROVAL_AUTHORIZATION != '0' and CUSTOMERS_APPROVAL_AUTHORIZATION != '3') and $_SESSION['customer_id'] == ''):
        // customer must be logged in to browse
        return TEXT_AUTHORIZATION_PENDING_PRICE;
        break;
        case ((CUSTOMERS_APPROVAL_AUTHORIZATION != '0' and CUSTOMERS_APPROVAL_AUTHORIZATION != '3') and $_SESSION['customers_authorization'] > '0'):
        // customer must be logged in to browse
        return TEXT_AUTHORIZATION_PENDING_PRICE;
        break;
        default:
        // proceed normally
        break;
      }

// show case only
    if (STORE_STATUS != '0') {
      if (STORE_STATUS == '1') {
        return '';
      }
    }

    // $new_fields = ', product_is_free, product_is_call, product_is_showroom_only';
    $product_check = $db->Execute("select products_tax_class_id, products_price, products_priced_by_attribute, product_is_free, product_is_call, products_type from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'" . " limit 1");

    // no prices on Document General
    if ($product_check->fields['products_type'] == 3) {
      return '';
    }

    $show_display_price = '';
    $display_normal_price = zen_get_products_base_price($products_id);
    $display_special_price = zen_get_products_special_price($products_id, true);
    $display_sale_price = zen_get_products_special_price($products_id, false);

    $show_sale_discount = '';
    if (SHOW_SALE_DISCOUNT_STATUS == '1' and ($display_special_price != 0 or $display_sale_price != 0)) {
      if ($display_sale_price) {
        if (SHOW_SALE_DISCOUNT == 1) {
          if ($display_normal_price != 0) {
             $show_discount_amount = number_format(100 - (($display_sale_price / $display_normal_price) * 100),SHOW_SALE_DISCOUNT_DECIMALS);
          } else {
            $show_discount_amount = '';
          }
          $show_sale_discount = 1;

        } else {
          $show_sale_discount = 1;
        }
      } else {
        if (SHOW_SALE_DISCOUNT == 1) {
          $show_sale_discount = 1;
        } else {
          $show_sale_discount =1;
        }
      }
    }
    return $show_sale_discount;
  
	}

function mb_display_banner($action, $identifier) {
    global $db, $request_type;

    switch ($request_type) {
      case ('SSL'):
        $my_banner_filter=" and banners_on_ssl= " . "1 ";
        break;
      case ('NONSSL'):
        $my_banner_filter='';
        break;
    }

    if ($action == 'dynamic') {
      $new_banner_search = zen_build_banners_group($identifier);

      $banners_query = "select count(*) as count
                        from " . TABLE_BANNERS . "
                           where status = '1' " .
                           $new_banner_search . $my_banner_filter;

      $banners = $db->Execute($banners_query);

      if ($banners->fields['count'] > 0) {
        $banner = $db->Execute("select  banners_id, banners_title, banners_image, banners_html_text, banners_open_new_windows, banners_url
                               from " . TABLE_BANNERS . "
                               where status = 1 " .
                               $new_banner_search . $my_banner_filter . " order by banners_id");

      } else {
        return '<p class="alert">ZEN ERROR! (zen_display_banner(' . $action . ', ' . $identifier . ') -> No banners with group \'' . $identifier . '\' found!</p>';
      }
    } elseif ($action == 'static') {
      if (is_object($identifier)) {
        $banner = $identifier;
      } else {
        $banner_query = "select banners_id, banners_title, banners_image, banners_html_text, banners_open_new_windows, banners_url
                         from " . TABLE_BANNERS . "
                         where status = 1
                         and banners_id = '" . (int)$identifier . "'" . $my_banner_filter;

        $banner = $db->Execute($banner_query);

        if ($banner->RecordCount() < 1) {
          //return '<strong>ZEN ERROR! (zen_display_banner(' . $action . ', ' . $identifier . ') -> Banner with ID \'' . $identifier . '\' not found, or status inactive</strong>';
        }
      }
    } else {
      return '<p class="alert">ZEN ERROR! (zen_display_banner(' . $action . ', ' . $identifier . ') -> Unknown $action parameter value - it must be either \'dynamic\' or \'static\'</p>';
    }
     if ($banner->RecordCount() > 0) {
		 $i=0;
  while (!$banner->EOF) {
	  $banner_string.='<span class="slidesjs-slide" slidesjs-index="'.$i.'">';
    if (zen_not_null($banner->fields['banners_html_text'])) {
      $banner_string.= $banner->fields['banners_html_text'];
    } else {
      if ($banner->fields['banners_url'] == '') {
        $banner_string.= zen_image(DIR_WS_IMAGES . $banner->fields['banners_image'], $banner->fields['banners_title']);
      } else {
        if ($banner->fields['banners_open_new_windows'] == '1') {
          $banner_string.= '<a href="' . zen_href_link(FILENAME_REDIRECT, 'action=banner&goto=' . $banner->fields['banners_id']) . '" target="_blank">' . zen_image(DIR_WS_IMAGES . $banner->fields['banners_image'], $banner->fields['banners_title']) . '</a>';
        } else {
          $banner_string.= '<a href="' . zen_href_link(FILENAME_REDIRECT, 'action=banner&goto=' . $banner->fields['banners_id']) . '">' . zen_image(DIR_WS_IMAGES . $banner->fields['banners_image'], $banner->fields['banners_title'],254,309) . '</a>';
        }
      }
    }
    zen_update_banner_display_count($banner->fields['banners_id']);
	$banner_string.='</span>';
	$mj_banners_list.=$banner_string;
	$i++;
    $banner->MoveNext();
	$banner_string='';
  }
} 
else {
  echo '<p>Sorry, banners found.</p>';
}
    return $mj_banners_list;
  }

function zen_mb_get_products_display_price($products_id,$sales='0') {
    global $db, $currencies;

    $free_tag = "";
    $call_tag = "";

// 0 = normal shopping
// 1 = Login to shop
// 2 = Can browse but no prices
    // verify display of prices
      switch (true) {
        case (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == ''):
        // customer must be logged in to browse
        return '';
        break;
        case (CUSTOMERS_APPROVAL == '2' and $_SESSION['customer_id'] == ''):
        // customer may browse but no prices
        return TEXT_LOGIN_FOR_PRICE_PRICE;
        break;
        case (CUSTOMERS_APPROVAL == '3' and TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM != ''):
        // customer may browse but no prices
        return TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM;
        break;
        case ((CUSTOMERS_APPROVAL_AUTHORIZATION != '0' and CUSTOMERS_APPROVAL_AUTHORIZATION != '3') and $_SESSION['customer_id'] == ''):
        // customer must be logged in to browse
        return TEXT_AUTHORIZATION_PENDING_PRICE;
        break;
        case ((CUSTOMERS_APPROVAL_AUTHORIZATION != '0' and CUSTOMERS_APPROVAL_AUTHORIZATION != '3') and $_SESSION['customers_authorization'] > '0'):
        // customer must be logged in to browse
        return TEXT_AUTHORIZATION_PENDING_PRICE;
        break;
        default:
        // proceed normally
        break;
      }

// show case only
    if (STORE_STATUS != '0') {
      if (STORE_STATUS == '1') {
        return '';
      }
    }

    // $new_fields = ', product_is_free, product_is_call, product_is_showroom_only';
    $product_check = $db->Execute("select products_tax_class_id, products_price, products_priced_by_attribute, product_is_free, product_is_call, products_type from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'" . " limit 1");

    // no prices on Document General
    if ($product_check->fields['products_type'] == 3) {
      return '';
    }

    $show_display_price = '';
    $display_normal_price = zen_get_products_base_price($products_id);
	$display_sale_price = zen_get_products_special_price($products_id, false);
    $display_special_price = zen_get_products_special_price($products_id, true);

    $show_sale_discount = '';
    if (SHOW_SALE_DISCOUNT_STATUS == '1' and ($display_special_price != 0 or $display_sale_price != 0)) {
      if ($display_sale_price) {
        if (SHOW_SALE_DISCOUNT == 1) {
          if ($display_normal_price != 0) {
            $show_discount_amount = number_format(100 - (($display_sale_price / $display_normal_price) * 100),SHOW_SALE_DISCOUNT_DECIMALS);
          } else {
            $show_discount_amount = '';
          }
          $show_sale_discount = '<span class="productPriceDiscount">'.  $show_discount_amount . PRODUCT_PRICE_DISCOUNT_PERCENTAGE . '</span>';

        } else {
          $show_sale_discount = '<span class="productPriceDiscount">' .$currencies->display_price(($display_normal_price - $display_sale_price), zen_get_tax_rate($product_check->fields['products_tax_class_id'])) . PRODUCT_PRICE_DISCOUNT_AMOUNT . '</span>';
        }
      } else {
        if (SHOW_SALE_DISCOUNT == 1) {
          $show_sale_discount = '<span class="productPriceDiscount">' . number_format(100 - (($display_special_price / $display_normal_price) * 100),SHOW_SALE_DISCOUNT_DECIMALS) . PRODUCT_PRICE_DISCOUNT_PERCENTAGE . '</span>';
        } else {
          $show_sale_discount = '<span class="productPriceDiscount">' . $currencies->display_price(($display_normal_price - $display_special_price), zen_get_tax_rate($product_check->fields['products_tax_class_id'])) . PRODUCT_PRICE_DISCOUNT_AMOUNT . '</span>';
        }
      }
    }

    if ($display_special_price) {
      $show_normal_price = '<span class="normalprice">' . $currencies->display_price($display_normal_price, zen_get_tax_rate($product_check->fields['products_tax_class_id'])) . '</span>'; //id="old-price-'.$products_id.'"
	  
      if ($display_sale_price && $display_sale_price != $display_special_price) {
      
		 $show_special_price = '<span class="productSpecialPriceSale">' .$currencies->display_price($display_special_price, zen_get_tax_rate($product_check->fields['products_tax_class_id'])) . '</span>'; //id="product-price-'.$products_id.'"
		
        if ($product_check->fields['product_is_free'] == '1') {
		   $show_sale_price = '<span class="productSalePrice">' .$currencies->display_price($display_sale_price, zen_get_tax_rate($product_check->fields['products_tax_class_id'])). '</span>'; //id="product-price-'.$products_id.'"
		  
        } else {
          $show_sale_price = '<span class="productSalePrice">' . $currencies->display_price($display_sale_price, zen_get_tax_rate($product_check->fields['products_tax_class_id'])) . '</span>'; //id="product-price-'.$products_id.'"
        }
      } else {
        if ($product_check->fields['product_is_free'] == '1') {
			$show_special_price = '<span class="productSpecialPrice">' . '<s>' .$currencies->display_price($display_special_price, zen_get_tax_rate($product_check->fields['products_tax_class_id'])) .'</s>' . '</span>'; //id="product-price-'.$products_id.'"
        } else {
		    $show_special_price = '<span class="productSpecialPrice">' .$currencies->display_price($display_special_price, zen_get_tax_rate($product_check->fields['products_tax_class_id'])) . '</span>'; //id="product-price-'.$products_id.'"
		  
        }
        $show_sale_price = '';
      }
    } else {
      if ($display_sale_price) {

        $show_normal_price = ' <span class="normalprice">' . $currencies->display_price($display_normal_price, zen_get_tax_rate($product_check->fields['products_tax_class_id'])) . '</span>'; //id="old-price-'.$products_id.'"
        $show_special_price = '';
		  $show_sale_price = '<span class="special-price productSalePrice"><span  class="price product-price-'.$products_id.'">' .$currencies->display_price($display_sale_price, zen_get_tax_rate($product_check->fields['products_tax_class_id'])) . '</span></span>'; //id="product-price-'.$products_id.'"
    
      } else {
        if ($product_check->fields['product_is_free'] == '1') {
          $show_normal_price = '<span class="normalprice">' . $currencies->display_price($display_normal_price, zen_get_tax_rate($product_check->fields['products_tax_class_id'])) . '</span>'; //id="old-price-'.$products_id.'"
        } else {
          $show_normal_price = '<span class="single_price">'. $currencies->display_price($display_normal_price, zen_get_tax_rate($product_check->fields['products_tax_class_id'])).'</span>'; //id="product-price-'.$products_id.'"

        }
        $show_special_price = '';
        $show_sale_price = '';
      }
    }

    if ($display_normal_price == 0) {
      // don't show the $0.00
      $final_display_price = $show_special_price . $show_sale_price . $show_sale_discount ;
    } else {
      $final_display_price = $show_normal_price. $show_special_price . $show_sale_price . $show_sale_discount;
    }

    // If Free, Show it
    if ($product_check->fields['product_is_free'] == '1') {
      if (OTHER_IMAGE_PRICE_IS_FREE_ON=='0') {
        $free_tag = '<br />' . PRODUCTS_PRICE_IS_FREE_TEXT;
      } else {
        $free_tag = '<br />' . zen_image(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_PRICE_IS_FREE, PRODUCTS_PRICE_IS_FREE_TEXT);
      }
    }

    // If Call for Price, Show it
    if ($product_check->fields['product_is_call']) {
      if (PRODUCTS_PRICE_IS_CALL_IMAGE_ON=='0') {
        $call_tag = '<br />' . PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT;
      } else {
        $call_tag = '<br />' . zen_image(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_CALL_FOR_PRICE, PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT);
      }
    }

    return $final_display_price;
  }
function zen_mb_get_productiscallforprice($products_id, $box='0') {
    global $db, $currencies;

    $free_tag = "";
    $call_tag = "";

// 0 = normal shopping
// 1 = Login to shop
// 2 = Can browse but no prices
    // verify display of prices
      switch (true) {
        case (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == ''):
        // customer must be logged in to browse
        return '';
        break;
        case (CUSTOMERS_APPROVAL == '2' and $_SESSION['customer_id'] == ''):
        // customer may browse but no prices
        return TEXT_LOGIN_FOR_PRICE_PRICE;
        break;
        case (CUSTOMERS_APPROVAL == '3' and TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM != ''):
        // customer may browse but no prices
        return TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM;
        break;
        case ((CUSTOMERS_APPROVAL_AUTHORIZATION != '0' and CUSTOMERS_APPROVAL_AUTHORIZATION != '3') and $_SESSION['customer_id'] == ''):
        // customer must be logged in to browse
        return TEXT_AUTHORIZATION_PENDING_PRICE;
        break;
        case ((CUSTOMERS_APPROVAL_AUTHORIZATION != '0' and CUSTOMERS_APPROVAL_AUTHORIZATION != '3') and $_SESSION['customers_authorization'] > '0'):
        // customer must be logged in to browse
        return TEXT_AUTHORIZATION_PENDING_PRICE;
        break;
        default:
        // proceed normally
        break;
      }

// show case only
    if (STORE_STATUS != '0') {
      if (STORE_STATUS == '1') {
        return '';
      }
    }

    // $new_fields = ', product_is_free, product_is_call, product_is_showroom_only';
    $product_check = $db->Execute("select products_tax_class_id, products_price, products_priced_by_attribute, product_is_free, product_is_call, products_type from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'" . " limit 1");

    // no prices on Document General
    if ($product_check->fields['products_type'] == 3) {
      return '';
    }

    $show_display_price = '';
    $display_normal_price = zen_get_products_base_price($products_id);
    $display_special_price = zen_get_products_special_price($products_id, true);
    $display_sale_price = zen_get_products_special_price($products_id, false);

    // If Call for Price, Show it
	       
		 $get_new_prod=mb_new_product($products_id);
	     $get_discount_prod=mb_discount_product($products_id);
		 $get_free_prod=zen_mb_get_productisfree($products_id);
		 $count_fea=array();
		 if($get_new_prod==1){$count_fea[]='new';}
		 if($get_discount_prod==1){$count_fea[]='discount';}
		 if($get_free_prod!=''){$count_fea[]='free';}
		 $count_fea=count($count_fea);
		 if($box==0)
		 if($count_fea==3){$top_pos=100;}elseif($count_fea==2){$top_pos=70;}elseif($count_fea==1){$top_pos=40;}else{$top_pos=10;}
		 else
		 if($count_fea==3){$top_pos=70;}elseif($count_fea==2){$top_pos=50;}elseif($count_fea==1){$top_pos=30;}else{$top_pos=10;}
		 
	
    if ($product_check->fields['product_is_call']) {
      if (PRODUCTS_PRICE_IS_CALL_IMAGE_ON=='0') {
        $call_tag = '<div class="callfor-product-icon" style="top:'.$top_pos.'px;">'.PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT.'</div>';
      } else {
        $call_tag ='<div class="callfor-product-icon" style="top:'.$top_pos.'px;">'.zen_image(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_CALL_FOR_PRICE, PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT).'</div>';
      }
    }
	else
	{
		$call_tag='';	
	}

    return $call_tag;
  } 
function zen_mb_get_productisfree($products_id, $box='0') {
    global $db, $currencies;

    $free_tag = "";
    $call_tag = "";

// 0 = normal shopping
// 1 = Login to shop
// 2 = Can browse but no prices
    // verify display of prices
      switch (true) {
        case (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == ''):
        // customer must be logged in to browse
        return '';
        break;
        case (CUSTOMERS_APPROVAL == '2' and $_SESSION['customer_id'] == ''):
        // customer may browse but no prices
        return TEXT_LOGIN_FOR_PRICE_PRICE;
        break;
        case (CUSTOMERS_APPROVAL == '3' and TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM != ''):
        // customer may browse but no prices
        return TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM;
        break;
        case ((CUSTOMERS_APPROVAL_AUTHORIZATION != '0' and CUSTOMERS_APPROVAL_AUTHORIZATION != '3') and $_SESSION['customer_id'] == ''):
        // customer must be logged in to browse
        return TEXT_AUTHORIZATION_PENDING_PRICE;
        break;
        case ((CUSTOMERS_APPROVAL_AUTHORIZATION != '0' and CUSTOMERS_APPROVAL_AUTHORIZATION != '3') and $_SESSION['customers_authorization'] > '0'):
        // customer must be logged in to browse
        return TEXT_AUTHORIZATION_PENDING_PRICE;
        break;
        default:
        // proceed normally
        break;
      }

// show case only
    if (STORE_STATUS != '0') {
      if (STORE_STATUS == '1') {
        return '';
      }
    }

    // $new_fields = ', product_is_free, product_is_call, product_is_showroom_only';
    $product_check = $db->Execute("select products_tax_class_id, products_price, products_priced_by_attribute, product_is_free, product_is_call, products_type from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'" . " limit 1");

    // no prices on Document General
    if ($product_check->fields['products_type'] == 3) {
      return '';
    }

    $show_display_price = '';
    $display_normal_price = zen_get_products_base_price($products_id);
    $display_special_price = zen_get_products_special_price($products_id, true);
    $display_sale_price = zen_get_products_special_price($products_id, false);
	
	     $get_new_prod=mb_new_product($products_id);
	     $get_discount_prod=mb_discount_product($products_id);
		 $count_fea=array();
		 if($get_new_prod==1){$count_fea[]='new';}
		 if($get_discount_prod==1){$count_fea[]='discount';}
		 $count_fea=count($count_fea);
		 if($box==0)
		 if($count_fea==2){$top_pos=70;}elseif($count_fea==1){$top_pos=40;}else{$top_pos=10;}
		 else
		 if($count_fea==2){$top_pos=50;}elseif($count_fea==1){$top_pos=30;}else{$top_pos=10;}

    // If Free, Show it
    if ($product_check->fields['product_is_free'] == '1') {
      if (OTHER_IMAGE_PRICE_IS_FREE_ON=='0') {
        $free_tag = '<div class="free-product-icon" style="top:'.$top_pos.'px;">'.PRODUCTS_PRICE_IS_FREE_TEXT.'</div>';
      } else {
        $free_tag = '<div class="free-product-icon" style="top:'.$top_pos.'px;">'.zen_image(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_PRICE_IS_FREE, PRODUCTS_PRICE_IS_FREE_TEXT).'</div>';
      }
    }
	else
	{
		$free_tag='';	
	}
    return $free_tag;
  }

  
function mb_product_reviews($product_id)
{
	
    global $db;
	$content='';
	$flag_show_product_info_reviews = zen_get_show_product_switch($product_id, 'reviews');
	$flag_show_product_info_reviews_count = zen_get_show_product_switch($product_id, 'reviews_count');
	
	// if review must be approved or disabled do not show review
    $review_status = " and r.status = '1'";

    $reviews_query = "select count(*) as count from " . TABLE_REVIEWS . " r, "
                                                       . TABLE_REVIEWS_DESCRIPTION . " rd
                       where r.products_id = '" . (int)$product_id . "'
                       and r.reviews_id = rd.reviews_id
                       and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                       $review_status;

    $reviews = $db->Execute($reviews_query);

// 2P added BOF - Average Product Rating
    $reviews_average_rating_query = "select avg(reviews_rating) as average_rating from " . TABLE_REVIEWS . " r, "
                                                       . TABLE_REVIEWS_DESCRIPTION . " rd
                       where r.products_id = '" . (int)$product_id . "'
                       and r.reviews_id = rd.reviews_id
                       and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                       $review_status;

    $reviews_average_rating = $db->Execute($reviews_average_rating_query);
    // 2P added EOF - Average Product Rating

    if ($flag_show_product_info_reviews == 1) {
    // if more than 0 reviews, then show reviews button; otherwise, show the "write review" button
    
    if ($reviews->fields['count'] > 0 ) { ?>
<?php // 2P modified BOF - Average Product Rating

  $content.= '<div class="ratings">
      	<div class="rating-box">';
  if ($flag_show_product_info_reviews_count == 1) {
    $stars_image_suffix = str_replace('.', '_', zen_round($reviews_average_rating->fields['average_rating'] * 2, 0) / 2); // for stars_0_5.gif, stars_1.gif, stars_1_5.gif etc.
    $average_rating = zen_round(($reviews_average_rating->fields['average_rating']*100)/5, 2);
   // $content.= zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $stars_image_suffix . '.gif', sprintf(BOX_REVIEWS_TEXT_OF_5_STARS, $average_rating));
   $content.='<div style="width:'.$average_rating.'%" class="rating"></div>';
  } else {
    echo '';
  }
  $link_content="var t = opener ? opener.window : window; t.location.href='".zen_href_link(FILENAME_PRODUCT_REVIEWS, zen_get_all_get_params())."'";
  $content.='</div>
   <span class="amount"><a onclick="'.$link_content.'; return false;" href="">'.$reviews->fields['count'].TEXT_CURRENT_REVIEWS.'</a></span>
  </div>';
// 2P modified EOF - Average Product Rating ?>
<?php }}
   return $content;
}

////// Get slected subcategories array
function mb_get_selected_subcategories($categories_ul_li = '', $parent_id = '0', $cpath = '') {
global $db;
 
$categories_query = "select c.categories_id, cd.categories_name, c.categories_status
                     from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                     where " . $zc_status . "
                     parent_id = '" . (int)$parent_id . "'
                     and c.categories_status = TRUE
                     and c.categories_id = cd.categories_id
                     and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                     order by sort_order, cd.categories_name";
$categories = $db->Execute($categories_query);
				while (!$categories->EOF) {
				if ($categories->fields['categories_id'] != $parent_id) {
					if(zen_has_category_subcategories($categories->fields['categories_id'])){
						
					   $categories_ul_li = mb_get_selected_subcategories($categories_ul_li, $categories->fields['categories_id'], $dpath.= "_");
					}
					else
					{
				        $categories_ul_li[]=$categories->fields['categories_id'];
					
					}
				$categories->MoveNext();
				}
				}
				return $categories_ul_li;
}

////// Get ul li
function zen_get_categories_ul_li($categories_ul_li = '', $parent_id = '0', $cpath = '') {
global $db;
 
$categories_query = "select c.categories_id, cd.categories_name, c.categories_status
                     from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                     where " . $zc_status . "
                     parent_id = '" . (int)$parent_id . "'
                     and c.categories_status = TRUE
                     and c.categories_id = cd.categories_id
                     and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                     order by sort_order, cd.categories_name";
$categories = $db->Execute($categories_query);
$categories_ul_li .= "<ul>";
				while (!$categories->EOF) {
					
					if ($categories->fields['categories_id'] != $parent_id) {
					
					}
					
				$dpath = $cpath.$categories->fields['categories_id'];
				$categories_ul_li .= "<li><a href=\"index.php?main_page=index&cPath=$dpath\">".$categories->fields['categories_name'].'</a>';
				if ($categories->fields['categories_id'] != $parent_id) {
					if(zen_has_category_subcategories($categories->fields['categories_id'])){
						
					   $categories_ul_li = zen_get_categories_ul_li($categories_ul_li, $categories->fields['categories_id'], $dpath.= "_");
					}
					else
					{
				        print_r($categories->fields['categories_id']);
					}
				$categories_ul_li .= "</li>";
				$categories->MoveNext();
				}
				}
				$categories_ul_li .= "</ul>";
				return $categories_ul_li;
}

function mb_getbaseimg_effects($img)
{
  if ($src == DIR_WS_IMAGES and PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1') {
      $src = DIR_WS_IMAGES . PRODUCTS_IMAGE_NO_IMAGE;
    }
	else
	{
	 $img_src=DIR_WS_IMAGES.$img;
	 if(file_exists($img_src) && $img!='')
      {
		$src=$img_src;  
	  }
	  else
	  {
		 $src = DIR_WS_IMAGES . PRODUCTS_IMAGE_NO_IMAGE;
	  }
	}
	return $src;
}
function mb_gethoverimg_effects($img)
{
	
  if ($src == DIR_WS_IMAGES and PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1') {
      $src = DIR_WS_IMAGES . PRODUCTS_IMAGE_NO_IMAGE;
    }
	else
	{
	    $img_fileInfo = pathinfo($img);
		$img_extension = '.'.$img_fileInfo['extension'];
		$second_product_img_src=DIR_WS_IMAGES.str_replace($img_extension,'',$img).'_01'.$img_extension;
		$src=(file_exists($second_product_img_src))? 'hover_img="'.$second_product_img_src.'"' : '' ;
		 
	}
	return $src;
}
////
// Return table heading with sorting capabilities
  function mb_create_sort_heading($sortby, $colnum, $heading) {
    global $PHP_SELF;
    $sort_prefix = '';
    if ($sortby) {
		 $select=(isset($_GET['sort']) && (($_GET['sort']==$colnum.'a') || ($_GET['sort']==$colnum.'d')) )? "selected='selected'":"";
      $sort_prefix = '<option '. $select .' value="'. $colnum.'a">'.$heading.'</option>' ;
    }

    return $sort_prefix ;
  }
  
  function mb_create_sort_heading_asc_des($sortby, $colnum, $heading) {
    global $PHP_SELF;

    $sort_prefix = '';
    $sort_suffix = '';
       $orderitm=(substr($sortby, 1, 1));
	  $colnum= str_replace($orderitm,'',$sortby);
    if ($sortby) {
      $sort_prefix = '<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('page', 'info', 'sort')) . 'page=1&sort=' . $colnum . ($sortby == $colnum . 'a' ? 'd' : 'a')) . '" title="' . zen_output_string(TEXT_SORT_PRODUCTS . ($sortby == $colnum . 'd' || substr($sortby, 0, 1) != $colnum ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading) . '">' ;
      $sort_suffix = (substr($sortby, 0, 1) == $colnum ? (substr($sortby, 1, 1) == 'a' ? '<span class="ascending_direction direction">'.PRODUCT_LIST_SORT_ORDER_ASCENDING.'</span>' : '<span class="descending_direction direction">'.PRODUCT_LIST_SORT_ORDER_DESCENDING.'</span>') : '') . '</a>';
    }

    return $sort_prefix . $sort_suffix;
  }
  
 
 function mb_gridlist_tab($page)
 {
	 $cont='';
	 $cont.= '<div class="display-mode"><ul class="unstyled float-right">
			  ';
			     (defined('PRODUCT_LISTING_LAYOUT_STYLE')? PRODUCT_LISTING_LAYOUT_STYLE: 'rows');
				    
				   if(isset($_GET['view']) && ($_GET['view']!='columns') )
				   {   
						$cont.= '<a class="grid" title="'.HEADING_VIEW_AS_GRID.'" href="'.zen_href_link($page, zen_get_all_get_params(array('view')) . 'view=columns').'" >'.'<i class="fa fa-th-large"></i></a>';
						$cont.= '<div class="list" title="'.HEADING_VIEW_AS_LIST.'">'.'<i class="fa fa-bars"></i></div>';
				   }
				   else
				   {
						$cont.= '<div class="grid" title="'.HEADING_VIEW_AS_GRID.'">'.'<i class="fa fa-th-large"></i></div>';
						$cont.= '<a class="list" title="'.HEADING_VIEW_AS_LIST.'" href="'.zen_href_link($page, zen_get_all_get_params(array('view')) . 'view=rows').'" >'.'<i class="fa fa-bars"></i></a>&nbsp;';
				   }
		$cont.= '</ul></div>';  
		return $cont;
 }
 
 
 function mb_souldout_product($product_id,$box='0')
 {
	 global $db;
	     $button_check = $db->Execute("select product_is_call, products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
	     $get_new_prod=mb_new_product($products_id);
	     $get_discount_prod=mb_discount_product($products_id);
		 $get_free_prod=zen_mb_get_productisfree($products_id);
		 $count_fea=array();
		 if($get_new_prod==1){$count_fea[]='new';}
		 if($get_discount_prod==1){$count_fea[]='discount';}
		 if($get_free_prod!=''){$count_fea[]='free';}
		 if($button_check->fields['products_quantity'] <= 0){
		   $count_fea[]='sould';
	     }
		 $count_fea=count($count_fea);
		 if($box==0)
		 if($count_fea==4){$top_pos=130;}elseif($count_fea==3){$top_pos=100;}elseif($count_fea==2){$top_pos=70;}elseif($count_fea==1){$top_pos=40;}else{$top_pos=10;}
		 else
		 if($count_fea==4){$top_pos=90;}elseif($count_fea==3){$top_pos=70;}elseif($count_fea==2){$top_pos=50;}elseif($count_fea==1){$top_pos=30;}else{$top_pos=10;}

    
    if($button_check->fields['products_quantity'] <= 0){
      if (SHOW_PRODUCTS_SOLD_OUT_IMAGE=='0') {
        $sould_out_tag = '<div class="sould-product-icon" style="top:'.$top_pos.'px;">'.BUTTON_SOLD_OUT_SMALL_ALT.'</div>';
      } else {
        $sould_out_tag = '<div class="sould-product-icon" style="top:'.$top_pos.'px;">'.zen_image_button(BUTTON_IMAGE_SOLD_OUT_SMALL, BUTTON_SOLD_OUT_SMALL_ALT).'</div>';
      }
	}
	else
	{
		$sould_out_tag='';	
	}
    return $sould_out_tag;	
 }
 