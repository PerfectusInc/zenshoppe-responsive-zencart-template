<?php 
/**
 * Zenshoppe - Premium Zencart Template
 *
 * @package Zenshoppe Admin File
 * @author Elegant Design Hub
 * @author website www.elegantdesignhub.com
 * @copyright Copyright 2013-2014 Elegant Design Hub
 * @license http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
 * @version $Id: zenshoppe.php 1.0
*/
 
require('includes/application_top.php');
require(DIR_WS_MODULES . 'prod_cat_header_code.php');	

	$query = "SELECT * from " . DB_PREFIX.zenshoppe;
			$query_result = $db->Execute($query);
			$theme_color_result = $query_result->fields['theme_color'];
			$theme_color_result = (explode(",",$theme_color_result));
			
			$logo_image_result = $query_result->fields['logo_image'];
			
			$store_address_result = $query_result->fields['store_address'];
			$store_map_result = $query_result->fields['store_map'];
			$store_contact_result = $query_result->fields['store_contact'];
			$store_email_result = $query_result->fields['store_email'];
			$store_copyright_result = $query_result->fields['store_copyright'];
			$store_fax_result = $query_result->fields['store_fax'];
			$store_skype_result = $query_result->fields['store_skype'];
			$newsletter_details_result = $query_result->fields['newsletter_details'];
			$aboutus_text_result = $query_result->fields['aboutus_text'];
			
			$facebook_link_result = $query_result->fields['facebook_link'];
			$twitter_link_result = $query_result->fields['twitter_link'];
			$pinterest_link_result = $query_result->fields['pinterest_link'];
			$google_link_result = $query_result->fields['google_link'];
			$tumblr_link_result = $query_result->fields['tumblr_link'];
			$linkedin_link_result = $query_result->fields['linkedin_link'];
			$youtube_link_result = $query_result->fields['youtube_link'];
			
			$facebook_box_result = $query_result->fields['facebook_box'];
			$twitter_box_result = $query_result->fields['twitter_box'];
			
			$custom_block_bg_result = $query_result->fields['custom_block_bg'];
			$custom_block_heading_result = $query_result->fields['custom_block_heading'];
			$custom_services_block_bg_result = $query_result->fields['custom_services_block_bg'];
			
			$banner1_slider_result = $query_result->fields['banner1_slider'];
			$banner2_slider_result = $query_result->fields['banner2_slider'];
			$banner3_slider_result = $query_result->fields['banner3_slider'];
			
			$banner1_result = $query_result->fields['banner1'];
			$banner2_result = $query_result->fields['banner2'];
			$banner3_result = $query_result->fields['banner3'];
			
			$banner1_link_result = $query_result->fields['banner1_link'];
			$banner2_link_result = $query_result->fields['banner2_link'];
			$banner3_link_result = $query_result->fields['banner3_link'];
			
			$banner1_title_result = $query_result->fields['banner1_title'];
			$banner2_title_result = $query_result->fields['banner2_title'];
			$banner3_title_result = $query_result->fields['banner3_title'];
			
			$banner1_subtitle_result = $query_result->fields['banner1_subtitle'];
			$banner2_subtitle_result = $query_result->fields['banner2_subtitle'];
			$banner3_subtitle_result = $query_result->fields['banner3_subtitle'];
			
			$bottom_banner1_result = $query_result->fields['bottom_banner1'];
			$bottom_banner2_result = $query_result->fields['bottom_banner2'];
			
			$bottom_banner1_title_result = $query_result->fields['bottom_banner1_title'];
			$bottom_banner2_title_result = $query_result->fields['bottom_banner2_title'];
			
			$bottom_banner1_subtitle_result = $query_result->fields['bottom_banner1_subtitle'];
			$bottom_banner2_subtitle_result = $query_result->fields['bottom_banner2_subtitle'];
			
			$bottom_banner1_link_result = $query_result->fields['bottom_banner1_link'];
			$bottom_banner2_link_result = $query_result->fields['bottom_banner2_link'];
			
			$payment_image_result = $query_result->fields['payment_image'];
			
			$custom_block1_icon_result = $query_result->fields['custom_block1_icon'];
			$custom_block2_icon_result = $query_result->fields['custom_block2_icon'];
			$custom_block3_icon_result = $query_result->fields['custom_block3_icon'];
			$custom_block4_icon_result = $query_result->fields['custom_block4_icon'];
			
			$custom_block1_title_result = $query_result->fields['custom_block1_title'];
			$custom_block2_title_result = $query_result->fields['custom_block2_title'];
			$custom_block3_title_result = $query_result->fields['custom_block3_title'];
			$custom_block4_title_result = $query_result->fields['custom_block4_title'];
			
			$custom_block1_subtitle_result = $query_result->fields['custom_block1_subtitle'];
			$custom_block2_subtitle_result = $query_result->fields['custom_block2_subtitle'];
			$custom_block3_subtitle_result = $query_result->fields['custom_block3_subtitle'];
			$custom_block4_subtitle_result = $query_result->fields['custom_block4_subtitle'];
			
	//Insert slideshow details
	if(isset($_POST['add_slideshow'])) {
			$slideshow_image = $_FILES['slideshow_image']['name'];
			$file_tmp =$_FILES['slideshow_image']['tmp_name'];
			$slideshow_caption = trim($_POST['slideshow_caption']);
			if($slideshow_image != NULL) {
				$slideshow_insert = "INSERT INTO " . DB_PREFIX.zenshoppe_slideshow . " (id, slideshow_image, slideshow_caption) VALUES ('','$slideshow_image','$slideshow_caption')";
				$slideshow_result = $db->Execute($slideshow_insert);
				move_uploaded_file( $file_tmp,"../includes/templates/" . $template_dir . "/images/slideshow/" . $slideshow_image);
			}
	}
	
	
	if(! isset($_POST['zenshoppe_settings']))
	{
		$theme_color = $theme_color_result;
		//print_r($theme_color);
		
		$logo_image = $logo_image_result;
		
		$store_address = $store_address_result;
		$store_map = $store_map_result;
		$store_contact = $store_contact_result;
		$store_email = $store_email_result;
		$store_copyright = $store_copyright_result;
		$store_fax = $store_fax_result;
		$store_skype = $store_skype_result;
		$newsletter_details = $newsletter_details_result;
		$aboutus_text = $aboutus_text_result;
		
		$facebook_link = $facebook_link_result;
		$twitter_link = $twitter_link_result;
		$pinterest_link = $pinterest_link_result;
		$google_link = $google_link_result;
		$tumblr_link = $tumblr_link_result;
		$linkedin_link = $linkedin_link_result;
		$youtube_link = $youtube_link_result;
		
		$facebook_box = $facebook_box_result;
		$twitter_box = $twitter_box_result;
		
		$custom_block_bg = $custom_block_bg_result;
		$custom_block_heading = $custom_block_heading_result;
		$custom_services_block_bg = $custom_services_block_bg_result;
		
		$banner1_slider = $banner1_slider_result;
		$banner2_slider = $banner2_slider_result;
		$banner3_slider = $banner3_slider_result;
		
		$banner1 = $banner1_result;
		$banner2 = $banner2_result;
		$banner3 = $banner3_result;
		
		$banner1_link = $banner1_link_result;
		$banner2_link = $banner2_link_result;
		$banner3_link = $banner3_link_result;
		
		$banner1_title = $banner1_title_result;
		$banner2_title = $banner2_title_result;
		$banner3_title = $banner3_title_result;
		
		$banner1_subtitle = $banner1_subtitle_result;
		$banner2_subtitle = $banner2_subtitle_result;
		$banner3_subtitle = $banner3_subtitle_result;
		
		$bottom_banner1 = $bottom_banner1_result;
		$bottom_banner2 = $bottom_banner2_result;
		
		$bottom_banner1_link = $bottom_banner1_link_result;
		$bottom_banner2_link = $bottom_banner2_link_result;
		
		$bottom_banner1_title = $bottom_banner1_title_result;
		$bottom_banner2_title = $bottom_banner2_title_result;
		
		$bottom_banner1_subtitle = $bottom_banner1_subtitle_result;
		$bottom_banner2_subtitle = $bottom_banner2_subtitle_result;
		
		$payment_image = $payment_image_result;
		
		$custom_block1_icon = $custom_block1_icon_result;
		$custom_block2_icon = $custom_block2_icon_result;
		$custom_block3_icon = $custom_block3_icon_result;
		$custom_block4_icon = $custom_block4_icon_result;
		
		$custom_block1_title = $custom_block1_title_result;
		$custom_block2_title = $custom_block2_title_result;
		$custom_block3_title = $custom_block3_title_result;
		$custom_block4_title = $custom_block4_title_result;
		
		$custom_block1_subtitle = $custom_block1_subtitle_result;
		$custom_block2_subtitle = $custom_block2_subtitle_result;
		$custom_block3_subtitle = $custom_block3_subtitle_result;
		$custom_block4_subtitle = $custom_block4_subtitle_result;
	}
	
	if(isset($_POST['zenshoppe_settings']))
	{
		header('Location: '.$_SERVER['PHP_SELF']); /* Important */
		
		$theme_color = $_POST['theme_color'] . ',' . $_POST['theme_color_2'];
		$theme_color = trim($theme_color);
		if($theme_color == NULL){
			$theme_color = $theme_color_result;	
		}
		$logo_image = $_FILES["file_logoimage"]["name"];
		if($logo_image == NULL){
			$logo_image = $logo_image_result;
		}
		
		
		$store_address = trim($_POST['store_address']);
		$store_map = trim($_POST['store_map']);
		$store_contact = trim($_POST['store_contact']);
		$store_email = trim($_POST['store_email']);
		$store_copyright = trim($_POST['store_copyright']);
		$store_fax = trim($_POST['store_fax']);
		$store_skype = trim($_POST['store_skype']);
		$newsletter_details = trim($_POST['newsletter_details']);
		$aboutus_text = trim($_POST['aboutus_text']);
		
		$facebook_link = trim($_POST['facebook_link']);
		$twitter_link = trim($_POST['twitter_link']);
		$pinterest_link = trim($_POST['pinterest_link']);
		$google_link = trim($_POST['google_link']);
		$tumblr_link = trim($_POST['tumblr_link']);
		$linkedin_link = trim($_POST['linkedin_link']);
		$youtube_link = trim($_POST['youtube_link']);
		
		$facebook_box = trim($_POST['facebook_box']);
		$twitter_box = trim($_POST['twitter_box']);
		
		//top banners slider
		$banner1_slider = $_FILES["banner1_slider"]["name"];
		if($banner1_slider == NULL){
			$banner1_slider = $banner1_slider_result;
		}
		$banner2_slider = $_FILES["banner2_slider"]["name"];
		if($banner2_slider == NULL){
			$banner2_slider = $banner2_slider_result;
		}
		$banner3_slider = $_FILES["banner3_slider"]["name"];
		if($banner3_slider == NULL){
			$banner3_slider = $banner3_slider_result;
		}

		//top banners
		$banner1 = $_FILES["banner1"]["name"];
		if($banner1 == NULL){
			$banner1 = $banner1_result;
		}
		$banner2 = $_FILES["banner2"]["name"];
		if($banner2 == NULL){
			$banner2 = $banner2_result;
		}
		$banner3 = $_FILES["banner3"]["name"];
		if($banner3 == NULL){
			$banner3 = $banner3_result;
		}
		
		$custom_block_bg = $_FILES["custom_block_bg"]["name"];
		if($custom_block_bg == NULL){
			$custom_block_bg = $custom_block_bg_result;
		}
		
		$custom_services_block_bg = $_FILES["custom_services_block_bg"]["name"];
		if($custom_services_block_bg == NULL){
			$custom_services_block_bg = $custom_services_block_bg_result;
		}
		
		$payment_image = $_FILES["payment_image"]["name"];
		if($payment_image == NULL){
			$payment_image = $payment_image_result;
		}
		
		$banner1_link = trim($_POST['banner1_link']);
		$banner2_link = trim($_POST['banner2_link']);
		$banner3_link = trim($_POST['banner3_link']);
		
		$banner1_title = trim($_POST['banner1_title']);
		$banner2_title = trim($_POST['banner2_title']);
		$banner3_title = trim($_POST['banner3_title']);
		
		$banner1_subtitle = trim($_POST['banner1_subtitle']);
		$banner2_subtitle = trim($_POST['banner1_subtitle']);
		$banner3_subtitle = trim($_POST['banner1_subtitle']);
		
		//bottom banners
		$bottom_banner1 = $_FILES["bottom_banner1"]["name"];
		if($bottom_banner1 == NULL){
			$bottom_banner1 = $bottom_banner1_result;
		}
		$bottom_banner2 = $_FILES["bottom_banner2"]["name"];
		if($bottom_banner2 == NULL){
			$bottom_banner2 = $bottom_banner2_result;
		}
		
		$bottom_banner1_link = trim($_POST['bottom_banner1_link']);
		$bottom_banner2_link = trim($_POST['bottom_banner2_link']);
		
		$bottom_banner1_title = trim($_POST['bottom_banner1_title']);
		$bottom_banner2_title = trim($_POST['bottom_banner2_title']);
		
		$bottom_banner1_subtitle = trim($_POST['bottom_banner1_subtitle']);
		$bottom_banner2_subtitle = trim($_POST['bottom_banner2_subtitle']);
		
		$custom_block_heading = trim($_POST['custom_block_heading']);
		
		$custom_block1_icon = trim($_POST['custom_block1_icon']);
		$custom_block2_icon = trim($_POST['custom_block2_icon']);
		$custom_block3_icon = trim($_POST['custom_block3_icon']);
		$custom_block4_icon = trim($_POST['custom_block4_icon']);
		
		$custom_block1_title = trim($_POST['custom_block1_title']);
		$custom_block2_title = trim($_POST['custom_block2_title']);
		$custom_block3_title = trim($_POST['custom_block3_title']);
		$custom_block4_title = trim($_POST['custom_block4_title']);
		
		$custom_block1_subtitle = trim($_POST['custom_block1_subtitle']);
		$custom_block2_subtitle = trim($_POST['custom_block2_subtitle']);
		$custom_block3_subtitle = trim($_POST['custom_block3_subtitle']);
		$custom_block4_subtitle = trim($_POST['custom_block4_subtitle']);
		
		$zenshoppe_query = "UPDATE " . DB_PREFIX.zenshoppe. " SET theme_color='$theme_color', logo_image='$logo_image', store_address='$store_address', store_fax='$store_fax', store_skype='$store_skype', store_map='$store_map', newsletter_details='$newsletter_details', aboutus_text='$aboutus_text', store_contact='$store_contact', store_email='$store_email', store_copyright='$store_copyright', facebook_link='$facebook_link', twitter_link='$twitter_link', pinterest_link='$pinterest_link', google_link='$google_link', tumblr_link='$tumblr_link', linkedin_link='$linkedin_link', youtube_link='$youtube_link', payment_image='$payment_image', banner1_slider='$banner1_slider', banner2_slider='$banner2_slider', banner3_slider='$banner3_slider', banner1='$banner1', banner1_link='$banner1_link', banner1_title='$banner1_title', banner1_subtitle='$banner1_subtitle', banner2='$banner2', banner2_link='$banner2_link', banner2_title='$banner2_title', banner2_subtitle='$banner2_subtitle', banner3='$banner3', banner3_link='$banner3_link', banner3_title='$banner3_title', banner3_subtitle='$banner3_subtitle', bottom_banner1='$bottom_banner1', bottom_banner1_link='$bottom_banner1_link', bottom_banner2='$bottom_banner2', bottom_banner2_link='$bottom_banner2_link', bottom_banner1_title='$bottom_banner1_title', bottom_banner2_title='$bottom_banner2_title', bottom_banner1_subtitle='$bottom_banner1_subtitle', bottom_banner2_subtitle='$bottom_banner2_subtitle', custom_block_bg='$custom_block_bg', custom_block_heading='$custom_block_heading', custom_services_block_bg='$custom_services_block_bg', custom_block1_icon='$custom_block1_icon', custom_block1_title='$custom_block1_title', custom_block1_subtitle='$custom_block1_subtitle', custom_block2_icon='$custom_block2_icon', custom_block2_title='$custom_block2_title', custom_block2_subtitle='$custom_block2_subtitle', custom_block3_icon='$custom_block3_icon', custom_block3_title='$custom_block3_title', custom_block3_subtitle='$custom_block3_subtitle', custom_block4_icon='$custom_block4_icon', custom_block4_title='$custom_block4_title', custom_block4_subtitle='$custom_block4_subtitle', facebook_box='$facebook_box', twitter_box='$twitter_box' WHERE id=1";
		
		$zenshoppe_result = $db->Execute($zenshoppe_query);
		
		
		
		
		//Delete selected Slideshow details
		foreach($_POST['slideshow_image_id'] as $key => $del_id ) {
			if(isset($_POST['slideshow_image_id'])){
				$checkboxAll = $_POST['slideshow_image_id'];
				$slideshow_image_delete = "DELETE FROM " . DB_PREFIX.zenshoppe_slideshow . " where id='$del_id'";
				$slideshow_delete_result = $db->Execute($slideshow_image_delete);
			}
		}
		
		
		//Update selected Slideshow details
		$k=0;
		if(isset($_POST['slideshow_caption_edit'][$k]) || isset($_POST['slideshow_image_update'][$k])) {
			foreach($_POST['slideshow_image_id_update'] as $k => $update_id) {
				$slideshow_caption_edit = trim(($_POST['slideshow_caption_edit'][$k]));
				$slideshow_image_update = $_FILES['slideshow_image_update']['name'][$k];
				$file_tmp_update =$_FILES['slideshow_image_update']['tmp_name'][$k];
				
				
				
				if( ($slideshow_caption_edit != NULL)) {
					$slideshow_update = "UPDATE " . DB_PREFIX.zenshoppe_slideshow . " SET slideshow_caption='$slideshow_caption_edit' where id='$update_id'";
					$slideshow_update_result = $db->Execute($slideshow_update);
				}
				
				if(($slideshow_image_update != NULL)) {
				/* process for old file remove */
				$zenshoppe_result = $db->Execute("SELECT slideshow_image FROM " . DB_PREFIX.zenshoppe_slideshow . " where id='$update_id'");
				$zenshoppe_result_img=$zenshoppe_result->fields['slideshow_image'];
				if(file_exists("../includes/templates/" . $template_dir . "/images/slideshow/" . $zenshoppe_result_img))
				{
				   unlink("../includes/templates/" . $template_dir . "/images/slideshow/" . $zenshoppe_result_img);
				}
				/* eof  process for old file remove */
				
				$slideshow_update = "UPDATE " . DB_PREFIX.zenshoppe_slideshow . " SET slideshow_image='$slideshow_image_update' where id='$update_id'";
				$slideshow_update_result = $db->Execute($slideshow_update);
				move_uploaded_file($file_tmp_update,"../includes/templates/" . $template_dir . "/images/slideshow/" . $slideshow_image_update);
				}
			}
			$k++;
		}
		
		
		move_uploaded_file($_FILES["file_logoimage"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/logo/" . $_FILES["file_logoimage"]["name"]);
		move_uploaded_file($_FILES["banner1"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/banners/" . $_FILES["banner1"]["name"]);
		move_uploaded_file($_FILES["banner2"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/banners/" . $_FILES["banner2"]["name"]);
		move_uploaded_file($_FILES["banner3"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/banners/" . $_FILES["banner3"]["name"]);
		move_uploaded_file($_FILES["banner1_slider"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/banners/" . $_FILES["banner1_slider"]["name"]);
		move_uploaded_file($_FILES["banner2_slider"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/banners/" . $_FILES["banner2_slider"]["name"]);
		move_uploaded_file($_FILES["banner3_slider"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/banners/" . $_FILES["banner3_slider"]["name"]);
		move_uploaded_file($_FILES["bottom_banner1"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/banners/" . $_FILES["bottom_banner1"]["name"]);
		move_uploaded_file($_FILES["bottom_banner2"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/banners/" . $_FILES["bottom_banner2"]["name"]);
		move_uploaded_file($_FILES["bottom_banner3"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/banners/" . $_FILES["bottom_banner3"]["name"]);
		move_uploaded_file($_FILES["bottom_banner4"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/banners/" . $_FILES["bottom_banner4"]["name"]);
		move_uploaded_file($_FILES["payment_image"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/banners/" . $_FILES["payment_image"]["name"]);
		move_uploaded_file($_FILES["custom_block_bg"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/background/" . $_FILES["custom_block_bg"]["name"]);
		move_uploaded_file($_FILES["custom_services_block_bg"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/background/" . $_FILES["custom_services_block_bg"]["name"]);
	}
	
	
	
?>


<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>

<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="../includes/templates/<?php echo $template_dir; ?>/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../includes/templates/<?php echo $template_dir; ?>/css/templatecss.css">
<link rel="stylesheet" type="text/css" href="../includes/templates/<?php echo $template_dir; ?>/css/mcColorPicker.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link href='http://fonts.googleapis.com/css?family=Telex|Muli|Quattrocento+Sans|Exo+2|Alef|Carme|PT+Sans' rel='stylesheet' type='text/css'>
<style type="text/css">
.accordian-header{
	color:#404040;
}
.accordian-header.active, h3.product_head_admin{
	color: <?php echo $theme_color; ?>;	
}
input[type="submit"] {
	color: <?php echo $theme_color[0]; ?>;;
	border: 1px solid <?php echo $theme_color[0]; ?>;	
}
input[type="submit"]:hover{
	background-color: <?php echo $theme_color[0]; ?>;
	transition: all 0.3s ease-in 0s;
		-moz-transition: all 0.3s ease-in 0s;
		-webkit-transition: all 0.3s ease-in 0s;
		-o-transition: all 0.3s ease-in 0s;
		-ms-transition: all 0.3s ease-in 0s;
	color: #FFFFFF;	
}
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
<script src="../includes/templates/<?php echo $template_dir; ?>/jscript/mcColorPicker.js" type="text/javascript"></script>
<script type="text/javascript">
 var acc = jQuery.noConflict();
acc(document).ready(function(){

//Set default open/close settings
acc('.accordian-content').hide(); //Hide/close all containers
acc('.accordian-header:first').addClass('active').next().show(); //Add "active" class to first trigger, then show/open the immediate next container

//On Click
acc('.accordian-header').click(function(){
if( acc(this).next().is(':hidden') ) { //If immediate next container is closed...
acc('.accordian-header').removeClass('active').next().slideUp(); //Remove all .accordian-header classes and slide up the immediate next container
acc(this).toggleClass('active').next().slideDown(); //Add .accordian-header class to clicked trigger and slide down the immediate next container
}
return false; //Prevent the browser jump to the link anchor
});

});
</script>
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
	function init()
	{
		cssjsmenu('navbar');
		if (document.getElementById)
		{
		  var kill = document.getElementById('hoverJS');
		  kill.disabled = true;
		}
		if (typeof _editor_url == "string")
		{
			HTMLArea.replaceAll();
		}
	}
  // -->
</script>
<?php if ($editor_handler != '') include ($editor_handler); ?>
</head>

<!-- body //-->
<body onLoad="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<div id="maincontent-wrapper" class="zenshoppe_admin">
	<div class="container">
    	<div class="msadmin_options">
            <div class="product_info_accordian row">
            	<h3 class="product_head_admin">Zenshoppe Theme Settings</h3>
				<form name="zenshoppe_settings" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                
				<div class="bg_color_setting">
					<h4 class="accordian-header">Choose your Theme Color :</h4>
					<div class="accordian-content">
                    	<p>
                            <label for="color">Primary Theme Color :</label>
                            <input type="text" class="color" size="60" name="theme_color" value="<?php echo $theme_color[0]; ?>" /> 
                            <span class="admin-text" style="color:#FF4444"></span>
						</p>
                        <p>
                            <label for="color">Secondary Theme Color :</label>
                            <input type="text" class="color" size="60" name="theme_color_2" value="<?php echo $theme_color[1]; ?>" /> 
                            <span class="admin-text" style="color:#FF4444"></span>
						</p>
                    </div>
               	</div>
				<div class="logo_setting">
					<h4 class="accordian-header">Store Logo :</h4>
            		<div class="accordian-content">
                    	<p>
        					<label for="file_logoimage" style="vertical-align:middle">Select Logo :</label>
							<input type="file" size="30" name="file_logoimage" id="file" value="<?php echo $logo_image; ?>"/><br/><br/> 
							<?php if($logo_image != NULL) { 
								echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="200px" src="../includes/templates/<?php echo $template_dir; ?>/images/logo/<?php echo $logo_image; ?>"/>
							<?php }?>
        				</p>
    				</div>
              	</div>
                <div class="slideshow">
                	<h4 class="accordian-header">Add Slideshow Images :</h4>
                    <div class="accordian-content">
                    	<p>
                        	<label for="slideshow_image">Slideshow Image:</label>
                            <input type="file" name="slideshow_image" id="file" />
                        </p>
                        <p>
                        	<label for="slideshow_caption">Slideshow Captions :</label>
                            <span class="admin-text" style="color:#FF4444">
                            </span>
                            <textarea rows="4" cols="3" name="slideshow_caption" style="width:30%;"></textarea>
                        </p>
                        <p>
                        	<input type="submit" name="add_slideshow" value="Add Slideshow" />
                        </p>
                	</div>
              	</div>
              	<div class="slideshow">
                	<h4 class="accordian-header">Delete/Edit Slideshow Details :</h4>
                   	<div class="accordian-content">
                       	Current Slideshow Images: 
                    	<span class="admin-text" style="color:#FF4444">
                        	&nbsp; &nbsp; Select Image from below to Delete it.
                      	</span>
                        <br/> <br/>
                        <?php 
							$slideshow_query = "SELECT * from " . DB_PREFIX.zenshoppe_slideshow;
							$slideshow_query_result = $db->Execute($slideshow_query);
							$i=0;
							while(!$slideshow_query_result->EOF) {
								
								$slideshow_image_name = $slideshow_query_result->fields['slideshow_image'];
								$slideshow_image_id = $slideshow_query_result->fields['id'];
								$slideshow_image_id_update=$slideshow_image_id;
								$slideshow_caption_added = trim($slideshow_query_result->fields['slideshow_caption']);
						?>
                        <div class="row">
                            <div class="slideshow_image">
                                <div class="col-lg-2">
                                    <input type="checkbox" name="slideshow_image_id[]" value="<?php echo $slideshow_image_id; ?>" />
                                    <label for="slideshow_delete">Delete</label>&nbsp;
                                </div>
                                <div class="col-lg-2">
                                    <input type="hidden" name="slideshow_image_id_update[]" value="<?php echo $slideshow_image_id_update; ?>"/>
                                    <label for="slideshow_image_update">Slideshow Image:</label>
                            		<input type="file" name="slideshow_image_update[<?php echo $i; ?>]" id="file" value="<?php echo $slideshow_image_id_update; ?>"/>
                                </div>
                                <div class="col-lg-3">
                                    <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/slideshow/<?php echo $slideshow_image_name; ?>"/>
                                </div>
                                <div class="col-lg-5">
                                    <textarea rows="4" cols="3" name="slideshow_caption_edit[<?php echo $i; ?>]" value="<?php echo $slideshow_image_id_update; ?>"><?php echo $slideshow_caption_added; ?></textarea>
                                </div>
                            </div>
						</div>
                        <?php $i++; $slideshow_query_result->MoveNext(); } ?>
                	</div>
                </div>
                
                <div class="store_banners_slider">
                	<h4 class="accordian-header">Custom Top Banners Slider :</h4>
    				<div class="accordian-content">
                        <div class="banners">
                            <p>
                        		<label for="banner1_slider">Top Slider Banner - 1 :</label>
                            	<input type="file" size="30" name="banner1_slider" id="file" value="<?php echo $banner1_slider; ?>"/>
                        	</p>
                            <p>
                                <?php if($banner1_slider != NULL) { 
								echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $banner1_slider; ?>"/>
							<?php } ?>
                            </p>
                        </div>
                        <div class="banners">
                            <p>
                        		<label for="banner2_slider">Top Slider Banner - 2 :</label>
                            	<input type="file" size="30" name="banner2_slider" id="file" value="<?php echo $banner2_slider; ?>"/>
                        	</p>
                            <p>
                                <?php if($banner2_slider != NULL) { 
								echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $banner2_slider; ?>"/>
							<?php } ?>
                            </p>
                        </div>
                        <div class="banners">
                            <p>
                        		<label for="banner3_slider">Top Slider Banner - 3 :</label>
                            	<input type="file" size="30" name="banner3_slider" id="file" value="<?php echo $banner3_slider; ?>"/>
                        	</p>
                            <p>
                                <?php if($banner3_slider != NULL) { 
								echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $banner3_slider; ?>"/>
							<?php } ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="store_banners">
                	<h4 class="accordian-header">Custom Top Banners :</h4>
    				<div class="accordian-content">
                        <div class="banners">
                            <p>
                        		<label for="banner1">Top Banner - 1 :</label>
                            	<input type="file" size="30" name="banner1" id="file" value="<?php echo $banner1; ?>"/>
                        	</p>
                            <p>
                        		<label for="banner1_link">Link :</label>
                            	<input type="text" size="60" name="banner1_link" value="<?php echo $banner1_link; ?>"/>
                        	</p>
                            <p>
                        		<label for="banner1_title">Title :</label>
                            	<input type="text" size="60" name="banner1_title" value="<?php echo $banner1_title; ?>"/>
                        	</p>
                            <p>
                        		<label for="banner1_subtitle">Sub Title :</label>
                            	<input type="text" size="60" name="banner1_subtitle" value="<?php echo $banner1_subtitle; ?>"/>
                        	</p>
                            <p>
                                <?php if($banner1 != NULL) { 
								echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $banner1; ?>"/>
							<?php } ?>
                            </p>
                        </div>
                        <div class="banners">
                            <p>
                        		<label for="banner2">Top Banner - 2 :</label>
                            	<input type="file" size="30" name="banner2" id="file" value="<?php echo $banner2; ?>"/>
                        	</p>
                            <p>
                        		<label for="banner2_link">Link :</label>
                            	<input type="text" size="60" name="banner2_link" value="<?php echo $banner2_link; ?>"/>
                        	</p>
                            <p>
                        		<label for="banner2_title">Title :</label>
                            	<input type="text" size="60" name="banner2_title" value="<?php echo $banner2_title; ?>"/>
                        	</p>
                            <p>
                        		<label for="banner2_subtitle">Sub Title :</label>
                            	<input type="text" size="60" name="banner2_subtitle" value="<?php echo $banner2_subtitle; ?>"/>
                        	</p>
                            <p>
                                <?php if($banner2 != NULL) { 
								echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $banner2; ?>"/>
							<?php } ?>
                            </p>
                        </div>
                        <div class="banners">
                            <p>
                        		<label for="banner3">Top Banner - 3 :</label>
                            	<input type="file" size="30" name="banner3" id="file" value="<?php echo $banner3; ?>"/>
                        	</p>
                            <p>
                        		<label for="banner3_link">Link :</label>
                            	<input type="text" size="60" name="banner3_link" value="<?php echo $banner3_link; ?>"/>
                        	</p>
                            <p>
                        		<label for="banner3_title">Title :</label>
                            	<input type="text" size="60" name="banner3_title" value="<?php echo $banner3_title; ?>"/>
                        	</p>
                            <p>
                        		<label for="banner3_subtitle">Sub Title :</label>
                            	<input type="text" size="60" name="banner3_subtitle" value="<?php echo $banner3_subtitle; ?>"/>
                        	</p>
                            <p>
                                <?php if($banner3 != NULL) { 
								echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $banner3; ?>"/>
							<?php } ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="store_bottom_banners">
                	<h4 class="accordian-header">Custom Bottom Banners :</h4>
    				<div class="accordian-content">
                        <div class="banners">
                            <p>
                        		<label for="bottom_banner1">Bottom Banner - 1 :</label>
                            	<input type="file" size="30" name="bottom_banner1" id="file" value="<?php echo $bottom_banner1; ?>"/>
                        	</p>
                            <p>
                        		<label for="bottom_banner1_link">Link :</label>
                            	<input type="text" size="60" name="bottom_banner1_link" value="<?php echo $bottom_banner1_link; ?>"/>
                        	</p>
                            <p>
                        		<label for="bottom_banner1_title">Title :</label>
                            	<input type="text" size="60" name="bottom_banner1_title" value="<?php echo $bottom_banner1_title; ?>"/>
                        	</p>
                            <p>
                        		<label for="bottom_banner1_subtitle">Sub Title :</label>
                            	<input type="text" size="60" name="bottom_banner1_subtitle" value="<?php echo $bottom_banner1_subtitle; ?>"/>
                        	</p>
                            <p>
                                <?php if($bottom_banner1 != NULL) { 
								echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $bottom_banner1; ?>"/>
							<?php } ?>
                            </p>
                        </div>
                        <div class="banners">
                            <p>
                        		<label for="bottom_banner2">Bottom Banner - 2 :</label>
                            	<input type="file" size="30" name="bottom_banner2" id="file" value="<?php echo $bottom_banner2; ?>"/>
                        	</p>
                            <p>
                        		<label for="bottom_banner2_link">Link :</label>
                            	<input type="text" size="60" name="bottom_banner2_link" value="<?php echo $bottom_banner2_link; ?>"/>
                        	</p>
                            <p>
                        		<label for="bottom_banner2_title">Title :</label>
                            	<input type="text" size="60" name="bottom_banner2_title" value="<?php echo $bottom_banner2_title; ?>"/>
                        	</p>
                            <p>
                        		<label for="bottom_banner2_subtitle">Sub Title :</label>
                            	<input type="text" size="60" name="bottom_banner2_subtitle" value="<?php echo $bottom_banner2_subtitle; ?>"/>
                        	</p>
                            <p>
                                <?php if($bottom_banner2 != NULL) { 
								echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $bottom_banner2; ?>"/>
							<?php } ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="custom_content">
                	<h4 class="accordian-header">Custom Featured Products Block :</h4>
    				<div class="accordian-content">
                    	<div class="custom_block_content">
                            <p>
                        		<label for="custom_block_bg">Background Image :</label>
                            	<input type="file" id="file" size="30" name="custom_block_bg" value="<?php echo $custom_block_bg; ?>"/>
                        	</p>
                            <p>
                                <?php if($custom_block_bg != NULL) { 
								echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/background/<?php echo $custom_block_bg; ?>"/>
							<?php } ?>
                            </p>
                    	</div>
                	</div>
                </div>
                <div class="custom_content">
                	<h4 class="accordian-header">Custom Our Services Block :</h4>
    				<div class="accordian-content">
                    	<div class="custom_block_content">
                        	 <p>
                        		<label for="custom_block_heading">Our Services Heading :</label>
                            	<textarea style="width:40%" rows="3" cols="4" name="custom_block_heading"><?php echo $custom_block_heading; ?></textarea>
                        	</p>
                            <p>
                        		<label for="custom_services_block_bg">Background Image :</label>
                            	<input type="file" id="file" size="30" name="custom_services_block_bg" value="<?php echo $custom_services_block_bg; ?>"/>
                        	</p>
                            <p>
                                <?php if($custom_services_block_bg != NULL) { 
								echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                                <img height="auto" width="120px" src="../includes/templates/<?php echo $template_dir; ?>/images/background/<?php echo $custom_services_block_bg; ?>"/>
							<?php } ?>
                            </p>
                    	</div>
                        <div class="custom_block_content">
                        	<h4>Custom Block - 1 </h4>
                    		<p>
                        		<label for="custom_block1_icon">Custom Block Font-awesome Icon :</label>
                            	<input type="text" size="60" name="custom_block1_icon" value="<?php echo $custom_block1_icon; ?>"/>
                        	</p>
                            <p>
                        		<label for="custom_block1_title">Custom Block Title :</label>
                            	<input type="text" size="60" name="custom_block1_title" value="<?php echo $custom_block1_title; ?>"/>
                        	</p>
                            <p>
                        		<label for="custom_block1_subtitle">Custom Block Subtitle :</label>
                                <textarea style="width:40%" rows="3" cols="4" name="custom_block1_subtitle"><?php echo $custom_block1_subtitle; ?></textarea>
                        	</p>
                    	</div>
                        <div class="custom_block_content">
                        	<h4>Custom Block - 2 </h4>
                    		<p>
                        		<label for="custom_block2_icon">Custom Block Font-awesome Icon :</label>
                            	<input type="text" size="60" name="custom_block2_icon" value="<?php echo $custom_block2_icon; ?>"/>
                        	</p>
                            <p>
                        		<label for="custom_block2_title">Custom Block Title :</label>
                            	<input type="text" size="60" name="custom_block2_title" value="<?php echo $custom_block2_title; ?>"/>
                        	</p>
                            <p>
                        		<label for="custom_block2_subtitle">Custom Block Subtitle :</label>
                            	<textarea rows="3" cols="4" name="custom_block2_subtitle" style="width:40%"><?php echo $custom_block2_subtitle; ?></textarea>
                        	</p>
                    	</div>
                        <div class="custom_block_content">
                        	<h4>Custom Block - 3 </h4>
                    		<p>
                        		<label for="custom_block3_icon">Custom Block Font-awesome Icon :</label>
                            	<input type="text" size="60" name="custom_block3_icon" value="<?php echo $custom_block3_icon; ?>"/>
                        	</p>
                            <p>
                        		<label for="custom_block3_title">Custom Block Title :</label>
                            	<input type="text" size="60" name="custom_block3_title" value="<?php echo $custom_block3_title; ?>"/>
                        	</p>
                            <p>
                        		<label for="custom_block3_subtitle">Custom Block Subtitle :</label>
                            	<textarea rows="3" cols="4" name="custom_block3_subtitle" style="width:40%"><?php echo $custom_block3_subtitle; ?></textarea>
                        	</p>
                    	</div>
                        <div class="custom_block_content">
                        	<h4>Custom Block - 4 </h4>
                    		<p>
                        		<label for="custom_block4_icon">Custom Block Font-awesome Icon :</label>
                            	<input type="text" size="60" name="custom_block4_icon" value="<?php echo $custom_block4_icon; ?>"/>
                        	</p>
                            <p>
                        		<label for="custom_block4_title">Custom Block Title :</label>
                            	<input type="text" size="60" name="custom_block4_title" value="<?php echo $custom_block4_title; ?>"/>
                        	</p>
                            <p>
                        		<label for="custom_block4_subtitle">Custom Block Subtitle :</label>
                            	<textarea rows="3" cols="4" name="custom_block4_subtitle" style="width:40%"><?php echo $custom_block4_subtitle; ?></textarea>
                        	</p>
                    	</div>
                	</div>
    			</div>
                <div class="contact_details">            
					<h4 class="accordian-header">Store Contact Details :</h4>
    				<div class="accordian-content">
                    	<p>
                    		<span class="admin-text" style="color:#FF4444">
                        		Leave empty to remove the detail from template.
                        	</span>
                    	</p>
                    	<p>
                        	<label for="store_address">Address :</label>
                            <textarea rows="3" cols="2" name="store_address" style="width:30%;"><?php echo $store_address; ?></textarea>
                        </p>
                        <p>
                            <label for="store_contact">Contact Number :</label>
                        	<input type="text" size="60" name="store_contact" value="<?php echo $store_contact; ?>" />
                        </p>
                        <p>
                            <label for="store_fax">Fax :</label>
                        	<input type="text" size="60" name="store_fax" value="<?php echo $store_fax; ?>" />
                        </p>
                        <p>
                            <label for="store_skype">Skype Id :</label>
                        	<input type="text" size="60" name="store_skype" value="<?php echo $store_skype; ?>" />
                        </p>
                        <p>
                            <label for="store_email">Store Email Address :</label>
                            <input type="text" size="60" name="store_email" value="<?php echo $store_email; ?>" />
                        </p>
                    </div>
                </div>
                <div class="sociallinks_details">            
					<h4 class="accordian-header">Store Social Links :</h4>
    				<div class="accordian-content">
                        <p>
                        	<label for="facebook_link">Facebook Page Link :</label>
                            <input type="text" size="60" name="facebook_link" value="<?php echo $facebook_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>(e.g : envato). Leave text-box empty to hide the Facebook link.
                            </span>
                        </p>
                        <p>
                        	<label for="twitter_link">Twitter Page Link :</label>
                            <input type="text" size="60" name="twitter_link" value="<?php echo $twitter_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>(e.g : envato). Leave text-box empty to hide the Twitter link.
                            </span>
                        </p>
                        <p>
                        	<label for="pinterest_link">Pinterest Link :</label>
                            <input type="text" size="60" name="pinterest_link" value="<?php echo $pinterest_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>(e.g : envato). Leave text-box empty to hide the Pinterest link.
                            </span>
                        </p>
                        <p>
                        	<label for="google_link">Google Plus Link :</label>
                            <input type="text" size="60" name="google_link" value="<?php echo $google_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>(e.g : https://plus.google.com/yourpage). Leave text-box empty to hide the Google Plus link.
                            </span>
                        </p>
                        <p>
                        	<label for="tumblr_link">Tumblr Page Link :</label>
                            <input type="text" size="60" name="tumblr_link" value="<?php echo $tumblr_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>(e.g : http://yourpage.tumblr.com). Leave text-box empty to hide the Tumblr link.
                            </span>
                        </p>
                        <p>
                        	<label for="linkedin_link">LinkedIn Page Link :</label>
                            <input type="text" size="60" name="linkedin_link" value="<?php echo $linkedin_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>Leave text-box empty to hide the LinkedIn link.
                            </span>
                        </p>
                        <p>
                        	<label for="youtube_link">Youtube Page Link :</label>
                            <input type="text" size="60" name="youtube_link" value="<?php echo $youtube_link; ?>" />
                            <span class="admin-text" style="color:#FF4444">
                                <br/><br/>Leave text-box empty to hide the Youtube link.
                            </span>
                        </p>
                    </div>
                </div>
                <div class="newsletter_details">            
					<h4 class="accordian-header">Newletter Subscribe Details :</h4>
    				<div class="accordian-content">
                        <p>
                        	<label for="newsletter_details">Newsletter Subcribe Code for your Store (Mail Chimp Account) :</label>
            				<textarea rows="5" cols="2" name="newsletter_details" style="width:40%;"><?php echo $newsletter_details; ?></textarea>
            				<span class="admin-text" style="color:#FF4444;">
            					Get this code from your Mail Chimp Account. Follow instructions in Documentation to get the code.
            				</span>
                        </p>
                     </div>
                </div>
                <div class="payment_image">
                	<h4 class="accordian-header">Payment Method Image : </h4>
                    <div class="accordian-content">
                    	<p>
                        	<label for="payment_image">Select Payment Method Image :</label>
                            <input type="file" size="30" name="payment_image" id="file" value="<?php echo $payment_image; ?>"/>
                        </p>
                        <p>
                        	<?php if($payment_image != NULL) { 
							echo "<label style='vertical-align:top'>Current Image : </label>";?> 
                            <img height="auto" width="100px" 
                            	src="../includes/templates/<?php echo $template_dir; ?>/images/banners/<?php echo $payment_image; ?>"/>
							<?php } ?>
                        </p>
                	</div>
                </div>
                <div class="googlemap_details">            
					<h4 class="accordian-header">Google Map :</h4>
    				<div class="accordian-content">
                        <p>
                        	<label for="store_map">Google Map iframe code for your Store :</label>
            				<textarea rows="5" cols="2" name="store_map" style="width:40%;"><?php echo $store_map; ?></textarea>
            				<span class="admin-text" style="color:#FF4444;">
            					Get this iframe code from Google Maps. Leave blank to remove Google Map from Contact Us page.
            				</span>
                        </p>
                     </div>
                </div>
                <div class="aboutus_text">            
					<h4 class="accordian-header">About Us Details :</h4>
    				<div class="accordian-content">
                        <p>
                        	<label for="aboutus_text">About Us Text :</label>
            				<textarea rows="5" cols="2" name="aboutus_text" style="width:40%;"><?php echo $aboutus_text; ?>
                            </textarea>
                        </p>
                     </div>
                </div>
                <div class="copyright_details">            
					<h4 class="accordian-header">Copyright Text :</h4>
    				<div class="accordian-content">
                        <p>
                        	<label for="store_copyright">Copy Right Information :</label>
                            <input type="text" size="60" name="store_copyright" value="<?php echo $store_copyright; ?>" />
                        </p>
    				</div>
                </div>
                <div class="socialmedia">            
					<h4 class="accordian-header">Social Media Boxes :</h4>
    				<div class="accordian-content">
                    	<span class="admin-text" style="color:#FF4444">
                         	Leave text-box empty to hide the Social Media Box.
                        </span>
                        <p>
                        	<label for="facebook_box">Facebook Page :</label>
                            <input type="text" size="60" name="facebook_box" value="<?php echo $facebook_box; ?>" />
                        </p>
                        <p>
                        	<label for="twitter_box">Twitter :</label>
                            <textarea rows="5" cols="2" name="twitter_box" style="width:40%;"><?php echo $twitter_box; ?>
                            </textarea>
                        </p>
    				</div>
                </div>
        		<p style="text-align:center"><input type="submit" name="zenshoppe_settings" value="Save Changes" /></p>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->

</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>