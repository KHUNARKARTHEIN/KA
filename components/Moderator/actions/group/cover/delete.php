<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 * @codeby	Homelancer
 */
$guid = input('guid');
$group = ossn_get_group_by_guid($guid);
if($group->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin() && !user_canModerate()) {
	redirect(REF);	
}
if (isset($group->guid)) {
    $entity = new OssnEntities;
	$params = array(
		'from' => 'ossn_entities',
		'wheres' => array("(type='object') AND 
			(subtype='cover' OR subtype='file:cover')"
		)
	);
	$items = $entity->select($params,true);	
	foreach($items as $item){
		if($entity->deleteEntity($item->guid)){
			if ($item->subtype=='file:cover'){
				$source = ossn_get_userdata("object/{$group->guid}/{$group->$file_cover}");
				//delete file
				unlink($source);	
			}
		}
	}
}
redirect(REF);	
