<?php
/*
* tpl_dynamic_filter.php
*
*Zen Cart dynamic filter module
*Damian Taylor, March 2010
*
*/

	//if (defined('CEON_URI_MAPPING_ENABLED') && CEON_URI_MAPPING_ENABLED == 1) $pageName = preg_replace('{^.*/([^\?]+)\??.*$}', '$1', $_SERVER['REQUEST_URI']); 
	$pageName = substr(strrchr($breadcrumb->trail('/'), "/"), 1);
	if (empty($currency_type)) $currency_type = $_SESSION['currency'];
	$currency_symbol = $currencies->currencies[$currency_type]['symbol_left'];
	$conversion_rate = $currencies->get_value($_SESSION['currency']);
	$resetParms = array();
	$display_limit = zen_get_new_date_range();
	if (FILTER_GOOGLE_TRACKING == 'Asynchronous') {
		$trackingStart = '_gaq.push([\'_trackEvent\', ';
		$trackingEnd = ']);';
	} else if (FILTER_GOOGLE_TRACKING == 'ga.js') {
		$trackingStart = 'pageTracker._trackEvent(';
		$trackingEnd = ');';
	}

// draw filter form
   	$content = '';
	$content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">';
	$content .= zen_draw_form('product_filter_form','', 'get');

// draw hidden fields
	reset($_GET);
	while(list($key, $value) = each ($_GET)) {
		if ( ($key != 'main_page' || $key == 'main_page' && (!defined('CEON_URI_MAPPING_ENABLED') || CEON_URI_MAPPING_ENABLED == 0 || $current_page_base == 'advanced_search_result')) && ($key != zen_session_name()) && ($key != 'error') && ($key != 'currency') && ($key != 'x') && ($key != 'y') && ($key != 'filter_id') ) {
			if ((substr($key,0,strlen(DYNAMIC_FILTER_PREFIX)) != DYNAMIC_FILTER_PREFIX) ) $content .= zen_draw_hidden_field($key, $value);
		}
	}

// use $listing_sql to populate dynamic filter
	$query_lower = strtolower($listing_sql);
	$pos_from = strpos($query_lower, ' from', 0);
	$pos_where = strpos($query_lower, ' where', 0);
	$pos_group = strpos($query_lower, ' group by', 0);
	$pos_to = strlen($query_lower);
	if ($pos_group == 0) $pos_group = $pos_to;

// list filtered and unfiltered products for category
	$unfiltered_sql = str_replace(array($filter, $having), array("",""), "SELECT p.products_id, p.products_price_sorter, p.master_categories_id, p.manufacturers_id" . substr($listing_sql, $pos_from, ($pos_where - $pos_from)) . substr($listing_sql, $pos_where, ($pos_group - $pos_where)));
	$unfiltered = $db->Execute($unfiltered_sql);

	$filtered_sql = "SELECT p.products_id, p.products_price_sorter, p.master_categories_id, p.manufacturers_id" . substr($listing_sql, $pos_from, ($pos_where - $pos_from)) . substr($listing_sql, $pos_where, ($pos_to - $pos_where));
	
	$filtered = $db->Execute($filtered_sql);
	if ($filtered->RecordCount() == 0) {
		$filtered_sql = str_replace(array($filter, $having), array("",""), "SELECT p.products_id, p.products_price_sorter, p.master_categories_id, p.manufacturers_id" . substr($listing_sql, $pos_from, ($pos_where - $pos_from)) . substr($listing_sql, $pos_where, ($pos_group - $pos_where)));
		$filtered = $db->Execute($filtered_sql);
	}

