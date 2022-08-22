<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
define('CATEGORIES', ossn_route()->com . 'Categories/');
require_once(CATEGORIES . 'classes/Categories.php'); 
ossn_register_system_sdk('Categories', 'categories_init');