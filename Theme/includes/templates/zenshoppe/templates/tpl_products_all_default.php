<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_products_all_default.php 2603 2005-12-19 20:22:08Z wilt $
 */
?>
<div class="centerColumn" id="allProductsDefault">

<header>
	<h4 id="allProductsDefaultHeading"><?php echo HEADING_TITLE; ?></h4>
</header>
<!-- Top Product Sorter -->
<?php
$gridlist_tab='';
   if (defined('PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER') and PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER == '1') {
    //echo '<div class="view-mode">' .  array(array('id'=>'rows','text'=>PRODUCT_LISTING_LAYOUT_ROWS),array('id'=>'columns','text'=>PRODUCT_LISTING_LAYOUT_COLUMNS))) . '</div>';
	 $gridlist_tab=mb_gridlist_tab(FILENAME_PRODUCTS_ALL);
  }
require($template->get_template_dir('/tpl_modules_listing_display_order.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_listing_display_order.php'); ?>
<!-- Top Product Sorter -->
<!-- Product List -->
<?php
/**
 * display the new products
 */
require($template->get_template_dir('/tpl_modules_products_all_listing.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_products_all_listing.php'); ?>
<!-- Product List Ends -->
<!-- Bottom Pagination and button -->
<?php
  if (($products_all_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div class="pageresult_bottom">
	<!-- Top Product Counts-->
    <div class="product-page-count">
	<?php
  		if (($products_all_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
	?>
  		<div id="allProductsListingTopNumber" class="navSplitPagesResult back"><?php echo $products_all_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_ALL); ?></div>
 	<?php } ?>
    </div>
	<!-- Top Product Counts Ends-->
	<?php if($products_all_split->number_of_pages > 1) { //to hide the pagination div if no. of pages < 1 ?>
  	<div id="allProductsListingBottomLinks" class="navSplitPagesLinks forward pagination-style"><?php echo TEXT_RESULT_PAGE . ' ' . $products_all_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></div>
	<?php
        } ?>
</div>     
   <?php
    }
    ?>
</div>