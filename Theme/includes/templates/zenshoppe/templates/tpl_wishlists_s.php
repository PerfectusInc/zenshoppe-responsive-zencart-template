<div id="wishlist"> <!-- begin wishlist id for styling -->

<h1><?php echo HEADING_TITLE; ?></h1>

<p><?php echo TEXT_DESCRIPTION; ?></p>

<?php 
if ( $messageStack->size('wishlists') > 0 ) { 
	echo $messageStack->output('wishlists'); 
}
?>

<ul>
	<li><a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST_EMAIL, '', 'SSL'); ?>"><?php echo UN_TEXT_EMAIL_WISHLIST; ?></a></li>
	<li><a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST_FIND); ?>"><?php echo UN_TEXT_FIND_WISHLIST; ?></a></li>
	<li><a href="<?php echo zen_href_link(UN_FILENAME_WISHLISTS, '', 'SSL'); ?>"><?php echo UN_TEXT_MANAGE_WISHLISTS; ?></a></li>
	<?php if ( UN_ALLOW_MULTIPLE_WISHLISTS===true ) { ?>
	<li><a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST_EDIT, 'op=add', 'SSL'); ?>"><?php echo UN_TEXT_NEW_WISHLIST; ?></a></li>
	<li><a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST_MOVE, '', 'SSL'); ?>"><?php echo UN_TEXT_WISHLIST_MOVE; ?></a></li>
	<?php } ?>
</ul>
 
<?php if ( $records->RecordCount() > 0 ) { ?>

<!-- record listing -->
<table cellspacing="0" class="productlist">

	<tr class="heading">
	<th><?php echo TABLE_HEADING_NAME; ?></th>
	<th><?php echo TABLE_HEADING_COMMENT; ?></th>
	<th><?php echo TABLE_HEADING_DEFAULT; ?></th>
	<th><?php echo TABLE_HEADING_PUBLIC; ?></th>
	</tr>
	
<?php 
$rows = 0;
while ( !$records->EOF ) {
	if ( $rows & 1 ) {
		$tdclass = 'even';
	} else {
		$tdclass = 'odd';
	}
?>

	<tr>
	<td class="<?php echo $tdclass; ?>"><a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST, 'wid='.$records->fields['id'], 'SSL'); ?>"><?php echo $records->fields['name']; ?></a> <a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST_EDIT, 'wid='.$records->fields['id'].'&op=edit', 'SSL'); ?>"><?php echo '[Edit]'; ?></a> <a href="<?php echo zen_href_link(UN_FILENAME_WISHLISTS, 'wid='.$records->fields['id'].'&op=del', 'SSL'); ?>"><?php echo '[Delete]'; ?></a></td>
	<td class="<?php echo $tdclass; ?>"><?php echo $records->fields['comment']; ?></td>
	<td class="<?php echo $tdclass; ?>-center"><a href="<?php echo zen_href_link(UN_FILENAME_WISHLISTS, 'wid='.$records->fields['id'].'&op=default', 'SSL'); ?>"><?php echo ($records->fields['default_status']==1?TEXT_YES:TEXT_NO); ?></a></td>
	<td class="<?php echo $tdclass; ?>-center"><a href="<?php echo zen_href_link(UN_FILENAME_WISHLISTS, 'wid='.$records->fields['id'].'&op='.($records->fields['public_status']==1?'deact':'act'), 'SSL'); ?>"><?php echo ($records->fields['public_status']==1?TEXT_YES:TEXT_NO); ?></a></td>
	</tr>
	
	<?php $rows++; ?>
	<?php $records->MoveNext(); ?>
<?php } // end while records ?>

</table>
<!-- end records listing -->

<?php } else { ?>

<p><?php echo TEXT_NO_RECORDS; ?></p>

<?php } // end RecordCount > 0 ?>

</div> <!-- end (un) id for styling -->