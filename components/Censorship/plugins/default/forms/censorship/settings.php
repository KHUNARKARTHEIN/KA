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
 $settings  = $component->getSettings('Censorship'); 
 ?>
 <div>
 	<label><?php echo ossn_print('censorship:add:words');?></label>
    <p><?php echo ossn_print('censorship:add:words:note');?></p>
    <?php 
		echo ossn_plugin_view('input/text', array(
				'name' => 'words',
				'value' => $settings->words,
		));
	?>		
 </div>
 <div>
 	<label><?php echo ossn_print('censorship:replace:string');?></label>
    <?php 
		echo ossn_plugin_view('input/text', array(
				'name' => 'string',
				'value' => $settings->stringval,
		));
	?>		
 </div> 
 <div class="margin-top-10">
 	<input type="submit" class="btn btn-success" value="<?php echo ossn_print('save');?>" />
 </div>