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
class Videos extends OssnObject {
		/**
		 * Intialize the attributes
		 *
		 * @return void
		 */
		public function initAttributes() {
				$this->file = new OssnFile;
				$this->wall = new OssnWall;
		}
		/**
		 * Add Video
		 *
		 * @param string $title A title of video
		 * @param string $description A description of video
		 *
		 * @return boolean
		 */
		public function addVideo($title = '', $description = '', $container_guid = 0, $container_type = 'user') {
				self::initAttributes();
				$user = ossn_loggedin_user();
				
				$converter = ossn_video_ffmpeg_dir();
				if(empty($converter)) {
						error_log('The path for FFMPEG is empty');
						return false;
				}
				if (empty($container_guid) || empty($container_type)) {
						return false;
				}				
				if(!empty($title) && !empty($description) && !empty($user->guid)) {
						
						$this->title       = $title;
						$this->description = $description;
						$this->type        = 'user';
						$this->subtype     = 'video';
						
						$this->owner_guid = $user->guid;

						$this->data->container_guid = $container_guid;
						$this->data->container_type = $container_type;
						//create video
						if($this->addObject()) {
								$guid = $this->getObjectId();
								
								$this->file->type       = 'object';
								$this->file->owner_guid = $guid;
								$this->file->subtype    = 'video';
								$this->file->setFile('video');
								$this->file->setPath('video/file/');
								$this->file->setMimeTypes(array(
										'mp4' => array('video/mp4'),
										'mov' => array('video/mpeg', 'video/quicktime'),
								));
								$this->file->setExtension(array(
										'mp4',
										'mov'
								));
								
								//create video file
								if($this->file->addFile()) {
										$tmp_file = $this->file->file['tmp_name'];
										if(is_file($tmp_file)) {
												$data = ossn_get_userdata("tmp/{$guid}/");
												
												if(!is_dir($data)) {
														mkdir($data, 0755, true);
												}
												$new_thumb_file = $data . md5($guid) . '.jpg';
												$thumb          = new VideoThumb($converter, $tmp_file, $new_thumb_file);
												//generate video cover
												if($thumb->generate()) {
														self::setTmpFile($new_thumb_file, 'cover');
														
														$this->file             = new OssnFile;
														$this->file->type       = 'object';
														$this->file->owner_guid = $guid;
														$this->file->subtype    = 'cover';
														$this->file->setFile('cover');
														$this->file->setPath('video/cover/');
														$this->file->setExtension(array(
																'jpg',
																'png',
																'jpeg',
																'gif'
														));
														//save video cover
														if($this->file->addFile()) {
																$this->addWall($container_type, $container_guid, $guid);
																return true;
														} else {
																$object = ossn_get_object($guid);
																$object->deleteObject($object->guid);
																return false;
														}
												}
												//finally delete temp generated cover since we saved it.
												OssnFile::DeleteDir($data);
										}
								}
								$this->deleteObject($guid);
						}
				}
				return false;
		}
		/**
		 * Get all videos
		 *
		 * @param array $params A options
		 *
		 * @return array
		 */
		public function getAll(array $params = array()) {
				$default             = array();
				$default['type']     = 'user';
				$default['subtype']  = 'video';
				$default['order_by'] = 'o.guid DESC';
				$default['entities_pairs'] = array(
					array(
						'name' => 'container_type',
						'value' => 'user',
				 	),				
				);					
				$vars = array_merge($default, $params);
				return $this->searchObject($vars);
		}
		/**
		 * Set temperory image file
		 *
		 * @param string $path A path of image
		 * @param string $id A name of image
		 *
		 * @return void
		 */
		public static function setTmpFile($path, $id = '') {
				if(!empty($path) && !empty($id)) {
						$_FILES[$id] = array(
								'tmp_name' => $path,
								'name' => md5(time()) . '.jpg',
								'type' => 'image/jpeg',
								'size' => filesize($path),
								'error' => UPLOAD_ERR_OK
						);
				}
		}
		/**
		 * Add video to wall
		 *
		 * @param integer $itemguid A video guid
		 *
		 * @return boolean
		 */
		public function addWall($walltype = "user", $owner_guid = "", $itemguid = '') {
				if (empty($itemguid) || !class_exists("OssnWall")) {
						return false;
				}
				$this->wall              = new \OssnWall;
				$this->wall->type        = $walltype;
				$this->wall->item_type   = 'video';
				$this->wall->owner_guid  = $owner_guid;
				$this->wall->poster_guid = ossn_loggedin_user()->guid;
				$this->wall->item_guid   = $itemguid;
				if($walltype !== 'user'){
						$access = OSSN_PRIVATE;
				}	
				if ($this->wall->Post('null:data', '', '', $access)) {
						return true;
				}
				return false;
		}
		/**
		 * Get video cover url
		 *
		 * @return void|string
		 */
		public function getCoverURL() {
				if(!empty($this->guid)) {
						$hash = md5($this->guid);
						return ossn_site_url("video/cover/{$this->guid}/{$hash}.jpg");
				}
		}
		/**
		 * Get video file url
		 *
		 * @return void|string
		 */
		public function getFileURL() {
				if(!empty($this->guid)) {
						$hash = md5($this->guid);
						return ossn_site_url("video/file/{$this->guid}/{$hash}.mp4");
				}
		}
		/**
		 * Get video url
		 *
		 * @return void|string
		 */
		public function getURL() {
				if(!empty($this->guid)) {
						$hash = OssnTranslit::urlize($this->title);
						return ossn_site_url("video/view/{$this->guid}/{$hash}");
				}
		}
		/**
		 * Get delete video url
		 *
		 * @return void|string
		 */
		public function getDeleteURL() {
				if(!empty($this->guid)) {
						return ossn_site_url("action/video/delete?guid={$this->guid}", true);
				}
		}
		/**
		 * Get video edit url
		 *
		 * @return void|string
		 */
		public function getEditURL() {
				if(!empty($this->guid)) {
						$translit = OssnTranslit::urlize($this->title);
						return ossn_site_url("video/edit/{$this->guid}/{$translit}", true);
				}
		}
		/**
		 * Video Edit
		 *
		 * @param string $title A title of video
		 * @param string description A description of video
		 *
		 * @return boolean
		 */
		public function videoEdit($title = '', $description = '') {
				if(!empty($this->guid) && !empty($title) && !empty($description)) {
						$fields = array(
								'title',
								'description'
						);
						$values = array(
								$title,
								$description
						);
						if($this->updateObject($fields, $values, $this->guid)) {
								return true;
						}
				}
				return false;
		}
		/**
		 * Delete video wall post
		 * 
		 * @param integer $fileguid Video file guid
		 * @return boolean
		 */
		public function deleteWallPost($fileguid) {
				if(empty($fileguid) || !class_exists("OssnWall")) {
						return false;
				}
				//prepare a query to get post guid
				$statement = "SELECT * FROM ossn_entities, ossn_entities_metadata WHERE(
				  	  ossn_entities_metadata.guid = ossn_entities.guid 
				      AND  ossn_entities.subtype='item_guid'
				      AND  ossn_entities.type = 'object'
				      AND ossn_entities_metadata.value = '{$fileguid}'
				      );";
				
