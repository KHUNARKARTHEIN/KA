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

$video = ossn_get_video($params['post']->item_guid);
 $entity = ossn_get_entities(array(
		'type' => 'object',
		'owner_guid' => $video->guid,
		'subtype' => 'file:video',
  ));
 $videolink = ossn_plugin_view('output/url', array(
		'href' => $video->getURL(),
		'text' => $video->title,
  ));
?>
<div class="ossn-wall-item" id="activity-item-<?php echo $params['post']->guid; ?>">
	<div class="row">
		<div class="meta">
			<img class="user-img" src="<?php echo $params['user']->iconURL()->small; ?>" />
			<div class="post-menu">
				<div class="dropdown">
                 <?php
           			if (ossn_is_hook('wall', 'post:menu') && ossn_isLoggedIn()) {
                		$menu['post'] = $params['post'];
               			echo ossn_call_hook('wall', 'post:menu', $menu);
            			}
            		?>   
				</div>
			</div>
			<div class="user">
           <?php if ($params['user']->guid == $params['post']->owner_guid) { ?>
                <a class="owner-link" href="<?php echo $params['user']->profileURL(); ?>"> <?php echo $params['user']->fullname; ?> </a>
                <div class="ossn-wall-item-type"><?php echo ossn_print('video:com:wall:added', array($videolink));?></div>
            <?Php
            } else {

                $owner = ossn_user_by_guid($params['post']->owner_guid);
                ?>
                <a href="<?php echo $params['user']->profileURL(); ?>">
                    <?php echo $params['user']->fullname; ?>
                </a>
                <i class="fa fa-angle-right fa-lg"></i>
                <a href="<?php echo $owner->profileURL(); ?>"> <?php echo $owner->fullname; ?></a>
            <?php } ?>
			</div>
			<div class="post-meta">
				<span class="time-created"><?php echo ossn_user_friendly_time($params['post']->time_created); ?></span>
			</div>
		</div>

       <div class="post-contents">
                 <p>
						<video class="ossn-video-player" poster="<?php echo $video->getCoverURL();?>" controls="controls" preload="none">
							<source type="video/mp4" src="<?php echo $video->getFileURL();?>" />
								<object width="640" height="360" type="application/x-shockwave-flash" data="<?php echo ossn_site_url();?>components/Videos/vendors/player/flashmediaelement.swf"> 		
										<param name="movie" value="<?php echo ossn_site_url();?>components/Videos/vendors/player/flashmediaelement.swf" /> 
										<param name="flashvars" value="controls=true&poster=<?php echo $video->getCoverURL();?>&file=<?php echo $video->getFileURL();?>" /> 		
										<img src="<?php echo $video->getCoverURL();?>" width="640" height="360" />
								</object> 	
						</video> 
						<div class="ossn-video-description">
							<p><?php echo $video->description;?></p>
						</div>
                 </p>
    	</div>
	<?php
		$vars['entity'] = $entity[0];
		echo ossn_plugin_view('entity/comment/like/share/view', $vars);
	?>    
	</div>
</div>
