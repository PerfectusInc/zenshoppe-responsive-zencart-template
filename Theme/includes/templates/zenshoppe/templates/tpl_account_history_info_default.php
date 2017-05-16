<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_edit.<br />
 * Displays information related to a single specific order
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_history_info_default.php 19103 2011-07-13 18:10:46Z wilt $
 */
?>
<div class="centerColumn" id="accountHistInfo">
	<header>
		<h4><?php echo HEADING_ORDER_DATE . ' ' . zen_date_long($order->info['date_purchased']); ?></h4>
	</header>
	<div class="content">
    	<div class="table-responsive">
            <table border="0" width="100%" cellspacing="0" cellpadding="0" class="table table-hover">
                <caption>
                    <h4>
                    	<?php echo HEADING_TITLE . ORDER_HEADING_DIVIDER . sprintf(HEADING_ORDER_NUMBER, $_GET['order_id']); ?>
                    </h4>
                </caption>
                <tr class="tableHeading">
                    <th scope="col" id="myAccountQuantity"><?php echo HEADING_QUANTITY; ?></th>
                    <th scope="col" id="myAccountProducts"><?php echo HEADING_PRODUCTS; ?></th>
                    <?php
                      if (sizeof($order->info['tax_groups']) > 1) {
                    ?>
                    <th scope="col" id="myAccountTax"><?php echo HEADING_TAX; ?></th>
                    <?php
                     }
                    ?>
                    <th scope="col" id="myAccountTotal"><?php echo HEADING_TOTAL; ?></th>
                 </tr>
                <?php
                  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
                ?>
                <tr class="user-accounthistory">
                    <td class="accountQuantityDisplay"><?php echo  $order->products[$i]['qty'] //. QUANTITY_SUFFIX; ?></td>
                    <td class="accountProductDisplay"><?php echo  $order->products[$i]['name'];
                    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
                        echo '<ul id="orderAttribsList">';
                            for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
                                echo '<li>' . $order->products[$i]['attributes'][$j]['option'] . TEXT_OPTION_DIVIDER . nl2br(zen_output_string_protected($order->products[$i]['attributes'][$j]['value'])) . '</li>';
                          }
                            echo '</ul>';
                        }
                    ?>
                    </td>
                    <?php
                        if (sizeof($order->info['tax_groups']) > 1) {
                    ?>
                    <td class="accountTaxDisplay"><?php echo zen_display_tax_value($order->products[$i]['tax']) . '%' ?></td>
                    <?php
                        }
                    ?>
                    <td class="accountTotalDisplay">
                    <?php 
                        $ppe = zen_round(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']), $currencies->get_decimal_places($order->info['currency']));
                        $ppt = $ppe * $order->products[$i]['qty']; 
            //        echo $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') 
                        echo $currencies->format($ppt, true, $order->info['currency'], $order->info['currency_value']) . ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : ''); 
            ?>
                    </td>
                </tr>
                <?php
                  }
                ?>
            </table>
		</div>
        <div id="orderTotals">
			<?php
              for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {
            ?>
             <div class="lineTitle larger forward"><?php echo $order->totals[$i]['title'] ?></div>
             <div class="amount larger forward"><?php echo $order->totals[$i]['text'] ?></div>
        	<br class="clearBoth" />
			<?php
              }
            ?>
        </div>
	</div>

	<?php
    /**
     * Used to display any downloads associated with the cutomers account
     */
      if (DOWNLOAD_ENABLED == 'true') require($template->get_template_dir('tpl_modules_downloads.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_downloads.php');
    ?>

	<?php
    /**
     * Used to loop thru and display order status information
     */
    if (sizeof($statusArray)) {
    ?>
	<div class="content">
    	<div class="table-responsive">
			<table class="table table-hover" border="0" width="100%" cellspacing="0" cellpadding="0" id="myAccountOrdersStatus">
				<caption>
                	<h4><?php echo HEADING_ORDER_HISTORY; ?></h4>
                </caption>
    			<tr class="tableHeading">
                	<th scope="col" id="myAccountStatusDate"><?php echo TABLE_HEADING_STATUS_DATE; ?></th>
                	<th scope="col" id="myAccountStatus"><?php echo TABLE_HEADING_STATUS_ORDER_STATUS; ?></th>
                	<th scope="col" id="myAccountStatusComments"><?php echo TABLE_HEADING_STATUS_COMMENTS; ?></th>
       			</tr>
				<?php
                  foreach ($statusArray as $statuses) {
                ?>
                <tr class="user-accounthistory">
                    <td><?php echo zen_date_short($statuses['date_added']); ?></td>
                    <td><?php echo $statuses['orders_status_name']; ?></td>
                    <td><?php echo (empty($statuses['comments']) ? '&nbsp;' : nl2br(zen_output_string_protected($statuses['comments']))); ?></td> 
                 </tr>
				<?php
                  }
                ?>
			</table>
		</div>
	</div>
	<?php } ?>
	<div class="content">
		<div class="row accountinformation">
			<div id="myAccountShipInfo" class="floatingBox back">
				<?php
                  if ($order->delivery != false) {
                ?>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 shipinfo-delivery-address">
                	<h4><?php echo HEADING_DELIVERY_ADDRESS; ?></h4>
					<address><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'); ?></address>
				</div>
				<?php
                  }
                ?>
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 shipinfo-billing-address">
                	<h4><?php echo HEADING_BILLING_ADDRESS; ?></h4>
					<address><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'); ?></address>
                </div>
            </div>
        </div>
        <div class="row accountinformation">
        	<div id="myAccountShipInfo" class="floatingBox back">
				<?php
                    if (zen_not_null($order->info['shipping_method'])) {
                ?>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 shipinfo-shipping-method">
                    	<h4><?php echo HEADING_SHIPPING_METHOD; ?></h4>
						<?php echo $order->info['shipping_method']; ?>
                    </div>
				<?php } else { // temporary just remove these 4 lines ?>
                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 alert alert-danger">WARNING: Missing Shipping Information</div>
                <?php
                    }
                ?>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 shipinfo-payment-method">
						<h4><?php echo HEADING_PAYMENT_METHOD; ?></h4>
						<?php echo $order->info['payment_method']; ?>
                    </div>
			</div>
		</div>
	</div>
	<div class="buttonRow forward change_address">
		<?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
    </div>
</div>