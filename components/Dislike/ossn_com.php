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
#The component is removed in favor of dislike reactions icon
if(class_exists('OssnLikes')){
	define('__DISLIKE__', ossn_route()->com . 'Dislike/');
	#require_once(__DISLIKE__ . 'classes/Dislike.php');
	#ossn_register_system_sdk('Dislike', 'dislike_main');
}