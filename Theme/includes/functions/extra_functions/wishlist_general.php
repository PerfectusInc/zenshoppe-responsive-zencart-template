<?php

// Write a pre-formatted array contents
//-----------------------------------------------------------------
function un_dump($var, $description=NULL) {
    echo "<pre>";
    if ( !is_null($description) ) {
		echo $description.":\n";
    }
    if ( is_string($var) || is_int($var) ) {
		var_dump($var);
		echo "\n";
    } else {
		print_r($var);
		echo "\n";
    }
    echo "</pre>";
}

// get top level id
//-----------------------------------------------------------------
function get_top_category($categories_id) {

	// look up the parent of this node
	$sql = "SELECT 
				parent_id   
			FROM ".TABLE_CATEGORIES." 
			WHERE 
				categories_id='".$categories_id."' 
	";
	$result = $db->Execute($sql);
	
	if ( $result->fields['parent_id']!=0 ) {
		get_top_category($result->fields['parent_id']);
	}
	
	return $categories_id; 
}

// Test value for contents 
//-----------------------------------------------------------------

function un_is_empty($value) {
	if ( strlen(trim($value)) == 0 ) {
		return true;
	} else {
		return false;
	}
}


/*
 * Return subjects (parent_id=0)
 *-----------------------------------------------------------------------*/
function un_get_categories($fields = '') {
	global $db;
	
	if ( is_array($fields) ) {
		$fields_string = un_create_sql_field_string($fields, 'cd.');
	} else {
		$fields_string = '';
	}
	
	$sql = "select " . $fields_string . " c.categories_id, c.parent_id, cd.categories_name from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd 
			where c.parent_id=0 
			and c.categories_status=1 
			and c.categories_id = cd.categories_id 
			and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' 
			order by c.sort_order, cd.categories_name";
	
	$categories = $db->Execute($sql);
	
	return $categories;
}

/*
 * Return sql string of fields
 *-----------------------------------------------------------------------*/
function un_create_sql_field_string($aFields, $sAlias = 'pd.') {

	$sComma = ',';
	$sFields = $sAlias . implode($sComma.$sAlias, $aFields) . $sComma;
	
	return $sFields;
}


/*
 * Return option with sorting capabilities
 *-----------------------------------------------------------------------*/
function un_create_sort_option($sortby, $colnum, $heading) {
	
	if ($sortby) {
		if ( substr($sortby, 0, 1) == $colnum ) {
			$id_sel = $sortby;
			$text_sel = $heading;
			$id = $colnum . (substr($sortby, 1, 1) == 'a' ? 'd' : 'a');
			$text = $heading . (substr($sortby, 1, 1) == 'a' ? '-' : '+');
			$aOption = array(
				'id' => $id,
				'text' => $text,
			);
			$aSelected = array(
				'id' => $id_sel, 
				'text' => $text_sel,
			);
			return $aOption;
		} else {
			$aOption = array(
				'id' => $colnum . 'a',
				'text' => $heading,
			);
			return $aOption;
		}
/* 		$aOption = array( */
/* 			'id' => $colnum . ($sortby == $colnum . 'a' ? 'a' : 'a'), */
/* 			'text' => $heading, */
/* 		); */
	}
}


/*
 * Return formatted full name given first and last
 *-----------------------------------------------------------------------*/

function un_get_fullname($firstname='', $lastname='', $default='') {

    if ( zen_not_null($firstname) && zen_not_null($lastname) ) {
		$name = $firstname . " " . $lastname;
    } elseif ( zen_not_null($firstname) ) {
		$name = $firstname;
    } elseif ( zen_not_null($lastname) ) {
		$name = $lastname;
    } else {
    	$name = $default;
    }

    return zen_output_string_protected($name);
}


/*
 * Return formatted city and state given city and state
 *-----------------------------------------------------------------------*/

function un_get_citystate($firstname='', $lastname='', $default='') {

    if ( zen_not_null($firstname) && zen_not_null($lastname) ) {
		$name = $firstname . ", " . $lastname;
    } elseif ( zen_not_null($firstname) ) {
		$name = $firstname;
    } elseif ( zen_not_null($lastname) ) {
		$name = $lastname;
    } else {
    	$name = $default;
    }

    return zen_output_string_protected($name);
}


/*
 * Check required fields of html form
 *-----------------------------------------------------------------------*/

function un_check_html_form($class) {
	global $messageStack;

	if ( isset($_POST['meta-process']) && $_POST['meta-process'] == 1 ) {
		$status = true;
		foreach ( $_POST as $key => $value ) {
			if ( strstr($key, 'required-') && un_is_empty($value) ) {
				$status = false;
				$messageStack->add($class, 'Please fill-in the &quot;' . ucfirst(str_replace('required-', '', $key)) . '&quot; field.');
			}
		}
	} else {
		$status = false;
	}
	
	return $status;
}


?>