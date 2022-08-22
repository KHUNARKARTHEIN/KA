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
  $title = input('title');
  $description = input('description');
  
  $category = new Categories;
  $search = $category->searchObject(array(
					'type' => 'site',
					'subtype' => 'user:category',
					'wheres' => "o.title = '{$title}'",
			));
  if($search){
	  ossn_trigger_message(ossn_print('categories:categry:exists'), 'error');
	  redirect(REF);	  	  
  }
  if(!ctype_alpha($title)){
	  ossn_trigger_message(ossn_print('categories:alphabets:only'), 'error');
	  redirect(REF);	  
  }
  if($category->addCategory($title, $description)){
	  ossn_trigger_message(ossn_print('categories:categry:added'));
	  redirect("administrator/component/Categories");
  } else {
	  ossn_trigger_message(ossn_print('categories:categry:add:failed'), 'error');
	  redirect(REF);	  
  }