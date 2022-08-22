<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Core Team <info@softlab24.com>
 * @copyright 2017 iNFORMATIKON TECHNOLOGIES
 * @license   https://www.softlab24.com/license/commercial-license-v1
 * @link      https://www.softlab24.com/license
 * @version   1.1
 */

define('__MODERATOR__', ossn_route()->com . 'Moderator/');
define('MODERATOR_DELETE_USERS', true);

/**
 * Moderator initialize
 *
 * @return void
 */
function moderator_init() {
		//Check if user is logged in
		if (ossn_isLoggedin()) {
				//Set up hooks only if user is administrator
				//preg_match('/admin\/edit\/user/i', $_SERVER['REQUEST_URI']) $asalan means when its also on edit action
				if (ossn_isAdminLoggedin() && (preg_match('/edituser/i', $_SERVER['REQUEST_URI']) || preg_match('/\/action\/admin\/edit\/user/i', $_SERVER['REQUEST_URI']))) {
						//these allow us to tap the access to the user fields
						ossn_add_hook('user', 'default:fields', 'mod_default_fields');
						ossn_add_hook('user', 'signup:fields', 'mod_default_fields');
				}
				//Do not proceed if not allowed to moderate
				if (!user_canModerate()) {
						return;
				}
				
				ossn_extend_view('js/opensource.socialnetwork', 'js/moderator');				
				ossn_extend_view('css/ossn.default', 'css/moderator');
				//allow moderator to delete user $arsalan
				if(MODERATOR_DELETE_USERS == true && ossn_isLoggedin() && ossn_loggedin_user()->canModerate()){
					ossn_register_action('moderator/delete/user', __MODERATOR__ . 'actions/administrator/user/delete.php');
				}
				//Allow user access to comments
				mod_replace_action('delete/comment', __MODERATOR__ . 'actions/comment/delete.php');
				ossn_register_callback('comment', 'load', 'mod_ossn_comment_menu');
				
				//Allow user access to wall 
				mod_replace_action('wall/post/delete', __MODERATOR__ . 'actions/wall/post/delete.php');
				
				//Allow user access to photos
				mod_replace_action('photo/delete', __MODERATOR__ . 'actions/photo/delete.php');
				mod_replace_action('profile/photo/delete', __MODERATOR__ . 'actions/photo/profile/delete.php');
				mod_replace_action('profile/cover/photo/delete', __MODERATOR__ . 'actions/photo/profile/cover/delete.php');
				
				mod_replace_hook('photo:view', 'profile:controls', 'ossn_profile_photo_menu', 'mod_ossn_profile_photo_menu');
				mod_replace_hook('photo:view', 'album:controls', 'ossn_album_photo_menu', 'mod_ossn_album_photo_menu');
				mod_replace_hook('cover:view', 'profile:controls', 'ossn_album_cover_photo_menu', 'mod_ossn_album_cover_photo_menu');
				
				//Allow access to groups
				mod_replace_action('group/cover/delete', __MODERATOR__ . 'actions/group/cover/delete.php');
				mod_replace_hook('group', 'subpage', 'group_edit_page', 'mod_group_edit_page');
				
				//ossn_new_external_js('bootstrap-select.min.js', ossn_site_url('components/Moderator/vendors/js/bootstrap-select.min.js'), false);
				//ossn_new_external_css('bootstrap-select.min.css', ossn_site_url('components/Moderator/vendors/css/bootstrap-select.min.css'), false);
				
				//ossn_load_external_js('bootstrap-select.min.js', 'admin');
				//ossn_load_external_css('bootstrap-select.min.css', 'admin');
				if(MODERATOR_DELETE_USERS == true && ossn_isLoggedin() && ossn_loggedin_user()->canModerate()){
					ossn_register_callback('page', 'load:profile', 'ossn_user_moderator_menu', 100);	
				}
				
		}
}
/**
 * User moderator menu item in profile.
 *
 * @return void;
 * @access private;
 */
function ossn_user_moderator_menu($name, $type, $params) {
    $user = ossn_user_by_guid(ossn_get_page_owner_guid());
	if($user && !$user->isAdmin()){
	    $delete = ossn_site_url("action/moderator/delete/user?guid={$user->guid}", true);
    	ossn_register_menu_link('delete_user', ossn_print('moderator:delete:user'), $delete, 'profile_extramenu');
	}
}
/**
 * Define our local moderator checking function 
 * #homelancer
 *
 * @return true/false
 */
function user_canModerate() {
		$user = ossn_loggedin_user();
		return (ossn_isAdminLoggedin() || ossn_isLoggedin() && $user->canModerate());
}

/**
 * Capture the hooks
 *
 * @param string $hook   Name of the hook
 * @param string $type   The type of hook
 * @param string $args   The mixed data
 * @param array  $params The option values
 *
 * @return $args
 */
function mod_default_fields($hook, $type, $args, $params) {
		$recnalemoh = array(
				'name' => 'can_moderate',
				'id' => 'can_moderate',
				'label' => true,
				'placeholder' => ossn_print('can_moderate'),
				'options' => array(
						'no' => ossn_print('moderator:no'),
						'yes' => ossn_print('moderator:yes')
				)
		);
		$found      = false;
		if (isset($args['required']['dropdown'])) {
				$dropdowns = $args['required']['dropdown'];
				$found     = array_search('can_moderate', array_column($dropdowns, 'name'));
		}
		if (!$found) {
				$args['required']['dropdown'][] = $recnalemoh;
		}
		return $args;
}

