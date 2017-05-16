<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_listing_display_order.php 3369 2006-04-03 23:09:13Z drbyte $
 */
?>
<?php
// NOTE: to remove a sort order option add an HTML comment around the option to be removed
?>

	<div class="sorter">
          <?php
  echo zen_draw_form('sorter_form', zen_href_link($_GET['main_page']), 'get');
  echo zen_draw_hidden_field('main_page', $_GET['main_page']);
//  echo zen_draw_hidden_field('disp_order', $_GET['disp_order']);
  echo zen_hide_session_id();
?>
          <?php
 
  if (PRODUCT_LISTING_GRID_SORT) { 
   echo '<label for="disp-order-sorter">' . PRODUCT_LISTING_GRID_SORT_TEXT . '</label>';
   ?>
          <select name="disp_order" onchange="this.form.submit();" id="disp-order-sorter">
            <?php if ($disp_order != $disp_order_default) { ?>
            <option value="<?php echo $disp_order_default; ?>" <?php echo ($disp_order == $disp_order_default ? 'selected="selected"' : ''); ?>><?php echo PULL_DOWN_ALL_RESET; ?></option>
            <?php } // reset to store default ?>
            <option value="1" <?php echo ($disp_order == '1' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_PRODUCTS_NAME; ?></option>
            <option value="2" <?php echo ($disp_order == '2' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_PRODUCTS_NAME_DESC; ?></option>
            <option value="3" <?php echo ($disp_order == '3' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_PRODUCTS_PRICE; ?></option>
            <option value="4" <?php echo ($disp_order == '4' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_PRODUCTS_PRICE_DESC; ?></option>
            <option value="5" <?php echo ($disp_order == '5' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_PRODUCTS_MODEL; ?></option>
            <option value="6" <?php echo ($disp_order == '6' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_PRODUCTS_DATE_DESC; ?></option>
            <option value="7" <?php echo ($disp_order == '7' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_PRODUCTS_DATE; ?></option>
          </select>
          <?php 
}
?>
          <?php
 
 /* Gridview- Listview tab */
   echo $gridlist_tab;
  // draw alpha sorter
  //require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING_ALPHA_SORTER));
?>
          </form>
    </div>
