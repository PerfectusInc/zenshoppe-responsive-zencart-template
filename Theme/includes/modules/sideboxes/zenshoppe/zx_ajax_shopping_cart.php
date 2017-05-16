<?php
/**
 * AJAX shopping cart sidebox - displays contents of customer's shopping cart in header
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: zx_ajax_shopping_cart.php 1 2014-06-05 20:56:05Z ZenExpert $
 */

    if (ZX_AJAX_CART_STATUS == 'true')
      $show_shopping_cart_box = true;


  if ($show_shopping_cart_box == true) {
    require($template->get_template_dir('tpl_zx_ajax_shopping_cart.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_zx_ajax_shopping_cart.php');
    $title =  BOX_HEADING_SHOPPING_CART;
    $title_link = false;
    $title_link = FILENAME_SHOPPING_CART;

    require($template->get_template_dir('tpl_box_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_box_header.php');
  }
?>