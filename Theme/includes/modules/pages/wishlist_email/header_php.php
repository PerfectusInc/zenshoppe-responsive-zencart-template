<?php
if ( !$_SESSION['customer_id'] ) {
	$_SESSION['navigation']->set_snapshot();
	zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

// Get wishlist class and instantiate
require_once(DIR_WS_CLASSES . 'wishlist_class.php');
$oWishlist = new un_wishlist($_SESSION['customer_id']);

// Use specified wishlist if wid set, else use default wishlist
$id = isset($_REQUEST['wid']) ? (int) $_REQUEST['wid'] : '';
if ( ! un_is_empty($id) ) {
	$oWishlist->setWishlistId($id);
	if ( ! $oWishlist->hasPermission() ) {
		zen_redirect(zen_href_link(UN_FILENAME_WISHLISTS, '', 'SSL'));
	}
} else {
	$id = $oWishlist->getDefaultWishlistId();
}
require(DIR_WS_MODULES . 'require_languages.php');

$sql = "select c.customers_firstname, c.customers_lastname, c.customers_email_address from " . TABLE_CUSTOMERS . " c 
		where c.customers_id='" . (int)$_SESSION['customer_id'] . "'";
$customers = $db->Execute($sql);
$from_name = $customers->fields['customers_firstname'] . ' ' . $customers->fields['customers_lastname'];
$from_email_address = $customers->fields['customers_email_address'];

if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
	$error = false;
	
	$to_email_address = zen_db_prepare_input($_POST['to_email_address']);
	$to_name = '';
	$message = zen_db_prepare_input($_POST['message']);
	
	if (!zen_validate_email($to_email_address)) {
		$error = true;
		$messageStack->add('wishlist_email', TEXT_ERROR_EMAIL);
	}

    if ($error == false) {
		$email_subject = sprintf(TEXT_EMAIL_SUBJECT, $from_name, STORE_NAME);
		$email_body = "";
		
		if (zen_not_null($message)) {
			$email_body .= $message . "\n\n" . EMAIL_SEPARATOR . "\n\n";
		}
		
		$email_body .= sprintf(TEXT_EMAIL_LINK, $from_name,  zen_href_link(UN_FILENAME_WISHLIST_FIND, 'wid=' . $id, 'NONSSL', false));
		$email_body .= "\n\n";
		$email_body .= sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME, HTTP_SERVER . DIR_WS_CATALOG, $from_name);

		// include disclaimer
		$email_body .= "\n\n" . UN_EMAIL_SEPARATOR . EMAIL_ADVISORY . "\n\n";
		
		zen_mail($to_name, $to_email_address, $email_subject, $email_body, $from_name, $from_email_address, array('EMAIL_MESSAGE_HTML' => nl2br($email_body)));

		// send additional emails
		if (SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_STATUS == '1' and SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO !='') {
			$extra_subject = SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_SUBJECT . ' ' . $email_subject;
			$extra_body = $email_body;
			$extra_body .= OFFICE_USE . "\t" . "\n";
			$extra_body .= OFFICE_FROM . "\t" . $from_name . "\n";
			$extra_body .= OFFICE_EMAIL. "\t" . $from_email_address . "\n";
			if ( isset($customers) ) {
				$extra_body .= OFFICE_LOGGIN_EMAIL . "\t" . $customers->fields['customers_email_address'] . "\n";
			} else {
				$extra_body .= OFFICE_LOGGIN_EMAIL . "\t" . 'Anonymous' . "\n";
			}
			$extra_body .= OFFICE_IP_ADDRESS . "\t" . $_SERVER['REMOTE_ADDR'] . "\n";
			$extra_body .= OFFICE_HOST_ADDRESS . "\t" . gethostbyaddr($_SERVER['REMOTE_ADDR']) . "\n";
			$extra_body .= OFFICE_DATE_TIME . "\t" . date("D M j Y G:i:s T") . "\n\n";

			zen_mail('', SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO, $extra_subject,
			$extra_body, STORE_NAME, STORE_OWNER_EMAIL_ADDRESS);
		}

		$messageStack->add_session('header', TEXT_SUCCESS, 'success');
		
		zen_redirect(zen_href_link(UN_FILENAME_WISHLIST));
	}
}
$breadcrumb->add(NAVBAR_TITLE);
require_once(DIR_WS_CLASSES . 'wishlist_class.php');
$oWishlist = new un_wishlist($_SESSION['customer_id']);