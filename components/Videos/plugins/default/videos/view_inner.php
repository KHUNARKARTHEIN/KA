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
 $entity = ossn_get_entities(array(
		'type' => 'object',
		'owner_guid' => $video->guid,
		'subtype' => 'file:video',
  ));
 ?>
<video class="ossn-video-player" poster="<?php echo $video->getCoverURL();?>" controls="controls" preload="none">
	<source type="video/mp4" src="<?php echo $video->getFileURL();?>" />
	<object width="640" height="360" type="application/x-shockwave-flash" data="<?php echo ossn_site_url();?>components/Videos/vendors/player/flashmediaelement.swf"> 		
		<param name="movie" value="<?php echo ossn_site_url();?>components/Videos/vendors/player/flashmediaelement.swf" /> 
		<param name="flashvars" value="controls=true&poster=<?php echo $video->getCoverURL();?>&file=<?php echo $video->getFileURL();?>" /> 		
		<img src="<?php echo $video->getCoverURL();?>" width="640" height="360" />
	</object> 	
</video> 
<div class="ossn-video-description">
	<p><?php echo $video->description;?> <span class="time-created"><?php echo ossn_user_friendly_time($video->time_created); ?></span></p>
</div>
<?php
	$vars['entity'] = $entity[0];
	$vars['full_view'] = true;
	echo ossn_plugin_view('entity/comment/like/share/view', $vars);
?>
<?php 
$user = ossn_loggedin_user();
if(ossn_isLoggedin()){
	if($user->guid == $video->owner_guid || $user->canModerate()){ ?>
<div class="ossn-video-controls"> 
	<a href="<?php echo $video->getDeleteURL();?>" class="btn btn-danger"><?php echo ossn_print('video:com:delete');?></a>
	<a href="<?php echo $video->getEditURL();?>" class="btn btn-success"><?php echo ossn_print('video:com:edit');?></a>
</div>
<?php
	}
}