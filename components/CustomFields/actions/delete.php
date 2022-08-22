<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   SOFTLAB24 LIMITED, COMMERCIAL LICENSE  https://www.softlab24.com/license/commercial-license-v1
 * @link      https://www.softlab24.com/
 */
 $guid = input('guid');
 $object = ossn_get_object($guid);
 
 if($object->deleteObject()){
			ossn_trigger_message(ossn_print('customfield:fields:deleted'));
			redirect(REF);			 
 } else {
			ossn_trigger_message(ossn_print('customfield:fields:delete:error'), 'error');
			redirect(REF);
}
