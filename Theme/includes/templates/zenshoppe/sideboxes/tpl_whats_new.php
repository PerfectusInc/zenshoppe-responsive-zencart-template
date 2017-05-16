<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_whats_new.php 18698 2011-05-04 14:50:06Z wilt $
 */
  $content = "";
  $content .= '<div class="sideBoxContent centeredContent owl-carousel owl-theme" id="sidebox-new-slider">';
  $whats_new_box_counter = 0;
  while (!$random_whats_new_sidebox_product->EOF) {
    $whats_new_box_counter++;
    $whats_new_price = zen_get_products_display_price($random_whats_new_sidebox_product->fields['products_id']);
    $content .= "\n" . '  <div class="sideBoxContentItem item">';
    $content .= '<div class="sidebox_content"><div class="product_sideboximage">' . zen_image(DIR_WS_IMAGES . $random_whats_new_sidebox_product->fields['products_image'], $random_whats_new_sidebox_product->fields['products_name'], MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '</div>';
    $content .=  '<div class="product_sideboxname"><a href="' . zen_href_link(zen_get_info_page($random_whats_new_sidebox_product->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($random_whats_new_sidebox_product->fields['master_categories_id']) . '&products_id=' . $random_whats_new_sidebox_product->fields['products_id']) . '">' . $random_whats_new_sidebox_product->fields['products_name'] . '</a>';
    $content .= '<div class="sidebox_price">' . $whats_new_price . '</div></div></div>';
    $content .= '</div>';
    $random_whats_new_sidebox_product->MoveNextRandom();
  }
  $content .= '</div>' . "\n";
