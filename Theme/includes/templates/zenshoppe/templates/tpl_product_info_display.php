<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=product_info.<br />
 * Displays details of a typical product
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_product_info_display.php 19690 2011-10-04 16:41:45Z drbyte $
 */
 //require(DIR_WS_MODULES . '/debug_blocks/product_info_prices.php');
?>
<div class="centerColumn" id="productGeneral">

<!--bof Form start-->
<?php echo zen_draw_form('cart_quantity', zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('action')) . 'action=add_product', $request_type), 'post', 'enctype="multipart/form-data"') . "\n"; ?>
<!--eof Form start-->

<?php if ($messageStack->size('product_info') > 0) echo $messageStack->output('product_info'); ?>

<!--bof Category Icon -->
<?php if ($module_show_categories != 0) {?>
<?php
/**
 * display the category icons
 */


//require($template->get_template_dir('/tpl_modules_category_icon_display.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_category_icon_display.php'); ?>
<header>
	<h4 class="product_head">
    	
		<?php echo $products_name; ?>

		<span class="product-next-prev">
			<?php if (PRODUCT_INFO_PREVIOUS_NEXT == 1 or PRODUCT_INFO_PREVIOUS_NEXT == 3) { 
                    if ($products_found_count > 1) {
                ?>
                    <div class="navNextPrevList"><a data-toggle="tooltip" data-original-title="Previous Product" href="<?php echo zen_href_link(zen_get_info_page($previous), "cPath=$cPath&products_id=$previous"); ?>"><?php echo $previous_image . $previous_button; ?></a></div>
            <?php } 
                }
            ?>
            <?php if (PRODUCT_INFO_PREVIOUS_NEXT == 1 or PRODUCT_INFO_PREVIOUS_NEXT == 3) { 
                    if ($products_found_count > 1) {
                ?>
                    <div class="navNextPrevList"><a data-toggle="tooltip" data-original-title="Next Product" href="<?php echo zen_href_link(zen_get_info_page($next_item), "cPath=$cPath&products_id=$next_item"); ?>"><?php echo  $next_item_button . $next_item_image; ?></a></div>
            <?php } 
                }
            ?>
		</span>
    </h4>
		<?php } ?>
</header>
<!--eof Category Icon -->

