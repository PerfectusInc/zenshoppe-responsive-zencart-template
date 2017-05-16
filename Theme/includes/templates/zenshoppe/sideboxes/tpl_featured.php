<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_featured.php 18698 2011-05-04 14:50:06Z wilt $
 */
  $content = "";
  $content .= '<div class="sideBoxContent centeredContent owl-carousel owl-theme" id="sidebox-featured-slider">';
  $featured_box_counter = 0;
  while (!$random_featured_product->EOF) {
    $featured_box_counter++;
    $featured_box_price = zen_get_products_display_price($random_featured_product->fields['products_id']);
    $content .= "\n" . '  <div class="sideBoxContentItem item">';
    $content .=  '<div class="sidebox_content"><div class="product_sideboximage">' . zen_image(DIR_WS_IMAGES . $random_featured_product->fields['products_image'], $random_featured_product->fields['products_name'], MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '</div>';
    $content .= '<div class="product_sideboxname"><a href="' . zen_href_link(zen_get_info_page($random_featured_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_featured_product->fields["master_categories_id"]) . '&products_id=' . $random_featured_product->fields["products_id"]) . '">' . $random_featured_product->fields['products_name'] . '</a>';
    $content .= '<div class="sidebox_price">' . $featured_box_price . '</div></div></div>';
    $content .= '</div>';
    $random_featured_product->MoveNextRandom();
  }
  $content .= '</div>' . "\n";
