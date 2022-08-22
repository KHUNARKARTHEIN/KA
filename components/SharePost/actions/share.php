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
 $guid = input('guid');
 if(share_post($guid)){
	 ossn_trigger_message(ossn_print('post:shared'));
	 redirect(REF);
 }
 ossn_trigger_message(ossn_print('post:share:error'), 'error');
 redirect(REF);
 