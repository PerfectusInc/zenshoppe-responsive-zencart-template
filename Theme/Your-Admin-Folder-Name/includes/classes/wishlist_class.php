<?php 
// File Location: /admin/includes/classes/wishlist_class.php
// Include stuff
require_once('wishlist_productlist_class.php');

/** 
 * handles admin wishlist functions
 */

class un_wishlist extends un_productlist {
    
	/** 
	 * unique identifier for a wishlist
	 *
	 * @var integer
	 * @access private
	 * @see setWishlistId()
	 */
	var $_iWishlistId;
	
	/** 
	 * default page for errors
	 *
	 * @var string
	 * @access public
	 * @see $this->_oMessages->add()
	 */
	var $_sName='header';
	
	/** 
	 * fields for product list
	 *
	 * @var array
	 * @access private
	 * @see setStructure()
	 */
	var $_aFields = array(
		'p2w.products_id',
		'w.customers_id',
		'p2w.created',
		'p2w.quantity',
		'p2w.priority',
		'p2w.comment',
		'p.products_price', 
		'p.products_tax_class_id',
		'p.products_image',
		'p.products_date_available',
		'pd.products_name',
		'pd.products_description',
	);
    
	/** 
	 * structure for product list
	 *
	 * @var array
	 * @access private
	 * @see setStructure()
	 */
	var $_aStructure = array(
		array(
			'label'			=>	TABLE_HEADING_PRODUCT,
			'field'			=>	'pd.products_name',
			'column_order'	=>	1,
			'default'		=>	true,
			'sortable'		=>	true,
			'command'		=>	'product',
		),
		array(
			'label'			=>	TABLE_HEADING_PRICE,
			'field'			=>	'p.products_price',
			'column_order'	=>	2,
			'default'		=>	false,
			'sortable'		=>	true,
			'align'			=>	'right',
			'command'		=>	'price',
		),
		array(
			'label'			=>	TABLE_HEADING_PRIORITY,
			'field'			=>	'p2w.priority',
			'column_order'	=>	3,
			'default'		=>	false,
			'sortable'		=>	true,
			'align'			=>	'center',
			'command'		=>	'field_value',
		),
		array(
			'label'			=>	TABLE_HEADING_COMMENT,
			'field'			=>	'p2w.comment',
			'column_order'	=>	4,
			'default'		=>	false,
			'sortable'		=>	true,
			'command'		=>	'field_value',
		),
		array(
			'label'			=>	TABLE_HEADING_ACTION,
			'field'			=>	'',
			'column_order'	=>	5,
			'default'		=>	false,
			'sortable'		=>	false,
			'command'		=>	'action',
		),
	);
    
    
	// CONSTRUCTOR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	
	/** 
	 * class constructor
	 *
	 * @param integer $iPollId [optional] poll id
	 * @access public
	 *----------------------------------------------------------*/
	function un_wishlist($iCustomerId=NULL) {
		global $db, $messageStack;
			
		// implement db object
		$this->_oDB =& $db;
		$this->_oMessages =& $messageStack;
		
		// set unique identifier
		if (is_numeric($iCustomerId)) {
				$this->setCustomerId($iCustomerId);
				$this->setWishlistId();
		}
		
	}
    
    
	// PUBLIC METHODS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	
	/**
	 * set the _iWishlistId variable for the class
	 *
	 * @param integer $iWishlistId unique wishlist identifier
	 * @access public
	 *----------------------------------------------------------*/
	function setWishlistId($iWishlistId=NULL) {
        
		if ( is_numeric($iWishlistId) ) {
				$this->_iWishlistId = (int)$iWishlistId;
		} else {
			return false;
		}
		
		return true;
	}
    
	/** 
	 * get a single wishlist
	 *
	 * @return array
	 * @access public
	 *----------------------------------------------------------*/
	function getWishlist($iID) {
	
		if ( isset($iID) && trim($iID)!='' ) {
			$this->setWishlistId($iID);
		}
		if ( isset($this->_iWishlistId) ) {
        
			$sql = "SELECT 
						* 
					FROM 
						".UN_TABLE_WISHLISTS." w, 
						".TABLE_CUSTOMERS." c  
					WHERE 
						w.id=".$this->_iWishlistId." 
						and w.customers_id=c.customers_id 
					";
					
			$result = $this->_oDB->Execute($sql);
			if ( !$result ) {
				$this->_oMessages->add($this->_sName, 'Error getting wishlist.');
				return false;
			}
        
		} else {
			$this->_oMessages->add($this->_sName, 'Error getting wishlist: id not set.');
        	return false;
		}
			
		return $result;
	}
    
