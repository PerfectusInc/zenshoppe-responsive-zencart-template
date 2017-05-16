<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_product_listing.php 3241 2006-03-22 04:27:27Z ajeh $
 * UPDATED TO WORK WITH COLUMNAR PRODUCT LISTING 04/04/2006
 * Modified for admin control of customer option by Glenn Herbert (gjh42) 2012-09-21   2012-11-17 grid sorter
 */
 include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING));
?>
<div id="productListing">

<?php
/**
 * load the list_box_content template to display the products
 */
require($template->get_template_dir('tpl_zenshoppe_productlisting.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_zenshoppe_productlisting.php');

?>
<!-- Bottom Pagination and button -->
    <?php /*?><div id="newProductsDefaultListingBottomNumber" class="navSplitPagesResult back"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></div><?php */?>
<?php
  if (($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div class="pageresult_bottom">
  <!-- Top Product Counts-->
  <div class="product-page-count">
<?php
  if (($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div id="newProductsDefaultListingTopNumber" class="navSplitPagesResult back"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></div>
<?php } ?>
<!-- Top Product Counts Ends-->
<?php if($listing_split->number_of_pages > 1) { //to hide the pagination div if no. of pages < 1 ?>
  <div id="newProductsDefaultListingBottomLinks" class="navSplitPagesLinks forward pagination-style"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></div>
<?php
  } ?>
</div>
</div>
<?php  }
?>

<?php
// if ($show_top_submit_button == true or $show_bottom_submit_button == true or (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0 and $show_submit == true and $listing_split->number_of_rows > 0)) {
  if ($show_top_submit_button == true or $show_bottom_submit_button == true) {
?>
</form>
<?php } ?>
</div>