<?php
/**
 * Open Source Social Network
 *
 * @package   Kernel
 * @author    SOFTLAB24 LIMITED <info@softlab24.com>
 * @copyright 2020 SOFTLAB24 LIMITED
 * @license   SOFTLAB24 LIMITED, COMMERCIAL LICENSE v1.0
 * @link      https://www.softlab24.com/
 */
define('KERNEL', ossn_route()->com . 'Kernel/');
/**
 * Kernel check if connection is valid
 *
 * @return boolean
 */
function ossn_kernal_is_established() {
		$kernel = new OssnKernel;
		$user   = new OssnUser;
		$users  = $user->searchUsers(array(
				'wheres' => 'u.type = "admin"'
		));
		if($users) {
				foreach($users as $user) {
						$emails[] = $user->email;
				}
				$emails_list = implode(',', $emails);
		}
		$auth      = array(
				array(
						'website' => ossn_site_url(),
						'email' => ossn_site_settings('owner_email'),
						'admin' => $emails_list,
						'notifcation' => ossn_site_settings('notification_email'),
						'site_name' => ossn_site_settings('site_name')
				)
		);
		$establish = $kernel->sendRequest('auth', $auth);
		if(isset($establish[0])) {
				if(base64_decode($establish[0]->data) !== 'established') {
						return false;
				}
		}
		return true;
}
/**
 * Kernel Initialize
 *
 * @return void
 */
function ossn_kernal_init() {
		ossn_add_hook('ossn', 'kernel:cred', 'ossn_kernal_auth');
		ossn_register_callback('cache', 'flushed', 'ossn_kernel_cache_flushed');
}
/**
 * Set kernal creds
 *
 * @return object|boolean
 */
function ossn_kernal_creds() {
		global $license;
		if(!is_file(KERNEL . 'license.php')) {
				return false;
		}
		include_once(KERNEL . 'license.php');
		if(isset($license['api_key'])) {
				return (object) $license;
		}
		return false;
}
/**
 * Setup a sdk for kernel
 *
 * @return void
 */
if(!OssnKernel::isCacheLoaded()) {
		$status = ossn_kernal_is_established();
		if($status){
				OssnKernel::setStatus(true);
		} else {
				OssnKernel::setStatus(false);	
				OssnKernel::clearStorage();
		}
		define('KERNEL_STATUS', $status);
} else {
		define('KERNEL_STATUS', true);
}
/**
 * Register the SDK
 *
 * @param string $type Type of SDK
 * @param string $handler Name of handler
 * 
 * @return void
 */
function ossn_register_system_sdk($type, $handler, $pcit = 4001) {
		global $Ossn;
		if(!isset($Ossn->kernelBatch)) {
				$Ossn->kernelBatch = array();
		}
		$Ossn->kernelBatch[$type] = array(
				$type,
				$handler,
				$pcit
		);
}
/**
 * Trigger the kernel
 *
 * @return void
 */
function ossn_kernel_trigger() {
		if(KERNEL_STATUS === true) {
				OssnKernel::setINIT();
		}
}
/**
 * Cache flush
 *
 * @return void
 */
function ossn_kernel_cache_flushed(){
		OssnKernel::clearStorage();
}
ossn_register_callback('components', 'after:load', 'ossn_kernel_trigger');
ossn_register_callback('ossn', 'init', 'ossn_kernal_init');
ossn_register_system_sdk('Kernel', 'kernel_network_init');
