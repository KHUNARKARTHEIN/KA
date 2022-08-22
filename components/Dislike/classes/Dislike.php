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
class Dislike extends OssnLikes {
    /**
     * Dislike item
     *
     * @params integer $subject_id Id of item which users liked
     * @params integer $guid Guid of user
	 * @params string  $type Subject type
     *
     * @return boolean
     */
    public function SetDislike($subject_id = '', $guid = '', $type = '') {
       	return parent::Like($subject_id, $guid, "dislike:{$type}");
    }
    /**
     * Dislike item
     *
     * @params integer $subject_id Id of item which users liked
     * @params integer $guid Guid of user
	 * @params string  $type Subject type
     *
     * @return boolean
     */
    public function UnDislike($subject_id = '', $guid = '', $type = '') {
       	return parent::UnLike($subject_id, $guid, "dislike:{$type}");
    }	
    /**
     * Check if user disliked item or not
     *
     * @params integer $subject_id Id of item which users liked
     * @params integer $guid Guid of user
	 * @params string  $type Subject type
     *
     * @return boolean
     */
    public function isDisliked($subject_id = '', $guid = '', $type = 'post') {
       return parent::isLiked($subject_id, $guid, "dislike:{$type}");
    }	
    /**
     * Get dislikes
     *
     * @params integer $subject_id Id of item which users liked
	 * @params string  $type Subject type
     *
     * @return object
     */
    public function GetDislikes($subject_id = '', $type = 'post') {
			return parent::GetLikes($subject_id, "dislike:{$type}");
    }
    /**
     * Count dislikes
     *
     * @params integer $subject_id Id of item which users liked
	 * @params string  $type Subject type
     *
     * @return integer;
     */
    public function CountDisLikes($subject_id = '', $type = 'post') {
         return parent::CountLikes($subject_id, "dislike:{$type}");
    }	
    /**
     * Delte subject likes
     *
     * @params integer $subject_id Id of item which users liked
	 * @params string  $type Subject type
     *
     * @return bool;
     */
	  public function deleteDislikes($subject_id = '', $type = 'post') {
		 return parent::deleteLikes($subject_id, "dislike:{$type}"); 
	  }
}//class
