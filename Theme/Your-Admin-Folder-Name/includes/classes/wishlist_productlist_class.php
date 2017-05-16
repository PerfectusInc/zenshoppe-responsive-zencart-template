<?php 

// File Location: /admin/includes/classes/un_productlist.class.php

/** 
 * handles product list functions
 */

class un_productlist {
    
	/** 
	 * fields for product list
	 *
	 * @var array
	 * @access private
	 * @see setStructure()
	 */
	var $_aFields = array();
	
	/** 
	 * structure for product list
	 *
	 * @var array
	 * @access private
	 * @see setStructure()
	 */
	var $_aStructure = array();
	
	/** 
	 * sql
	 *
	 * @var string
	 * @access public
	 * @see $this->setSqlFrom
	 */
	var $_sSqlFrom='';
	
	/** 
	 * sql
	 *
	 * @var string
	 * @access public
	 * @see $this->setSqlWhere
	 */
	var $_sSqlWhere='';
	
	/** 
	 * zencart db object
	 *
	 * @var object
	 * @access private
	 */
	var $_oDB;
	
	/** 
	 * zencart message object
	 *
	 * @var object
	 * @access private
	 */
	var $_oMessages;
	
	/** 
	 * default page for errors
	 *
	 * @var string
	 * @access public
	 * @see $this->_oMessages->add()
	 */
	var $_sName='header';
    
    
	// CONSTRUCTOR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    
	/** 
	 * class constructor
	 *
	 * @access public
	 *----------------------------------------------------------*/
	function un_productlist() {
		global $db, $messageStack;
		
		// implement db object
		$this->_oDB =& $db;
		$this->_oMessages =& $messageStack;

	}
    
    
	// PUBLIC METHODS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	
	/** 
	 * get structure
	 *
	 * @return array
	 * @access public
	 *----------------------------------------------------------*/
	function getStructure() {
	
		$structure = $this->_aStructure;	
		foreach ($structure as $val) {
			$sortarray[] = $val['column_order'];
		}
		array_multisort($sortarray,$structure);
		
		return $structure;
    }
    
    /** 
     * set stuff
     *
     * @return boolean
     * @access public
     *----------------------------------------------------------*/
	
	function setStructure($structure) {
		
		foreach ($structure as $val) {
			$sortarray[] = $val['column_order'];
		}
		array_multisort($sortarray,$structure);
		$this->_aStructure = $structure;
		
		return true;
    }
	
	function setFields($fields) {
		
		$this->_aFields = $fields;
		
		return true;
    }
    
	function setSqlFrom($string) {
		
		$this->_sSqlFrom = $string;
		
		return true;
    }
    
	function setSqlWhere($string) {
		
		$this->_sSqlWhere = $string;
		
		return true;
    }
	
	
	/*
	 * Sort options
	 *-----------------------------------------------------------------------*/
	 
	function getSortOptions($current_option) {
	
		$define_list = $this->getStructure();
		
		$options = array();
		foreach ( $define_list as $value ) {
			if ( $value['sortable'] == true ) {
		/* 		$lc_text = zen_create_sort_heading($current_option, $col+1, $lc_text); */
				$lc_option = un_create_sort_option($current_option, $value['column_order'], $value['label']);
				array_push($options, $lc_option);
				
				if ( substr($current_option, 0, 1) == $value['column_order'] ) {
					$lc_option = array(
						'id' => $current_option,
						'text' => $value['label'],
					);
					array_push($options, $lc_option);
				}
			}
		}
		return $options;
	}
	
	
	/*
	 * Generic Main function
	 *-----------------------------------------------------------------------*/
	 
