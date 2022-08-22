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
class Photo extends \OssnFile {
		/**
		 * Add a photo for page
		 * 
		 * @param integer $guid A page guid
		 * 
		 * @return boolean
		 */			
		public function addPhoto($guid) {
				if(empty($guid)) {
						return false;
				}
				$this->owner_guid = $guid;
				$this->type       = 'object';
				$this->subtype    = 'page:photo';
				$this->setFile('photo');
				$this->setPath('page/photo/');
				$this->setExtension(array(
						'jpg',
						'png',
						'jpeg',
						'gif'
				));
				if($file_guid = $this->addFile()) {
						$page = ossn_get_object($guid);
						if($page) {
								$page->data->photo_entity_guid = $file_guid;
								$page->save();
						}
						$this->deleteOld($guid, $file_guid);
						return true;
				}
				return false;
		}
		/**
		 * Delete old photos for page
		 * 
		 * @param integer $guid A page guid
		 * 
		 * @return boolean
		 */				
		public function deleteOld($guid, $pic_guid) {
				if(empty($guid)) {
						return false;
				}
				$pics = $this->searchEntities(array(
						'type' => 'object',
						'subtype' => 'file:page:photo',
						'owner_guid' => $guid
				));
				if($pics) {
						foreach($pics as $pic) {
								if($pic->guid == $pic_guid) {
										continue;
								}
								$dir = ossn_get_userdata("object/{$guid}/");
								if($pic->deleteEntity($pic->guid)) {
										unlink($dir . $pic->value);
								}
						}
				}
		}
}