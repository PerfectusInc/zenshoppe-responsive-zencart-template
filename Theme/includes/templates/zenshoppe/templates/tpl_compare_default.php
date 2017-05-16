<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_compare_default.php 2011-01-28 5:23:52MT brit (docreativedesign.com) $
 */
?>
<div class="centerColumn " id="privacy">
	<header>
		<h4 id="privacyDefaultHeading"><?php echo HEADING_TITLE; ?></h4>
	</header>
    <div class="row"> 
        <div id="compareDefaultMainContent" class="content col-lg-12 col-md-6 com-sm-4 col-xs-12">
        
        
        
        <?php
        
        if (!empty($_SESSION['compare'])) {
        
            // make sure loop only goes the number needed
            $comp_value_count = (count($result) < COMPARE_VALUE_COUNT)
                ? count($result)
                : COMPARE_VALUE_COUNT;
            echo '<div class="table-responsive"><table class="table">';
            
            // create our table rows of data
            for ($i=1; $i<=$comp_value_count; $i++) {
        
                $compPro = 'pro'.$i;
        
                $compName         .= '<td>' . $result[$compPro][0] . '</td>';
                $compImage        .= '<td>' . $result[$compPro][1] . '</td>';
                $compDescription  .= '<td>' . $result[$compPro][2] . '</td>';
                $compModel        .= '<td>' . $result[$compPro][3] . '</td>';
                $compWeight       .= '<td>' . $result[$compPro][4] . '</td>';
                $compQuantity     .= '<td>' . $result[$compPro][5] . '</td>';
                $compPrice        .= '<td>' . $result[$compPro][6] . '</td>';
                $compManufacturer .= '<td>' . $result[$compPro][7] . '</td>';
                $compRemove       .= '<td>' . $result[$compPro][8] . '</td>';
				$compaddtocart    .= '<td>' . $result[$compPro][9] . '</td>';
            }
        
        
            // create the display
            echo '<tr><th>'                 .COMPARE_IMAGE.             '</th>' . $compImage        . '</tr>';
            echo '<tr><th>'                 . COMPARE_NAME             . '</th>' . $compName         . '</tr>';
            echo '<tr class="rowOdd"><th>'  . COMPARE_PRICE        . '</th>' . $compPrice        . '</tr>';
            echo '<tr class="rowEven"><th>' . COMPARE_QUANTITY     . '</th>' . $compQuantity     . '</tr>';
            echo '<tr class="rowOdd"><th>'  . COMPARE_MODEL        . '</th>' . $compModel        . '</tr>';
            echo '<tr class="rowEven"><th>' . COMPARE_WEIGHT       . '</th>' . $compWeight       . '</tr>';
            echo '<tr class="rowOdd"><th>'  . COMPARE_MANUFACTURER . '</th>' . $compManufacturer . '</tr>';
            echo '<tr class="rowEven"><th>' . COMPARE_DESC  . '</th>' . $compDescription  . '</tr>';
            echo '<tr class="rowOdd"><th>'  . COMPARE_REMOVE             . '</th>' . $compRemove       . '</tr>';
			echo '<tr class="rowOdd"><th>'  . COMPARE_BUTTON_ADD_TO_CART     . '</th>' . $compaddtocart       . '</tr>';
        
            echo '</table></div>';
            
        } else {
          // nothing to compare
          echo NOTHING_TO_COMPARE;
        }
        
        ?>
        
        <br class="clearBoth" />
        
        </div>
	</div>
</div>

