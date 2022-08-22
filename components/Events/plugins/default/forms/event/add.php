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
    <input type="text" name="title" required/>
</div>
<div>
    <label><?php echo ossn_print('event:description');?></label>
    <textarea name="info" required></textarea>
</div>
<div class="time-picker-start">
    <label><?php echo ossn_print('event:start:time');?></label>
    <input type="text" data-format="HH:mm PP" name="start_time" class="add-on" required />
</div>
<div class="time-picker-end">
    <label><?php echo ossn_print('event:end:time');?></label>
    <input type="text" data-format="HH:mm PP" name="end_time" class="add-on" required />
</div>
<div>
    <label><?php echo ossn_print('event:location');?></label>
    <input type="text" name="location" id="event-location-input" required/>
</div>
<div>
    <label><?php echo ossn_print('event:date');?></label>
    <div id="datetimepicker4" class="input-append">
        <input data-format="MM/dd/yyyy" class="add-on" name="date" type="text" required>
    </div>
</div>

<div>
    <label><?php echo ossn_print('event:price:any');?></label>
    <input type="text" name="event_cost" />
</div>
<div>
	<label><?php echo ossn_print('event:allow:comments');?></label>
    <?php
		echo ossn_plugin_view('input/dropdown', array(
					'name' => 'allowed_comments',
					'options' => ossn_events_comments_allowed(),
		));
	?>
</div>
<div>
    <label><?php echo ossn_print('event:image');?></label>
    <input type="file" name="picture" required />
</div>
<div>
    <input type="submit" value="Save" class="btn btn-success" />
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