	/** 
	 * get wishlists associated with customer
	 *
	 * @return array
	 * @access public
	 *----------------------------------------------------------*/
	function getWishlists() {
        
		$sql = "SELECT 
						w.id,
						w.customers_id,
						w.created,
						w.modified,
						w.name,
						w.comment,
						w.default_status,
						w.public_status,
						count(p.products_id) as items_count, 
						c.customers_email_address, 
						c.customers_firstname, 
						c.customers_lastname 
					FROM 
						".UN_TABLE_WISHLISTS." w 
					LEFT JOIN 
						".UN_TABLE_PRODUCTS_TO_WISHLISTS." p2w ON w.id=p2w.un_wishlists_id 
					LEFT JOIN 
						".TABLE_PRODUCTS." p ON p2w.products_id=p.products_id 
					LEFT JOIN 
						".TABLE_CUSTOMERS." c ON w.customers_id=c.customers_id 
					GROUP BY
						w.id 
					";
					
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error getting wishlists.');
			return false;
		}
			
		return $result;
	}
    
	/** 
	 * find wishlists associated with customer data
	 *
	 * @return array
	 * @access public
	 *----------------------------------------------------------*/
	function findWishlists($aArgs) {
        
		$sql = "SELECT 
					w.id, w.name, w.comment, w.public_status, c.customers_id, c.customers_firstname, c.customers_lastname, c.customers_email_address, ab.entry_city, ab.entry_state 
				FROM 
					".UN_TABLE_WISHLISTS." w, 
					".TABLE_CUSTOMERS." c, 
					".TABLE_ADDRESS_BOOK." ab 
				WHERE 
					c.customers_firstname like '".$aArgs['firstname']."' 
					and c.customers_lastname like '".$aArgs['lastname']."' 
					and c.customers_email_address like '".$aArgs['email']."' 
					and w.customers_id = c.customers_id 
					and c.customers_default_address_id = ab.address_book_id 
					and w.public_status=1 
				";
/* 				dump($sql); exit; */
				
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error finding wishlists.');
			return false;
		}
			
		return $result;
	}
    
	/** 
	 * get a products in wishlist
	 *
	 * @return array
	 * @access public
	 *----------------------------------------------------------*/
	function getProductsQuery() {
		
		$this->_sSqlFrom = "from ".UN_TABLE_WISHLISTS." w, ".UN_TABLE_PRODUCTS_TO_WISHLISTS." p2w, ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd ";
		
		$this->_sSqlWhere = "where w.id = '".$this->_iWishlistId."' 
			and pd.language_id = '".(int)$_SESSION['languages_id']."' 
			and p.products_status = 1 
			and w.id = p2w.un_wishlists_id 
			and p2w.products_id = p.products_id 
			and p2w.products_id = pd.products_id ";
			
		return parent::getProductsQuery();
	}
    
	
	// PRIVATE METHODS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	
	
	
	// INSERT METHODS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	
	
	
	// UPDATE METHODS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	
	/** 
	* delete a wishlist
	*
	* @return boolean
	* @access public
	*----------------------------------------------------------*/
	function deleteWishlist($iID) {
	
		if ( isset($iID) && trim($iID)!='' ) {
			$this->setWishlistId($iID);
		}
		if ( !isset($this->_iWishlistId) || trim($this->_iWishlistId)=='' ) {
			return false;
		}

		$sql = "DELETE FROM 
							".UN_TABLE_PRODUCTS_TO_WISHLISTS." 
						WHERE 
							un_wishlists_id='".$this->_iWishlistId."' 
						";
		
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error deleting products from wishlist.');
			return false;
		}

		$sql = "DELETE FROM 
							".UN_TABLE_WISHLISTS." 
						WHERE 
							id='".$this->_iWishlistId."' 
						";
		
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, 'Error deleting wishlist.');
			return false;
		}
        
		return true;
	}

	/** 
	* remove a product from wishlist
	*
	* @return boolean
	* @access public
	*----------------------------------------------------------*/
	function removeProduct($products_id) {
		
		// Remove from database
		if ( !empty($this->_iWishlistId) ) {
			$sql = "delete from ".UN_TABLE_PRODUCTS_TO_WISHLISTS." where un_wishlists_id = '".$this->_iWishlistId."' and products_id = '".$products_id."'";
			
			$result = $this->_oDB->Execute($sql);
			if ( !$result ) {
				$this->_oMessages->add($this->_sName, 'Error deleting product from wishlist.');
				return false;
			}
		}
		
		return true;
	}


} // end class

?>