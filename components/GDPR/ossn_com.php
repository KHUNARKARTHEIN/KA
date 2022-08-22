<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
define('GDPR', ossn_route()->com . 'GDPR/');
//require_once(GDPR . 'classes/GDPR.php');
function gdpr_init() {
		ossn_extend_view('js/opensource.socialnetwork', 'gdpr/js');
		ossn_extend_view('css/ossn.default', 'gdpr/css');
		
		if(ossn_isLoggedin() && !ossn_isAdminLoggedin()){
				ossn_register_action('gdpr/delete/account', GDPR . 'actions/delete.php');
				ossn_register_menu_item('topbar_dropdown', array(
						'name' => 'deleteaccount',
						'text' => ossn_print('gdpr:deleteaccount'),
						'href' => ossn_site_url('action/gdpr/delete/account'),
						'class' => 'ossn-make-sure',
						'action' => true,
						'priority' => 201
				));			
		}
		
		ossn_register_callback('action', 'load', 'gdpr_signup_check');
}
function gdpr_signup_check($callback, $type, $params){
			$gdpr_agree = input('gdpr_agree');
			if(!$gdpr_agree && isset($params['action']) && $params['action'] == 'user/register'){
						header('Content-Type: application/json');
						echo json_encode(array(
								'dataerr' => ossn_print('gdpr:signup:error')
						));
						exit;		
			}
}
ossn_register_callback('ossn', 'init', 'gdpr_init');