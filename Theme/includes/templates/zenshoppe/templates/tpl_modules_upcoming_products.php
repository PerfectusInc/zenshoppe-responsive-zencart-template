<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_upcoming_products.php 6422 2007-05-31 00:51:40Z ajeh $
 */
?>
<!-- bof: upcoming_products -->
<div class="centerBoxWrapper" id="upcomingProducts">
    <div id="upcoming-slider" class="owl-carousel owl-theme">
<?php
	$msg = "<span class='label-upcoming' title=''>Coming Soon</span>";
    for($i=0; $i < sizeof($expectedItems); $i++) { 
		$product_description = $expectedItems[$i]['products_description'];
		$product_description = ltrim(substr($product_description, 0, 250) . '..'); //Trims and Limits the desc
	?>
    <div class="item centerBoxContentsUpcoming centeredContent back">
    <div class="productinfo-wrapper">
    	<div class="row">
            <div class="col-lg-5">
            	<div class="product_image">
                	<?php echo  $msg . '<a href="' . zen_href_link(zen_get_info_page($expectedItems[$i]['products_id']), 'cPath=' . $productsInCategory[$expectedItems[$i]['products_id']] . '&products_id=' . $expectedItems[$i]['products_id']) . '">' . zen_image(DIR_WS_IMAGES . $expectedItems[$i]['products_image'], $expectedItems[$i]['products_name'], IMAGE_PRODUCT_NEW_WIDTH, IMAGE_PRODUCT_NEW_HEIGHT) . '</a>' ; ?>
            	</div>
           	</div>
            <div class="col-lg-7">
                <div class="product-name-desc">
                    <div class="product_name">
                        <?php
              echo '<a href="' . zen_href_link(zen_get_info_page($expectedItems[$i]['products_id']), 'cPath=' . $productsInCategory[$expectedItems[$i]['products_id']] . '&products_id=' . $expectedItems[$i]['products_id']) . '">' . $expectedItems[$i]['products_name'] . '</a>'; 
			  ?>
                    </div>
                    <div class="product_description">
                    	<p><?php echo $product_description; ?>
                    </div>
                    <div class="product_price">
                        <?php $products_price = zen_get_products_display_price($expectedItems[$i]['products_id']); 
                            if($products_price==NULL){ $products_price = 'Price Coming Soon';}
                        ?>
                        <?php echo $products_price;?>
                    </div>
                </div>
                <div class="expected-date">
                    <div class="product-date">
                        <?php echo 'Date Expected : ' . zen_date_short($expectedItems[$i]['date_expected']); ?>
                    </div>
                </div>
    		</div>
    	</div>
    </div>
    </div>
	  <?php
    }
?>
	</div>
</div>
<!-- eof: upcoming_products -->
