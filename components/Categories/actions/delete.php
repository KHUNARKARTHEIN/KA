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
set_time_limit(0);
$guid   = input('guid');
$object = ossn_get_object($guid);

if(!$object) {
		ossn_trigger_message(ossn_print('categories:delete:failed'), 'error');
		redirect(REF);
}
if($object->deleteObject()) {
		$entities = ossn_get_entities(array(
				'type' => 'user',
				'subtype' => 'category',
				'page_limit' => false
		));
		
		if($entities) {
				foreach($entities as $item) {
						$item->deleteEntity();
				}
		}
		ossn_trigger_message(ossn_print('categories:categry:deleted'));
		redirect("administrator/component/Categories");
} else {
		ossn_trigger_message(ossn_print('categories:delete:failed'), 'error');
		redirect(REF);
}