<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=advanced_search.<br />
 * Displays options fields upon which a product search will be run
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_advanced_search_default.php 18695 2011-05-04 05:24:19Z drbyte $
 */
?>
<div class="centerColumn" id="advSearchDefault">
	<?php echo zen_draw_form('advanced_search', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', $request_type, false), 'get', 'onsubmit="return check_form(this);"') . zen_hide_session_id(); ?>
    
	<?php echo zen_draw_hidden_field('main_page', FILENAME_ADVANCED_SEARCH_RESULT); ?>
    <header>
        <h4 id="advSearchDefaultHeading"><?php echo HEADING_TITLE_1; ?></h4>
    </header>
	<?php if ($messageStack->size('search') > 0) echo $messageStack->output('search'); ?>
	<div class="content">
		<h4>
			<?php echo HEADING_SEARCH_CRITERIA; ?>
        	<div class="forward">
				<?php //echo '<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_SEARCH_HELP) . '\')">' . TEXT_SEARCH_HELP_LINK . '</a>'; ?>
        	</div>
        </h4>
		<div class="centeredContent">
			<?php echo zen_draw_input_field('keyword', $sData['keyword'], 'onfocus="RemoveFormatString(this, \'' . KEYWORD_FORMAT_STRING . '\')"'); ?>
			<?php echo zen_draw_checkbox_field('search_in_description', '1', $sData['search_in_description'], 'id="search-in-description"'); ?>
        	<label class="checkboxLabel" for="search-in-description"><?php echo TEXT_SEARCH_IN_DESCRIPTION; ?></label>
    	</div>
	</div>
    <div class="content">
    	<div class="row">
        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4><?php echo ENTRY_CATEGORIES; ?></h4>
                <div class="centeredContent">
                    <div class="floatLeft">
                        <?php echo zen_draw_pull_down_menu('categories_id', zen_get_categories(array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES)), '0' ,'', '1'), $sData['categories_id']); ?>
                        <?php echo zen_draw_checkbox_field('inc_subcat', '1', $sData['inc_subcat'], 'id="inc-subcat"'); ?>
                        <label class="checkboxLabel" for="inc-subcat"><?php echo ENTRY_INCLUDE_SUBCATEGORIES; ?></label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            	<h4><?php echo ENTRY_MANUFACTURERS; ?></h4>
                <div class="centeredContent">
                	<div class="floatLeft">
                    	<?php echo zen_draw_pull_down_menu('manufacturers_id', zen_get_manufacturers(array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS)), PRODUCTS_MANUFACTURERS_STATUS), $sData['manufacturers_id']); ?>
                     </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
    	<div class="row">
        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4><?php echo ENTRY_PRICE_RANGE; ?></h4>
                <div class="centeredContent">
                    <label><?php echo ENTRY_PRICE_FROM; ?></label>
                    <?php echo zen_draw_input_field('pfrom', $sData['pfrom']); ?>
                    <label><?php echo ENTRY_PRICE_TO; ?></label>
                    <?php echo zen_draw_input_field('pto', $sData['pto']); ?>
                </div>
			</div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4><?php echo ENTRY_DATE_RANGE; ?></h4>
                <div class="centeredContent">
                    <label><?php echo ENTRY_DATE_FROM; ?></label>
                    <?php echo zen_draw_input_field('dfrom', $sData['dfrom'], 'onfocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"'); ?>
                    <label><?php echo ENTRY_DATE_TO; ?></label>
                    <?php echo zen_draw_input_field('dto', $sData['dto'], 'onfocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"'); ?>
                </div>
            </div>
    	</div>
    </div>
	<div class="buttonRow forward">
		<?php echo zen_image_submit(BUTTON_IMAGE_SEARCH, BUTTON_SEARCH_ALT); ?>
    </div>
	<!--<div class="buttonRow back">
		<?php //echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
    </div>-->
</form>
</div>