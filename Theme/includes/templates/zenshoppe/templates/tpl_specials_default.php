<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_specials_default.php 2958 2006-02-03 08:55:25Z birdbrain $
 */
?>
<div class="centerColumn" id="specialsListing">

<header>
	<h4 id="specialsListingHeading"><?php echo $breadcrumb->last(); ?></h4>
</header>
<!-- bof: specials -->
<?php
/**
 * require the list_box_content template to display the products
 */
  require($template->get_template_dir('tpl_columnar_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_columnar_display.php');
?>
<!-- eof: specials -->
<?php
  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div class="pageresult_bottom">
	<!-- Top Product Counts-->
    <div class="product-page-count">
		<div class="speciallisting_number_links special_bottomlinks">
			<div id="specialsListingBottomNumber" class="navSplitPagesResult back"><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?>
            </div>
    	</div>
   	</div>
	<?php if($specials_split->number_of_pages > 1) { //to hide the pagination div if no. of pages < 1 ?>
	<div id="specialsListingBottomLinks" class="navSplitPagesLinks forward pagination-style"><?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?>
    </div>
<?php
	} ?>
</div>    
<?php  } // split page
?>
</div>