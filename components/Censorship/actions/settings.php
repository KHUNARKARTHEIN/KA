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
 $input = input('words');
 $string = input('string');
 if(empty($input) || empty($string)){
		ossn_trigger_message(ossn_print('censorship:fields:error'), 'error');
		redirect(REF);		 
 }
 $args = array(
			   'words' => trim($input),
			   'stringval' => trim($string),
			   );
 if($component->setSettings('Censorship', $args)){
		ossn_trigger_message(ossn_print('censorship:saved'));
		redirect(REF);
 } else {
		ossn_trigger_message(ossn_print('censorship:save:error'), 'error');
		redirect(REF);	 
 }