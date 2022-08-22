<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   SOFTLAB24 LIMITED, COMMERCIAL LICENSE v1.0 https://www.softlab24.com/license/commercial-license-v1
 * @link      https://www.softlab24.com
 */
 $title = input('title');
 $Stories = new Stories;
 if($Stories->addStory($title)){
		ossn_trigger_message(ossn_print('stories:added')); 
		redirect(REF);
 } else {
		ossn_trigger_message(ossn_print('stories:add:failed'), 'error'); 
		redirect(REF);	 
 }