<!--bof Main Product Image -->
<?php
  if (zen_not_null($products_image)) {
  ?>
  
<div class="product_info">
	<div class="row productinfo-container">
		<div class="productinfo-leftwrapper col-md-4 col-sm-5 col-xs-12">
			<div class="product_image">
				<?php
				/**
 				* display the main product image
 				*/
   					require($template->get_template_dir('/tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_main_product_image.php'); ?>
				<?php
  					}
				?>
			</div><!--eof product image -->
            <!--bof product additional images--><?php
				/**
				 * display the products additional images
				 */
  					require($template->get_template_dir('/tpl_modules_additional_images.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_additional_images.php'); ?>
            <!--eof product additional images-->
	    </div> <!--eof Product_info left wrapper -->
        <div id="product_info_display" class="col-md-8 col-sm-7 col-xs-12 productinfo-rightwrapper"> 
            <!--<div class="product_title">
            	<h1 id="productName" class="productGeneral"><?php //echo $products_name; ?></h1>
            </div>-->
            <!--eof Product Name-->
            <div class="desc-info">
            	<div class="desc-info-details">
                    <div class="product_description">
                        <?php 
                            $products_description_short = ltrim(substr($products_description, 0, 350) . '..'); //Trims and Limits the desc
                        ?>
                        <h4>Quick Overview</h4>
                        <p><?php echo stripslashes($products_description_short); ?></p>
                    </div>
                    <div class="product_quantity">
                        <?php if ( (($flag_show_product_info_model == 1 and $products_model != '') or ($flag_show_product_info_weight == 1 and $products_weight !=0) or 
                                ($flag_show_product_info_quantity == 1) or ($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name))) ) { ?>
                            <h4>Additional Information</h4>
                            <ul id="productDetailsList" class="floatingBox">
                                <?php echo (($flag_show_product_info_model == 1 and $products_model !='') ? '<li>' . TEXT_PRODUCT_MODEL . $products_model . '</li>' : '') . "\n"; ?>
                                <?php echo (($flag_show_product_info_weight == 1 and $products_weight !=0) ? '<li>' . TEXT_PRODUCT_WEIGHT .  $products_weight . TEXT_PRODUCT_WEIGHT_UNIT . 
                                    '</li>'  : '') . "\n"; ?>
                                <?php echo (($flag_show_product_info_quantity == 1) ? '<li><span class="units">' . $products_quantity . TEXT_PRODUCT_QUANTITY . '</span></li>'  : '') . "\n"; ?>
                                <?php echo (($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name)) ? '<li><span class="units">' . TEXT_PRODUCT_MANUFACTURER . 
                                    $manufacturers_name . '</span></li>' : '') . "\n"; ?>
                            </ul>
                           <?php } ?>
                    </div>
				</div>
			</div>
            <!--bof Product Price block -->
            <div class="product_price">
            	<!--<strong>Price :</strong>-->
                <div class="productprice-amount" style="display:inline-block">
                	<?php
                    	// base price
                        if ($show_onetime_charges_description == 'true') {
                           	$one_time = '<span >' . TEXT_ONETIME_CHARGE_SYMBOL . TEXT_ONETIME_CHARGE_DESCRIPTION . '</span><br />';
						} else {
                        	$one_time = '';
                      	}
                        echo $one_time . ((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? '' : '') . zen_get_products_display_price((int)$_GET['products_id']);
                   	?>
               	</div>
                <!--eof Product Price block -->
    		</div>
             <!--bof Attributes Module -->
            <?php
              if ($pr_attr->fields['total'] > 0) {
            ?>
            <?php
            /**
             * display the product atributes
             */
              require($template->get_template_dir('/tpl_modules_attributes.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_attributes.php'); ?>
            <?php
              }
            ?>
            <!--eof Attributes Module -->
    	    
            <!--bof free ship icon  -->
			<?php if(zen_get_product_is_always_free_shipping($products_id_current) && $flag_show_product_info_free_shipping) { ?>
            <div id="freeShippingIcon"><?php echo TEXT_PRODUCT_FREE_SHIPPING_ICON; ?></div>
            <?php } ?>
            <!--eof free ship icon  -->
            
            <!--bof Add to Cart Box -->
           
            <?php
            if (CUSTOMERS_APPROVAL == 3 and TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM == '') {
              // do nothing
            } else {
            ?>
            <?php
                //$display_qty = (($flag_show_product_info_in_cart_qty == 1 and $_SESSION['cart']->in_cart($_GET['products_id'])) ? '<p>' . PRODUCTS_ORDER_QTY_TEXT_IN_CART . $_SESSION['cart']->get_quantity($_GET['products_id']) . '</p>' : '');
            	if ($products_qty_box_status == 0 or $products_quantity_order_max== 1) {
                	// hide the quantity box and default to 1
                    $the_button = '<input type="hidden" name="cart_quantity" value="1" />' . zen_draw_hidden_field('products_id', (int)$_GET['products_id']) . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT);
                } else {
                		// show the quantity box
                          
                        $quantity = str_replace("Add to cart","Qty ","Add to cart:");
                		$the_button = '<strong>' . $quantity . '</strong><input type="text" class="quantity-input" name="cart_quantity" value="' . (zen_get_buy_now_qty($_GET['products_id'])) . '" maxlength="6" size="4" /><div class="sp-plus fff"><span class="ddd"><i class="fa fa-angle-up"></i></span></div><div class="sp-minus fff"> <span class="ddd minus"><i class="fa fa-angle-down"></i></span></div><br />' . zen_get_products_quantity_min_units_display((int)$_GET['products_id']) . zen_draw_hidden_field('products_id', (int)$_GET['products_id']);
                        }
                $display_button = zen_get_buy_now_button($_GET['products_id'], $the_button);
				
              ?>
              <?php if ($display_qty != '' or $display_button != '') { ?>
    		<div class="addtocart-info">
    			<div class="cart_quantity">
    				<?php
      					//echo $products_quantity;
	   					echo $display_button;
						//echo $products_qty_box_status;
	   				?>
				</div>
                <?php if ($products_quantity != 0) {?>
				<div class="cart_button">
    				<?php
     					echo zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT);
            		?>
    			</div>
                <?php } ?>
                <div class="prodinfo-actions">
					<?php
                    if (UN_MODULE_WISHLISTS_ENABLED) { $wishlist_link= '<div class="wish_link"><a data-toggle="tooltip" data-original-title="Add to Wishlist" class="wishlink" href="' . zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $_GET['products_id'] . '&action=wishlist_add_product') . '"><i class="fa fa-heart-o fa-lg"></i></a></div><div class="compare_link"><a class="addtocompare" data-toggle="tooltip" data-original-title="Add to Compare" href="javascript: compareNew('.$_GET['products_id'].', \'add\')"><i class="fa fa-files-o fa-lg"></i></a></div>';}else{ $wishlist_link='';}
                    echo $wishlist_link;
                    ?>
				</div>
       		</div>
  					<?php } // display qty and button ?>
				<?php } // CUSTOMERS_APPROVAL == 3 ?>
				<!--eof Add to Cart Box-->
			<?php
              //}
            ?>
			<!--eof Product details list -->
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
			<div class="addthis_sharing_toolbox"></div>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5182608131868df1" async></script>
            <!-- AddThis Button END -->
		</div>
	</div>