// retrieve filtered and unfiltered product options
	$min = 0;
	$max = 0;
	while (!$unfiltered->EOF) {
		if ($min == 0 or round($unfiltered->fields['products_price_sorter'], 2) < $min) $min = round($unfiltered->fields['products_price_sorter'], 2);
		if (round($unfiltered->fields['products_price_sorter'], 2) > $max) $max = round($unfiltered->fields['products_price_sorter'], 2);
		$unfilteredProducts[] = $unfiltered->fields['products_id'];
		$unfilteredManufacturers[] = $unfiltered->fields['manufacturers_id'];
		$unfilteredCategories[] = $unfiltered->fields['master_categories_id'];

		$unfiltered->MoveNext();
	}
	while (!$filtered->EOF) {	
		$priceArray[] = round($filtered->fields['products_price_sorter'], 2);
		$filteredProducts[] = $filtered->fields['products_id'];
		$filteredManufacturers[] = $filtered->fields['manufacturers_id'];
		$filteredCategories[] = $filtered->fields['master_categories_id']; 

		$filtered->MoveNext();
	}
	
	if (count($unfilteredManufacturers) > 1) $unfilteredManufacturers = array_filter(array_unique($unfilteredManufacturers));
	if (count($unfilteredCategories) > 1) $unfilteredCategories = array_filter(array_unique($unfilteredCategories));
	if (count($unfilteredProducts) > 1) $unfilteredProducts = array_filter(array_unique($unfilteredProducts));
	if (count($filteredManufacturers) > 1) $filteredManufacturers = array_filter(array_unique($filteredManufacturers));
	if (count($filteredCategories) > 1) $filteredCategories = array_filter(array_unique($filteredCategories));
	if (count($filteredProducts) > 1) $filteredProducts = array_filter(array_unique($filteredProducts));
	if (count($priceArray) > 1) $priceArray = array_filter(array_unique($priceArray));

	
/**********************************start manufacturer/category drop down/link/check boxes**********************************************/

