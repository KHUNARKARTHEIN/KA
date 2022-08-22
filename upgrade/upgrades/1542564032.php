<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$new_components = array(
		'Kernel',
		'BanUser',
		'Birthdays',
		'Categories',
		'Censorship',
		'Dislike',
		'MobileLogin',
		'MultiUpload',
		'PhoneNumbers',
		'Sentiment',
		'SiteOffline',
		'Softlab24',
		'Styler',
		'Videos',
		'SocialLogin',
		'EMembers',
		'SharePost',
		'AccessCode',
		'CustomFields',
		'Moderator',
		'OssnSounds',
		'Hangout',
		'UserVerified',
		'LinkPreview',
		'Report',
		'HashTag'
);

$components = new OssnComponents;
$systemcoms = $components->getComponents();

foreach($new_components as $item) {
		if(!in_array($item, $systemcoms)) {
				$components->enable($item);
				if($item == 'AccessCode'){
						$components->DISABLE($item); //disable AccessCode by default
				}	
		}
}