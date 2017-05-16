<?php
/**
 * Specials
 *
 * @package page
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: main_template_vars.php 2011-01-28 5:23:52MT brit (docreativedesign.com) $
 */

if (!empty($_SESSION['compare'])) {
    $compare_info = array();
    $result       = array();
    $comp         = 1;
    $action       = $_GET['remove'];

    if ($action > 0) {
        $removed_compare_array = array();
        foreach ($_SESSION['compare'] as $value) {
            if ($value != $action) {
                 $removed_compare_array[] = $value;
            }
            $_SESSION['compare'] = $removed_compare_array;
        }
    }

    // loop session for products
    foreach ($_SESSION['compare'] as $value) {
        if (!empty($value)) {
            $products_compare_query = "SELECT p.products_id, p.products_image, pd.products_name,
                                              p.master_categories_id, pd.products_description, p.products_price,
                                              p.products_model, p.products_weight, p.products_quantity, p.manufacturers_id
                                       FROM " . TABLE_PRODUCTS . " p
                                       LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd
                                       ON p.products_id = pd.products_id
                                       WHERE p.products_status = '1'
                                       AND p.products_id='".$value."'
                                       AND pd.language_id='".(int)$_SESSION['languages_id']."'";

            $products_compare = $db->Execute($products_compare_query);
            $products_manufacturer = $db->Execute(
                "SELECT manufacturers_name FROM " . TABLE_MANUFACTURERS . "
                 WHERE manufacturers_id='".$products_compare->fields['manufacturers_id']."'"
            );
      
            $products_name = '<h1 class="productGeneral">'.'<a href="' . zen_href_link(zen_get_info_page($products_compare->fields['products_id']), 'cPath=' . (zen_get_generated_category_path_rev($products_compare->fields['master_categories_id'])) . '&products_id=' . $products_compare->fields['products_id']) . '">'.$products_compare->fields['products_name'].'</a>'.'</h1>';
            $products_image = '<div class="compareImage">'.'<a href="' . zen_href_link(zen_get_info_page($products_compare->fields['products_id']), 'cPath=' . (zen_get_generated_category_path_rev($products_compare->fields['master_categories_id'])) . '&products_id=' . $products_compare->fields['products_id']) . '">' . zen_image(DIR_WS_IMAGES . $products_compare->fields['products_image'], $products_compare->fields['products_name'], IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT, 'class="listingProductImage"') . '</a>'.'</div>';
            $products_description = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($products_compare->fields['products_id'], $_SESSION['languages_id']))), COMPARE_DESCRIPTION);
            $products_model = $products_compare->fields['products_model'];
            $producst_weight = $products_compare->fields['products_weight'];
            $products_quantity = $products_compare->fields['products_quantity'];
            $products_price = ((zen_has_product_attributes_values($products_compare->fields['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . zen_get_products_display_price($products_compare->fields['products_id']);
            $products_manufacturer = $products_manufacturer->fields['manufacturers_name'];
            $products_remove = '<a href="index.php?main_page=compare&remove='.$products_compare->fields['products_id'].'" alt="remove" data-original-title="Remove" data-toggle="tooltip" class="compare_remove">'.'<i class="fa fa-times fa-lg"></i>'
.'</a>';
			$addtocart = zen_get_buy_now_button($products_compare->fields['products_id'],'<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products_compare->fields['products_id']) . '"><button class="button" type="button"><span> '.COMPARE_BUTTON_ADD_TO_CART.' </span></button></a>');
      
            $compare_info = array($products_name, $products_image, $products_description, $products_model, $producst_weight, $products_quantity, $products_price, $products_manufacturer, $products_remove, $addtocart);
            $new_comp_result = array('pro'.$comp => $compare_info);

            $result = array_merge($result, $new_comp_result);

        } else {
            echo '<div>Value was empty, something went wrong with the array</div>';
        }
        $comp++;
    }
}

require($template->get_template_dir('tpl_compare_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_compare_default.php');
?>