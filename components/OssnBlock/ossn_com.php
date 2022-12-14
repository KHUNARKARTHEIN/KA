<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

/* Define Paths */
define('__OSSN_BLOCK__', ossn_route()->com . 'OssnBlock/');

/* Load OssnBlock Class */
require_once(__OSSN_BLOCK__ . 'classes/OssnBlock.php');

/**
 * Initialize the block component.
 *
 * @return void;
 * @access private;
 */
function ossn_block() {
		//callbacks
		ossn_register_callback('page', 'load:profile', 'ossn_user_block_menu', 100);
		ossn_register_callback('action', 'load', 'ossn_user_block_action');
		
		//hooks
		ossn_add_hook('page', 'load', 'ossn_user_block');
		
		//actions
		if(ossn_isLoggedin()) {
				ossn_register_action('block/user', __OSSN_BLOCK__ . 'actions/user/block.php');
				ossn_register_action('unblock/user', __OSSN_BLOCK__ . 'actions/user/unblock.php');
		}
		ossn_register_page('blocked', 'ossn_block_page_handler');
}

/**
 * User block menu item in profile.
 *
 * @return void;
 * @access private;
 */
function ossn_user_block_menu($name, $type, $params) {
		$user = ossn_user_by_guid(ossn_get_page_owner_guid());
		if(OssnBlock::isBlocked(ossn_loggedin_user(), $user)) {
				$unblock = ossn_site_url("action/unblock/user?user={$user->guid}", true);
				ossn_register_menu_link('block', ossn_print('user:unblock'), $unblock, 'profile_extramenu');
		} else {
				$block = ossn_site_url("action/block/user?user={$user->guid}", true);
				ossn_register_menu_link('block', ossn_print('user:block'), $block, 'profile_extramenu');
		}
}
/**
 * Check user blocks.
 *
 * @return void;
 * @access private;
 */
function ossn_user_block_action($callback, $type, $params) {
		switch($params['action']) {
				case 'poke/user':
						$user = ossn_user_by_guid(input('user'));
						if($user) {
								if(OssnBlock::UserBlockCheck($user)) {
										ossn_trigger_message(ossn_print('user:poke:error'), 'error');
										redirect(REF);
								}
						}
						break;
				case 'ossnchat/send':
						$user = ossn_user_by_guid(input('to'));
						if($user) {
								//we need to check for other user too to avoid sending message to user that he blocked
								//[E] Stop UserA to send messages to UserB if he blocked UserB #1676					
								if(OssnBlock::UserBlockCheck($user) || OssnBlock::selfBlocked($user)) {
										header('Content-Type: application/json');
										echo json_encode(array(
												'type' => 0
										));
										exit;
								}
						}
						break;
				case 'post/comment':
						$guid = input('post');
						
						$post = new OssnWall;
						$post = $post->GetPost($guid);
						
						$user = ossn_user_by_guid($post->owner_guid);
						if($user && (OssnBlock::UserBlockCheck($user) || OssnBlock::selfBlocked($user))) {
								ossn_block_page();
						}
						break;
				case 'message/send':
						$user = ossn_user_by_guid(input('to'));
						if($user) {
								//we need to check for other user too to avoid sending message to user that he blocked
								//[E] Stop UserA to send messages to UserB if he blocked UserB #1676
								if(OssnBlock::UserBlockCheck($user) || OssnBlock::selfBlocked($user)) {
										echo 0;
										exit;
								}
						}
						break;
		}
}
/**
 * Check user blocks.
 *
 * @return void;
 * @access private;
 */
