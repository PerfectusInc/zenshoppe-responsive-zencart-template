<?php   

	// Includes
  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'currencies.php');
	require_once(DIR_WS_CLASSES . 'wishlist_class.php');
  
  // Instantiate
  $currencies = new currencies();
	$oWishlist = new un_wishlist();
  
  // Get wishlist
  $id = (isset($_GET['wid']) ? $_GET['wid'] : '');
  if ( zen_not_null($id) ) {
		$wishlist = $oWishlist->getWishlist($id);
  } else {
  	zen_redirect(UN_FILENAME_WISHLISTS);
  	exit;
  }
  
  // Process action
  $products_id = (isset($_GET['products_id']) ? $_GET['products_id'] : '');
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  if ( zen_not_null($action) && zen_not_null($products_id) ) {
    switch ($action) {
      case 'delete':
      	$oWishlist->removeProduct($products_id);
    }
  }

	// Get products in wishlist
	$products_query = $oWishlist->getProductsQuery();
	$products = $db->Execute($products_query);
	if ( !$products ) {
		$messageStack->add('header', 'Error getting wishlist products.');
	}
	
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

<h1><?php echo HEADING_TITLE . TEXT_DELIMITER . $wishlist->fields['name']; ?></h1>

<ul>
<li><?php echo ENTRY_CUSTOMER; ?><a href="<?php echo zen_href_link(FILENAME_CUSTOMERS, 'cID=' . $wishlist->fields['customers_id']); ?>"><?php echo un_get_fullname($wishlist->fields['customers_firstname'], $wishlist->fields['customers_lastname'], $wishlist->fields['customers_email_address']); ?></a></li>
<li><?php echo ENTRY_COMMENT . $wishlist->fields['comment']; ?></li>
<li><?php echo ENTRY_DEFAULT . $wishlist->fields['default_status']; ?></li>
<li><?php echo ENTRY_PUBLIC . $wishlist->fields['public_status']; ?></li>
</ul>

<!-- product listing -->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr class="dataTableHeadingRow">

	<?php echo $oWishlist->getTableHeader(); ?>

	</tr>
              
<?php 
if ( $products->RecordCount() > 0 ) { 
	$rows = 0;
	while (!$products->EOF) {
		if ( $rows & 1 ) {
			$tdclass = 'even';
		} else {
			$tdclass = 'odd';
		}
?>

	<tr>
  
	<?php echo $oWishlist->getTableRow($tdclass, $products); ?>

	</tr>
		<?php $rows++; ?>
		<?php $products->MoveNext(); ?>
	<?php } // end while products ?>
	
<?php } else { ?>
	<tr><td colspan="99"><?php echo TEXT_NO_RECORDS; ?></td></tr>
	
<?php } ?>

</table>
<!-- end product listing -->
        
        
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>