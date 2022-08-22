<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
 $component = new OssnComponents;
 
 $path = input('ffmpeg');
 $upgrade = input('upgrade');
 if(empty($path) && !isset($upgrade)){
	 ossn_trigger_message(ossn_print('video:ffmpeg:input:empty'), 'error');
	 redirect(REF);
 }
 $vars = array(
	'ffmpeg_path' => $path,
 );
 if(isset($upgrade)){
		 if($upgrade == 'v5.2'){
				$vars['upgrade'] = $upgrade;
				 set_time_limit(0);
				 $videos = new OssnObject;
	 			 $all = $videos->searchObject(array(
						'type' => 'user',
						'subtype' => 'video',
						'page_limit' => false,	
						'entities_pairs' => false,
				 ));
				 if($all){
						foreach($all as $video){
								if(!isset($video->container_type)){
										$video->data->container_type = 'user';
										$video->data->container_guid = $video->owner_guid;
										$video->save();
								}
						}
				 }
			 
		 }
 } 
 if($component->setSettings('Videos', $vars)){
	 ossn_trigger_message(ossn_print('video:ffmpeg:path:saved'));
	 redirect(REF);
 } else {
	 ossn_trigger_message(ossn_print('video:ffmpeg:path:save:error'), 'error');
	 redirect(REF);	 
 }