// Only display if standard zen cart category/manufacturer dropdown is disabled
	if (PRODUCT_LIST_FILTER == 0) {
		if (isset($_GET['manufacturers_id']) && $_GET['manufacturers_id'] != '' || $current_page_base == 'products_all' || $current_page_base == 'products_new' || $current_page_base == 'specials' || $current_page_base == 'featured_products' || $current_page_base == 'advanced_search_result') {
			if (count($unfilteredCategories) > 0) {
				$group = DYNAMIC_FILTER_PREFIX . str_replace(' ', '', DYNAMIC_FILTER_CATEGORY_GROUP);
				$resetParms[] = $group;
				$parameters = zen_get_all_get_params();
				$dropdownDefault = str_replace('%n', DYNAMIC_FILTER_CATEGORY_GROUP, DYNAMIC_FILTER_DROPDOWN_DEFAULT);

				$categories = $db->Execute("SELECT categories_id, categories_name, IF(categories_id IN (" . implode(',', $filteredCategories) . "), 'Y', 'N') as flag" .
			 	" FROM " . TABLE_CATEGORIES_DESCRIPTION .
			 	" WHERE categories_id IN (" . implode(',', $unfilteredCategories) . ")" .
				" ORDER BY categories_name");

				$content .= '<div><div class="dFilter"><p class="dFilterHeading">' . DYNAMIC_FILTER_TEXT_PREFIX . DYNAMIC_FILTER_TEXT_CATEGORY . DYNAMIC_FILTER_TEXT_SUFFIX . '</p>';
				if (isset($_GET[$group]) && array_filter($_GET[$group])) $content .= '<div class="dFilterClear"><a data-original-title="Clear Filter" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array($group)), 'NONSSL') . '"><i class="fa fa-times"></i></a></div>';
				if (strtok(FILTER_STYLE, " ") == 'Dropdown') $content .= '<select name="' . $group . '[]" class="dFilterDrop"' . (FILTER_STYLE == 'Dropdown - Single' ? ' onchange="this.form.submit();"' : '') . '>' . '<option value=""' . (!isset($_GET[$group]) || !array_filter($_GET[$group]) ? ' selected="selected"' : '') . '>' . $dropdownDefault . '</option>';
				else $content .= '<ul' . (count($unfilteredCategories) > FILTER_MAX_OPTIONS ? (FILTER_OPTIONS_STYLE == 'Scroll' ? ' class="dFilterScroll">' : ' class="dFilterExpand">') : '>');
				while (!$categories->EOF) {
					if (isset($_GET[$group]) && in_array($categories->fields['categories_id'],$_GET[$group])) $linkClass = 'selected';
					else if ($categories->fields['flag'] == 'N') $linkClass = 'disabled';
					else $linkClass = 'enabled';
					
					$onClick = '';
					if (FILTER_GOOGLE_TRACKING != 'No') $onClick .= $trackingStart . '\'filterAction\', \'' . ($linkClass != 'selected' ? 'addFilter' : 'removeFilter') . '\', \'' . $pageName . ';' . DYNAMIC_FILTER_CATEGORY_GROUP . '=' . $categories->fields['categories_name'] . '\'' . $trackingEnd;
					if (FILTER_STYLE == 'Checkbox - Single') $onClick .= ' this.form.submit();';

					if (FILTER_METHOD != 'Hidden' || $linkClass != 'disabled') {
						$hrefLink = $group . '[]=' . $categories->fields['categories_id'];
						switch(strtok(FILTER_STYLE, " ")) {
						case 'Checkbox':
							$content .= '<li class="dFilterLink">' . zen_draw_checkbox_field($group . '[]', $categories->fields['categories_id'], (isset($_GET[$group]) && in_array($categories->fields['categories_id'],$_GET[$group]) ? true : false), ($linkClass == 'disabled' ? 'disabled="disabled"' : '') . ($onClick != '' && FILTER_STYLE == 'Checkbox - Single' ? ' onclick="' . $onClick . '"' : '')) . $categories->fields['categories_name'] . '</li>';
							break;
						case 'Link':
							$content .= '<li class="dFilterLink"><a class="' . $linkClass . '"' . ($linkClass != 'disabled' ? ' rel="nofollow" href="' . zen_href_link($_GET['main_page'], ($linkClass != 'selected' ? $parameters . $hrefLink : str_replace(array($hrefLink,'&'.$hrefLink), array("",""), $parameters)), 'NONSSL') . '"' . ($onClick != '' ? ' onclick="' . $onClick . '"' : '') : '') . ' >' . $categories->fields['categories_name'] . '</a></li>';
							break;
						case 'Dropdown':
						$content .= '<option value="' . $categories->fields['categories_id'] . '"' . ($linkClass == 'selected' ? ' selected="selected"' : '') . ($linkClass == 'disabled' ? ' disabled="disabled"' : '') . ($onClick != '' && FILTER_STYLE == 'Dropdown - Single' ? ' onclick="' . $onClick . '"' : '') . ' >' .  $categories->fields['categories_name'] . '</option>';
							break;
						}
					}
				$categories->MoveNext();
				}
				if (strtok(FILTER_STYLE, " ") == 'Dropdown') $content .= '</select>';
				else $content .= '</ul>';
				if (FILTER_OPTIONS_STYLE == 'Expand' && count($unfilteredCategories) > FILTER_MAX_OPTIONS) $content .= '<a class="dFilterToggle" href="#">More' . zen_image(DIR_WS_TEMPLATE_IMAGES . 'arrow_more.gif', 'More', '', '', 'class="dFilterToggleImg"') . '</a>';
				$content .= '</div></div>';
			}
		} 
		if (!isset($_GET['manufacturers_id'])) {
			if (count($unfilteredManufacturers) > 0) {
				$group = DYNAMIC_FILTER_PREFIX . str_replace(' ', '', DYNAMIC_FILTER_MANUFACTURER_GROUP);
				$resetParms[] = $group;
				$parameters = zen_get_all_get_params(array($group));
				$dropdownDefault = str_replace('%n', DYNAMIC_FILTER_MANUFACTURER_GROUP, DYNAMIC_FILTER_DROPDOWN_DEFAULT);

				$manufacturers = $db->Execute("SELECT manufacturers_id, manufacturers_name, IF(manufacturers_id IN(" . implode(',', $filteredManufacturers) . "), 'Y', 'N') as flag" .
			 	" FROM " . TABLE_MANUFACTURERS . 
			 	" WHERE manufacturers_id IN (" . implode(',', $unfilteredManufacturers) . ")" .
				" ORDER BY manufacturers_name");				

				$content .= '<div><div class="dFilter"><p class="dFilterHeading">' . DYNAMIC_FILTER_TEXT_PREFIX . DYNAMIC_FILTER_TEXT_MANUFACTURER . DYNAMIC_FILTER_TEXT_SUFFIX . '</p>';
				if (isset($_GET[$group]) && array_filter($_GET[$group])) $content .= '<div class="dFilterClear"><a data-original-title="Clear Filter" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array($group)), 'NONSSL') . '"><i class="fa fa-times"></i></a></div>';
				if (strtok(FILTER_STYLE, " ") == 'Dropdown') $content .= '<select name="' . $group . '[]" class="dFilterDrop"' . (FILTER_STYLE == 'Dropdown - Single' ? ' onchange="this.form.submit();"' : '') . '>' . '<option value=""' . (!isset($_GET[$group]) || !array_filter($_GET[$group]) ? ' selected="selected"' : '') . '>' . $dropdownDefault . '</option>';
				else $content .= '<ul' . (count($unfilteredManufacturers) > FILTER_MAX_OPTIONS ? (FILTER_OPTIONS_STYLE == 'Scroll' ? ' class="dFilterScroll">' : ' class="dFilterExpand">') : '>');
				while (!$manufacturers->EOF) {
					if (isset($_GET[$group]) && in_array($manufacturers->fields['manufacturers_id'],$_GET[$group])) $linkClass = 'selected';
					else if ($manufacturers->fields['flag'] == 'N') $linkClass = 'disabled';
					else $linkClass = 'enabled';
					
					$onClick = '';
					if (FILTER_GOOGLE_TRACKING != 'No') $onClick .= $trackingStart . '\'filterAction\', \'' . ($linkClass != 'selected' ? 'addFilter' : 'removeFilter') . '\', \'' . $pageName . ';' . DYNAMIC_FILTER_MANUFACTURER_GROUP . '=' . $manufacturers->fields['manufacturers_name'] . '\'' . $trackingEnd;
					if (FILTER_STYLE == 'Checkbox - Single') $onClick .= ' this.form.submit();';

					if (FILTER_METHOD != 'Hidden' || $linkClass != 'disabled') {
						$hrefLink = $group . '[]=' . $manufacturers->fields['manufacturers_id'];
						switch(strtok(FILTER_STYLE, " ")) {
						case 'Checkbox':
							$content .= '<li class="dFilterLink">' . zen_draw_checkbox_field($group . '[]', $manufacturers->fields['manufacturers_id'], (isset($_GET[$group]) && in_array($manufacturers->fields['manufacturers_id'],$_GET[$group]) ? true : false), ($linkClass == 'disabled' ? 'disabled="disabled"' : '') . ($onClick != '' && FILTER_STYLE == 'Checkbox - Single' ? ' onclick="' . $onClick . '"' : '')) . $manufacturers->fields['manufacturers_name'] . '</li>';
							break;
						case 'Link':
							$content .= '<li class="dFilterLink"><a class="' . $linkClass . '"' . ($linkClass != 'disabled' ? ' rel="nofollow" href="' . zen_href_link($_GET['main_page'], ($linkClass != 'selected' ? $parameters . $hrefLink : str_replace(array($hrefLink,'&'.$hrefLink), array("",""), $parameters)), 'NONSSL') . '"' . ($onClick != '' ? ' onclick="' . $onClick . '"' : '') : '') . ' >' . $manufacturers->fields['manufacturers_name'] . '</a></li>';
							break;
						case 'Dropdown':
						$content .= '<option value="' . $manufacturers->fields['manufacturers_id'] . '"' . ($linkClass == 'selected' ? ' selected="selected"' : '') . ($linkClass == 'disabled' ? ' disabled="disabled"' : '') . ($onClick != '' && FILTER_STYLE == 'Dropdown - Single' ? ' onclick="' . $onClick . '"' : '') . ' >' .  $manufacturers->fields['manufacturers_name'] . '</option>';
							break;
						}
					}
				$manufacturers->MoveNext();
				}
				if (strtok(FILTER_STYLE, " ") == 'Dropdown') $content .= '</select>';
				else $content .= '</ul>';
				if (FILTER_OPTIONS_STYLE == 'Expand' && count($unfilteredManufacturers) > FILTER_MAX_OPTIONS) $content .= '<a class="dFilterToggle" href="#">More' . zen_image(DIR_WS_TEMPLATE_IMAGES . 'arrow_more.gif', 'More', '', '', 'class="dFilterToggleImg"') . '</a>';
				$content .= '</div></div>';
			}
		}
	}
	
