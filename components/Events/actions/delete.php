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
$guid = input('guid');

$object = ossn_get_event($guid);
if(!$object) {
		ossn_trigger_message(ossn_print("event:save:failed"), 'error');
		redirect(REF);
}
if($object->owner_guid !== ossn_loggedin_user()->guid || ossn_loggedin_user()->canModerate()) {
		if($object->deleteObject()) {
				$list = (array)ossn_get_relationships(array(
						'to' => $object->guid,
						'type' => ossn_events_relationship_default()
				));
				if($list) {
						foreach($list as $item) {
								ossn_delete_relationship_by_id($item->relation_id);
						}
				}
				ossn_trigger_message(ossn_print('event:deleted'));
				redirect("event/list");
		}
}
ossn_trigger_message(ossn_print('event:delete:failed'), 'error');
redirect(REF);