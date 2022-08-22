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
 
 $fb_consumer_key = input('fb_consumer_key');
 $fb_consumer_secret = input('fb_consumer_secret');
 
 $tw_consumer_key = input('tw_consumer_key');
 $tw_consumer_secret = input('tw_consumer_secret');
 
 $args = array(
			   'fb_consumer_key' => trim($fb_consumer_key),
			   'fb_consumer_secret' => trim($fb_consumer_secret),
			   'tw_consumer_key' => trim($tw_consumer_key),
			   'tw_consumer_secret' => trim($tw_consumer_secret),
			   );
 if($component->setSettings('SocialLogin', $args)){
		ossn_trigger_message(ossn_print('social:login:settings:saved'));
		redirect(REF);
 } else {
		ossn_trigger_message(ossn_print('social:login:settings:save:error'), 'error');
		redirect(REF);	 
 }