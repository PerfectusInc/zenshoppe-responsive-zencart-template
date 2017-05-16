<?php   

	// Includes
  require('includes/application_top.php');
	require_once(DIR_WS_CLASSES . 'wishlist_class.php');
  
  // Instantiate
	$oWishlist = new un_wishlist();
  
  // Process action
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  if (zen_not_null($action)) {
    switch ($action) {
      case 'delete':
      	$oWishlist->deleteWishlist($_GET['wid']);
        break;
    }
  }
  
  // Get records
	$records = $oWishlist->getWishlists();
	
?><!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
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
  }
  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<h1><?php echo HEADING_TITLE; ?></h1>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr class="dataTableHeadingRow">
		<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CUSTOMER; ?></td>
		<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_WISHLIST; ?></td>
		<td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_COUNT; ?></td>
		<td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
	</tr>
              
<?php if ( $records->RecordCount() > 0 ) { ?>

<?php while (!$records->EOF) { ?>
	<tr>
		<td class="dataTableContent"><?php echo un_get_fullname($records->fields['customers_firstname'], $records->fields['customers_lastname'], $records->fields['customers_email_address']); ?></td>
		<td class="dataTableContent"><a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST, 'wid=' . $records->fields['id']);?>"><?php echo $records->fields['name']; ?></a></td>
		<td class="dataTableContent" align="right"><?php echo $records->fields['items_count']; ?></td>
		<td class="dataTableContent" align="right">
			<a href="<?php echo zen_href_link(UN_FILENAME_WISHLISTS, 'wid=' . $records->fields['id'] . '&action=delete'); ?>" onclick="javascript:return confirm('Are you sure you want to Delete this record?')"><?php echo zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE); ?></a>
		</td>
	</tr>
	<?php $records->MoveNext(); ?>
<?php } ?>

<?php } else { ?>
	<tr>
		<td class="dataTableContent" colspan="99"><?php echo TEXT_NO_RECORDS; ?></td>
	</tr>
<?php } ?>


</table>
        
        
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>