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
  $settings  = $component->getSettings('SiteOffline');
 ?>
 <div>
 	<label><?php echo ossn_print('styler:select:color');?></label>
    <?php 
		echo ossn_plugin_view('input/radio', array(
				'name' => 'offline',
				'value' => $settings->offline,
				'options' => array(
							'online' => ossn_print('siteoffline:online'),
							'offline' => ossn_print('siteoffline:offline'),				   
				),
		));
	?>		
 </div>
 <div class="margin-top-10">
 	<input type="submit" class="btn btn-success" value="<?php echo ossn_print('save');?>" />
 </div>