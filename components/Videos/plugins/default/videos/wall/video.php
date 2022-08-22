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

$video = ossn_get_video($params['post']->item_guid);
if($video->container_type == 'user'){
	echo ossn_plugin_view('videos/wall/user', $params);
}
if($video->container_type == 'group'){
	echo ossn_plugin_view('videos/wall/group', $params);
}