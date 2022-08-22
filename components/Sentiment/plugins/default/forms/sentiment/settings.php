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
  $component = new OssnComponents;
  $settings  = $component->getSettings('Sentiment');
 ?>
 <div>
 	<label><?php echo ossn_print('sentiment:apikey');?></label>
    <?php 
		echo ossn_plugin_view('input/text', array(
				'name' => 'apikey',
				'value' => $settings->apikey,
		));
	?>		
 </div>
 <div>
 	<label><?php echo ossn_print('sentiment:email');?></label>
    <?php 
		echo ossn_plugin_view('input/text', array(
				'name' => 'email',
				'value' => $settings->email,
		));
	?>		
 </div> 
 <div>
 	<label><?php echo ossn_print('sentiment:username');?></label>
    <?php 
		echo ossn_plugin_view('input/text', array(
				'name' => 'website',
				'value' => $settings->website,
		));
	?>		
 </div> 
 <div>
 	<label><?php echo ossn_print('sentiment:whocansee');?></label>
    <?php 
		echo ossn_plugin_view('input/dropdown', array(
				'name' => 'whocansee',
				'value' => $settings->whocansee,
				'options' => array(
							'admin' => ossn_print('sentiment:admin'),
							'all' => ossn_print('sentiment:all'),				   
				),
		));
	?>		
 </div>
 <div class="margin-top-10">
 	<input type="submit" class="btn btn-success" value="<?php echo ossn_print('save');?>" />
 </div>