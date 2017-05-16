<?php
/**
 * mb_ajax_compare.php
 * ajax call to show products selected for comparison
 *
 * @package general
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: trg_ajax_compare.php 00001 2011-01-28 5:23:52MT brit (docreativedesign.com) $
 */
 
require('includes/application_top.php');
include(DIR_WS_LANGUAGES . $_SESSION['language'].'/'.FILENAME_DEFINE_COMPARE_LANGUAGE);

// get values
$action = $_POST['com_action'];
$selected = $_POST['compare_id'];
$compare_array = array();
$comp_images = '';
$compare_warning = '';

$comp_value_count = count($_SESSION['compare']);
// add new products selected
if ($action == 'add') {
    if ($comp_value_count < COMPARE_VALUE_COUNT) {
        $compare_array[] = $selected;
        foreach ($_SESSION['compare'] as $c) {
            if ($c != $selected) {
                $compare_array[] = $c;
            }
        }
        $_SESSION['compare'] = array_unique($compare_array);
		$compare_warning = 'The product has been added in compare list.';
    } else {
        $compare_warning = 'Only ' . COMPARE_VALUE_COUNT  . ' items can be compared at one time';
    }
} 

// remove products
if ($action == 'remove') {
    foreach ($_SESSION['compare'] as $rValue) {
        if ($rValue != $selected) {
            $removed_compare_array[] = $rValue;
        }
        $_SESSION['compare'] = array_unique($removed_compare_array);
    }
}

// return new value for the session

foreach ($_SESSION['compare'] as $value) {
    if (!empty($value)) {
        $product_comp_image = $db->Execute(
            "SELECT p.products_id, p.master_categories_id, pd.products_name, p.products_image
             FROM " . TABLE_PRODUCTS . " p
             LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd
             ON pd.products_id=p.products_id
             WHERE p.products_id='".$value."'"
        );
        $comp_images .= '<li class="compareAdded"><span class="com_left"><a href="' . zen_href_link(zen_get_info_page($product_comp_image->fields['products_id']), 'cPath=' . (zen_get_generated_category_path_rev($product_comp_image->fields['master_categories_id'])) . '&products_id=' . $product_comp_image->fields['products_id']) . '">' . zen_image(DIR_WS_IMAGES . $product_comp_image->fields['products_image'], $product_comp_image->fields['products_name'],'35','class="listingProductImage"') . '</a></span><span class="com_right">'.'<span class="com_prod_name">'.$product_comp_image->fields['products_name'].'</span><span class="rmv_btn"><a onclick="javascript: compareNew('.$product_comp_image->fields['products_id'].', \'remove\')" alt="remove">'.COMPARE_REMOVE.'</a></span><li>';
    }
}

// return HTML view of found products
if(isset($_POST['com_action'])&& isset($_POST['compare_id']) && isset($_POST['msg']))
{
	echo $compare_warning;

}else{
	if (!empty($comp_images)) {
    echo '<ul id="compareMainWrapper">'.$comp_images.'<li class="compareAdded compareButton">'.'<a href="index.php?main_page=compare" alt="compare">'.'<span class="button">'.COMPARE_DEFAULT.'</span></a></li></ul>';
	}
}

// send back warning if more than allowed is selected

require('includes/application_bottom.php');
?>