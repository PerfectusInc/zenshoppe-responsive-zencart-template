<?php
/**
 * Page Template - Featured Products listing
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_featured_products_default.php 2603 2005-12-19 20:22:08Z wilt $
 */
?>
<div class="centerColumn" id="featuredDefault">

<header>
	<h4 id="featuredDefaultHeading"><?php echo HEADING_TITLE; ?></h4>
</header>
<!-- Top Product Sorter -->
<?php
$gridlist_tab='';
   if (defined('PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER') and PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER == '1') {
    //echo '<div class="view-mode">' .  array(array('id'=>'rows','text'=>PRODUCT_LISTING_LAYOUT_ROWS),array('id'=>'columns','text'=>PRODUCT_LISTING_LAYOUT_COLUMNS))) . '</div>';
	 $gridlist_tab=mb_gridlist_tab(FILENAME_FEATURED_PRODUCTS);
  }
  ?>
<?php
  /**
   * require code to display the list-display-order dropdown
   */
  require($template->get_template_dir('/tpl_modules_listing_display_order.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_listing_display_order.php'); 
?>
<!-- Top Product Sorter Ends-->
<!-- Product List -->
<?php
/**
 * display the featured products
 */
require($template->get_template_dir('/tpl_modules_products_featured_listing.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_products_featured_listing.php'); ?>
<!-- Product List Ends -->
<!-- Bottom Pagination and button -->
<?php
  if (($featured_products_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div class="pageresult_bottom">
	<!-- Top Product Counts-->
	<div class="product-page-count">
		<?php
          if (($featured_products_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
        ?>
		<div id="featuredProductsListingTopNumber" class="navSplitPagesResult back"><?php echo $featured_products_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_FEATURED_PRODUCTS); ?>
        </div>
		<?php } ?>
	</div>
		<?php if($featured_products_split->number_of_pages > 1) { //to hide the pagination div if no. of pages < 1 ?>
		<div id="featuredProductsListingBottomLinks" class="navSplitPagesLinks forward pagination-style"><?php echo TEXT_RESULT_PAGE . ' ' . $featured_products_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></div>
		<?php
        } ?>
</div>     
   <?php
    }
    ?>
</div>