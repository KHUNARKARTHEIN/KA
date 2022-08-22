<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 ?>
<div class="row bpage-bottom">
	<div class="col-md-8">
		<?php
		   if(ossn_isLoggedin()){
				if($params['page']->owner_guid == ossn_loggedin_user()->guid || ossn_loggedin_user()->canModerate()){
					echo '<div class="ossn-wall-container">';
					echo ossn_view_form('bpage/wall/container', array(
							'action' => ossn_site_url() . 'action/wall/post/bpage',
							'params' => $params,
							'id' => 'ossn-wall-form',
					));
					echo '</div>';
				}
			}
			echo '<div class="user-activity">';
					$wall  = new OssnWall;
					$posts = $wall->GetPostByOwner($params['page']->guid, 'businesspage');
					$count = $wall->GetPostByOwner($params['page']->guid, 'businesspage', true);
			if($posts) {
				foreach($posts as $post) {
					$vars = ossn_wallpost_to_item($post);
					if(!empty($vars) && is_array($vars)){ 
						echo ossn_wall_view_template($vars);
					}
				}
				echo ossn_view_pagination($count);
			}
			echo "</div>";
			?>
	</div>
	<div class="col-md-4">
		<div class="business-page-right-bottom">
			<?php echo ossn_plugin_view( 'ads/page/view_small'); ?>
		</div>
	</div>
</div>