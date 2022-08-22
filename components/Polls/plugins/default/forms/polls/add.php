<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   SOFTLAB24 LIMITED, COMMERCIAL LICENSE  https://www.softlab24.com/license/commercial-license-v1
 * @link      https://www.softlab24.com/
 */
 ?>
<div>
	<label><?php echo ossn_print('polls:title');?></label>
    <input type="text" name="title" />
</div>
<div class="polls-form-options">
	<label><?php echo ossn_print('polls:options');?> <a id="polls-add-option" class="label label-primary"><?php echo ossn_print('polls:add:option');?></a></label>
    <div class="margin-top-10">
	    <input type="text" name="poll_options_1" placeholder="<?php echo ossn_print("polls:option:title");?>" />
     </div>   
</div>
<?php if($params['container_type'] !== 'user'){ ?>
<div>
	<label><?php echo ossn_print('polls:group');?></label>
    <input type="text" value="<?php echo $params['group']->title;?>" disabled="disabled" readonly="readonly"/>
<?php } ?>
<div>
	<input type="hidden" name="container_type" value="<?php echo $params['container_type'];?>" />
	<input type="hidden" name="container_guid" value="<?php echo $params['container_guid'];?>" />
    <input type="hidden" name="counter" value="1" id="polls-form-counter"/>
	<input type="submit" value="<?php echo ossn_print("polls:publish");?>" class="btn btn-success" />
</div>
