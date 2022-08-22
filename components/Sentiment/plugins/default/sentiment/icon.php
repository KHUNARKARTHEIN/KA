<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
 $component = new OssnComponents;
 $settings  = $component->getSettings('Sentiment'); 
 
 if(isset($settings->whocansee) && $settings->whocansee == 'admin'){
	 	if(!ossn_isAdminLoggedin()){
			return;
		}
 }
 if(isset($params['sentiment']) && !empty($params['sentiment'])){
		if($params['sentiment'] == 'positive'){
			$title = ossn_print('sentiment:positive');
			echo "<span class='sentiment {$params['class']}' title='{$title}'>{$params['text']} <i class='fa fa-circle sentiment-positive'></i> {$params['text_after']}</span>";
		}
		if($params['sentiment'] == 'neutral'){
			$title = ossn_print('sentiment:neutral');			
			echo "<span class='sentiment {$params['class']}' title='{$title}'>{$params['text']} <i class='fa fa-circle sentiment-neutral'></i> {$params['text_after']}</span>";
		}
		if($params['sentiment'] == 'negative'){
			$title = ossn_print('sentiment:negative');			
			echo "<span class='sentiment {$params['class']}' title='{$title}'>{$params['text']} <i class='fa fa-circle sentiment-negative'></i> {$params['text_after']}</span>";
		}		
 }