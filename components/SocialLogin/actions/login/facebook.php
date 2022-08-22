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
$cc = social_login_cred();
if((!isset($cc->facebook->consumer_key)  || isset($cc->facebook->consumer_key) && empty($cc->facebook->consumer_key)) || (!isset($cc->facebook->consumer_secret) || isset($cc->facebook->consumer_secret) && empty($cc->facebook->consumer_secret))){
		ossn_trigger_message("Error 100!", 'error');
		redirect();
}
$new = new Login;
$URL = $new->fbURL();
header("Location: {$URL}");