function ossn_user_block($name, $type, $return, $params) {
		/*
		 * Deny from visiting profile
		 */
		if($params['handler'] == 'u') {
				$user = ossn_user_by_username($params['page'][0]);
				if($user && OssnBlock::UserBlockCheck($user)) {
						ossn_block_page();
				}
		}
		/*
		 * Deny from sending messages
		 */
		if($params['handler'] == 'messages' && isset($params['page'][1])) {
				$user = ossn_user_by_username($params['page'][1]);
				if($user && (OssnBlock::UserBlockCheck($user) || OssnBlock::selfBlocked($user))) {
						ossn_block_page();
				}
		}
		/*
		 * Deny from viewing user wall posts
		 */
		if($params['handler'] == 'post' && $params['page'][0] == 'view' && com_is_active('OssnWall')) {
				$post = new OssnWall;
				$post = $post->GetPost($params['page'][1]);
				$user = ossn_user_by_guid($post->owner_guid);
				if($user && (OssnBlock::UserBlockCheck($user) || OssnBlock::selfBlocked($user))) {
						ossn_block_page();
				}
		}
		//add support for some components
		if($params['handler'] == 'video' && com_is_active('Videos') && function_exists('ossn_get_video') && $params['page'][0] == 'view') {
				$video = ossn_get_video($params['page'][1]);
				$user  = ossn_user_by_guid($video->owner_guid);
				if($user && (OssnBlock::UserBlockCheck($user) || OssnBlock::selfBlocked($user))) {
						ossn_block_page();
				}
		}
		if($params['handler'] == 'event' && com_is_active('Events') && function_exists('ossn_get_event') && $params['page'][0] == 'view') {
				$video = ossn_get_event($params['page'][1]);
				$user  = ossn_user_by_guid($video->owner_guid);
				if($user && (OssnBlock::UserBlockCheck($user) || OssnBlock::selfBlocked($user))) {
						ossn_block_page();
				}
		}
		if($params['handler'] == 'polls' && com_is_active('Polls') && function_exists('ossn_poll_get') && $params['page'][0] == 'view') {
				$video = ossn_poll_get($params['page'][1]);
				$user  = ossn_user_by_guid($video->owner_guid);
				if($user && (OssnBlock::UserBlockCheck($user) || OssnBlock::selfBlocked($user))) {
						ossn_block_page();
				}
		}
		if($params['handler'] == 'files' && com_is_active('Files') && function_exists('ossn_file_get') && $params['page'][0] == 'view') {
				$video = ossn_file_get($params['page'][1]);
				$user  = ossn_user_by_guid($video->owner_guid);
				if($user && (OssnBlock::UserBlockCheck($user) || OssnBlock::selfBlocked($user))) {
						ossn_block_page();
				}
		}
		if($params['handler'] == 'blog' && com_is_active('Blog') && function_exists('ossn_file_get') && $params['page'][0] == 'view') {
				$video = com_blog_get_blog($params['page'][1]);
				$user  = ossn_user_by_guid($video->owner_guid);
				if($user && (OssnBlock::UserBlockCheck($user) || OssnBlock::selfBlocked($user))) {
						ossn_block_page();
				}
		}
		/*
		 * Deny from viewing profile photos album and albums
		 */
		if($params['handler'] == 'album') {
				//check if album is profile photos
				if($params['page'][0] == 'profile') {
						$user = ossn_user_by_guid($params['page'][1]);
						//if album is not profile photos album then it means it simple album
				} elseif($params['page'][0] == 'view') {
						$album = new OssnAlbums;
						$album = $album->GetAlbum($params['page'][1]);
						$user  = ossn_user_by_guid($album->album->owner_guid);
				}
				if(isset($user) && OssnBlock::UserBlockCheck($user)) {
						ossn_block_page();
				}
		}
		return $return;
}
/**
 * Block Page
 * 
 * @return void
 */
function ossn_block_page_handler() {
		$title                  = ossn_print('ossn:blocked:error');
		$contents['content']    = ossn_plugin_view('block/error');
		$contents['background'] = false;
		$content                = ossn_set_page_layout('contents', $contents);
		echo ossn_view_page($title, $content);
}
/**
 * Ossn block page
 *
 * @return void
 */
function ossn_block_page() {
		if(ossn_is_xhr()) {
				header("HTTP/1.0 404 Not Found");
		} else {
				redirect('blocked');
		}
}
ossn_register_callback('ossn', 'init', 'ossn_block');