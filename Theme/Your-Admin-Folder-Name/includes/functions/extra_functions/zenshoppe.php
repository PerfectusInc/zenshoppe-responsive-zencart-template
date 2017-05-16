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

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

if (function_exists('zen_register_admin_page')) {
    if (!zen_page_key_exists('zenshoppe')) {
        // Add Color menu to Tools menu
        zen_register_admin_page('zenshoppe', 'BOX_TOOLS_ZENSHOPPE','FILENAME_ZENSHOPPE', '', 'tools', 'Y', 21);
    }
}
?>