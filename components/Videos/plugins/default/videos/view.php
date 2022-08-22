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
 $video = $params['video'];
 ?>
 <div class="ossn-page-contents">
 	<?php 
		echo ossn_plugin_view('widget/view', array(
				'title' => $video->title, 
				'contents' => ossn_plugin_view('videos/view_inner', $params),
		));
	?>
 </div>