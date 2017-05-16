<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_product_reviews_info_default.php 2993 2006-02-08 07:14:52Z birdbrain $
 */
?>
<div class="centerColumn" id="reviewsInfoDefault">
	<header>
    	<h4><?php echo $products_name; //. $products_model; ?></h4>
    </header>
    <div class="row">
		<?php
          if (zen_not_null($products_image)) {
            /**
             * require the image display code
             */
        ?>
        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 reviews-info-productmain-image">
            <div id="reviewsInfoDefaultProductImage" class="centeredContent back">
                <?php require($template->get_template_dir('/tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_main_product_image.php'); ?>
            </div>
        </div> <!-- productinfo-leftwrapper --> 
        <?php
            }
        ?>
        <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12 reviews-list">
            <blockquote>
                <div class="reviews-description">
                    <p><i class="fa fa-quote-left fa-lg"></i>
                        <?php echo zen_break_string(nl2br(zen_output_string_protected(stripslashes($review_info->fields[
                            'reviews_text']))), 60, '-<br />'); ?>
                    </p>
                    <footer>
                        <?php echo sprintf(zen_output_string_protected($review_info->fields['customers_name'])); ?>, 
                        <cite title="Source Title"><?php echo sprintf(zen_date_short($review_info->fields['date_added'])); ?></cite>
                        <br/>
                        <?php echo zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . 
                        $review_info->fields['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, 
                        $review_info->fields['reviews_rating'])), sprintf(TEXT_OF_5_STARS, $review_info->fields['reviews_rating']); ?>
                    </footer>
                </div>
                <div class="review-links">
                    <div class="buttonRow forward" id="reviewsWriteProductPageLink">
                        <?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array(
                        'reviews_id'))) . '">' . zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>'; ?>		
                    </div>
                    <div id="reviewsWriteReviewPageLink" class="buttonRow"><?php echo '<a href="' . zen_href_link(
                        zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array(
                        'reviews_id'))) . '">' . zen_image_button(BUTTON_IMAGE_GOTO_PROD_DETAILS , 
                        BUTTON_GOTO_PROD_DETAILS_ALT) . '</a>'; ?>
                    </div>
                    <?php 
                        if($reviews_counter > 0) {
                    ?>
                    <div id="reviewsWriteReviewPageLink" class="buttonRow">
                        <?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS, zen_get_all_get_params(array('reviews_id'))) . '">'. zen_image_button(BUTTON_IMAGE_MORE_REVIEWS , BUTTON_MORE_REVIEWS_ALT) . '</a>' ; ?>
                    </div>
                    <?php } ?>
                </div>
            </blockquote>
        </div>
    </div>
	<div class="content row">
   		<div class="product_price col-lg-10 col-md-10 col-sm-12 col-xs-12"> 
        	<div class="productprice-amount" style="display:inline-block">
				<span class="productprice-amount"><?php echo $products_price; ?></span>
        	</div>
   		</div>
    	<div class="forward productpage_links col-lg-2 col-md-2 col-sm-12 col-xs-12">
			<div class="buttonRow" id="reviewsWriteProductPageLink">
			<?php
        		// more info in place of buy now
        		if (zen_has_product_attributes($review_info->fields['products_id'] )) {
             		$link = '<a href="' . zen_href_link(zen_get_info_page($review_info->fields['products_id']), 'products_id=' . $review_info->fields['products_id'] ) . '">Product Details</a>';
          	//$link = '';
        		} else {
          			$link= '<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action', 'reviews_id')) . 'action=buy_now') . '">' . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT) . '</a>';
        		}
        		$the_button = $link;
        		$products_link = '';
        		echo zen_get_buy_now_button($review_info->fields['products_id'], $the_button, $products_link) . '' . zen_get_products_quantity_min_units_display($review_info->
				fields['products_id']);
      		?>
			</div> <!-- buttonRow ends -->		
		</div> <!--forward ends-->
	</div> <!--productinfo-rightwrapper ends -->
</div>