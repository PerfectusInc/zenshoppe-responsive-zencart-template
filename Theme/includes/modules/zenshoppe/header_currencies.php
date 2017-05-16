<?php
/**
 * currencies header links - allows customer to select from available currencies
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_currencies.php  2006-05-31 bunyip $
 */

// test if box should display
  $show_currencies= true;

  // don't display on checkout page:
  //if (substr($current_page, 0, 8) != 'checkout') {
    //$show_currencies= true;
  //}

  if ($show_currencies == true) {
    if (isset($currencies) && is_object($currencies)) {

      reset($currencies->currencies);
      $currencies_array = array();
      while (list($key, $value) = each($currencies->currencies)) {
        $currencies_array[] = array('id' => $key, 'text' => (zen_not_null($value['symbol_left']) ? $value['symbol_left'] : $value['symbol_right']) );
      }

      $hidden_get_variables = '';
      reset($_GET);
      while (list($key, $value) = each($_GET)) {
        if ( ($key != 'currency') && ($key != zen_session_name()) && ($key != 'x') && ($key != 'y') ) {
          $hidden_get_variables .= zen_draw_hidden_field($key, $value);
        }
      }

      require($template->get_template_dir('tpl_header_currencies.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header_currencies.php');
    }
  }
?>