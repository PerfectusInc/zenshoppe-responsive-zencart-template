<?php
/**
 * Common Template - tpl_columnar_display.php
 *
 * This file is used for generating tabular output where needed, based on the supplied array of table-cell contents.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_columnar_display.php 3157 2006-03-10 23:24:22Z drbyte $
 */

?>
<?php
  if ($title) {
  ?>
<?php echo $title; ?>
<?php
 }
 ?>
<?php
if (is_array($list_box_contents) > 0 ) 
	{
		$string_parts = explode("=", $list_box_contents[0][0]['params']);
		$param = $string_parts[1];
		$param1 = trim($param,'"');
		
		$param2= explode(" ", $string_parts[1]);
		$param2 = $param2[0];
		$param2 = trim($param2,'"');
		
		$param3= explode(" ", $string_parts[1]);
		$param3 = $param3[1];
		$param3 = trim($param3,'"');
		//print_r($param3);
		$param4= explode(" ", $string_parts[1]);
		$param4 = $param4[0].$param4[1];
		$param4 = trim($param4,'"');
		//print_r($param4);
		$param5= explode(" ", $string_parts[1]);
		$param5 = $param5[0];
		$param5 = trim($param5,'"');
		//print_r($param5);
		$param6= explode(" ", $string_parts[1]);
		$param6 = $param6[0];
		$param6 = trim($param6,'"');
		
		if($param1 == "categoryListBoxContents") 
		{ 
		?>
			<div id="subcategory_names">
            	<ul class="subcategory_list">
                <li>Browse Subcategories : </li>
        <?php
			for($row=0;$row<sizeof($list_box_contents);$row++) 
				{
    				$params = "";
    				//if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
        			for($col=0;$col<sizeof($list_box_contents[$row]);$col++) 
						{
      						$r_params = "";
      						if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
     						if (isset($list_box_contents[$row][$col]['text'])) 
							{ 
								echo '<li id="subproduct_name" ' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</li>' . "\n";
					 		}
    					}
  				} ?>
              	</ul>
            </div>
				<?php
		}
		elseif($param4 == "itemcenterBoxContentsSpecials" && !$this_is_home_page)
		{ ?>
        	<div class="row">
                <div id="special-slider-inner" class="owl-carousel owl-theme">
                <?php
                for($row=0;$row<sizeof($list_box_contents);$row++)
                    {
                        $params = "";
                        //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
                        for($col=0;$col<sizeof($list_box_contents[$row]);$col++) 
                            {
                                $r_params = "";
                                if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
                                if (isset($list_box_contents[$row][$col]['text'])) 
                                { 
                                    echo '<div' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</div>' . "\n";
                                }
                            }
                    }
                ?>
                </div>
			</div>
			<?php		
		}
		elseif($param2 == "centerBoxContentsAlsoPurch") 
		{ 
		?>
        	<div class="row">
                <div id="alsopurchased_products" class="owl-carousel owl-theme">
                <?php
                for($row=0;$row<sizeof($list_box_contents);$row++) 
                    {
                        $params = "";
                        //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
                        for($col=0;$col<sizeof($list_box_contents[$row]);$col++) 
                            {
                                $r_params = "";
                                if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
                                if (isset($list_box_contents[$row][$col]['text'])) 
                                { 
                                    echo '<div' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</div>' . "\n";
                                }
                            }
                    } ?>
                </div>
			</div>
				<?php
		}
		elseif($param3 == "centerBoxContentsNew")
		{ ?>
        	<div class="row">
                <div id="new-slider" class="owl-carousel owl-theme">
                <?php
                for($row=0;$row<sizeof($list_box_contents);$row++)
                    {
                        $params = "";
                        //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
                        for($col=0;$col<sizeof($list_box_contents[$row]);$col++) 
                            {
                                $r_params = "";
                                if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
                                if (isset($list_box_contents[$row][$col]['text'])) 
                                { 
                                    echo '<div' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</div>' . "\n";
                                }
                            }
                    }
                ?>
                </div>
			</div>
			<?php		
		}
		elseif($param3 == "centerBoxContentsFeatured")
		{ ?>
        	<div class="row">
                <div id="featured-slider" class="owl-carousel owl-theme">
                <?php
                for($row=0;$row<sizeof($list_box_contents);$row++)
                    {
                        $params = "";
                        //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
                        for($col=0;$col<sizeof($list_box_contents[$row]);$col++) 
                            {
                                $r_params = "";
                                if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
                                if (isset($list_box_contents[$row][$col]['text'])) 
                                { 
                                    echo '<div' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</div>' . "\n";
                                }
                            }
                    }
                ?>
                </div>
			</div>
			<?php		
		}
		elseif($param3 == "centerBoxContentsSpecials")
		{ ?>
        	<div class="row">
                <div class="owl-carousel owl-theme specials-slider">
                <?php
                for($row=0;$row<sizeof($list_box_contents);$row++)
                    {
                        $params = "";
                        //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
                        for($col=0;$col<sizeof($list_box_contents[$row]);$col++) 
                            {
                                $r_params = "";
                                if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
                                if (isset($list_box_contents[$row][$col]['text'])) 
                                { 
                                    echo '<div' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</div>' . "\n";
                                }
                            }
                    }
                ?>
                </div>
			</div>
			<?php		
		}
		elseif($param3 == "centerBoxContentsUpcoming")
		{ ?>
			<div id="upcoming-slider" class="owl-carousel owl-theme">
			<?php
			for($row=0;$row<sizeof($list_box_contents);$row++)
				{
    				$params = "";
    				//if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
        			for($col=0;$col<sizeof($list_box_contents[$row]);$col++) 
						{
      						$r_params = "";
      						if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
     						if (isset($list_box_contents[$row][$col]['text'])) 
							{ 
								echo '<div' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</div>' . "\n";
					 		}
    					}
  				}
			?>
            </div>
			<?php		
		}
		elseif($param5 == "additionalImages")
		{ ?>
			<div id="additionalimages-slider" class="owl-carousel owl-theme">
			<?php
			for($row=0;$row<sizeof($list_box_contents);$row++)
				{
    				$params = "";
    				//if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
        			for($col=0;$col<sizeof($list_box_contents[$row]);$col++) 
						{
      						$r_params = "";
      						if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
     						if (isset($list_box_contents[$row][$col]['text'])) 
							{ 
								echo '<div' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</div>' . "\n";
					 		}
    					}
  				}
			?>
            </div>
			<?php		
		}
		elseif($param6 == "specialsListBoxContents")
		{ ?>
			<div id="special-listing" class="row">
			<?php
			for($row=0;$row<sizeof($list_box_contents);$row++)
				{
    				$params = "";
    				//if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
        			for($col=0;$col<sizeof($list_box_contents[$row]);$col++) 
						{
      						$r_params = "";
      						if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
     						if (isset($list_box_contents[$row][$col]['text'])) 
							{ 
								echo '<div' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</div>' . "\n";
					 		}
    					}
  				}
			?>
            </div>
			<?php		
		}
		else
		{ ?>
        	<ul>
			<?php
			for($row=0;$row<sizeof($list_box_contents);$row++)
				{
    				$params = "";
    				//if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
        			for($col=0;$col<sizeof($list_box_contents[$row]);$col++) 
						{
      						$r_params = "";
      						if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
     						if (isset($list_box_contents[$row][$col]['text'])) 
							{ 
								echo '<li' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</li>' . "\n";
					 		}
    					}
  				}
			?>
            </ul>
			<?php		
		}
	}
?> 
