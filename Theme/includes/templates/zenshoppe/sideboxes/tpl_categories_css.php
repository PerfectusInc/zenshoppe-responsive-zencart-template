<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: tpl_categories_css.php 2004/06/23 00:00:00 DrByteZen Exp $
//
  $content = "";

    $content .= '<div id="nav-cat">';
    $content .= $menulist; // see the modules/sideboxes/YOURTEMPLATE/categories_css.php for this

  if (SHOW_CATEGORIES_BOX_SPECIALS == 'true' or SHOW_CATEGORIES_BOX_PRODUCTS_ALL == 'true'){
    $content .= '';  // insert a blank line/box in the menu
    if (SHOW_CATEGORIES_BOX_SPECIALS == 'true') {
      $content .= '<ul class="level1"><li><a href="' . zen_href_link(FILENAME_SPECIALS) . '">' . CATEGORIES_BOX_HEADING_SPECIALS . '</a></li></ul>';
    }
    if (SHOW_CATEGORIES_BOX_PRODUCTS_NEW == 'true') {
      $content .= '<ul class="level1"><li><a href="' . zen_href_link(FILENAME_PRODUCTS_NEW) . '">' . CATEGORIES_BOX_HEADING_WHATS_NEW . '</a></li></ul>';
    }
    if (SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS == 'true') {
      $show_this = $db->Execute("select products_id from " . TABLE_FEATURED . " where status= 1 limit 1");
      if ($show_this->RecordCount() > 0) {
        $content .= '<ul class="level1"><li><a href="' . zen_href_link(FILENAME_FEATURED_PRODUCTS) . '">' . CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS . '</a></li></ul>';
      }
    }
    if (SHOW_CATEGORIES_BOX_PRODUCTS_ALL == 'true') {
      $content .= '<ul class="level1"><li><a href="' . zen_href_link(FILENAME_PRODUCTS_ALL) . '">' . CATEGORIES_BOX_HEADING_PRODUCTS_ALL . '</a></li></ul>';
    }
  }
  $content .= '</div>';
// May want to add ............onfocus="this.blur()"...... to each A HREF to get rid of the dotted-box around links when they're clicked.
// just parse the $content string and insert it into each A HREF tag

?>
