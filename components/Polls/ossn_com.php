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

define('__POLLS__', ossn_route()->com . 'Polls/');
ossn_register_class(array(
		'Softlab24\Ossn\Component\Polls' => __POLLS__ . 'classes/Polls.php'
));
ossn_register_system_sdk('Polls', 'polls_init');