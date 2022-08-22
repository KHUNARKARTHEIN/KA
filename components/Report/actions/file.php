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
$type   = input('type');
$guid   = input('guid');
$reason = input('reason');

$types = array(
		'post',
		'comment'
);
if(!in_array($type, $types) || empty($guid) || empty($type)) {
		ossn_trigger_message(ossn_print('report:file:failed'), 'error');
		redirect(REF);
		exit;
}
$report = new Report;
if($report->addReport($guid, $reason, $type)) {
		$user   = new OssnUser;
		$admins = $user->searchUsers(array(
				'wheres' => "u.type = 'admin'"
		));
		if(class_exists("OssnNotifications")) {
				$notification = new OssnNotifications;
				if($admins) {
						foreach($admins as $user) {
								$notification->add("report", ossn_loggedin_user()->guid, $guid, NULL, $user->guid);
						}
				}
				if(com_is_active("Moderator")) {
						$moderators = $user->searchUsers(array(
								'wheres' => "u.type = 'normal'",
								'entities_pairs' => array(
										array(
												'name' => 'can_moderate',
												'value' => 'yes',
										)
								)
						));
						$notification = new OssnNotifications;
						if($moderators) {
								foreach($moderators as $muser) {
										$notification->add("report", ossn_loggedin_user()->guid, $guid, NULL, $muser->guid);
								}
						}
				}
		}
		ossn_trigger_message(ossn_print('report:filed'));
		//redirect(REF);
} else {
		ossn_trigger_message(ossn_print('report:file:failed'), 'error');
		//redirect(REF);
}