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
class Sentiment {
		/**
		 * Analyze a text
		 * 
		 * @param string $text A text
		 * 
		 * @return array
		 */
		public static function analyze($text = '') {
				if(!empty($text)) {
						$component = new OssnComponents;
						$settings  = $component->getSettings('Sentiment');
						$api       = new SOFTLAB24_API(array(
								'method' => 'sentiment',
								'email' => $settings->email,
								'website' => $settings->website,
								'apikey' => $settings->apikey,
								'text' => $text
						));
						$data      = $api->sentiment;
						if(!empty($data)) {
								return json_decode($data, true);
						}
				}
		}
		/**
		 * Get type of text (neutral, positive, negatice)
		 * 
		 * @param array $data A API data
		 * 
		 * @return astring
		 */
		public static function getType(array $data = array()) {
				if(!empty($data)) {
						if(isset($data['data']) && !empty($data['data']['positive']) && !empty($data['data']['negative'])) {
								if($data['data']['positive'] > $data['data']['negative']) {
										return 'positive';
								} elseif($data['data']['negative'] > $data['data']['positive']) {
										return 'negative';
								} elseif($data['data']['postivie'] == $data['data']['negative']) {
										return 'neutral';
								} else {
										return 'neutral';
								}
						}
				}
		}
}