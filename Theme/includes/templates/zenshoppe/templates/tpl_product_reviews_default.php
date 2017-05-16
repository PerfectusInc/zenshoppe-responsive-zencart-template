<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_product_reviews_default.php 4852 2006-10-28 06:47:45Z drbyte $
 */

?>
<div class="centerColumn" id="reviewsDefault">
	<header>
		<h4>Product Reviews<?php //echo $products_name; //. $products_model; ?></h4>
	</header>
    <?php /*?><div class="content">
		<?php
          if (zen_not_null($products_image)) {
        ?>
    	<div class="row">
            <div class="smallProductImage back col-lg-2 col-md-4 col-sm-6 col-xs-12">
            		<?php echo '<a data-toggle="tooltip" data-original-title="Read Review" href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . (int)$_GET['products_id'] . '&reviews_id=' . $reviews->fields['reviews_id']) . '">' . zen_image(DIR_WS_IMAGES . $products_image, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>'; ?>
            </div>
            
        <?php
		    }
        ?>
			<div class="col-lg-10 col-md-8 col-sm-12 col-xs-12">
				<h4><?php echo $products_name; ?></h4>
   				<div class="product_price"> 
        			<div class="productprice-amount" style="display:inline-block">
						<span class="productprice-amount"><?php echo $products_price; ?></span>
        			</div>
   				</div>
				<div class="forward">
					<div id="productReviewsDefaultProductPageLink" class="buttonRow">
						<?php echo '<a href="' . zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('reviews_id'))) . '">' . zen_image_button(BUTTON_IMAGE_GOTO_PROD_DETAILS , BUTTON_GOTO_PROD_DETAILS_ALT) . '</a>'; ?>
        			</div>
				</div>
			</div>
		</div>
	</div><?php */?>
	<?php
      if ($reviews_split->number_of_rows > 0) {
        if ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3')) {
            $reviewsplit = $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS);
            if($reviewsplit == '')
            {
            
            }
            else
            {
    ?>
		<!--<div id="productReviewsDefaultListingTopNumber" class="navSplitPagesResult">
			<?php //echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?>
        </div>-->
		<?php if($reviews_split->number_of_pages > 1) { //to hide the pagination div if no. of pages < 1 ?>
		<!--<div id="productReviewsDefaultListingTopLinks" class="navSplitPagesLinks pagination-style">
			<?php //echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?>
        </div>-->
		<?php
                }
            }
        }
        ?>
		<div class="reviews-list">
		<?php 
            foreach ($reviewsArray as $reviews) {
				//print_r($reviews);
        ?> 
        	<blockquote>
            	<div class="row product-details-review">
            		<div class="smallProductImage back col-lg-2 col-md-3 col-sm-3 col-xs-12">
                		<?php echo '<a data-toggle="tooltip" data-original-title="Read Review" href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . (int)$_GET['products_id'] . '&reviews_id='. $reviews['id']) . '">' . zen_image(DIR_WS_IMAGES . $products_image, $product_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>'; ?>
            		</div>
                	<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 product-review-default">
                    	<h4>
                    		<?php echo '<a data-toggle="tooltip" data-original-title="Product Detail" href="' . zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('reviews_id'))) . '">' . $products_name . '</a>'; ?>
                    	</h4>
						<?php $product_review = $reviews['reviewsText'];
                            $product_review = ltrim(substr($product_review, 0, 160) . '...'); //Trims and Limits the Review
                        ?>
                    	<p>
                    		<?php echo '<a data-toggle="tooltip" data-original-title="Read Review" href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . (int)$_GET['products_id'] . '&reviews_id='. $reviews['id']) . '"><i class="fa fa-quote-left"></i>' . $product_review . '</a>'; ?>
                    	</p>
                    	<footer>
                        	<?php echo sprintf(zen_output_string_protected($reviews['customersName'])); ?>, 
                        	<cite title="Source Title"><?php echo sprintf(zen_date_short($reviews['dateAdded'])); ?></cite>
                        	<br/>
                        	<?php echo zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $reviews['reviewsRating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews['reviewsRating'])), sprintf(TEXT_OF_5_STARS, $reviews['reviewsRating']); ?>
                    	</footer>
                	</div>
        		</div> <!--productreviews-wrapper ends -->
			</blockquote>       
			<?php /*?><div class="simple-boxcontent">
				<div class="productreviews-wrapper">
                	<?php $product_review = $reviews['reviewsText'];
						$product_review = ltrim(substr($product_review, 0, 160) . '...'); //Trims and Limits the Review
					?>
					<div class="review_content">
						<p><i class="fa fa-quote-left fa-lg"></i><?php echo $product_review; ?></p>
            		</div>
                	<div class="review_left">	
                    	<div class="buttonRow forward" id="reviewsWriteProductPageLink"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . (int)$_GET['products_id'] . '&reviews_id='. $reviews['id']) . '">' . zen_image_button(BUTTON_IMAGE_READ_REVIEWS , BUTTON_READ_REVIEWS_ALT) . '</a>'; ?>
                    	</div>
    					<div class="buttonRow forward" id="reviewsWriteReviewPageLink"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array('reviews_id'))) . '">' . 
							zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>'; ?>
                        </div>
					</div>
                	<div class="ratings">
                    	<div class="user_detail">
                        	<span class="bold user_reviewer">
                            	<strong> Reviewed By : </strong>
                            	<?php echo sprintf(zen_output_string_protected($reviews['customersName'])); ?>
                        	</span>
                        	<span class="date user_reviewdate">
                            	<strong> On : </strong>
                            	<?php echo sprintf(zen_date_short($reviews['dateAdded'])); ?>
                        	</span>
                    	</div>
    		        	<div class="rating"><?php echo zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $reviews['reviewsRating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews['reviewsRating'])), sprintf(TEXT_OF_5_STARS, $reviews['reviewsRating']); ?>
                        </div>
                	</div>
				</div> <!--productreviews-wrapper ends -->
			</div><?php */?> <!--Review box ends --> 
			<?php
                }
            ?>
		</div>
	<?php   } else {
	?>
	<div id="productReviewsDefaultNoReviews" class="content">
		<?php echo TEXT_NO_REVIEWS . (REVIEWS_APPROVAL == '1' ? '<br />' . TEXT_APPROVAL_REQUIRED: ''); ?>
    </div>
	<br class="clearBoth" />
	<?php
      } 
    ?>
	<?php  if (($reviews_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
		$reviewsplit = $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS);
		if($reviewsplit == '')
			{
			}
		else
			{
	?>
	<div id="productReviewsDefaultListingBottomNumber" class="navSplitPagesResult">
		<?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?>
    </div>
	<?php if($reviews_split->number_of_pages > 1) { //to hide the pagination div if no. of pages < 1 ?>
	<div id="productReviewsDefaultListingBottomLinks" class="navSplitPagesLinks pagination-style">
		<?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?>	</div>
	<?php
    }
      }
    }
    ?>
</div>
