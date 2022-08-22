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
    <label><?php echo ossn_print('event:title');?></label>
    <input type="text" name="title" value="<?php echo $params['event']->title;?>" />
</div>
<div>
    <label><?php echo ossn_print('event:description');?></label>
    <textarea name="info"><?php echo ossn_restore_new_lines($params['event']->description);?></textarea>
</div>
<div class="time-picker-start">
    <label><?php echo ossn_print('event:start:time');?></label>
    <input type="text" data-format="HH:mm PP" name="start_time" class="add-on" value="<?php echo $params['event']->start_time;?>"/>
</div>
<div class="time-picker-end">
    <label><?php echo ossn_print('event:end:time');?></label>
    <input type="text" data-format="HH:mm PP" name="end_time" class="add-on" value="<?php echo $params['event']->end_time;?>" />
</div>

<div>
    <label><?php echo ossn_print('event:country');?></label>
   <?php echo ossn_plugin_view('input/dropdown', array(
			'name' => 'country',
			'options' => event_country_list(),
			'value' => $params['event']->country,
	));
   ?>
</div>
<div>
    <label><?php echo ossn_print('event:location');?></label>
    <input type="text" name="location" id="event-location-input" value="<?php echo $params['event']->location;?>" />
</div>
<div>
    <label><?php echo ossn_print('event:date');?></label>
    <div id="datetimepicker4" class="input-append">
        <input data-format="MM/dd/yyyy" class="add-on" name="date" type="text" value="<?php echo $params['event']->date;?>">
    </div>
</div>

<div>
    <label><?php echo ossn_print('event:price:any');?></label>
    <input type="text" name="event_cost" value="<?php echo $params['event']->event_cost;?>" />
</div>
<div>
	<label><?php echo ossn_print('event:allow:comments');?></label>
    <?php
		echo ossn_plugin_view('input/dropdown', array(
					'name' => 'allowed_comments',
					'options' => ossn_events_comments_allowed(),
					'value' => $params['event']->allowed_comments_likes,
		));
	?>
</div>

<div>
    <label><?php echo ossn_print('event:image');?></label>
    <input type="file" name="picture" />
</div>
<div>
	<input type="hidden" name="guid" value="<?php echo $params['event']->guid;?>" />
    <input type="submit" value="<?php echo ossn_print('save');?>" class="btn btn-success" />
</div>
<script type="text/javascript">
    $(function() {
        $('#datetimepicker4').datetimepicker({
            pickTime: false
        });
        $('.time-picker-start').datetimepicker({
            pickDate: false,
            pick12HourFormat: true,
            pickSeconds: false,
        });
        $('.time-picker-end').datetimepicker({
            pickDate: false,
            pick12HourFormat: true,
            pickSeconds: false,
        });
    });
</script>