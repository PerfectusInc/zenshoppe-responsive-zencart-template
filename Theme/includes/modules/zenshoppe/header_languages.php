<?php
/**
 * languages links for header - allows customer to select from available languages installed on your site
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_languages.php  2005-05-31 bunyip $
 */

// test if box should display
  $show_languages= true;

  // don't display on checkout page:
  //if (substr($current_page, 0, 8) != 'checkout') {
    //$show_languages= true;
  //}

  if ($show_languages == true) {
    if (!isset($lng) || (isset($lng) && !is_object($lng))) {
      $lng = new language;
    }

    reset($lng->catalog_languages);
    require($template->get_template_dir('tpl_header_languages.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header_languages.php');
  }
?>