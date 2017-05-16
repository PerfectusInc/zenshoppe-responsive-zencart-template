<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_reviews_default.php 2905 2006-01-28 01:25:36Z birdbrain $
 */
?>
<div class="centerColumn" id="reviewsListingDefault">
    <header>
        <h4 id="reviewsDefaultHeading"><?php echo $breadcrumb->last();  ?></h4>
    </header>
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
        <!--<div id="reviewsDefaultListingTopNumber" class="navSplitPagesResult">
            <?php //echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?>
        </div>-->
		<?php if($reviews_split->number_of_pages > 1) { //to hide the pagination div if no. of pages < 1 ?>
		<!--<div id="reviewsDefaultListingTopLinks" class="navSplitPagesLinks pagination-style">
			<?php //echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?>
    	</div>-->
		<?php
            }
                }
            } ?>
	<div class="reviews-list" style="background:none; margin:0; padding:0">
		<?php
            $reviews = $db->Execute($reviews_split->sql_query);
            while (!$reviews->EOF) {
        ?>
		<blockquote>
            <div class="row product-details-review">
            	<div class="smallProductImage back col-lg-2 col-md-3 col-sm-3 col-xs-12">
            		<?php echo '<a data-toggle="tooltip" data-original-title="Read Review" href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $reviews->fields['products_id'] . '&reviews_id=' . $reviews->fields['reviews_id']) . '">' . zen_image(DIR_WS_IMAGES . $reviews->fields['products_image'], $reviews->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>'; ?>
            	</div>
                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 product-review-default">
                    <h4>
                        <?php echo '<a data-toggle="tooltip" data-original-title="Product Detail" href="' . zen_href_link(zen_get_info_page($reviews->fields['products_id']), 'products_id=' . $reviews->fields['products_id']) . '">' . $reviews->fields['products_name'] . '</a>'; ?>
                    </h4>
                        <?php $product_review = $reviews->fields['reviews_text'];
                            $product_review = ltrim(substr($product_review, 0, 130) . '...'); //Trims and Limits the Review
                        ?>
                    <p>
						<?php echo '<a data-toggle="tooltip" data-original-title="Read Review" href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $reviews->fields['products_id'] . '&reviews_id=' . $reviews->fields['reviews_id']) . '"><i class="fa fa-quote-left"></i>' . $product_review . '</a>'; ?>
                    </p>
                    <footer>
                        <?php echo sprintf(zen_output_string_protected($reviews->fields['customers_name'])); ?>, 
                        <cite title="Source Title"><?php echo sprintf(zen_date_short($reviews->fields['date_added'])); ?></cite>
                        <br/>
                        <?php echo zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $reviews->fields['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews->fields['reviews_rating'])), sprintf(TEXT_OF_5_STARS, $reviews->fields['reviews_rating']); ?>
                    </footer>
                </div>
        	</div> <!--productreviews-wrapper ends -->
		</blockquote><!--Reviewbox ends -->
		<?php
              $reviews->MoveNext();
            }
        ?>
        </div> <!-- List Reviews end -->
        <?php
          } else {
        ?>
        <div id="reviewsDefaultNoReviews" class="content"><?php echo TEXT_NO_REVIEWS; ?></div>
        <?php
          }
        ?>
		<?php
          if (($reviews_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
                $reviewsplit = $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS);
                if($reviewsplit == '')
                {
                
                }
                else
                {
        ?>
		<div id="reviewsDefaultListingBottomNumber" class="navSplitPagesResult">
			<?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?>
        </div>
		<?php if($reviews_split->number_of_pages > 1) { //to hide the pagination div if no. of pages < 1 ?>
		<div id="reviewsDefaultListingBottomLinks" class="navSplitPagesLinks pagination-style">
			<?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?>
        </div>
		<br class="clearBoth" />
		<?php
            }
                }
          }
        ?>
</div>
