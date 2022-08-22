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
 
 $user = input('guid');
 $user = ossn_user_by_guid($user);
 if(!$user){
	 ossn_trigger_message(ossn_print('banuser:invalid:user'), 'error');
	 redirect(REF);
 }
 if($user->guid == ossn_loggedin_user()->guid){
	 ossn_trigger_message(ossn_print('banuser:ban:failed'), 'error');
	 redirect(REF);	 
 }
 $user->data->is_banned = true;
 $user->data->icon_time = time();
 if($user->save()){
	 ossn_trigger_message(ossn_print('banuser:banned'));
	 redirect("u/{$user->username}");
 } else  {
	 ossn_trigger_message(ossn_print('banuser:ban:failed'), 'error');
	 redirect("u/{$user->username}");
 }
 