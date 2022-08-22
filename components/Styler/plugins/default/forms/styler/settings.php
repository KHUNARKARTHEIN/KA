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
  $settings  = $component->getSettings('Styler');
		
  $vals = styler_colors();
  foreach($vals as $color){
	 $img = "<img src='".ossn_site_url("components/Styler/images/{$color}.jpg")."' />";
	 $options[$color] = $img.' '.ossn_print("styler:{$color}"); 
  }
 ?>
 <div>
 	<label><?php echo ossn_print('styler:select:color');?></label>
    <?php 
		echo ossn_plugin_view('input/radio', array(
				'name' => 'styler',
				'value' => $settings->styler,
				'options' => $options,
		));
	?>		
 </div>
 <div class="margin-top-10">
 	<input type="submit" class="btn btn-success" value="<?php echo ossn_print('save');?>" />
 </div>