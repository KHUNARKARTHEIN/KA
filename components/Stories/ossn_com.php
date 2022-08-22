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
define('Stories', ossn_route()->com . 'Stories/');
require_once(Stories . 'classes/Stories.php');
ossn_register_system_sdk('Stories', 'stories_init');