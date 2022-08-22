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
 $input = input('whocansee');
 $email = input('email');
 $apikey = input('apikey');
 $website = input('website');
 
 if(empty($input) || empty($apikey) || empty($website) || empty($email)){
		ossn_trigger_message(ossn_print('sentiment:save:error'), 'error');
		redirect(REF);		 
 }
 $args = array(
			   'whocansee' => $input,
			   'apikey' => $apikey,
			   'website' => $website,
			   'email' => $email,
			   );
 if($component->setSettings('Sentiment', $args)){
		ossn_trigger_message(ossn_print('sentiment:saved'));
		redirect(REF);
 } else {
		ossn_trigger_message(ossn_print('sentiment:save:error'), 'error');
		redirect(REF);	 
 }