</div><!-- eof product_info -->





<!--bof Quantity Discounts table -->
<?php
  if ($products_discount_type != 0) { ?>
<?php
/**
 * display the products quantity discount
 */
 require($template->get_template_dir('/tpl_modules_products_quantity_discounts.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_products_quantity_discounts.php'); ?>
<?php
  }
?>
<!--eof Quantity Discounts table -->
<div class="product_info_tab">
	<ul class="tabs">
    	<li><a href="#" rel="description">Description</a></li>
        <li><a href="#" rel="reviews">Reviews</a></li>
    </ul>
    <div class="tabcontents">
    	<div id="description" class="tabcontent">
        	<p><?php echo stripslashes($products_description); ?></p>
        </div>
        <div id="reviews" class="tabcontent">
        	<?php
  				if ($flag_show_product_info_reviews == 1) { 
    		// if more than 0 reviews, then show reviews button; otherwise, show the "write review" button ?>
				<!--<div class="contentText accordian-content">-->
    				<?php if ($reviews->fields['count'] > 0 ) { ?>
						<div id="productReviewLink" class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS, zen_get_all_get_params()) . '">' . 						
							/*zen_image_button(BUTTON_IMAGE_REVIEWS, BUTTON_REVIEWS_ALT) */ 'Go to the Reviews Page' . '</a>'; ?>
                        </div>
						<p class="reviewCount"><?php echo ($flag_show_product_info_reviews_count == 1 ? TEXT_CURRENT_REVIEWS . ' ' . $reviews->fields['count'] : ''); ?></p>
					<?php } else { ?>
						<div id="productReviewLink" class="buttonRow back">There are no reviews for this product. <br/><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array())) . '">' . zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>'; ?>
                        </div>
					<?php
                      } ?>
  				<!--</div>-->
			<?php }
            ?>
        </div>
    </div>
</div>
		<?php require($template->get_template_dir('tpl_modules_also_purchased_products.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_also_purchased_products.php');?>
<!--eof also purchased products module-->
<!--bof Prev/Next bottom position -->
<?php if (PRODUCT_INFO_PREVIOUS_NEXT == 2 or PRODUCT_INFO_PREVIOUS_NEXT == 3) { ?>
<?php
/**
 * display the product previous/next helper
 */
 require($template->get_template_dir('/tpl_products_next_previous.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_products_next_previous.php'); ?>
<?php } ?>
<!--eof Prev/Next bottom position -->

<!--bof Product date added/available-->
<?php
 /* if ($products_date_available > date('Y-m-d H:i:s')) {
    if ($flag_show_product_info_date_available == 1) {
?>
  <p id="productDateAvailable" class="productGeneral centeredContent"><?php echo sprintf(TEXT_DATE_AVAILABLE, zen_date_long($products_date_available)); ?></p>
<?php
    }
  } else {
    if ($flag_show_product_info_date_added == 1) {
?>
      <p id="productDateAdded" class="productGeneral centeredContent"><?php echo sprintf(TEXT_DATE_ADDED, zen_date_long($products_date_added)); ?></p>
<?php
    } // $flag_show_product_info_date_added
  } */
?>
<!--eof Product date added/available -->

<!--bof Product URL -->
<?php /*?><?php
  if (zen_not_null($products_url)) {
    if ($flag_show_product_info_url == 1) {
?>
    <p id="productInfoLink" class="productGeneral centeredContent"><?php echo sprintf(TEXT_MORE_INFORMATION, zen_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($products_url), 'NONSSL', true, false)); ?></p>
<?php
    } // $flag_show_product_info_url
  }
?><?php */?>
<!--eof Product URL -->

<!--bof Form close-->
</form>
<!--bof Form close-->
 
</div>