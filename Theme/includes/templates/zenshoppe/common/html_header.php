<?php
/**
 * Common Template
 *
 * outputs the html header. i,e, everything that comes before the \</head\> tag <br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: html_header.php 19537 2011-09-20 17:14:44Z drbyte $
 */
/**
 * load the module for generating page meta-tags
 */
require(DIR_WS_MODULES . zen_get_module_directory('meta_tags.php'));
/**
 * output main page HEAD tag and related headers/meta-tags, etc
 */
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo META_TAG_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" />
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" />
<meta name="author" content="The Zen Cart&reg; Team and others" />
<meta name="generator" content="shopping cart program by Zen Cart&reg;, http://www.zen-cart.com eCommerce" />
<?php if (defined('ROBOTS_PAGES_TO_SKIP') && in_array($current_page_base,explode(",",constant('ROBOTS_PAGES_TO_SKIP'))) || $current_page_base=='down_for_maintenance' || $robotsNoIndex === true) { ?>
<meta name="robots" content="noindex, nofollow" />
<?php } ?>
<!--CSS Files-->
<!--Bootstrap CSS -->
<link rel="stylesheet" href="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'css').'/bootstrap.css'?>" type="text/css" />
<link rel="stylesheet" href="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'css').'/bootstrap-theme.css'?>" type="text/css" />
<!--Bootstrap CSS Ends -->
<link href="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'css').'/owl.transitions.css'?>" rel="stylesheet">
<!-- Menu Maker CSS -->
<link href="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'css').'/menumaker.css'?>" rel="stylesheet" type="text/css" />
<!-- Menu Maker CSS Ends -->
<!-- Zenshoppe Template CSS -->
<link href="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'css').'/templatecss.css'?>" rel="stylesheet" type="text/css" />
<!-- Zenshoppe Template CSS Ends -->
<!-- Animation CSS on Scroll -->
<link rel="stylesheet" href="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'css').'/animate.css'?>" type="text/css" media="screen" />
<!-- Animation CSS on Scroll Ends -->
<!-- Font Awesome CSS -->
<link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet" />
<!-- Font Awesome CSS Ends -->
<!-- Dropdown Select Menu CSS -->
<link rel="stylesheet" href="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'css').'/select2.css'?>" type="text/css" media="screen" />
<!-- Dropdown Select Menu CSS -->
<!-- MailChimp CSS -->
<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css" />
<!--Mail Chimp CSS Ends -->
<!-- Responsive CSS for Device -->
<link href="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'css').'/devicecss.css'?>" rel="stylesheet" type="text/css" />
<!-- Responsive CSS for Device Ends -->
<!-- Zenshoppe Theme File for Color -->

<link href="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'css').'/jquery.remodal.css'?>" rel="stylesheet" type="text/css" />

