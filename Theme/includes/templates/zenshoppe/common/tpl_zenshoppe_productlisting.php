<?php
/**
 * Common Template - tpl_tabular_display.php
 *
 * This file is used for generating tabular output where needed, based on the supplied array of table-cell contents.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_tabular_display.php 3957 2006-07-13 07:27:06Z drbyte $
 */

?>
 <?php  if((isset($_GET['view'])) && ($_GET['view']=='rows')){ 
 echo '<div id="product-area" class="section offer products-container portrait product-list" data-layout="list">';
}else{
 echo '<div id="product-area" class="section offer products-container portrait product-grid" data-layout="grid">';
} ?>
<div class="row" style=" transform: ">
<?php
	if (is_array($list_box_contents) > 0 ) {
 		for($row=0;$row<sizeof($list_box_contents);$row++) {
			$prod_content='';
    		$params = "";
    		//if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
    	for($col=0;$col<sizeof($list_box_contents[$row]);$col++) {
      		$r_params = "";
      		if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
     			if (isset($list_box_contents[$row][$col]['text'])) {
					  if ($list_box_contents[$row][$col]['text']==TEXT_NO_PRODUCTS) {
					  $prod_content.='<div class="col-lg-12"><div' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '' . "\n</div>"; 
					  }
					 else {
					  $prod_content.='<div' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '' . "\n"; 
					  }
      				}
   				}
			echo $prod_content;
			
			
 			}
		}
?>
</div> 
</div>