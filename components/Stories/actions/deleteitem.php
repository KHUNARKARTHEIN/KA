<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   SOFTLAB24 LIMITED, COMMERCIAL LICENSE v1.0 https://www.softlab24.com/license/commercial-license-v1
 * @link      https://www.softlab24.com
 */
 $guid = input('guid');
 $file = ossn_get_file($guid);
 if($file && $file->subtype == 'file:storyfile'){
	 $status = story_get_item($file->owner_guid);
	 if($status &&  $status->owner_guid == ossn_loggedin_user()->guid){
			$path =  $file->getPath();
			if($file->deleteEntity()){
					unset($path);
					
					$stores = new Stories;
					//check if its only one file then delete entire status
				 	$count  = $stores->getStoryItemPhotos($status->guid, array(
									'count' => true,	
					));	
					if(!$count){
						$status->deleteObject();	
					}
					ossn_trigger_message(ossn_print('stories:deleted:status'));
					redirect(REF);
			}
	 }
 }
ossn_trigger_message(ossn_print('stories:delete:failed'));
redirect(REF);
