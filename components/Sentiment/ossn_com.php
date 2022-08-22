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
define('SENTIMENT', ossn_route()->com . 'Sentiment/');

require_once(SENTIMENT . 'classes/Sentiment.php');
/**
 * Sentiment Initilizze
 * 
 * @param null
 * @return void
 */
function sentiment_init() {
		ossn_register_callback('wall', 'post:created', 'sentiment_wallpost_add', 1);
		ossn_register_callback('wall', 'post:edited', 'sentiment_wallpost_add', 1);
		ossn_register_callback('comment', 'created', 'sentiment_comment_add', 1);
		ossn_register_callback('comment', 'edited', 'sentiment_comment_add', 1);
		
		ossn_extend_view('css/ossn.default', 'css/sentiment');
		
		ossn_register_com_panel('Sentiment', 'settings');
		if(ossn_isAdminLoggedin()) {
				ossn_register_action('sentiment/settings', SENTIMENT . 'actions/settings.php');
		}		
}
/**
 * Sentiment wallpost add
 * 
 * @param string $callback A name of callback
 * @param string $type A callback type
 * @param array	 $params A option values
 * 
 * @return void
 */
function sentiment_wallpost_add($callback, $type, $params) {
		if(isset($params['object_guid']) && !empty($params['object_guid'])) {
				$object = ossn_get_object($params['object_guid']);
		} elseif(isset($params['object']) && $params['object'] instanceof OssnObject) {
				$object = $params['object'];
		}
		if($object) {
				$json = html_entity_decode($object->description);
				
				$data = json_decode($json, true);
				$text = ossn_restore_new_lines($data['post']);
				$text = ossn_input_escape($text);
				
				$data['post'] = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
				$rejson       = json_encode($data, JSON_UNESCAPED_UNICODE);
				
				$object->description = "{$rejson}";
				
				$data      = json_decode($json, true);
				$sentiment = sentiment_process($data['post']);
				if(!empty($data['post']) && $data['post'] !== 'null:data') {
						$object->data->sentiment = $sentiment;
						$object->save();
				}
		}
}
/**
 * Sentiment comment add
 * 
 * @param string $callback A name of callback
 * @param string $type A callback type
 * @param array	 $params A option values
 * 
 * @return void
 */
function sentiment_comment_add($callback, $type, $params) {
		if(isset($params['id']) && !empty($params['id'])) {
				$comment = ossn_get_annotation($params['id']);
		} elseif($params['annotation']) {
				$comment = ossn_get_annotation($params['annotation']->id);
		}
		if($comment) {
				if($comment->type == 'comments:entity') {
						$text = $comment->getParam('comments:entity');
				} elseif($comment->type == 'comments:post') {
						$text = $comment->getParam('comments:post');
				}
				if(!empty($text)) {
						$sentiment = sentiment_process($text);
						if(!empty($sentiment)) {
								$comment->data->sentiment = $sentiment;
								$comment->save();
						}
				}
		}
}
/**
 * Sentiment process
 * 
 * @param string $text A text
 * 
 * @return string|boolean
 */
function sentiment_process($text = '') {
		$data = Sentiment::analyze($text);
		if(!empty($text) && !empty($data)) {
				return Sentiment::getType($data);
		}
		return false;
}
ossn_register_callback('ossn', 'init', 'sentiment_init');
