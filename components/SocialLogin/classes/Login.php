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
class Login {
		/**
		 * aouth initilize
		 * 
		 * @return object
		 */
		public function aouth() {
				return social_login_cred();
		}
		/**
		 * Initilize Facebook
		 * 
		 * @return object
		 */
		public function initFb() {
				$oauth = $this->aouth()->facebook;
				require_once(SOCIAL_LOGIN . 'vendors/Facebook/autoload.php');
				$fb = new Facebook\Facebook(array(
						'app_id' => $oauth->consumer_key,
						'app_secret' => $oauth->consumer_secret,
						'default_graph_version' => 'v2.5'
				));
				return $fb;
		}
		/**
		 * Get a facebook login URL
		 * 
		 * @return string
		 */
		public function fbURL() {
				$helper = $this->initFb()->getRedirectLoginHelper();
				$url    = $helper->getLoginUrl(ossn_site_url("social_login/facebook"), array(
						'email'
				));
				return $url;
		}
		/**
		 * Get a facebook login URL
		 * 
		 * @return string
		 */
		public function twitterURL() {
				require_once(SOCIAL_LOGIN . 'vendors/Twitter/autoload.php');
				$config = $this->aouth();
				if(isset($config->twitter->consumer_key) && isset($config->twitter->consumer_secret) && !empty($config->twitter->consumer_key) && !empty($config->twitter->consumer_secret)) {
						$connection                                          = new \Abraham\TwitterOAuth\TwitterOAuth($config->twitter->consumer_key, $config->twitter->consumer_secret);
						$request_token                                       = $connection->oauth('oauth/request_token', array(
								'oauth_callback' => ossn_site_url('social_login/twitter')
						));
						$_SESSION['social:login:twitter:oauth_token']        = $request_token['oauth_token'];
						$_SESSION['social:login:twitter:oauth_token_secret'] = $request_token['oauth_token_secret'];
						$url                                                 = $connection->url('oauth/authorize', array(
								'oauth_token' => $request_token['oauth_token']
						));
						if(!empty($url)){
								return $url;	
						}
				}
				return false;
		}
}