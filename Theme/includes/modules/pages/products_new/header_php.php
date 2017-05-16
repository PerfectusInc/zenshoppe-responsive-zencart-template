<?php
/**
 * products_new header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 6912 2007-09-02 02:23:45Z drbyte $
 */

  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
  $breadcrumb->add(NAVBAR_TITLE);
// display order dropdown
  $disp_order_default = PRODUCT_NEW_LIST_SORT_DEFAULT;
  require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_LISTING_DISPLAY_ORDER));
  $products_new_array = array();
// display limits
//  $display_limit = zen_get_products_new_timelimit();
  $display_limit = zen_get_new_date_range();

// bof dynamic filter 1 of 1
  include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_DYNAMIC_FILTER));

  $listing_sql = "SELECT p.products_id, p.products_type, pd.products_name, p.products_image, p.products_price,
                                    p.products_tax_class_id, p.products_date_added, m.manufacturers_name, p.products_model,
                                    p.products_quantity, p.products_weight, p.product_is_call,
                                    p.product_is_always_free_shipping, p.products_qty_box_status,
                                    p.master_categories_id, m.manufacturers_id";
									
  $listing_sql .= " FROM " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on (p.manufacturers_id = m.manufacturers_id)" .
   " left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id" .
   " left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id" .
   ($filter_attr == true ? " join " . TABLE_PRODUCTS_ATTRIBUTES . " p2a on p.products_id = p2a.products_id" .
   " join " . TABLE_PRODUCTS_OPTIONS . " po on p2a.options_id = po.products_options_id" .
   " join " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov on p2a.options_values_id = pov.products_options_values_id" .
   (defined('TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK') ? " join " . TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK . " p2as on p.products_id = p2as.products_id " : "") : '');
   
  $listing_sql .= " WHERE p.products_status = 1 AND pd.language_id = :languageID " .
   $display_limit . $filter . " GROUP BY p.products_id " . $having . $order_by;

  $listing_sql = $db->bindVars($listing_sql, ':languageID', $_SESSION['languages_id'], 'integer');
  $products_new_split = new splitPageResults($listing_sql, MAX_DISPLAY_PRODUCTS_NEW);
// eof dynamic filter 1 of 1

//check to see if we are in normal mode ... not showcase, not maintenance, etc
  $show_submit = zen_run_normal();

// check whether to use multiple-add-to-cart, and whether top or bottom buttons are displayed
  if (PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART > 0 and $show_submit == true and $products_new_split->number_of_rows > 0) {

    // check how many rows
    $check_products_all = $db->Execute($products_new_split->sql_query);
    $how_many = 0;
    while (!$check_products_all->EOF) {
      if (zen_has_product_attributes($check_products_all->fields['products_id'])) {
      } else {
// needs a better check v1.3.1
        if ($check_products_all->fields['products_qty_box_status'] != 0) {
          if (zen_get_products_allow_add_to_cart($check_products_all->fields['products_id']) !='N') {
            if ($check_products_all->fields['product_is_call'] == 0) {
              if ((SHOW_PRODUCTS_SOLD_OUT_IMAGE == 1 and $check_products_all->fields['products_quantity'] > 0) or SHOW_PRODUCTS_SOLD_OUT_IMAGE == 0) {
                if ($check_products_all->fields['products_type'] != 3) {
                  if (zen_has_product_attributes($check_products_all->fields['products_id']) < 1) {
                    $how_many++;
                  }
                }
              }
            }
          }
        }
      }
      $check_products_all->MoveNext();
    }

    if ( (($how_many > 0 and $show_submit == true and $products_new_split->number_of_rows > 0) and (PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART == 1 or  PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART == 3)) ) {
      $show_top_submit_button = true;
    } else {
      $show_top_submit_button = false;
    }
    if ( (($how_many > 0 and $show_submit == true and $products_new_split->number_of_rows > 0) and (PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART >= 2)) ) {
      $show_bottom_submit_button = true;
    } else {
      $show_bottom_submit_button = false;
    }
  }
?>