				$this->statement($statement);
				$this->execute();
				$entity = $this->fetch();
				
				//check if post exists or not
				if($entity) {
						//get object
						$object = ossn_get_object($entity->owner_guid);
						if($object && $object->subtype == 'wall') {
								$wall = new OssnWall;
								//delete wall post
								if($wall->deletePost($object->guid)) {
										return true;
								}
						}
				}
				return false;
		}
		/**
		 * Convert given video into H.260 MP4
		 *
		 * @param string $source A complete path to source file
		 * @param string $newfile A complete path to new file
		 * @param string $progress A path to file where a progress stores
		 *
		 * @return boolean
		 */
		public static function convert($source, $newfile, $progress) {
				if(!is_file($source) || empty($source) || empty($newfile) || empty($progress)) {
						return false;
				}
				$binfile = "ffmpeg";
				if(strtoupper(substr(PHP_OS, 0, 3) == 'WIN')) {
						$binfile = "ffmpeg.exe";
				}
				$converter = ossn_video_ffmpeg_dir();
				if(empty($converter)) {
						error_log('The path for FFMPEG is empty');
						return false;
				}
				$command = "{$converter}{$binfile} -i {$source} -vcodec libx264 -profile:v baseline -level 3 {$newfile} 1> {$progress} 2>&1";
				exec($command, $opt, $return);
				if($return === 0) {
						return true;
				}
				return false;
		}
		/**
		 * Find a progress of video %
		 *
		 * @param string $file A complete path to progress file
		 *
		 * @return integer
		 */		
		public static function progress($file) {
				if(!is_file($file)) {
						return false;
				}
				$content = file_get_contents($file);
				preg_match("/Duration: (.*?), start:/", $content, $matches);
				
				$rawDuration = $matches[1];
				// # rawDuration is in 00:00:00.00 format. This converts it to seconds.
				$ar          = array_reverse(explode(":", $rawDuration));
				$duration    = floatval($ar[0]);
				
				
				if(!empty($ar[1]))
						$duration += intval($ar[1]) * 60;
				if(!empty($ar[2]))
						$duration += intval($ar[2]) * 60 * 60;
				
				// # get the current time
				preg_match_all("/time=(.*?) bitrate/", $content, $matches);
				
				$matches = array_reverse($matches);
				$last    = array_pop($matches);
				// # this is needed if there is more than one match
				if(is_array($last)) {
						$last = array_pop($last);
				}
				$last = str_replace(array(
						" bitrate",
						"time="
				), '', $last);
				$last = array_reverse(explode(":", $last));
				
				$last_duration = floatval($last[0]);
				
				if(!empty($last[1]))
						$last_duration += intval($last[1]) * 60;
				if(!empty($last[2]))
						$last_duration += intval($last[2]) * 60 * 60;
				return percentage($last_duration, $duration, 1);
		}
} //class