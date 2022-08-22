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
 ?>
 <div>
 	<label><?php echo ossn_print('video:com:title');?></label>
    <input type="text" name="title" id="video_title" />
 </div>
  <div>
 	<label><?php echo ossn_print('video:com:description');?></label>
    <textarea name="description" id="video_description"></textarea>
 </div>
  <div>
 	<label><?php echo ossn_print('video:com:file');?> (<?php echo ossn_video_max_size();?> MB)  Allowed formats (.3gp, .mov, .avi, .wmv, .mp4)</label>
    <input type="file" name="video" id="video_file" />
 </div> 
<?php if($params['container_type'] == 'group'){ ?>
<div>
	<label><?php echo ossn_print('video:group');?></label>
    <input type="text" value="<?php echo $params['group']->title;?>" disabled="disabled" readonly="readonly"/>
<?php } ?>
<div> 
 <div class="video-submit">
 	<input type="hidden" name="vtk" value="<?php echo md5(time().rand());?>" />
	<input type="hidden" name="container_type" value="<?php echo $params['container_type'];?>" id="container_type" />
	<input type="hidden" name="container_guid" value="<?php echo $params['container_guid'];?>" id="container_guid" />
 	<input type="submit" class="btn btn-success" value="<?php echo ossn_print('video:com:save');?>" />
 </div>
<div class="video-upload margin-top-20">
	<label><?php echo ossn_print("video:com:uploading"); ?></label>
	<div class="progress">
    	<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
        	<span>0%</span>
    	</div>
	</div> 
</div>
<div class="conversion">
	<label><?php echo ossn_print("video:com:converting"); ?></label>
	<div class="progress">
    	<div class="progress-bar progress-bar-conversion" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
        	<span>0%</span>
    	</div>
	</div>
</div>