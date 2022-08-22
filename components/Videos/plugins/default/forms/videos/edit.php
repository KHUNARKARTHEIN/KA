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
    <input type="text" name="title" value="<?php echo $params['video']->title;?>" />
 </div>
  <div>
 	<label><?php echo ossn_print('video:com:description');?></label>
    <textarea name="description"><?php echo $params['video']->description;?></textarea>
 </div>
 <div>
 	<input type="hidden" name="guid" value="<?php echo $params['video']->guid;?>" />
 	<input type="submit" class="btn btn-success" value="<?php echo ossn_print('video:com:save');?>" />
 </div>