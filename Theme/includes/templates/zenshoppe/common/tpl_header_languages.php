<?php
/**
 * Header Languages Links Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_header_languages.php 2006-05-31 bunyip $
 */
 ?> 
 <?php 
	for ($i=0; $i<4; $i++) {
  while (list($key, $value) = each($lng->catalog_languages)) {
  	
  	//print_r ($value);
    $content1 .= '<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('language', 'currency')) . 'language=' . $key, $request_type) . '">' . $value['code'] . '</a>';
  	}
  }
  echo $content1;
?>
