<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   SOFTLAB24 LIMITED, COMMERCIAL LICENSE https://www.softlab24.com/license/commercial-license-v1
 * @link      https://www.softlab24.com/
 */
 $guid = input('user');
 $user = ossn_user_by_guid($guid);
 if($user){
		$user->data->is_verified_user = true;
		if($user->save()){
				ossn_trigger_message(ossn_print('userverified:success'));
				redirect(REF);
		}
 }
 ossn_trigger_message(ossn_print('userverified:failed'), 'error');
 redirect(REF);