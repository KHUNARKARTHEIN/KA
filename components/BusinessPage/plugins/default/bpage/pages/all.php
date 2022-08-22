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
$page = new \Ossn\Component\BusinessPage\Page;
$list = $page->getPages();
$count = $page->getPages(array(
		'count' => true,							  
));
?>
<div class="business-page ossn-page-contents">
	<?php
	if($list){
			foreach($list as $item){ ?>
			    <div class="row list-item">
    					<div class="col-md-3">
                        	<img src="<?php echo $item->photoURL();?>" />
                        </div>
                        <div class="col-md-9">
                        	<a href="<?php echo ossn_site_url("page/view/{$item->guid}");?>"><?php echo $item->title;?></a>
                            <p><?php echo $item->description;?></p>
                        </div>
   				 </div>
     <?php	
			}
			echo ossn_view_pagination($count);
	}
	?>
</div>