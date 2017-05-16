<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: tpl_drop_menu.php  2005/06/15 15:39:05 DrByte Exp $
//

?>
<?php
  if(isset($_REQUEST['pg']))
  {
    $pg=$_REQUEST['pg'];
  }
?>
	<!-- menu area -->
         <ul id="nav" class="nav">
          	<li id='home' class="<?php if($this_is_home_page){ echo "tab_active"; } ?>" >
            	<a href="<?php echo zen_href_link(FILENAME_DEFAULT."&pg=home"); ?>">
                <i class="fa fa-home"></i><?php echo HEADER_TITLE_CATALOG; ?></a>
          	</li>
            
            <!--Categories Link in Menu-->
            <?php 
            	$cat_query = "select * from ".DB_PREFIX."categories where categories_status='1' ORDER BY RAND() LIMIT 1";
                $category = $db->Execute($cat_query);
                $categories_id=$category->fields['categories_id'];
            ?>
			
			<li id='categories' class="<?php if($pg=='categories') { echo "tab_active";}?>" >
            	<a href="<?php echo zen_href_link(FILENAME_DEFAULT."&cPath=".$categories_id."&pg=categories"); ?>">
				<i class="fa fa-inbox"></i><?php echo HEADER_TITLE_CATEGORIES; ?>
                </a>
			<?php			
         		// load the UL-generator class and produce the menu list dynamically from there
         		require_once (DIR_WS_CLASSES . 'categories_ul_generator.php');
         		$zen_CategoriesUL = new zen_categories_ul_generator;
        		$menulist = $zen_CategoriesUL->buildTree(true);
			   	$menulist = str_replace('"level4"','"level5"',$menulist);
			   	$menulist = str_replace('"level3"','"level4"',$menulist);
			   	$menulist = str_replace('"level2"','"level3"',$menulist);
			   	$menulist = str_replace('"level1"','"level2"',$menulist);
			   	$menulist = str_replace('<li class="">','<li class="">',$menulist);
			   	$menulist = str_replace("</li>\n</ul>\n</li>\n</ul>\n","</li>\n</ul>\n",$menulist);
			   	echo $menulist;
        	?>
            </li>
            <!--Categories Link in Menu Ends-->
            <!--Manufacturers Link in Menu-->
            <?php 
              	$man_query = "select * from ".DB_PREFIX."manufacturers ORDER BY RAND() LIMIT 1";
                $man = $db->Execute($man_query);
                $manufacturers_id=$man->fields['manufacturers_id'];
            ?>
            
            <li id="products" class="<?php if($pg=='products') { echo "tab_active";}?>" >
            	<a href="<?php echo zen_href_link(FILENAME_PRODUCTS_ALL."&pg=products"); ?>">
					<i class="fa fa-filter"></i><?php echo Products ?>
                </a>
                	<ul class="">
                    	<li><a href="<?php echo zen_href_link(FILENAME_PRODUCTS_NEW."&pg=products"); ?>">		
								<?php echo CATEGORIES_BOX_HEADING_WHATS_NEW; ?>
                        	</a>
                        </li>
                        <li><a href="<?php echo zen_href_link(FILENAME_FEATURED_PRODUCTS."&pg=products"); ?>">		
								<?php echo CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS; ?>
                        	</a>
                        </li>
                        <li><a href="<?php echo zen_href_link(FILENAME_SPECIALS."&pg=products"); ?>">		
								<?php echo CATEGORIES_BOX_HEADING_SPECIALS; ?>
                        	</a>
                        </li>
                        <li><a href="<?php echo zen_href_link(FILENAME_PRODUCTS_ALL."&pg=products"); ?>">		
								<?php echo CATEGORIES_BOX_HEADING_PRODUCTS_ALL; ?>
                        	</a>
                        </li>
                    </ul>
            </li>
            <li id='brands' class="<?php if($pg=='brands') { echo "tab_active";}?>" >
            	<a href="<?php echo zen_href_link("index&manufacturers_id=".$manufacturers_id."&pg=brands"); ?>">
				<i class="fa fa-leaf"></i><?php echo HEADER_TITLE_MANUFACTURER; ?>
                </a>
                	<ul class="">
                    	<?php
					  		global $languages_id, $db;
							$manufacturers_query = "select * from ".DB_PREFIX."manufacturers as m join ".DB_PREFIX.
							"manufacturers_info as mi on m.manufacturers_id = mi.manufacturers_id
							where mi.languages_id = ". (int)$_SESSION['languages_id'];
							$manufacturers = $db->Execute($manufacturers_query);
							while (!$manufacturers->EOF) 
								{
							        $manufacturers_id=$manufacturers->fields['manufacturers_id'];
								    $manufacturers_name=$manufacturers->fields['manufacturers_name'];
							       if($manufacturers_name !='' )
								   	 { ?>
										<li><a href="<?php echo zen_href_link("index&manufacturers_id=".$manufacturers_id."&pg=brands"); ?>">
											<?php echo $manufacturers_name; ?></a>			
                                        </li>
										<?php 
								     }
										$manufacturers->MoveNext();
								}
					  	?>
                   	</ul>
            </li>
            <!--Manufacturers Link in Menu-->
            <!--Display the EZ Pages link in Menu. Uncomment if needed. -->
            <?php /*
				global $languages_id, $db;
		 		$ezpages_query = "select * from ".DB_PREFIX."ezpages where status_header='1' and languages_id = ".(int)$_SESSION
				['languages_id'];
				$ezpages = $db->Execute($ezpages_query);
				$pages_id=$ezpages->fields['pages_id'];
			?>
            
            <li id='ezpages'>
            	<a href="<?php echo zen_href_link("page&id=".$pages_id."&pg=ezpages"); ?>">
				<i class="fa fa-rss-square fa-lg"></i><?php echo HEADER_TITLE_EZPAGES; ?></a>
                                            
              	<ul class="nav-child unstyled">
             		<?php
				  		while (!$ezpages->EOF) 
						{
  							$pages_id=$ezpages->fields['pages_id'];
  							$pages_title=$ezpages->fields['pages_title'];
 							if($pages_title !='' )
   							{
					?>
       					<li>
                        	<a href="<?php echo zen_href_link("page&id=".$pages_id."&pg=ezpages"); ?>"><?php echo $pages_title; ?></a>			
       					</li>
      					<?php }
							$ezpages->MoveNext();
						} ?>
              	</ul>
          	</li> 
            <!--EZ Pages Menu Ends Here-->
             */ ?>
          	<li class="contact_us last <?php if($pg=='contact_us') { echo "tab_active";}?>">
             	<a href="<?php echo zen_href_link(FILENAME_CONTACT_US."&pg=contact_us", '', 'NONSSL'); ?>">
					<i class="fa fa-pencil"></i><?php echo HEADER_TITLE_CONTACT_US; ?>
               	</a>
            </li>
          </ul>
	      <!-- end dropMenuWrapper-->
    <div class="clearBoth"></div>