<?php
require($template->get_template_dir('tpl_zenshoppe_custom_css.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_zenshoppe_custom_css.php');
?>
<?php if ($this_is_home_page) { ?>
<style type="text/css">
	.box_heading.box_heading_new, .box_heading.box_heading_specials {
    display: none;
}
</style>
<?php } ?>
<!-- Zenshoppe Theme File for Color -->
<!--CSS files Ends-->
<!--Google Fonts-->
<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto" />
<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Libre+Baskerville" />
<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Dosis" />
<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway" />
<!--Google Fonts Ends-->
<?php if (defined('FAVICON')) { 
?>
<link rel="icon" href="<?php echo FAVICON; ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo FAVICON; ?>" type="image/x-icon" />
<?php } //endif FAVICON ?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER . DIR_WS_HTTPS_CATALOG : HTTP_SERVER . DIR_WS_CATALOG ); ?>" />
<?php if (isset($canonicalLink) && $canonicalLink != '') { ?>
<link rel="canonical" href="<?php echo $canonicalLink; ?>" />
<?php } ?>

<?php
/**
 * load all template-specific stylesheets, named like "style*.css", alphabetically
 */
  $directory_array = $template->get_template_part($template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css'), '/^style/', '.css');
  while(list ($key, $value) = each($directory_array)) {
    echo '<link rel="stylesheet" type="text/css" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css') . '/' . $value . '" />'."\n";
  }
/**
 * load stylesheets on a per-page/per-language/per-product/per-manufacturer/per-category basis. Concept by Juxi Zoza.
 */
  $manufacturers_id = (isset($_GET['manufacturers_id'])) ? $_GET['manufacturers_id'] : '';
  $tmp_products_id = (isset($_GET['products_id'])) ? (int)$_GET['products_id'] : '';
  $tmp_pagename = ($this_is_home_page) ? 'index_home' : $current_page_base;
  if ($current_page_base == 'page' && isset($ezpage_id)) $tmp_pagename = $current_page_base . (int)$ezpage_id;
  $sheets_array = array('/' . $_SESSION['language'] . '_stylesheet',
                        '/' . $tmp_pagename,
                        '/' . $_SESSION['language'] . '_' . $tmp_pagename,
                        '/c_' . $cPath,
                        '/' . $_SESSION['language'] . '_c_' . $cPath,
                        '/m_' . $manufacturers_id,
                        '/' . $_SESSION['language'] . '_m_' . (int)$manufacturers_id,
                        '/p_' . $tmp_products_id,
                        '/' . $_SESSION['language'] . '_p_' . $tmp_products_id
                        );
  while(list ($key, $value) = each($sheets_array)) {
    //echo "<!--looking for: $value-->\n";
    $perpagefile = $template->get_template_dir('.css', DIR_WS_TEMPLATE, $current_page_base, 'css') . $value . '.css';
    if (file_exists($perpagefile)) echo '<link rel="stylesheet" type="text/css" href="' . $perpagefile .'" />'."\n";
  }

/**
 * load printer-friendly stylesheets -- named like "print*.css", alphabetically
 */
  $directory_array = $template->get_template_part($template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css'), '/^print/', '.css');
  sort($directory_array);
  while(list ($key, $value) = each($directory_array)) {
    echo '<link rel="stylesheet" type="text/css" media="print" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css') . '/' . $value . '" />'."\n";
  }

/**
 * load all site-wide jscript_*.js files from includes/templates/YOURTEMPLATE/jscript, alphabetically
 */
  $directory_array = $template->get_template_part($template->get_template_dir('.js',DIR_WS_TEMPLATE, $current_page_base,'jscript'), '/^jscript_/', '.js');
  while(list ($key, $value) = each($directory_array)) {
    echo '<script type="text/javascript" src="' .  $template->get_template_dir('.js',DIR_WS_TEMPLATE, $current_page_base,'jscript') . '/' . $value . '"></script>'."\n";
  }

/**
 * load all page-specific jscript_*.js files from includes/modules/pages/PAGENAME, alphabetically
 */
  $directory_array = $template->get_template_part($page_directory, '/^jscript_/', '.js');
  while(list ($key, $value) = each($directory_array)) {
    echo '<script type="text/javascript" src="' . $page_directory . '/' . $value . '"></script>' . "\n";
  }

/**
 * load all site-wide jscript_*.php files from includes/templates/YOURTEMPLATE/jscript, alphabetically
 */
  $directory_array = $template->get_template_part($template->get_template_dir('.php',DIR_WS_TEMPLATE, $current_page_base,'jscript'), '/^jscript_/', '.php');
  while(list ($key, $value) = each($directory_array)) {
/**
 * include content from all site-wide jscript_*.php files from includes/templates/YOURTEMPLATE/jscript, alphabetically.
 * These .PHP files can be manipulated by PHP when they're called, and are copied in-full to the browser page
 */
    require($template->get_template_dir('.php',DIR_WS_TEMPLATE, $current_page_base,'jscript') . '/' . $value); echo "\n";
  }
/**
 * include content from all page-specific jscript_*.php files from includes/modules/pages/PAGENAME, alphabetically.
 */
  $directory_array = $template->get_template_part($page_directory, '/^jscript_/');
  while(list ($key, $value) = each($directory_array)) {
/**
 * include content from all page-specific jscript_*.php files from includes/modules/pages/PAGENAME, alphabetically.
 * These .PHP files can be manipulated by PHP when they're called, and are copied in-full to the browser page
 */
    require($page_directory . '/' . $value); echo "\n";
  }

// DEBUG: echo '<!-- I SEE cat: ' . $current_category_id . ' || vs cpath: ' . $cPath . ' || page: ' . $current_page . ' || template: ' . $current_template . ' || main = ' . ($this_is_home_page ? 'YES' : 'NO') . ' -->';


?>
<?php // NOTE: Blank line following is intended: ?>

