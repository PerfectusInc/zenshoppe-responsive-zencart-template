<div id="wishlist"> <!-- begin wishlist id for styling -->
<header>
	<h4><?php echo HEADING_TITLE . UN_LABEL_DELIMITER . $wishlist->fields['name']; ?></h4>
</header>
<p><?php echo TEXT_DESCRIPTION; ?></p>

<?php 
if ( $messageStack->size('wishlist') > 0 ) { 
	echo $messageStack->output('wishlist'); 
}
?>



<!-- control -->

<!-- product listing -->
<?php
if ($listing_split->number_of_rows > 0) {
	$rows = 0;
	$products = $db->Execute($listing_split->sql_query);
	while (!$products->EOF) {
		echo zen_draw_form('cart_quantity', zen_href_link(UN_FILENAME_WISHLIST, zen_get_all_get_params(array('action'), 'SSL') . 'action=add_product'));
		echo zen_hide_session_id();
		echo zen_draw_hidden_field('layout', isset($_REQUEST['layout'])? $_REQUEST['layout']: '');
		if ( $rows & 1 ) {
			$tdclass = 'even';
		} else {
			$tdclass = 'odd';
		}
		$products_price = zen_get_products_display_price($products->fields['products_id']);
		$attributes_stored = $oWishlist->wishlist_get_attributes($products->fields['products_id']);
		if (is_array($attributes_stored)) { 
			foreach ($attributes_stored as $option => $value){
			echo '<input type="hidden" name="id[' . $option . ']" value="' . $value . '">';
				}	
		}
		
?>

		<div class="wishlist<?php echo (!un_is_empty($tdclass)? '-'.$tdclass: ''); ?>">
		
		<!-- buttons -->
		<?php //echo '<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products->fields['products_id']) . '" title="'.BUTTON_IN_CART_ALT.'">' . zen_image_button(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT, 'style="float: right; margin-left: 5px;"') . '</a>'; ?>
		<?php
            //$the_button = '<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=add_product&products_id=' . $products->fields['products_id']) . '" title="'.BUTTON_IN_CART_ALT.'">' . $attributes_post . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT) . '</a>';
  			//$display_button = zen_get_buy_now_button($products->fields['products_id'], $the_button);
  		//if ( $display_button != '') { 
	  		?>
    	<!--<div class="extendedCart">-->
    	<?php
      	//echo $display_button;
		//} 
		?>	
		<!--</div>-->
		
		<?php
    $display_qty = (($flag_show_product_info_in_cart_qty == 1) ? '<p>' . PRODUCTS_ORDER_QTY_TEXT_IN_CART . '1' . '</p>' : '');
            if ($products_qty_box_status == 0 or $products_quantity_order_max== 1) {
              // hide the quantity box and default to 1
              $the_button = '<input type="hidden" name="cart_quantity" value="1" />' . zen_draw_hidden_field('products_id', $products->fields['products_id']) . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT);
            } else {
              // show the quantity box
    $the_button = PRODUCTS_ORDER_QTY_TEXT . '<input type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($products->fields['products_id'])) . '" maxlength="6" size="4" /><br />' . zen_get_products_quantity_min_units_display($products->fields['products_id']) . '<br />' . zen_draw_hidden_field('products_id', $products->fields['products_id']) . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT);
            }
            
    $display_button = zen_get_buy_now_button($products->fields['products_id'], $the_button);
	$products_description = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($products->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION);
	$products_description = ltrim(substr($products_description, 0, 130) . '..');
  ?>
 
		
		
		
		
		
		<!-- product data -->
        <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                    <a href="<?php echo zen_href_link(zen_get_info_page($products->fields['products_id']), 'products_id=' . $products->fields['products_id']);?>">
                    <?php echo zen_image(DIR_WS_IMAGES . $products->fields['products_image'], $products->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'class="productlist"'); ?></a>
                </div>
                <div class="product_wishlist_information col-lg-6 col-md-5 col-sm-5 col-xs-12 ">
                    <h3 class="product_wishlist_name"><a href="<?php echo zen_href_link(zen_get_info_page($products->fields['products_id']), 'products_id=' . $products->fields['products_id']);?>"> <?php echo $products->fields['products_name']; ?> </a></h3>
                    <div class="product_wishlist_description">
                        <?php echo $products_description; ?>
                    </div>
                </div>
                <div class="product_attribute col-lg-3 col-md-3 col-sm-3 col-xs-9">			
                <div class="price"><?php echo ((zen_has_product_attributes_values((int)$products->fields['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . $products_price; ?></div>
                 <?php if ($display_qty != '' or $display_button != '') { ?>

                <?php if ( SHOW_PRODUCT_INFO_DATE_AVAILABLE && ( $products->fields['products_date_available'] > date('Y-m-d H:i:s') ) ) { ?>
                <div class="notabene"><?php echo sprintf(UN_TEXT_DATE_AVAILABLE, zen_date_short($products->fields['products_date_available'])); ?></div>
                <?php } ?>

                <div class="extendedCart">
                <?php
                echo $display_qty;
                echo $display_button;
                } 
                ?>	
                </div>
                      
                <?php //attributes
                if (is_array($attributes_stored)) {
                    if (PRODUCTS_OPTIONS_SORT_ORDER=='0') {
              $options_order_by= ' ORDER BY LPAD(popt.products_options_sort_order,11,"0")';
            } else {
              $options_order_by= ' ORDER BY popt.products_options_name';
            }
            echo '<div class="cartAttribsList">';
            foreach ($attributes_stored as $option => $value) {
              $attributes = "SELECT popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix
                             FROM " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                             WHERE pa.products_id = :productsID
                             AND pa.options_id = :optionsID
                             AND pa.options_id = popt.products_options_id
                             AND pa.options_values_id = :optionsValuesID
                             AND pa.options_values_id = poval.products_options_values_id
                             AND popt.language_id = :languageID
                             AND poval.language_id = :languageID " . $options_order_by;
        
              $attributes = $db->bindVars($attributes, ':productsID', $products->fields['products_id'], 'integer');             //$products[$i]['id'], 'integer');
              $attributes = $db->bindVars($attributes, ':optionsID', $option, 'integer');
              $attributes = $db->bindVars($attributes, ':optionsValuesID', $value, 'integer');
              $attributes = $db->bindVars($attributes, ':languageID', $_SESSION['languages_id'], 'integer');
              $attributes_values = $db->Execute($attributes);
              //clr 030714 determine if attribute is a text attribute and assign to $attr_value temporarily
              if ($value == PRODUCTS_OPTIONS_VALUES_TEXT_ID) {
                $attributeHiddenField .= zen_draw_hidden_field('id[' . $products[$i]['id'] . '][' . TEXT_PREFIX . $option . ']',  $products[$i]['attributes_values'][$option]);
                $attr_value = htmlspecialchars($products[$i]['attributes_values'][$option], ENT_COMPAT, CHARSET, TRUE);
              } else {
                $attributeHiddenField .= zen_draw_hidden_field('id[' . $products->fields['products_id'] . '][' . $option . ']', $value);
                $attr_value = $attributes_values->fields['products_options_values_name'];
              }
        
              $attrArray[$option]['products_options_name'] = $attributes_values->fields['products_options_name'];
              $attrArray[$option]['options_values_id'] = $value;
              $attrArray[$option]['products_options_values_name'] = $attr_value;
              $attrArray[$option]['options_values_price'] = $attributes_values->fields['options_values_price'];
              $attrArray[$option]['price_prefix'] = $attributes_values->fields['price_prefix'];
              ?>
              <div><?php echo $attrArray[$option]['products_options_name'] . TEXT_OPTION_DIVIDER . nl2br($attrArray[$option]['products_options_values_name']); ?></div>
              
            <?php } //end foreach [attributes]
                ?>
        
                
        
                <?php
                echo '</div>';
                }
                ?>
                </div>
                </form><!--end add cart form-->
                <div class="extendedDelete col-lg-1 col-md-1 col-sm-1 col-xs-3">	
                <?php echo '<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=un_remove_wishlist&products_id=' . $products->fields['products_id']) . '" data-original-title="'.UN_TEXT_REMOVE_WISHLIST.'" data-toggle="tooltip">' . '<i class="fa fa-times fa-lg"></i>' . '</a>'; ?>
                </div>
        </div>
		<div class="clearleft"></div>
                    </div> <!-- end div.wishlist -->
		
		<?php $rows ++; ?>
		<?php $products->MoveNext(); ?>
	<?php } // end while products ?>
	
<?php } else { ?>
	<p><?php echo UN_TEXT_NO_PRODUCTS; ?></p>
	
<?php } // end if products ?>


<!-- end product listing -->

<?php if (($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) { ?>

	<dl class="pageresults">
	<dd><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></dd>
	<dd><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></dd>
	</dl>

<?php } // end paging bottom ?>
<div class="buttons">
<?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
</div>

</div> <!-- end (un) id for styling -->