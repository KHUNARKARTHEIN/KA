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
$title = input('title');
$info  = input('info');
$vars  = array(
		'country' => input('country'),
		'location' => input('location'),
		'event_cost' => input('event_cost'),
		'date' => input('date'),
		'start_time' => input('start_time'),
		'end_time' => input('end_time'),
		'comments' => input('allowed_comments')
);

$container_guid = input("container_guid");
if(!empty($container_guid)) {
		$group = ossn_get_object($container_guid);
		if($group->subtype !== 'ossngroup') {
				$container_guid = false;
		}
}

if(empty($title) || empty($info) || empty($vars['date']) && empty($_FILES['picture'])) {
		ossn_trigger_message(ossn_print("event:fields:required:title:info"), 'error');
		redirect(REF);
}
$event = new Events;
if($guid = $event->addEvent($title, $info, $container_guid, $vars)) {
		ossn_trigger_message(ossn_print("event:creation:succes"));
		$title = OssnTranslit::urlize($title);
		redirect("event/view/{$guid}/{$title}");
} else {
		ossn_trigger_message(ossn_print("event:creation:failed"));
		redirect(REF);
}