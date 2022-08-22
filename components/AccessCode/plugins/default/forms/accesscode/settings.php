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
 
 $component = new OssnComponents;
 $settings  = $component->getSettings('AccessCode'); 
 echo "<label>".ossn_print('accesscode:register:code')."</label>";
 echo ossn_plugin_view('input/text', array(
			'name' => 'access_code',
			'placeholder' => ossn_print('accesscode'),
			'value' => $settings->accesscode,
 ));
 echo "<input type='submit' class='btn btn-success' />";
 