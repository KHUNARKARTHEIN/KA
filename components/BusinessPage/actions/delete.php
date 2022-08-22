<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 $guid = input('guid');

 $page = new \Ossn\Component\BusinessPage\Page;
 if($page->deletePage($guid)){
		ossn_trigger_message(ossn_print('bpage:deleted'));
		redirect("page/all");
 }
 ossn_trigger_message(ossn_print('bpage:delete:failed'), 'error');
 redirect(REF); 