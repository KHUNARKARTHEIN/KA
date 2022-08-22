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

/**
 * Extended Members INIT
 *
 * @return void
 */
function extended_members() {
		ossn_register_page('site_members', 'ossn_site_members');
		ossn_extend_view('css/ossn.default', 'css/emembers');
		
		ossn_register_sections_menu('newsfeed', array(
				'name' => 'emembers_male',
				'text' => ossn_print('male'),
				'url' => ossn_site_url("site_members/male"),
				'section' => 'emembers',
				'icon' => true
		));
		ossn_register_sections_menu('newsfeed', array(
				'name' => 'emembers_female',
				'text' => ossn_print('female'),
				'url' => ossn_site_url("site_members/female"),
				'section' => 'emembers',
				'icon' => true
		));
}
/**
 * Extended Members Pages
 *
 * @return mixed contents
 */

function ossn_site_members($pages) {
		$page = $pages[0];
		
		$user        = new OssnUser;
		$males_vars  = array(
				'entities_pairs' => array(
						array(
								'name' => 'gender',
								'value' => 'male'
						)
				)
		);
		$males       = $user->searchUsers($males_vars);
		$males_count = $user->searchUsers(array_merge(array(
				'count' => true
		), $males_vars));
		
		$females_vars  = array(
				'entities_pairs' => array(
						array(
								'name' => 'gender',
								'value' => 'female'
						)
				)
		);
		$females       = $user->searchUsers($females_vars);
		$females_count = $user->searchUsers(array_merge(array(
				'count' => true
		), $females_vars));
		switch($page) {
				case 'male':
						$title    = ossn_print('male');
						$contents = array(
								'content' => ossn_plugin_view('emembers/emembers', array(
										'entities' => $males,
										'count' => $males_count
								))
						);
						$content  = ossn_set_page_layout('contents', $contents);
						echo ossn_view_page($title, $content);
						break;
				case 'female':
						$title    = ossn_print('female');
						$contents = array(
								'content' => ossn_plugin_view('emembers/emembers', array(
										'entities' => $females,
										'count' => $females_count
								))
						);
						$content  = ossn_set_page_layout('contents', $contents);
						echo ossn_view_page($title, $content);
						break;
		}
}
ossn_register_callback('ossn', 'init', 'extended_members');