	function getProductsQuery() {
	
		$define_list = $this->getStructure();
		$extra_fields = $this->_aFields;
		$sql_from = $this->_sSqlFrom;
		$sql_where = $this->_sSqlWhere;
		
		// Manipulate define_list array to get column order, fields, default
		foreach ($define_list as $val) {
			$sortarray[] = $val['column_order'];
			if ( isset($val['field']) && zen_not_null($val['field']) && !in_array($val['field'], $extra_fields) ) {
				array_push($extra_fields, $val['field']);
			}
			if ( $val['default'] == true ) {
				$default = $val;
			}
		}
		array_multisort($sortarray,$define_list);
		
		$field_string = un_create_sql_field_string($extra_fields, '');
		$sql_select = "select " . substr($field_string, 0, strlen($field_string)-1) . " ";
		$sql_filter = "";
		if ( isset($_GET['cPath']) && $_GET['cPath'] ) {
			$sql_filter .= "and p2c.categories_id = '" . $_GET['cPath'] . "' ";
			$sql_from .= ", " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c ";
			$sql_where .= " and p.products_id = p2c.products_id ";
		}
	
		// Define order based on posted html form
		if ( (!isset($_GET['sort'])) || (!ereg('[1-9][ad]', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($define_list)) ) {
			$_GET['sort'] = $default['column_order'] . 'a';
			$sql_order .= ' order by ' . $default['field'];
		} else {
			$sort_col = substr($_GET['sort'], 0 , 1);
			$sort_order = substr($_GET['sort'], 1);
			foreach ($define_list as $key => $val) {
				if ( $val['column_order'] == $sort_col ) {
					break;
				}
			}
			$sql_order .= ' order by ' . $define_list[$key]['field'] . ' ' . ($sort_order == 'd' ? 'desc' : '') . ', ' . $default['field'];
		}
		
		$listing_sql = $sql_select . $sql_from . $sql_where . $sql_filter . $sql_order;
		
		return $listing_sql;
	}
	
	function getTableHeader() {
	
		$result = '';
		for ($col=0;$col<sizeof($this->_aStructure);$col++) {

			$params = '';
			if ($this->_aStructure[$col]['align']) {
				$params = ' class="' . $this->_aStructure[$col]['align'] . '"';
			}	
			 
			$result .= '<th' . $params . '>';
			$result .= $this->_aStructure[$col]['label'];
			$result .= '</th>';

		} // end for each column
	
		return $result;
	}
	
	function getTableRow($tdclass='', $products) {
		
		$dispatch = $this->getDispatch();
		
		$result = '';
		for ($col=0;$col<sizeof($this->_aStructure);$col++) {

			$params = ' class="' . $tdclass . ($this->_aStructure[$col]['align'] ? '-' . $this->_aStructure[$col]['align'] : '') . '"';
			$result .= '<td' . $params . '>';
			$cmd = $this->_aStructure[$col]['command'];
			if ( array_key_exists($cmd,$dispatch) ) {
				$function = $dispatch[$cmd];
				$return = $this->$function($this->_aStructure[$col], $products);
				if ( $return ) {
					$result .= $return;
				}
			} else {
				$result .= 'command not found';
			}
			$result .= '</td>';

		} // end for each column
	
		return $result;
	}
    
    
	// PRIVATE METHODS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	
	/** 
	* associative array of descriptions used in product list structure
	* and respective functions to which they're mapped
	*
	* @var array
	* @access private
	* @see getDispatch()
	*/
	var $_aDispatchFunctions = array(
		'field_value'				=>	'_dispatchFieldValue',
		'price'						=>	'_dispatchPrice',
		'comment_hidden'			=>	'_dispatchCommentHidden',
		'comment_field'				=>	'_dispatchCommentField',
		'quantity_hidden'			=>	'_dispatchQuantityHidden',
		'priority_menu_s'			=>	'_dispatchPriorityMenuSmall',
		'select_checkbox'			=>	'_dispatchSelectCheckbox',
		'deletewish_checkbox'		=>	'_dispatchDeleteWishCheckbox',
		'addcart_checkbox'			=>	'_dispatchAddCartCheckbox',
		'product'					=>	'_dispatchProduct',
		'addcart_field'				=>	'_dispatchAddCartField',
		'addcart_link'				=>	'_dispatchAddCartLink',
		'addcart_multi'				=>	'_dispatchAddCartMulti',
		'action'				=>	'_dispatchAction',
	);
	
	/** 
	 * get dispatch function array
	 *
	 * @return array
	 * @access public
	 *----------------------------------------------------------*/
	 
	function getDispatch() {
		return $this->_aDispatchFunctions;
	}
    
	/** 
	* dispatch functions
	* functions referenced in product list structure
	* returning html strings computed from given product data
	*
	* @return string
	* @access private
	*----------------------------------------------------------*/
	
	function _dispatchFieldValue($map, $data) {
		$value = $data->fields[substr($map['field'], strpos($map['field'], '.')+1)];
		return $value;
	}
	
	function _dispatchPrice($map, $data) {
		$value = zen_get_products_actual_price($data->fields['products_price']);
		return $value;
	}
	
	function _dispatchAction($map, $data) {
		$value = '<a href="' . zen_href_link(UN_FILENAME_WISHLIST, 'wid=' . $_REQUEST['wid'] . '&products_id=' . $data->fields['products_id'] . '&action=delete') . '" onclick="javascript:return confirm(\'Are you sure you want to Delete this record?\')">' . zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE) . '</a>';
		return $value;
	}
	
	function _dispatchProduct($map, $data) {
		$product_id = $data->fields['products_id'];
		$value = '<a href="' . zen_href_link(FILENAME_CATEGORIES, '&action=new_product' . '&cPath=' . zen_get_product_path($data->fields['products_id'], 'override') . '&pID=' . $data->fields['products_id'] . '&product_type=' . zen_get_products_type($data->fields['products_id'])) . '">' . $data->fields['products_name'] . '</a>';
		#$value = $data->fields['products_name'];
		return $value;
	}


} // end class

?>