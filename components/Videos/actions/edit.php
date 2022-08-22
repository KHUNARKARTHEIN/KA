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
 $guid = input('guid');
 $title = input('title');
 $description  = input('description');
 
 $video = ossn_get_video($guid);
 if(!$video){
	 ossn_trigger_message(ossn_print('video:com:invalid'), 'error');
	 redirect(REF);	 
 }
 
 $user = ossn_loggedin_user();
 if($video->owner_guid == $user->guid || $user->canModerate()){
	 if($video->videoEdit($title, $description)){
	 	ossn_trigger_message(ossn_print('video:com:saved'));
	 	
		$url = $video->getURL();
		header("Location: {$url}");
		exit;
	 } 
 } 
 ossn_trigger_message(ossn_print('video:com:save:failed'), 'error');
 redirect(REF);	 
