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
class Cover extends \OssnFile {
		/**
		 * Add a cover for page
		 * 
		 * @param integer $guid A page guid
		 * 
		 * @return boolean
		 */
		public function addCover($guid) {
				if(empty($guid)) {
						return false;
				}
				$this->owner_guid = $guid;
				$this->type       = 'object';
				$this->subtype    = 'page:cover';
				$this->setFile('coverphoto');
				$this->setPath('page/cover/');
				$this->setExtension(array(
						'jpg',
						'png',
						'jpeg',
						'gif'
				));
				if($file_guid = $this->addFile()) {
						$page = ossn_get_object($guid);
						if($page) {
								$page->data->cover_entity_guid = $file_guid;
								$page->data->cover_top         = false;
								$page->data->cover_left        = false;
								$page->save();
						}
						$this->deleteOld($guid, $file_guid);
						return true;
				}
				return false;
		}
		/**
		 * Delete old covers for page
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
						'subtype' => 'file:page:cover',
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