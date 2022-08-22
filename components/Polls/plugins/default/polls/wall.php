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

$poll = ossn_poll_get($params['post']->item_guid);
$entity = ossn_get_entity($poll->poll_entity);

$params['entity'] = $entity;
$params['poll']   = $poll;

if($poll->container_type == 'user'){
	echo ossn_plugin_view('polls/wall/user', $params);
} else {
	echo ossn_plugin_view('polls/wall/group', $params);
}
