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
 $input = input('access_code');
 if(empty($input)){
		ossn_trigger_message(ossn_print('accesscode:save:error'), 'error');
		redirect(REF);		 
 }
 $args = array(
			   'accesscode' => $input,
			   );
 if($component->setSettings('AccessCode', $args)){
		ossn_trigger_message(ossn_print('accesscode:saved'));
		redirect(REF);
 } else {
		ossn_trigger_message(ossn_print('accesscode:save:error'), 'error');
		redirect(REF);	 
 }