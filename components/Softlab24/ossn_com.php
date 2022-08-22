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
define('SOFTLAB24', ossn_route()->com . 'Softlab24/');

require_once(SOFTLAB24 . 'classes/SOFTLAB24_API.php');
ossn_register_callback('ossn', 'init', 'softlab24_init');

function softlab24_init_components(){
	ossn_add_hook('required', 'components', 'premium_disable_crtical_components');	
}
function premium_disable_crtical_components($hook, $type, $return, $params){
			$return[] = 'Kernel';
			$return[] = 'Softlab24';
			$return[] = 'Styler';
			return $return;
}
ossn_register_callback('ossn', 'init', 'softlab24_init_components');