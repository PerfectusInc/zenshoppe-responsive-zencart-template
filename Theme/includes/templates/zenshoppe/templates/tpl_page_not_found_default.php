<?php
/**
 * Page Template
 *
 * Displays page-not-found message and site-map (if configured)
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_page_not_found_default.php 3230 2006-03-20 23:21:29Z drbyte $
 */
?>
<div class="centerColumn" id="pageNotFound">
<header>
	<h4 id="pageNotFoundHeading"><?php echo HEADING_TITLE; ?></h4>
</header>
<?php if (DEFINE_PAGE_NOT_FOUND_STATUS == '1') { ?>
<div id="pageNotFoundMainContent" class="content">
<?php
/**
 * require the html_define for the page_not_found page
 */
  require($define_page); ?>
</div>
<?php } ?>
	<div class="home_button">
    	<div class="buttonRow back button">
			<a href="<?php echo zen_href_link(FILENAME_DEFAULT."&pg=home"); ?>"><?php echo 'Go ' . HEADER_TITLE_CATALOG; ?></a>
    	</div>
	</div>
</div>
