<?php
/**
* dynamic_filter.php
*
*Zen Cart dynamic filter module
*Damian Taylor, March 2010
*
*/

if(FILTER_CATEGORY == 'Yes' && $current_page_base == 'index' && !$this_is_home_page && ($category_depth == 'products' || $category_depth == 'top') || FILTER_ALL == 'Yes' && $current_page_base == 'products_all' || FILTER_NEW == 'Yes' && $current_page_base == 'products_new' || FILTER_FEATURED == 'Yes' && $current_page_base == 'featured_products' || FILTER_SPECIALS == 'Yes' && $current_page_base == 'specials' || FILTER_SEARCH == 'Yes' && $current_page_base == 'advanced_search_result') {
    require($template->get_template_dir('tpl_dynamic_filter.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_dynamic_filter.php');

  	$title =  BOX_HEADING_FILTER;
  	$title_link = false;

    require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
}
 ?>
