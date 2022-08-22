<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   SOFTLAB24 COMMERICAL ITEMS LICENSE v1  https://www.softlab24.com/license/
 * @link      https://www.softlab24.com/
 */
define('REPORT', ossn_route()->com . 'Report/');
require_once(REPORT . 'classes/Report.php');
ossn_register_system_sdk('Report', 'ossn_report_init');
