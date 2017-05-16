<?php
/**
 * Page Template
 *
 * Loaded by main_page=index<br />
 * Displays category/sub-category listing<br />
 * Uses tpl_index_category_row.php to render individual items
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_index_categories.php 4678 2006-10-05 21:02:50Z ajeh $
 */
?>
<div class="centerColumn" id="indexCategories">
	<header>
		<h4 id="indexCategoriesHeading"><?php echo $breadcrumb->last(); ?></h4>
	</header>
<?php
/*if (PRODUCT_LIST_CATEGORIES_IMAGE_STATUS_TOP == 'true') {
// categories_image
  if ($categories_image = zen_get_categories_image($current_category_id)) {
?>
<div id="categoryImgListing" class="categoryImg"><?php echo zen_image(DIR_WS_IMAGES . $categories_image, '', SUBCATEGORY_IMAGE_TOP_WIDTH, SUBCATEGORY_IMAGE_TOP_HEIGHT); ?></div>
<?php
  }
}*/ // categories_image
?>

<?php
// categories_description
    if ($current_categories_description != '') {
?>
<div id="categoryDescription" class="catDescContent"><?php echo $current_categories_description;  ?></div>
<?php } // categories_description ?>
<!-- BOF: Display grid of available sub-categories, if any -->
<!-- hsyong remove categories thumbnails -->
<!-- EOF: Display grid of available sub-categories -->
<?php
$show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_CATEGORY);

while (!$show_display_category->EOF) {
  // //  echo 'I found ' . zen_get_module_directory(FILENAME_UPCOMING_PRODUCTS);

?>

<?php //if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_CATEGORY_FEATURED_PRODUCTS') { ?>
<?php
/**
 * display the Featured Products Center Box
 */
?>
<?php //require($template->get_template_dir('tpl_modules_featured_products.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_products.php'); ?>
<?php //} ?>

<?php if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_CATEGORY_SPECIALS_PRODUCTS') { ?>
<?php
/**
 * display the Special Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_specials_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_specials_default.php'); ?>
<?php } ?>

<?php //if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_CATEGORY_NEW_PRODUCTS') { ?>
<?php
/**
 * display the New Products Center Box
 */
?>
<?php //require($template->get_template_dir('tpl_modules_whats_new.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_whats_new.php'); ?>
<?php //} ?>

<?php //if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_CATEGORY_UPCOMING') { ?>
<?php //include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_PRODUCTS)); ?><?php //} ?>
<?php
  $show_display_category->MoveNext();
} // !EOF
?>
</div>
