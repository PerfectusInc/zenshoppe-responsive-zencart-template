<?php 
// Include stuff
require_once('wishlist_productlist_class.php');

/** 
 * handles wishlist functions
 *
 * @author untitled
 * @version 0.2
 * @since 0.2
 * @access public
 * @copyright untitled
 *
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
     * unique identifier for a customer
     *
     * @var integer
     * @access private
     * @see setCustomerId()
     */
    var $_iCustomerId;
    
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
			'label'			=>	UN_TABLE_HEADING_PRODUCTS,
			'field'			=>	'pd.products_name',
			'column_order'	=>	1,
			'default'		=>	true,
			'sortable'		=>	true,
			'command'		=>	'product',
		),
		array(
			'label'			=>	UN_TABLE_HEADING_PRICE,
			'field'			=>	'p.products_price',
			'column_order'	=>	2,
			'default'		=>	false,
			'sortable'		=>	true,
			'align'			=>	'right',
			'command'		=>	'price',
		),
		array(
			'label'			=>	UN_TEXT_PRIORITY,
			'field'			=>	'p2w.priority',
			'column_order'	=>	3,
			'default'		=>	false,
			'sortable'		=>	true,
			'align'			=>	'center',
			'command'		=>	'priority_menu_s',
		),
		array(
			'label'			=>	UN_TEXT_REMOVE,
			'field'			=>	'',
			'column_order'	=>	4,
			'default'		=>	false,
			'sortable'		=>	false,
			'align'			=>	'center',
			'command'		=>	'deletewish_checkbox',
		),
		array(
			'label'			=>	UN_TABLE_HEADING_BUY_NOW,
			'field'			=>	'',
			'column_order'	=>	5,
			'default'		=>	false,
			'sortable'		=>	false,
			'align'			=>	'center',
			'command'		=>	'addcart_checkbox',
		),
	);
    
    
    // CONSTRUCTOR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    
    /** 
     * class constructor
     *
     * @param integer $iPollId [optional] poll id
     * @access public
	/*----------------------------------------------------------*/
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
     * set the _iCustomerId variable for the class
     *
     * @param integer $iCustomerId unique customer identifier
     * @access public
	/*----------------------------------------------------------*/
    function setCustomerId($iCustomerId) {
        
        if (is_numeric($iCustomerId)) {
            $this->_iCustomerId = (int)$iCustomerId;
        }
        
    }
    
    /**
     * set the _iWishlistId variable for the class
     *
     * @param integer $iWishlistId unique wishlist identifier
     * @access public
	/*----------------------------------------------------------*/
    function setWishlistId($iWishlistId=NULL) {
        
        if ( is_numeric($iWishlistId) ) {
            $this->_iWishlistId = (int)$iWishlistId;
        } elseif ( isset($this->_iCustomerId) ) {
        	$iWishlistId = $this->getDefaultWishlistId();
        	if ( !empty($iWishlistId) ) {
				$this->_iWishlistId = $iWishlistId;
        	} else {
        		return $this->_createDefaultWishlist();
        	}
        } else {
        	return false;
        }
        
        return true;
    }

	/** 
	 * get default wishlist id
	 *
     * @return integer $iWishlistId unique wishlist identifier
	 * @access public
	/*----------------------------------------------------------*/
	function getDefaultWishlistId($iCustomerId=NULL) {
	
		if ( !empty($iCustomerId) ) {
			$this->setCustomerId($iCustomerId);
		}
		
		if ( empty($this->_iCustomerId) ) {
			return false;
		}
		
		$sql = "SELECT 
					id 
				FROM 
					".UN_TABLE_WISHLISTS." w 
				WHERE 
					w.customers_id=".$this->_iCustomerId." 
					and w.default_status=1 
					";
		
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_GET_ID);
				return false;
		}
		
		return (int)$result->fields['id'];
	}
	
	function getWishlistId() {
		
		return $this->_iWishlistId;
	}
	
	function getCustomerData() {
	
		if ( !isset($this->_iWishlistId) || un_is_empty($this->_iWishlistId) ) {
			return false;
		}
		
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
			$this->_oMessages->add($this->_sName, UN_ERROR_GET_CUSTDATA);
				return false;
		}
		
		return $result;
	}

	/** 
	 * get permission to view wishlist id
	 *
     * @param integer $iWishlistId unique wishlist identifier
     * @return boolean
	 * @access public
	/*----------------------------------------------------------*/
	function hasPermission() {
		
		if ( un_is_empty($this->_iWishlistId) ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_GET_PERMISSION);
			return false;
		}
		
		if ( un_is_empty($this->_iCustomerId) ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_GET_PERMISSION);
			return false;
		}		
		
		$sql = "SELECT 
					count(id) as items_count 
				FROM 
					".UN_TABLE_WISHLISTS." 
				WHERE 
					id='".$this->_iWishlistId."' 
					and customers_id='".$this->_iCustomerId."' 
				";
		
		$result = $this->_oDB->Execute($sql);
		if ( (int)$result->fields['items_count']==0 ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_GET_PERMISSION);
				return false;
		}
		
		return true;
	}
    
    /** 
     * get a single wishlist
     *
     * @return array
     * @access public
	/*----------------------------------------------------------*/
    function getWishlist() {
        
        if ( $this->_iWishlistId ) {
        
			$sql = "SELECT 
						* 
					FROM 
						".UN_TABLE_WISHLISTS." w 
					WHERE 
						w.id=".$this->_iWishlistId." 
					";
					
			$result = $this->_oDB->Execute($sql);
			if ( !$result ) {
				$this->_oMessages->add($this->_sName, UN_ERROR_GET_WISHLIST);
				return false;
			}
        
        } else {
			$this->_oMessages->add($this->_sName, UN_ERROR_GET_WISHLIST_ID);
        	return false;
        }
			
		return $result;
    }
    
    /** 
     * get wishlists associated with customer
     *
     * @return array
     * @access public
	/*----------------------------------------------------------*/
    function getWishlists() {
        
        if ( $this->_iCustomerId ) {
        
			$sql = "SELECT 
						w.id,
						w.customers_id,
						w.created,
						w.modified,
						w.name,
						w.comment,
						w.default_status,
						w.public_status,
						count(p.products_id) as items_count 
					FROM 
						".UN_TABLE_WISHLISTS." w 
					LEFT JOIN 
						".UN_TABLE_PRODUCTS_TO_WISHLISTS." p2w ON w.id=p2w.un_wishlists_id 
					LEFT JOIN 
						".TABLE_PRODUCTS." p ON p2w.products_id=p.products_id 
					WHERE 
						w.customers_id=".$this->_iCustomerId." 
					GROUP BY
						w.id 
					";
					
			$result = $this->_oDB->Execute($sql);
			if ( !$result ) {
				$this->_oMessages->add($this->_sName, UN_ERROR_GET_WISHLIST);
				return false;
			}
        
        } else {
			$this->_oMessages->add($this->_sName, UN_ERROR_GET_WISHLIST_ID);
        	return false;
        }
			
		return $result;
    }
    
    /** 
     * get html select menu of customer's wishlists
     *
     * @return string -- html select menu of customer's wishlists
     * @access public
	/*----------------------------------------------------------*/	 
	function getWishlistMenu($sName, $sDefault = '', $sParameters = '') {
		
		$sql = "SELECT 
					w.id, 
					w.name 
				FROM 
					" . UN_TABLE_WISHLISTS . " w 
				WHERE 
					w.customers_id='".$this->_iCustomerId."' 
				ORDER BY 
					w.name 
				";
		
		$result = $this->_oDB->Execute($sql);
		
		while ( !$result->EOF ) {
			$aValues[] = array(
				'id' => $result->fields['id'],
				'text' => $result->fields['name']
				);
			$result->MoveNext();
		}
	
		return zen_draw_pull_down_menu($sName, $aValues, $sDefault, $sParameters);
	}
    
    /** 
     * find wishlists associated with customer data
     *
     * @return array
     * @access public
	/*----------------------------------------------------------*/
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
			$this->_oMessages->add($this->_sName, UN_ERROR_FIND_WISHLIST);
			return false;
		}
			
		return $result;
    }
    
    /** 
     * get a products in wishlist
     *
     * @return array
     * @access public
	/*----------------------------------------------------------*/
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

    /** 
     * determine if wishlist is accessible
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function isPublic() {
		
		if ( !isset($this->_iWishlistId) ) {
			return false;
		}
        
        $sql = "SELECT 
                    public_status 
                FROM 
                    ".UN_TABLE_WISHLISTS." 
                WHERE 
                	id=".$this->_iWishlistId." 
				";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_IS_PRIVATE);
            return false;
        }
        
		if ( (int)$result->fields['public_status']==1 ) {
			return true;
		} else {
			return false;
		}
    }

    /** 
     * make default
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function makeDefault() {
		
		if ( !isset($this->_iCustomerId) ) {
			return false;
		}
        
        $sql = "UPDATE 
                    ".UN_TABLE_WISHLISTS." 
                SET 
                	default_status=0 
                WHERE 
                	customers_id=".$this->_iCustomerId." 
				";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_MAKE_DEFAULT_ZERO);
            return false;
        }
		
		if ( !isset($this->_iWishlistId) ) {
			return false;
		}
        
        $sql = "UPDATE 
                    ".UN_TABLE_WISHLISTS." 
                SET 
                	default_status=1 
                WHERE 
                	id=".$this->_iWishlistId." 
				";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_MAKE_DEFAULT);
            return false;
        }
        
		return true;
    }

    /** 
     * make public
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function makePublic() {
		
		if ( !isset($this->_iWishlistId) ) {
			return false;
		}
        
        $sql = "UPDATE 
                    ".UN_TABLE_WISHLISTS." 
                SET 
                	public_status=1 
                WHERE 
                	id=".$this->_iWishlistId." 
				";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_MAKE_PUBLIC);
            return false;
        }
        
		return true;
    }

    /** 
     * make private
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function makePrivate() {
		
		if ( !isset($this->_iWishlistId) ) {
			return false;
		}
        
        $sql = "UPDATE 
                    ".UN_TABLE_WISHLISTS." 
                SET 
                	public_status=0 
                WHERE 
                	id=".$this->_iWishlistId." 
				";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_MAKE_PRIVATE);
            return false;
        }
        
		return true;
    }
    
	
    // PRIVATE METHODS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::

    /** 
     * create default wishlist
     *
     * @return integer $iWishlistId unique wishlist identifier
     * @access private
	/*----------------------------------------------------------*/
    function _createDefaultWishlist() {
		
		$result = $this->createWishlist(DEFAULT_WISHLIST_NAME, '', 1, 1);
		if ( $result===false ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_CREATE_DEFAULT);
			return false;
		}
		$this->_iWishlistId = $result;
		
		return $result;
	}

    /** 
     * determine if product is in wishlist
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function _inWishlist($products_id) {
        
        $sql = "SELECT 
                    count(p2w.products_id) AS items_count 
                FROM 
                    ".UN_TABLE_WISHLISTS." w, 
                    ".UN_TABLE_PRODUCTS_TO_WISHLISTS." p2w 
                WHERE 
                	w.customers_id=".$this->_iCustomerId." 
                	AND p2w.products_id=".$products_id." 
                	AND w.id=p2w.un_wishlists_id ";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_IN_WISHLIST);
            return false;
        }
        
		if ( (int)$result->fields['items_count'] > 0 ) {
			return true;
		} else {
			return false;
		}
    }
    
     
    // INSERT METHODS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::

    /** 
     * create a new wishlist
     *
     * @param string $name name for wishlist
     # @param string $comment comment for wishlist
     # @param boolean $default indicates default wishlist for customer
     * @return integer $iWishlistId unique wishlist identifier
     * @access public
	/*----------------------------------------------------------*/
    function createWishlist($name='', $comment='', $default_status=0, $public_status=1) {
		
		if ( !isset($this->_iCustomerId) ) {
			return false;
		}

		$sql = "INSERT INTO ".UN_TABLE_WISHLISTS." (
					`customers_id`, 
					`created`, 
					`modified`, 
					`name`, 
					`comment`, 
					`default_status`, 
					`public_status` 
				) VALUES (
					'".$this->_iCustomerId."', 
					NOW(), 
					NOW(), 
					'".$name."', 
					'".$comment."', 
					'".$default_status."', 
					'".$public_status."' 
				)";
  
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_CREATE_WISHLIST);
			return false;
		}
		
		return $this->_oDB->Insert_ID();
	}

    /** 
     * add wishlist
     *
     * @param array $aArgs notes item values
     * @return integer $iWishlistId unique wishlist identifier
     * @access public
	/*----------------------------------------------------------*/
    function addWishlist($aArgs) {
		
		if ( !isset($this->_iCustomerId) ) {
			return false;
		}

        // create new record
		$sql = "INSERT INTO ".UN_TABLE_WISHLISTS." (
					`customers_id`, 
					`created`, 
					`modified`, 
					`name`, 
					`comment`, 
					`public_status`
				) VALUES (
					'".$this->_iCustomerId."', 
					NOW(), 
					NOW(), 
					'".$aArgs['name']."', 
					'".$aArgs['comment']."', 
					'".$aArgs['public_status']."'
				)";
  
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_ADD_WISHLIST);
			return false;
		}
		
		return true;
	}

    /** 
     * edit wishlist
     *
     * @param array $aArgs notes item values
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
    function editWishlist($aArgs) {
		
		if ( !isset($this->_iWishlistId) ) {
			return false;
		}

        // create new record
		$sql = "UPDATE ".UN_TABLE_WISHLISTS." SET 
					modified=NOW(), 
					name='".$aArgs['name']."', 
					comment='".$aArgs['comment']."', 
					public_status='".$aArgs['public_status']."' 
				WHERE 
					id='".$this->_iWishlistId."' 
				";
  
		$result = $this->_oDB->Execute($sql);
		if ( !$result ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_EDIT_WISHLIST);
			return false;
		}
		
		return true;
	}

    /** 
     * add a product to wishlist
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
    function addProduct($products_id, $attributes='', $quantity=1, $priority=2, $comment='') {
		//echo $attributes;
		if ( $this->_inWishlist($products_id) ) {
			$this->updateProduct($products_id, $attributes, $quantity);
			
		} else {

			if ( !empty($this->_iWishlistId) ) {
				$sql = "INSERT INTO ".UN_TABLE_PRODUCTS_TO_WISHLISTS." (
							`products_id`, 
							`un_wishlists_id`, 
							`created`, 
							`modified`, 
							`quantity`, 
							`priority`, 
							`comment`,
							`attributes`
						) VALUES (
							'".$products_id."', 
							'".$this->_iWishlistId."', 
							NOW(), 
							NOW(), 
							'".$quantity."', 
							'".$priority."', 
							'".$comment."',
							'".$attributes."' 
						)";
      
				$result = $this->_oDB->Execute($sql);
				if ( !$result ) {
					$this->_oMessages->add($this->_sName, UN_ERROR_ADD_PRODUCT_WISHLIST);
					return false;
				}
			}
			return true;
		}
		
    }

    /** 
     * get attributes from product in wishlist
     *
     * @return array
     * @access public
	/*----------------------------------------------------------*/
    function wishlist_get_attributes($products_id) {
	    if ( $this->_iWishlistId ) {
        
			$sql = "SELECT 
						* 
					FROM 
						".UN_TABLE_PRODUCTS_TO_WISHLISTS." 
					WHERE 
						un_wishlists_id=".$this->_iWishlistId." 
                		AND products_id=".$products_id."  
					";
					
			$result = $this->_oDB->Execute($sql);
			if ( !$result ) {
				$this->_oMessages->add($this->_sName, UN_ERROR_GET_WISHLIST);
				return false;
			}
			$attributes = unserialize($result->fields['attributes']);
        
        } else {
			$this->_oMessages->add($this->_sName, UN_ERROR_GET_WISHLIST_ID);
        	return false;
        }
			
		return $attributes;
    }
    
    /** 
     * update quantity of product already in wishlist
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function updateProduct($products_id, $attributes='', $quantity=NULL, $priority=2, $comment='') {

		if ( empty($quantity) ) {
			return true;
		}

		if ( !empty($this->_iWishlistId) ) {
			$attributes = serialize($this->wishlist_get_attributes($products_id));
			$sql = "UPDATE ".UN_TABLE_PRODUCTS_TO_WISHLISTS."
                SET 
                	modified = NOW(), 
                	quantity = '".$quantity."', 
                	priority = '".$priority."', 
                	comment = '".$comment."',
                	attributes = '".$attributes."' 
                WHERE 
                	products_id = '".$products_id."' 
                	AND un_wishlists_id = '".$this->_iWishlistId."' ";
			$this->_oDB->Execute($sql);
			return true;
		} else {
			return false;
		}
	}

    /** 
     * move product from one wishlist to another
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function moveProduct($products_id, $wishlists_id) {

		if ( !empty($this->_iWishlistId) ) {
			$sql = "UPDATE ".UN_TABLE_PRODUCTS_TO_WISHLISTS."
                SET 
                	modified = NOW(), 
                	un_wishlists_id = '".$wishlists_id."' 
                WHERE 
                	products_id = '".$products_id."' 
                	AND un_wishlists_id = '".$this->_iWishlistId."' ";
			$this->_oDB->Execute($sql);
			return true;
		} else {
			return false;
		}
	}

    
    
    // UPDATE METHODS :::::::::::::::::::::::::::::::::::::::::::::::::::::::::

    /** 
     * delete a wishlist
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function deleteWishlist() {
		
		if ( !isset($this->_iWishlistId) ) {
			return false;
		}
		
		if ( $this->_iWishlistId==$this->getDefaultWishlistId() ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_DELETE_DEFAULT_WISHLIST);
			return false;
		}

		$sql = "DELETE FROM 
					".UN_TABLE_WISHLISTS." 
				WHERE 
					id='".$this->_iWishlistId."' 
				";
        
        $result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_DELETE_WISHLIST);
            return false;
        }
        
        return true;
	}

    /** 
     * remove a product from wishlist
     *
     * @return boolean
     * @access public
	/*----------------------------------------------------------*/
	function removeProduct($products_id) {
		
		// Remove from database
		if ( !empty($this->_iWishlistId) ) {
			$sql = "delete from ".UN_TABLE_PRODUCTS_TO_WISHLISTS." where un_wishlists_id = '".$this->_iWishlistId."' and products_id = '".$products_id."'";
			
			$result = $this->_oDB->Execute($sql);
			if ( !$result ) {
				$this->_oMessages->add($this->_sName, UN_ERROR_DELETE_PRODUCT_WISHLIST);
				return false;
			}
		}
		
		return true;
	}
	
	/** 
     * products in wishlist?
     *
     * @return boolean
     * @access public
     * not used yet
	/*----------------------------------------------------------*/
	function _anyInWishlist() {
        
        $sql = "SELECT 
                    count(p2w.products_id) AS items_count 
                FROM 
                    ".UN_TABLE_WISHLISTS." w, 
                    ".UN_TABLE_PRODUCTS_TO_WISHLISTS." p2w 
                WHERE 
                	w.customers_id=".$this->_iCustomerId."  
                	AND w.id=p2w.un_wishlists_id ";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_IN_WISHLIST);
            return false;
        }
        
		if ( (int)$result->fields['items_count'] > 0 ) {
			return true;
		} else {
			return false;
		}
    }
    
    /** 
     * get products in wishlist
     *
     * @return boolean
     * @access public
     * not used yet
	/*----------------------------------------------------------*/
	function contents() {
        
        $sql = "SELECT 
                    p2w.products_id 
                FROM 
                    ".UN_TABLE_WISHLISTS." w, 
                    ".UN_TABLE_PRODUCTS_TO_WISHLISTS." p2w 
                WHERE 
                	w.customers_id=".$this->_iCustomerId."  
                	AND w.id=p2w.un_wishlists_id ";
		
		$result = $this->_oDB->Execute($sql);
        if ( !$result ) {
			$this->_oMessages->add($this->_sName, UN_ERROR_IN_WISHLIST);
            return false;
        }
        
		if ( (int)$result->fields['items_count'] > 0 ) {
			return true;
		} else {
			return false;
		}
    }
    

	function wishlist_get_products($check_for_valid_cart = false) {
    global $db;

    $this->notify('NOTIFIER_WISHLIST_GET_PRODUCTS_START');

    if (!$this->_anyInWishlist()) return false;

    $products_array = array();
    //reset($this->contents);
    while (list($products_id, ) = each($this->contents)) {
      $products_query = "select p.products_id, p.master_categories_id, p.products_status, pd.products_name, p.products_model, p.products_image,
                                  p.products_price, p.products_weight, p.products_tax_class_id,
                                  p.products_quantity_order_min, p.products_quantity_order_units,
                                  p.product_is_free, p.products_priced_by_attribute,
                                  p.products_discount_type, p.products_discount_type_from
                           from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           where p.products_id = '" . (int)$products_id . "'
                           and pd.products_id = p.products_id
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";

      if ($products = $db->Execute($products_query)) {

        $prid = $products->fields['products_id'];
        $products_price = $products->fields['products_price'];
        //fix here
        /*
        $special_price = zen_get_products_special_price($prid);
        if ($special_price) {
        $products_price = $special_price;
        }
        */
        $special_price = zen_get_products_special_price($prid);
        if ($special_price and $products->fields['products_priced_by_attribute'] == 0) {
          $products_price = $special_price;
        } else {
          $special_price = 0;
        }

        if (zen_get_products_price_is_free($products->fields['products_id'])) {
          // no charge
          $products_price = 0;
        }

        // adjust price for discounts when priced by attribute
        if ($products->fields['products_priced_by_attribute'] == '1' and zen_has_product_attributes($products->fields['products_id'], 'false')) {
          // reset for priced by attributes
          //            $products_price = $products->fields['products_price'];
          if ($special_price) {
            $products_price = $special_price;
          } else {
            $products_price = $products->fields['products_price'];
          }
        } else {
          // discount qty pricing
          if ($products->fields['products_discount_type'] != '0') {
            $products_price = zen_get_products_discount_price_qty($products->fields['products_id'], $this->contents[$products_id]['qty']);
          }
        }

// validate cart contents for checkout
        if ($check_for_valid_cart == true) {
          $fix_once = 0;

          // Check products_status if not already
          $check_status = $products->fields['products_status'];
          if ( $check_status == 0 ) {
            $fix_once ++;
            $_SESSION['valid_to_checkout'] = false;
            $_SESSION['cart_errors'] .= ERROR_PRODUCT . $products->fields['products_name'] . ERROR_PRODUCT_STATUS_SHOPPING_CART . '<br />';
            $this->remove($products_id);
          }

          // check only if valid products_status
          if ($fix_once == 0) {
            $check_quantity = $this->contents[$products_id]['qty'];
            $check_quantity_min = $products->fields['products_quantity_order_min'];
            // Check quantity min
            if ($new_check_quantity = $this->in_cart_mixed($prid) ) {
              $check_quantity = $new_check_quantity;
            }
          }

          if ($fix_once == 0) {
            if ($check_quantity < $check_quantity_min) {
              $fix_once ++;
              $_SESSION['valid_to_checkout'] = false;
              $_SESSION['cart_errors'] .= ERROR_PRODUCT . $products->fields['products_name'] . ERROR_PRODUCT_QUANTITY_MIN_SHOPPING_CART . ERROR_PRODUCT_QUANTITY_ORDERED . $check_quantity  . ' <span class="alertBlack">' . zen_get_products_quantity_min_units_display((int)$prid, false, true) . '</span> ' . '<br />';
            }
          }

          // Check Quantity Units if not already an error on Quantity Minimum
          if ($fix_once == 0) {
            $check_units = $products->fields['products_quantity_order_units'];
            if ( fmod_round($check_quantity,$check_units) != 0 ) {
              $_SESSION['valid_to_checkout'] = false;
              $_SESSION['cart_errors'] .= ERROR_PRODUCT . $products->fields['products_name'] . ERROR_PRODUCT_QUANTITY_UNITS_SHOPPING_CART . ERROR_PRODUCT_QUANTITY_ORDERED . $check_quantity  . ' <span class="alertBlack">' . zen_get_products_quantity_min_units_display((int)$prid, false, true) . '</span> ' . '<br />';
            }
          }

          // Verify Valid Attributes
        }

        //clr 030714 update $products_array to include attribute value_text. This is needed for text attributes.

        // convert quantity to proper decimals
        /* leave out for now
        if (QUANTITY_DECIMALS != 0) {
          //          $new_qty = round($new_qty, QUANTITY_DECIMALS);

          $fix_qty = $this->contents[$products_id]['qty'];
          switch (true) {
            case (!strstr($fix_qty, '.')):
            $new_qty = $fix_qty;
            break;
            default:
            $new_qty = preg_replace('/[0]+$/','',$this->contents[$products_id]['qty']);
            break;
          }
        } else {
          $new_qty = $this->contents[$products_id]['qty'];
        }
        */
        $check_unit_decimals = zen_get_products_quantity_order_units((int)$products->fields['products_id']);
        if (strstr($check_unit_decimals, '.')) {
          $new_qty = round($new_qty, QUANTITY_DECIMALS);
        } else {
          $new_qty = round($new_qty, 0);
        }

        if ($new_qty == (int)$new_qty) {
          $new_qty = (int)$new_qty;
        }

        $products_array[] = array('id' => $products_id,
                                  'category' => $products->fields['master_categories_id'],
                                  'name' => $products->fields['products_name'],
                                  'model' => $products->fields['products_model'],
                                  'image' => $products->fields['products_image'],
                                  'price' => ($products->fields['product_is_free'] =='1' ? 0 : $products_price),
        //                                    'quantity' => $this->contents[$products_id]['qty'],
                                  'quantity' => $new_qty,
                                  'weight' => $products->fields['products_weight'] + $this->attributes_weight($products_id),
                                  // fix here
                                  'final_price' => ($products_price + $this->attributes_price($products_id)),
                                  'onetime_charges' => ($this->attributes_price_onetime_charges($products_id, $new_qty)),
                                  'tax_class_id' => $products->fields['products_tax_class_id'],
                                  'attributes' => (isset($this->contents[$products_id]['attributes']) ? $this->contents[$products_id]['attributes'] : ''),
                                  'attributes_values' => (isset($this->contents[$products_id]['attributes_values']) ? $this->contents[$products_id]['attributes_values'] : ''),
                                  'products_priced_by_attribute' => $products->fields['products_priced_by_attribute'],
                                  'product_is_free' => $products->fields['product_is_free'],
                                  'products_discount_type' => $products->fields['products_discount_type'],
                                  'products_discount_type_from' => $products->fields['products_discount_type_from']);
      }
    }
    $this->notify('NOTIFIER_WISHLIST_GET_PRODUCTS_END');
    return $products_array;
  }

} // end class

?>