/**********************************end manufacturer/category drop down/link/check boxes**********************************************/


/********************************************start price range link/check boxes***************************************************/
	if (count($priceArray) > 0) {
		$priceGap = floor(($max - $min) / (FILTER_MAX_RANGES - 1)); 
		if (FILTER_MIN_PRICE > 0 && $priceGap < FILTER_MIN_PRICE) $priceGap = FILTER_MIN_PRICE;
		if (FILTER_MAX_PRICE > 0 && $priceGap > FILTER_MAX_PRICE) $priceGap = FILTER_MAX_PRICE;
		
		$group = DYNAMIC_FILTER_PREFIX . str_replace(' ', '', DYNAMIC_FILTER_PRICE_GROUP);
		$resetParms[] = $group;
		$parameters = zen_get_all_get_params();
		$dropdownDefault = str_replace('%n', DYNAMIC_FILTER_PRICE_GROUP, DYNAMIC_FILTER_DROPDOWN_DEFAULT);
		$priceCount = 0;
		$prices = '';
		
		for ($start = $min - 0.5; $start < $max; $start = $end + 0.01) {
			$end = round($start + $priceGap);
			if ($end < $max) $text = $currency_symbol . round($start * $conversion_rate) . ' -- ' . $currency_symbol . round($end * $conversion_rate);
			else $text = $currency_symbol . round($start * $conversion_rate) . ' and over';
			foreach($priceArray as $price ){
			    if ($start <= $price && $end >= $price) {
					if (isset($_GET[$group]) && in_array($start . '--' . $end,$_GET[$group])) $linkClass = 'selected';
					else $linkClass = 'enabled';
					break;
				} else $linkClass = 'disabled';
			}
			
			$onClick = '';
			if (FILTER_GOOGLE_TRACKING != 'No') $onClick .= $trackingStart . '\'filterAction\', \'' . ($linkClass != 'selected' ? 'addFilter' : 'removeFilter') . '\', \'' . $pageName . ';' . DYNAMIC_FILTER_PRICE_GROUP . '=' . $start . '-' . $end . '\'' . $trackingEnd;
			if (FILTER_STYLE == 'Checkbox - Single') $onClick .= ' this.form.submit();';

			if (FILTER_METHOD != 'Hidden' || $linkClass != 'disabled') {
				$hrefLink = $group . '[]=' . $start . '--' . $end;
				switch(strtok(FILTER_STYLE, " ")) {
				case 'Checkbox':
					$prices .= '<li class="dFilterLink">' . zen_draw_checkbox_field($group . '[]', $start . '--' . $end, (isset($_GET[$group]) && in_array($start . '--' . $end,$_GET[$group]) ? true : false), ($linkClass == 'disabled' ? 'disabled="disabled"' : '') . ($onClick != '' && FILTER_STYLE == 'Checkbox - Single' ? ' onclick="' . $onClick . '"' : '')) . $text . '</li>';
					break;
				case 'Link':
					$prices .= '<li class="dFilterLink"><a class="' . $linkClass . '"' . ($linkClass != 'disabled' ? ' rel="nofollow" href="' . zen_href_link($_GET['main_page'], ($linkClass != 'selected' ? $parameters . $hrefLink : str_replace(array($hrefLink,'&'.$hrefLink), array("",""), $parameters)), 'NONSSL') . '"' . ($onClick != '' ? ' onclick="' . $onClick . '"' : '') : '') . ' >' . $text . '</a></li>';
					break;
				case 'Dropdown':
					$prices .= '<option value="' . $start . '--' . $end . '"' . ($linkClass == 'selected' ? ' selected="selected"' : '') . ($linkClass == 'disabled' ? ' disabled="disabled"' : '') . ($onClick != '' && FILTER_STYLE == 'Dropdown - Single' ? ' onclick="' . $onClick . '"' : '') . ' >' . $text . '</option>';
					break;
				}
			}
			++$priceCount;
		}
		
		//$content .= '<hr width="90%" size="0" />';
		$content .= '<div><div class="dFilter"><p class="dFilterHeading">' . DYNAMIC_FILTER_TEXT_PREFIX . DYNAMIC_FILTER_TEXT_PRICE . DYNAMIC_FILTER_TEXT_SUFFIX . '</p>';
		if (isset($_GET[$group]) && array_filter($_GET[$group])) $content .= '<div class="dFilterClear"><a data-original-title="Clear Filter" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array($group)), 'NONSSL') . '"><i class="fa fa-times"></i></a></div>';
		if (strtok(FILTER_STYLE, " ") == 'Dropdown') $content .= '<select name="' . $group . '[]" class="dFilterDrop"' . (FILTER_STYLE == 'Dropdown - Single' ? ' onchange="this.form.submit();"' : '') . '>' . '<option value=""' . (!isset($_GET[$group]) || !array_filter($_GET[$group]) ? ' selected="selected"' : '') . '>' . $dropdownDefault . '</option>';
		else $content .= '<ul' . ($priceCount > FILTER_MAX_OPTIONS ? (FILTER_OPTIONS_STYLE == 'Scroll' ? ' class="dFilterScroll">' : ' class="dFilterExpand">') : '>');
		$content .= $prices;
		if (strtok(FILTER_STYLE, " ") == 'Dropdown') $content .= '</select>';
		else $content .= '</ul>';
		if (FILTER_OPTIONS_STYLE == 'Expand' && $priceCount > FILTER_MAX_OPTIONS) $content .= '<a class="dFilterToggle" href="#">More' . zen_image(DIR_WS_TEMPLATE_IMAGES . 'arrow_more.gif', 'More', '', '', 'class="dFilterToggleImg"') . '</a>';
		$content .= '</div></div>';
	}
		
