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
class Events extends OssnObject {
		/**
		 * Initialize The Attrs
		 *
		 * @return void
		 */
		public function initAttrs() {
				$this->file = new OssnFile;
				if(class_exists('OssnWall')) {
						$this->wall = new OssnWall;
				}
		}
		/**
		 * Add the event
		 * 
		 * @param  string $title A event title
		 * @param  string $info A description for event
		 * @param  $container_guid If its a group event
		 * @param  $params A option values
		 *
		 * @return boolean
		 */
		public function addEvent($title, $info, $container_guid = false, array $params = array()) {
				self::initAttrs();
				$user = ossn_loggedin_user();
				if(!empty($user->guid) && !empty($title) && !empty($params['date']) && !empty($info)) {
						
						//setup basic settings
						$this->title       = $title;
						$this->description = $info;
						$this->type        = 'user';
						$this->subtype     = 'event';
						$this->owner_guid  = $user->guid;
						
						//set event metadata
						$this->data->event_cost             = $params['event_cost'];
						$this->data->country                = $params['country'];
						$this->data->location               = $params['location'];
						$this->data->date                   = $params['date'];
						$this->data->start_time             = $params['start_time'];
						$this->data->end_time               = $params['end_time'];
						$this->data->allowed_comments_likes = $params['comments'];
						
						//is event is of any other object like group event?
						if($container_guid) {
								$this->data->container_guid = $container_guid;
						}
						if($this->addObject()) {
								$object_guid = $this->getObjectId();
								$this->addWall($this->eventEntityAdd($object_guid));
								//add event image
								if(isset($_FILES['picture'])) {
										$this->file->owner_guid = $object_guid;
										$this->file->type       = 'object';
										$this->file->subtype    = 'event:photo';
										$this->file->setFile('picture');
										$this->file->setPath('event/photo/');
										$this->file->setExtension(array(
												'jpg',
												'png',
												'jpeg',
												'gif'
										));
										if(!$this->file->addFile()) {
												//delete event if image creation failed.
												$this->deleteObject($this->file->owner_guid);
												return false;
										}
										$resize = $this->file->getFiles();
										//resize event image and create one small one of 150x150
										if(isset($resize->{0})) {
												$guid      = $user->guid;
												$datadir   = ossn_get_userdata("object/{$this->file->owner_guid}/{$resize->{0}->value}");
												$file_name = str_replace('event/photo/', '', $resize->{0}->value);
												
												$resized = ossn_resize_image($datadir, 250, 250, true);
												file_put_contents(ossn_get_userdata("object/{$this->file->owner_guid}/event/photo/small_{$file_name}"), $resized);
										}
								}
								//return the event guid
								return $this->getObjectId();
						}
				}
				return false;
		}
		/**
		 * Save the image for event
		 * 
		 * @param integer $guid A event guid
		 *
		 * @return boolean
		 */
		public function saveImage($guid) {
				if(isset($_FILES['picture']) && !empty($_FILES['picture']['name']) && !empty($guid)) {
						
						$entity             = new OssnEntities;
						$entity->type       = 'object';
						$entity->owner_guid = $guid;
						$entity->subtype    = 'file:event:photo';
						$pics               = $entity->get_entities();
						foreach($pics as $pic) {
								$entity->deleteEntity($pic->guid);
						}
						OssnFile::DeleteDir(ossn_get_userdata("object/{$guid}/event/photo/"));
						
						self::initAttrs();
						$this->file->owner_guid = $guid;
						$this->file->type       = 'object';
						$this->file->subtype    = 'event:photo';
						$this->file->setFile('picture');
						$this->file->setPath('event/photo/');
						$this->file->setExtension(array(
								'jpg',
								'png',
								'jpeg',
								'gif'
						));
						
						if(!$this->file->addFile()) {
								return false;
						}
						
						//reget the files
						$resize = $this->file->getFiles();
						//resize event image and create one small one of 150x150
						if(isset($resize->{0})) {
								$guid      = $user->guid;
								$datadir   = ossn_get_userdata("object/{$this->file->owner_guid}/{$resize->{0}->value}");
								$file_name = str_replace('event/photo/', '', $resize->{0}->value);
								
								$resized = ossn_resize_image($datadir, 250, 250, true);
								file_put_contents(ossn_get_userdata("object/{$this->file->owner_guid}/event/photo/small_{$file_name}"), $resized);
						}
				}
				return true;
		}
		/**
		 * Event icon URL
		 * 
		 * @param string $size A size of icon
		 *
		 * @return string
		 */
		public function iconURL($size = 'small') {
				$hash = md5($this->guid . $this->last_update);
				return ossn_site_url("event/image/{$this->guid}/{$size}/{$hash}.jpg");
		}
		/**
		 * Event profile URL
		 *
		 * @return string
		 */
		public function profileURL() {
				$title = OssnTranslit::urlize($this->title);
				return ossn_site_url("event/view/{$this->guid}/{$title}");
		}
		/**
		 * Get events
		 * 
		 * @param array $params A option values
		 *
		 * @return array
		 */
		public function getEvents(array $params = array()) {
				$default = array(
						'type' => 'user',
						'subtype' => 'event',
						'order_by' => 'o.guid DESC',
				);
				if(EVENTS_SORT_BY_DATE){
					$default['entities_pairs'] = array(
										array(
												'name' => 'date',
												'value' => false,
												'wheres' => 'emd0.value IS NOT NULL',
										)
					);
					$default['order_by'] = "STR_TO_DATE(emd0.value, '%c/%d/%Y') ASC";
				}
				$vars    = array_merge($default, $params);
				return $this->searchObject($vars);
		}
		/**
		 * Event add entity for wall post
		 * 
		 * @param integer $guid A event GUID
		 *
		 * @return boolean
		 */
		private function eventEntityAdd($guid) {
				if(empty($guid)) {
						return false;
				}
				$entity             = new OssnEntities;
				$entity->type       = 'object';
				$entity->owner_guid = $guid;
				$entity->subtype    = 'event:wall';
				$entity->value      = true;
				if($entity->add()) {
						return $entity->AddedEntityGuid();
				}
				return false;
		}
		/**
		 * Add wall post
		 * 
		 * @param integer $itemguid A entity->event:wall->guid
		 *
		 * @return boolean
		 */
		public function addWall($itemguid = '') {
				self::initAttrs();
				if(empty($itemguid) || !class_exists("OssnWall")) {
						return false;
				}
				$this->wall->item_type   = 'event';
				$this->wall->owner_guid  = ossn_loggedin_user()->guid;
				$this->wall->poster_guid = ossn_loggedin_user()->guid;
				$this->wall->item_guid   = $itemguid;
				if($this->wall->Post('null:data')) {
						return true;
				}
				return false;
		}
}