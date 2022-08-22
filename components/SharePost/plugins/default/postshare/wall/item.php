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
$object = ossn_get_object($params['post']->item_guid); 
if($object){
	$post = arrayObject((array)$object, 'OssnWall'); 
	$item = ossn_wallpost_to_item($post);
	$item = ossn_wall_view_template($item);
	$item = str_replace('activity-item-', 'activity-item-shared-', $item);
	$item = str_replace('ossn-wall-item-'.$params['post']->item_guid, 'ossn-wall-shared-item-'.$params['post']->item_guid, $item);
	$item = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $item);
	//remove comments initial
	$document = new DOMDocument('1.0', 'UTF-8');
	$document->loadHTML($item, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
	$DomXPath = new DomXPath($document);
	$commentlists = $DomXPath->query("//*[contains(@class, 'comments-likes')]");
	if($commentlists){
		foreach($commentlists as $Item){
				$Item->parentNode->removeChild($Item);	
		}
		$item = utf8_decode($document->saveHTML($document->documentElement));
	}	
}
ossn_trigger_callback('wall', 'load:item', $params);
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
                <div class="ossn-wall-item-type"><?php echo ossn_print('post:shared:title');?></div>
            <?php
            }?>
			</div>
			<div class="post-meta">
				<span class="time-created"><?php echo ossn_user_friendly_time($params['post']->time_created); ?></span>
			</div>
		</div>
       <div class="post-contents post-share-wall-item">
                <?php
					if($object){
						echo $item;
					} else {
						echo "<div class='post-share-unavailable'>".ossn_print('post:share:unavailable')."</div>";	
					}
				?>
    	</div>
		<div class="comments-likes">
			<div class="menu-likes-comments-share">
				<?php echo ossn_view_menu('postextra', 'wall/menus/postextra');?>
			</div>
         	<?php
      		  if (ossn_is_hook('post', 'likes')) {
          			  echo ossn_call_hook('post', 'likes', $params['post']);
        		}
      		  ?>           
			<div class="comments-list">
              <?php
          			  if (ossn_is_hook('post', 'comments')) {
                			echo ossn_call_hook('post', 'comments', $params['post']);
           			   }
            		?>            				
			</div>
		</div>
        
         
	</div>
</div>