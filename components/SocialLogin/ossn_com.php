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
define('SOCIAL_LOGIN', ossn_route()->com . 'SocialLogin/');

require_once(SOCIAL_LOGIN . 'classes/Login.php');
ossn_register_system_sdk('SocialLogin', 'social_login_init');