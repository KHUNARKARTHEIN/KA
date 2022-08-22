<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   SOFTLAB24 COMMERICAL ITEMS LICENSE v1  https://www.softlab24.com/license/
 * @link      https://www.softlab24.com/
 */
 class Report extends OssnObject {
		public function addReport($guid = '', $reason = '', $type = ''){
				if(empty($guid) || empty($type)){
					return false;	
				}
				$this->title 		= "";
				$this->type  		= 'site';
				$this->subtype 		= 'report';
				$this->owner_guid  	= 1;
				$this->description = $reason;
				
				$this->data->container_guid = $guid;
				$this->data->container_type = $type;
				$this->data->reported_by 	= ossn_loggedin_user()->guid;
				return $this->addObject();
		}
		public function getAll(array $params = array()) {
				$default             = array();
				$default['type']     = 'site';
				$default['subtype']  = 'report';
				$default['order_by'] = 'o.guid DESC';
				
				$vars = array_merge($default, $params);
				return $this->searchObject($vars);
		}
 }