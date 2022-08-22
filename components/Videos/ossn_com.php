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

define('__VIDEOS__', ossn_route()->com . 'Videos/');
require_once(__VIDEOS__ . 'classes/Videos.php');
require_once(__VIDEOS__ . 'classes/VideoThumb.php');
ossn_register_system_sdk('Videos', 'videos_init');