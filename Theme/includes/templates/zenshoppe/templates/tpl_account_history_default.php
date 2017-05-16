<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_history.<br />
 * Displays all customers previous orders
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_history_default.php 2580 2005-12-16 07:31:21Z birdbrain $
 */
?>
<div class="centerColumn" id="accountHistoryDefault">
	<div class="account_history">
		<header>
			<h4><?php echo HEADING_TITLE; ?></h4>
		</header>
		<div class="content">
		<?php
          if ($accountHasHistory === true) {
            foreach ($accountHistory as $history) {
        ?>
			<h4><?php echo TEXT_ORDER_NUMBER . $history['orders_id']; ?></h4>
        	<div class="user-orderhistory">
				<?php echo TEXT_ORDER_STATUS . $history['orders_status_name']; ?>
    			<?php echo TEXT_ORDER_DATE . zen_date_long($history['date_purchased']) . '<br />' . $history['order_type'] . zen_output_string_protected($history['order_name']); ?>
    			<?php echo TEXT_ORDER_PRODUCTS . $history['product_count'] . '<br />' . TEXT_ORDER_COST . strip_tags($history['order_total']); ?>
            <br />
    		<div class="forward change_address">
				<?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'order_id=' . $history['orders_id'], 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_VIEW_SMALL, BUTTON_VIEW_SMALL_ALT) . '</a>'; ?>
            </div>
		</div>
		<?php
            }
        ?>
		<?php
          } else {
        ?>
		<?php echo TEXT_NO_PURCHASES; ?>
		<?php
          }
        ?>
	</div>
	<div class="next-prev">
    	<div class="row">
        <?php if($history_split->display_count(TEXT_DISPLAY_NUMBER_OF_ORDERS)!= NULL) { ?>
            <div class="navSplitPagesResult col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<?php echo $history_split->display_count(TEXT_DISPLAY_NUMBER_OF_ORDERS); ?>
            </div>
        <?php } ?>
            <div class="buttonRow forward change_address col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
            </div>
            <div class="navSplitPagesLinks forward pagination-style col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <?php echo TEXT_RESULT_PAGE . ' ' . $history_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?>
            </div>
    	</div>
	</div>
</div>
</div>