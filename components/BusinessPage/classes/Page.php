<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team https://www.softlab24.com/contact
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
namespace Ossn\Component\BusinessPage;
class Page extends \OssnObject {
		/**
		 * Categories for page
		 *
		 * @return array
		 */
		public static function categories() {
				return array(
						'business',
						'brand',
						'product',
						'artist',
						'public:figure',
						'entertainment',
						'cause',
						'community',
						'org'
				);
		}
		/**
		 * Add business page
		 * 
		 * @param array $vars A option values
		 * 
		 * @return boolean
		 */				
		public function addPage(array $vars = array()) {
				if(!empty($vars['name']) && !empty($vars['category']) && !empty($vars['description'])) {
						$this->title       = $vars['name'];
						$this->description = $vars['description'];
						
						$this->type       = 'user';
						$this->owner_guid = ossn_loggedin_user()->guid;
						$this->subtype    = 'business:page';
						
						$this->data->category = $vars['category'];
						$this->data->website  = $vars['website'];
						$this->data->phone    = $vars['phone'];
						$this->data->address  = $vars['address'];
						return $this->addObject();
				}
				return false;
		}
		/**
		 * Edit business page
		 * 
		 * @param integer $guid A page guid
		 * 
		 * @return boolean
		 */				
		public function editPage($guid, $vars) {
				$page = ossn_get_object($guid);
				if(empty($guid) || !$page) {
						return false;
				}
				if($page->owner_guid == ossn_loggedin_user()->guid || ossn_loggedin_user()->canModerate()) {
						$page->title          = $vars['name'];
						$page->description    = $vars['description'];
						$page->data->category = $vars['category'];
						$page->data->website  = $vars['website'];
						$page->data->phone    = $vars['phone'];
						$page->data->address  = $vars['address'];
						return $page->save();
				}
				return false;
		}
		/**
		 * Delete businesspage
		 * 
		 * @param integer $guid A page guid
		 * 
		 * @return boolean
		 */				
		public function deletePage($guid) {
				$page = get_business_page($guid);
				if(empty($guid) || !$page) {
						return false;
				}
				return business_page_delete($page);
		}		
		/**
		 * Get user pages
		 *
		 * @param array $params A option values
		 * 
		 * @return object
		 */
		public function getUserPages($user_guid, $params = array()) {
				if(empty($user_guid)) {
						return false;
				}
				$vars = array(
						'type' => 'user',
						'subtype' => 'business:page',
						'owner_guid' => $user_guid
				);
				$args = array_merge($vars, $params);
				return $this->searchObject($args);
		}
		/**
		 * Get business pages
		 * 
		 * @param array $params A option values
		 * 
		 * @return boolean
		 */				
		public function getPages($params = array()) {
				$vars = array(
						'type' => 'user',
						'subtype' => 'business:page',
				);
				$args = array_merge($vars, $params);
				return $this->searchObject($args);
		}	
		/**
		 * Get photo URL
		 * 
		 * @param string $type A photo type
		 * 
		 * @return string
		 */				
		public function photoURL($type = "") {
				if(isset($this->photo_entity_guid)) {
						$hash = sha1($this->guid);
						return ossn_site_url("page/photo/{$this->guid}/{$type}/{$hash}.jpg");
				} else {
						return ossn_site_url("page/photo/{$this->guid}/default.jpg");
				}
		}
		/**
		 * Get cover URL
		 * 
		 * @return string
		 */			
		public function coverURL() {
				if(isset($this->cover_entity_guid)) {
						$hash = sha1($this->guid);
						return ossn_site_url("page/cover/{$this->guid}/{$hash}.jpg");
				} else {
						return ossn_site_url("page/cover/{$this->guid}/default.jpg");
				}
		}
}