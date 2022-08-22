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

$type = input('type');
if(empty($type)){
	$type = 'list';
}
switch($type){
	case 'add':
		echo ossn_view_form('categories/add', array(
    		'action' => ossn_site_url() . 'action/category/add',
    		'class' => 'ossn-admin-form'	
		));	
	break;
	case 'list':
		echo ossn_plugin_view('categories/admin/list');
	break;
}