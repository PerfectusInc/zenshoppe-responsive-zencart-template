<?php
/**
 * Specials
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 3000 2006-02-09 21:11:37Z wilt $
 */

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$breadcrumb->add(NAVBAR_TITLE);

// bof dynamic filter 1 of 1
if (MAX_DISPLAY_SPECIAL_PRODUCTS > 0 ) {
  include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_DYNAMIC_FILTER));

  $listing_sql = "SELECT DISTINCT p.products_id, p.products_image, pd.products_name, p.master_categories_id, p.manufacturers_id";
	
  $listing_sql .= " FROM " . TABLE_PRODUCTS . " p LEFT JOIN " . TABLE_SPECIALS . " s on p.products_id = s.products_id" .
	" LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id" .
	" LEFT JOIN " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id" .
	" LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id" .
    ($filter_attr == true ? " JOIN " . TABLE_PRODUCTS_ATTRIBUTES . " p2a on p.products_id = p2a.products_id" .
    " JOIN " . TABLE_PRODUCTS_OPTIONS . " po on p2a.options_id = po.products_options_id" .	 
	" JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov on p2a.options_values_id = pov.products_options_values_id" .
	(defined('TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK') ? " JOIN " . TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK . " p2as on p.products_id = p2as.products_id " : "") : '');
	 
  $listing_sql .= " WHERE p.products_status = '1'".
	" AND s.status = 1" .
    " AND pd.language_id = :languagesID" . $filter . " GROUP BY p.products_id " . $having . 'ORDER BY s.specials_date_added DESC';

  $listing_sql = $db->bindVars($listing_sql, ':languagesID', $_SESSION['languages_id'], 'integer');
  $specials_split = new splitPageResults($listing_sql, MAX_DISPLAY_SPECIAL_PRODUCTS);
}
// eof dynamic filter 1 of 1 
?>