/********************************************end price range link/check boxes***************************************************/


/********************************************start attribute link/check boxes***************************************************/

	if(count($filteredProducts) > 0){
		// Below line counts up all quantities of each item. e.g. if a glove is available in Small and Medium, quantity = 2.
		//$attributes = $db->Execute("SELECT po.products_options_name, pov.products_options_values_name, count( p2as.quantity ) as quantity" .
		$attributes = $db->Execute("SELECT count(DISTINCT p2a.products_id) as quantity, po.products_options_name, pov.products_options_values_name," .
		 " SUM(IF(p2a.products_id IN(" . implode(',', $filteredProducts) . "), 1, 0)) as flag" .
		 " FROM " . TABLE_PRODUCTS_ATTRIBUTES . " p2a ".
		 " JOIN " . TABLE_PRODUCTS_OPTIONS . " po ON p2a.options_id = po.products_options_id".
		 " JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES ." pov ON p2a.options_values_id = pov.products_options_values_id".
		 (defined('TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK') ? " JOIN " . TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK . " p2as ON p2a.products_id = p2as.products_id AND p2as.stock_attributes LIKE CONCAT('%', p2a.products_attributes_id, '%')" : "") .
		 " WHERE p2a.products_id IN (" . implode(',', $unfilteredProducts) . ")" .
		 (FILTER_OPTIONS_INCLUDE != '' ? " AND p2a.options_id IN (" . FILTER_OPTIONS_INCLUDE . ")" : '') .
		 (FILTER_OPTIONS_EXCLUDE != '' ? " AND p2a.options_id NOT IN (" . FILTER_OPTIONS_EXCLUDE . ")" : '') .
		 (defined('TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK') ? " AND p2as.quantity > 0" : "") .
		 " GROUP BY po.products_options_name, pov.products_options_values_name" .
		 " ORDER BY po.products_options_name, pov.products_options_values_sort_order");

		$savName = '';
		$savValue = '';
		//print_r();
		while (!$attributes->EOF) {
		// output if option name changes!!!
			if ($attributes->fields['products_options_name'] != $savName) {
				$options_array = array();
				if ($savName != "") {
					//$content .= '<hr width="90%" size="0" />';
					$content .= '<div><div class="dFilter"><p class="dFilterHeading">' . DYNAMIC_FILTER_TEXT_PREFIX . htmlspecialchars(html_entity_decode($savName, ENT_QUOTES)) . DYNAMIC_FILTER_TEXT_SUFFIX . '</p>';
					if (isset($_GET[$group]) && array_filter($_GET[$group])) $content .= '<div class="dFilterClear"><a data-original-title="Clear Filter" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array($group)), 'NONSSL') . '"><i class="fa fa-times"></i></a></div>';
					if (strtok(FILTER_STYLE, " ") == 'Dropdown') $content .= '<select name="' . $group . '[]" class="dFilterDrop"' . (FILTER_STYLE == 'Dropdown - Single' ? ' onchange="this.form.submit();"' : '') . '>' . '<option value=""' . (!isset($_GET[$group]) || !array_filter($_GET[$group]) ? ' selected="selected"' : '') . '>' . $dropdownDefault . '</option>';
					else $content .= '<ul' . ($attrCount > FILTER_MAX_OPTIONS ? (FILTER_OPTIONS_STYLE == 'Scroll' ? ' class="dFilterScroll">' : ' class="dFilterExpand">') : '>');
					$content .= $filters;
					if (strtok(FILTER_STYLE, " ") == 'Dropdown') $content .= '</select>';
					else $content .= '</ul>';
					if (FILTER_OPTIONS_STYLE == 'Expand' && $attrCount > FILTER_MAX_OPTIONS) $content .= '<a class="dFilterToggle" href="#">More' . zen_image(DIR_WS_TEMPLATE_IMAGES . 'arrow_more.gif', 'More', '', '', 'class="dFilterToggleImg"') . '</a>';
					$content .= '</div></div>';
				}

				$group = DYNAMIC_FILTER_PREFIX . str_replace(' ', '', $attributes->fields['products_options_name']);
				$resetParms[] = $group;
				$parameters = zen_get_all_get_params();
				$dropdownDefault = str_replace('%n', $attributes->fields['products_options_name'], DYNAMIC_FILTER_DROPDOWN_DEFAULT);
				$filters = '';
				$attrCount = 0;
			}
					
			if ($attributes->fields['products_options_values_name'] != $savValue) {
				if (isset($_GET[$group]) && in_array($attributes->fields['products_options_values_name'],$_GET[$group])) $linkClass = 'selected';
				else if (isset($_GET[$group]) && array_filter($_GET[$group]) && !in_array($attributes->fields['products_options_values_name'],$_GET[$group]) || $attributes->fields['flag'] == 0) $linkClass = 'disabled';
				//else if ($attributes->fields['flag'] == 0) $linkClass = 'disabled';
				else $linkClass = 'enabled';
				
				$onClick = '';
				if (FILTER_GOOGLE_TRACKING != 'No') $onClick .= $trackingStart . '\'filterAction\', \'' . ($linkClass != 'selected' ? 'addFilter' : 'removeFilter') . '\', \'' . $pageName . ';' . $attributes->fields['products_options_name'] . '=' . htmlspecialchars(html_entity_decode($attributes->fields['products_options_values_name'], ENT_QUOTES)) . '\'' . $trackingEnd;
				if (FILTER_STYLE == 'Checkbox - Single') $onClick .= ' this.form.submit();';

				if (FILTER_METHOD != 'Hidden' || $linkClass != 'disabled') {
					$hrefLink = $group . '[]=' . rawurlencode($attributes->fields['products_options_values_name']);
					switch(strtok(FILTER_STYLE, " ")) {
					case 'Checkbox':
						$filters .= '<li class="dFilterLink">' . zen_draw_checkbox_field($group . '[]', $attributes->fields['products_options_values_name'], (isset($_GET[$group]) && in_array($attributes->fields['products_options_values_name'],$_GET[$group]) ? true : false), ($linkClass == 'disabled' ? 'disabled="disabled"' : '') . ($onClick != '' && FILTER_STYLE == 'Checkbox - Single' ? ' onclick="' . $onClick . '"' : '')) . htmlspecialchars(html_entity_decode($attributes->fields['products_options_values_name'], ENT_QUOTES)) . '</li>';
						break;
					case 'Link':
						$filters .= '<li class="dFilterLink"><a class="' . $linkClass . '"' . ($linkClass != 'disabled' ? ' rel="nofollow" href="' . zen_href_link($_GET['main_page'], ($linkClass != 'selected' ? $parameters . $hrefLink : str_replace(array($hrefLink,'&'.$hrefLink), array("",""), $parameters)), 'NONSSL') . '"' . ($onClick != '' ? ' onclick="' . $onClick . '"' : '') : '') . ' >' . htmlspecialchars(html_entity_decode($attributes->fields['products_options_values_name'], ENT_QUOTES)) . '</a></li>';
						break;
					case 'Dropdown':
						$filters .= '<option value="' . htmlspecialchars(html_entity_decode($attributes->fields['products_options_values_name'], ENT_QUOTES)) . '"' . ($linkClass == 'selected' ? ' selected="selected"' : '') . ($linkClass == 'disabled' ? ' disabled="disabled"' : '') . ($onClick != '' && FILTER_STYLE == 'Dropdown - Single' ? ' onclick="' . $onClick . '"' : '') . ' >' .  $attributes->fields['products_options_values_name'] . '</option>';
						break;
					}
				++$attrCount;
				}
			}
			$savValue = $attributes->fields['products_options_values_name'];
			$savName = $attributes->fields['products_options_name'];
		$attributes->MoveNext();
		}
		if ($savName != "") {
			//$content .= '<hr width="90%" size="0" />';
			$content .= '<div><div class="dFilter"><p class="dFilterHeading">' . DYNAMIC_FILTER_TEXT_PREFIX . htmlspecialchars(html_entity_decode($savName, ENT_QUOTES)) . DYNAMIC_FILTER_TEXT_SUFFIX . '</p>';
			if (isset($_GET[$group]) && array_filter($_GET[$group])) $content .= '<div class="dFilterClear"><a data-original-title="Clear Filter" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array($group)), 'NONSSL') . '"><i class="fa fa-times"></i></a></div>';
			if (strtok(FILTER_STYLE, " ") == 'Dropdown') $content .= '<select name="' . $group . '[]" class="dFilterDrop"' . (FILTER_STYLE == 'Dropdown - Single' ? ' onchange="this.form.submit();"' : '') . '>' . '<option value=""' . (!isset($_GET[$group]) || !array_filter($_GET[$group]) ? ' selected="selected"' : '') . '>' . $dropdownDefault . '</option>';
			else $content .= '<ul' . ($attrCount > FILTER_MAX_OPTIONS ? (FILTER_OPTIONS_STYLE == 'Scroll' ? ' class="dFilterScroll">' : ' class="dFilterExpand">') : '>');
			$content .= $filters;
		}
		if (strtok(FILTER_STYLE, " ") == 'Dropdown') $content .= '</select>';
		else $content .= '</ul>';
		if (FILTER_OPTIONS_STYLE == 'Expand' && $attrCount > FILTER_MAX_OPTIONS) $content .= '<a class="dFilterToggle" href="#">More' . zen_image(DIR_WS_TEMPLATE_IMAGES . 'arrow_more.gif', 'More', '', '', 'class="dFilterToggleImg"') . '</a>';
		$content .= '</div>';
		if($attributes->fields['quantity'] != NULL) {
			$content .= '</div>';
		}
		elseif($attributes->fields['quantity'] == NULL) {
			$content .= '';
		}
	}

/********************************************end attribute link/check boxes***************************************************/


/********************************************start filter buttons***************************************************/
	if (FILTER_STYLE == 'Dropdown - Multi' || FILTER_STYLE == 'Checkbox - Multi') {
		$content .= '<div id="dFilterButton">';
		$content .= zen_image_submit('button_filter.png', DYNAMIC_FILTER_BUTTON_FILTER_ALT) . '<br />';
		$content .= '</div>';
	}
	foreach($resetParms as $reset){
		if (isset($_GET[$reset])) {
			$content .= '<a class="clear_all_filters" data-original-title="Clear All Filters" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params($resetParms), 'NONSSL') . '"><i class="fa fa-times-circle"></i></a>';
			break;
		}
	}
/********************************************end filter buttons***************************************************/
	//$content .= "</form>";
	if($attributes->fields['quantity'] != NULL) {
		$content .= '</form></div>';
	}
	elseif($attributes->fields['quantity'] == NULL) {
		$content .= '</form>';
	}
?>
