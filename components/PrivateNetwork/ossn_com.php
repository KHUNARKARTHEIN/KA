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

define('__PRIVATE_NETWORK__', ossn_route()->com . 'PrivateNetwork/');

require_once(__PRIVATE_NETWORK__ . 'classes/PrivateNetwork.php');

/**
 * Private network initialize
 *
 * @return void
 */
function private_network_init() {
		ossn_add_hook('page', 'load', 'private_network');
}
/**
 * Private Network
 *
 * @param string $hook   Name of the hook
 * @param string $type 	 The type of hook
 * @param string $return The mixed data
 * @param array  $params The option values
 *
 * @return void
 */
function private_network($hook, $type, $return, $params) {
		if(!ossn_isLoggedin()) {
				$privatenetwork = new PrivateNetwork;
				$privatenetwork->start($params);
		}
}
ossn_register_callback('ossn', 'init', 'private_network_init');