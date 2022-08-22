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
 $form = ossn_view_form('stories/add', array(
		'id' => 'stories-add',
		'action' => ossn_site_url('action/stories/add'),
		'params' => $params,
 ));
 echo ossn_plugin_view('widget/view', array(
		'title' => ossn_print('stories:story:add'),
		'contents' => $form,
 ));
