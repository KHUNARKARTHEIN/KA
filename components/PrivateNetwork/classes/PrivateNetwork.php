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
class PrivateNetwork {
		private function allowed_Pages($part) {
				$pages = array(
						// *1* OSSN allowed core pages
						// only first part of url will be checked
						array(
							'css',
							'js',
							'action',
							'administrator',
							'uservalidate',
							'resetlogin',
							'index',
							'login',
							'avatar',
							'userverified',
							'two_factor_login',
							'captcha',
						),
						// *2* be more specific: 'part1/part2' of url must match
						// make sure part1 is not listed in the array above!
						// in this example the footer links 'About' and 'Terms' are shown, while 'Privacy' needs logging in
						array(
							'site/about',
							'site/terms',
							//'u/botox',					// allow this member's profile page
						),
						// *3* be even more specific: 'part1/part2/part3' of url must match
						// make sure part1 and part 2 are not listed in the arrays above!
						array(
							// 'p/437/private-page',  	// existing but unreachable custom page
							//'p/438/public',				// this custom page will be shown
							//'post/view/432',			// one special post I want to share
							//
							// here is an experiment with specific albums and photos
							// but things are getting really tricky here
							// because unfortunately there's no straight logic in Ossn links
							//
							// with 'u/botox' above I do reach /u/botox/photos
							// but her profile album isn't 'u/botox/photos/album/profile-photos
							// but 'album/profile/2', so I would also need to add it here
							//'album/profile/2',
							// then it would need a
							//'album/getphoto/2',
						),
						// *4* add more pages to allow with url like 'part1/part2/part3/part4'
						array(
							// and finally a
						//	'photos/user/view/18',
							// theoretically working, but who would like to mess around with stuff like that?! :)
						),
						// *5* add more pages to allow with url like 'part1/part2/part3/part4/part5'
						array(
						)
				);
				return $pages[$part];
		}

		/**
		 * Deny for visiting page
		 *
		 * @param null
		 * 
		 * @return void
		 */
		private function deney() {
				ossn_trigger_message(ossn_print("private:network:deney"), 'error');
				redirect();
		}
		
		/**
		 * Start the PrivateNetwork Process
		 *
		 * @param null
		 * 
		 * @return array
		 */
		public function start($params) { 
				if($params && !empty($params['handler'])) {
						for($i = count($params['page']); $i >= 0; $i--) {
							// assemble handler and pages array to url like h/p0/p1/....
							$url = $params['handler'] . '/' . implode("/", $params['page']);
							if(in_array($params['handler'], $this->allowed_Pages(0)) || in_array($url, $this->allowed_Pages($i))) {
								// to keep things fast, ignore complete url first, and check if handler is already matching (old logic)
								// if not, try to find complete url in corresponding array
								// yes, matching entry found!
								return;
							}
							// no, drop rightmost part of url and continue
							// this way we can keep the old 'wildcard' logic with any number of url elements
							array_pop($params['page']);
						}
						$this->deney();
				}
		}
}