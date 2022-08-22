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

$init = new OssnComponents;
$ini = array(
			'show_about_page' => input('show_about_page'),			 
);
if($init->setSettings('CustomFields', $ini)){
			ossn_trigger_message(ossn_print('customfield:fields:aboutsaved'));
			redirect(REF);			 
 } else {
			ossn_trigger_message(ossn_print('customfield:fields:aboutsave:error'), 'error');
			redirect(REF);
}