/**
 * Check if the action exists and replace if it does
 * #homelancer
 *
 * @param string $action      The name of action
 * @param mixed  $recnalemoh  The replacement 
 *
 * @return bool
 */
function mod_replace_action($action, $recnalemoh) {
		ossn_unregister_action($action);
		ossn_register_action($action, $recnalemoh);
}

/**
 * Check if the hook exists and replace if it does
 * #homelancer
 *
 * @param string $hook        The name of the hook
 * @param string $type        The type of the hook
 * @param mixed  $callback    The callback of the hook
 * @param mixed  $recnalemoh  The replacement to the hook
 *
 * @return bool
 */
function mod_replace_hook($hook, $type, $callback, $recnalemoh) {
		global $Ossn;
		if (isset($Ossn->hooks[$hook][$type])) {
				$prio = array_search($callback, $Ossn->hooks[$hook][$type]);
				if ($prio === false) {
						$prio = 200; // default priority for add hooks
				} else {
						unset($Ossn->hooks[$hook][$type][$prio]);
				}
				ossn_add_hook($hook, $type, $recnalemoh, $prio);
		}
}

/**
 * We add the user_canModerate() on the delete comment menu 
 *
 * @param string $name Name of Callback
 * @param strign $type Callback type
 * @param array  $params A option values
 *
 * @return void
 * @access private
 */
function mod_ossn_comment_menu($name, $type, $params) {
		
		//unset previous comment menu item
		//Post owner can not delete others comments #607
		//Pull request #601 , refactoring
		ossn_unregister_menu('delete', 'comments');
		$user = ossn_loggedin_user();
		
		$OssnComment = new OssnComments;
		if (is_object($params)) {
				$params = get_object_vars($params);
		}
		$comment = $OssnComment->getComment($params['id']);
		if ($comment->type == 'comments:post') {
				if (com_is_active('OssnWall')) {
						$ossnwall = new OssnWall;
						$post     = $ossnwall->GetPost($comment->subject_guid);
						
						//check if type is group
						if ($post->type == 'group') {
								$group = ossn_get_group_by_guid($post->owner_guid);
						}
						//group admins must be able to delete ANY comment in their own group #170
						//just show menu if group owner is loggedin 
						if (ossn_isAdminLoggedin() || user_canModerate() || (ossn_loggedin_user()->guid == $post->owner_guid) || $user->guid == $comment->owner_guid || (ossn_loggedin_user()->guid == $group->owner_guid)) {
								ossn_unregister_menu('delete', 'comments');
								ossn_register_menu_item('comments', array(
										'name' => 'delete',
										'href' => ossn_site_url("action/delete/comment?comment={$params['id']}", true),
										'class' => 'ossn-delete-comment',
										'text' => ossn_print('comment:delete'),
										'priority' => 200
								));
						}
				}
		}
		//this section is for entity comment only
		if (ossn_isLoggedin() && $comment->type == 'comments:entity') {
				$entity = ossn_get_entity($comment->subject_guid);
				if (($user->guid == $params['owner_guid']) || ossn_isAdminLoggedin() || user_canModerate() || ($comment->type == 'comments:entity' && $entity->type = 'user' && $user->guid == $entity->owner_guid)) {
						ossn_unregister_menu('delete', 'comments');
						ossn_register_menu_item('comments', array(
								'name' => 'delete',
								'href' => ossn_site_url("action/delete/comment?comment={$params['id']}", true),
								'class' => 'ossn-delete-comment',
								'text' => ossn_print('comment:delete'),
								'priority' => 200
						));
				}
		}
}


/**
 * We add the user_canModerate() on the group edit page
 *
 * Page:
 *      group/<guid>/edit
 *
 * @return mixdata;
 * @access private
 */
function mod_group_edit_page($hook, $type, $return, $params) {
		$user = ossn_loggedin_user();
		
		$page  = $params['subpage'];
		$group = ossn_get_group_by_guid(ossn_get_page_owner_guid());
		if ($group->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin() && !user_canModerate()) {
				return false;
		}
		if ($page == 'edit') {
				$params = array(
						'action' => ossn_site_url() . 'action/group/edit',
						'component' => 'OssnGroups',
						'class' => 'ossn-edit-form',
						'params' => array(
								'group' => $group
						)
				);
				$form   = ossn_view_form('edit', $params, false);
				echo ossn_set_page_layout('module', array(
						'title' => ossn_print('edit'),
						'content' => $form
				));
		}
}

/**
 * Show a leftside menu on profile photo view
 *
 * @return mix data
 * @access private;
 */
function mod_ossn_profile_photo_menu($hook, $type, $return, $params) {
		if ($params->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin() || user_canModerate()) {
				return ossn_plugin_view('photos/views/profilephoto/menu', $params);
		}
}

/**
 * Show a leftside menu on album photo view
 *
 * @return mix data
 * @access private;
 */
function mod_ossn_album_photo_menu($hook, $type, $return, $params) {
		$album = ossn_albums()->getAlbum($params->owner_guid);
		if ($album->album->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin() || user_canModerate()) {
				return ossn_plugin_view('photos/views/albumphoto/menu', $params);
		}
}

/**
 * Show a leftside menu on profile cover photo vieww
 *
 * @return mix data
 * @access private;
 */
function mod_ossn_album_cover_photo_menu($hook, $type, $return, $params) {
		if ($params->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin() || user_canModerate()) {
				return ossn_plugin_view('photos/views/coverphoto/menu', $params);
		}
}

ossn_register_callback('ossn', 'init', 'moderator_init');