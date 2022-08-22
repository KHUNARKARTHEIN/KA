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
 
$com = new OssnComponents;
$params = $com->getSettings('Videos');
echo ossn_view_form('videos/admin', array(
    'action' => ossn_site_url() . 'action/video/admin/settings',
	'params' => array('video' => $params),
    'class' => 'ossn-admin-form'	
));