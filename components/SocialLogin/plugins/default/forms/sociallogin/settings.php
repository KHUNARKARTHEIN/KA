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
 $settings  = $component->getSettings('SocialLogin'); 
?>

<fieldset class="fieldset">
	<legend><?php echo ossn_print('social:login:facebook');?></legend>
    <label><?php echo ossn_print('social:login:app:key');?></label>
    <input type="text" name="fb_consumer_key" value="<?php echo $settings->fb_consumer_key;?>" />
    <label><?php echo ossn_print('social:login:app:secret');?></label>
    <input type="text" name="fb_consumer_secret"  value="<?php echo $settings->fb_consumer_secret;?>" />
    <label><?php echo ossn_print('social:login:facebook:url');?></label>
    <input type="text" readonly value="<?php echo ossn_site_url('social_login/facebook');?>" />
    <input type="submit" value="<?php echo ossn_print('save');?>" class="btn btn-success"/>
</fieldset>

<fieldset class="fieldset">
	<legend><?php echo ossn_print('social:login:twitter');?></legend>
    <label><?php echo ossn_print('social:login:consumer:key');?></label>
    <input type="text" name="tw_consumer_key" value="<?php echo $settings->tw_consumer_key;?>" />
    <label><?php echo ossn_print('social:login:constumer:secret');?></label>
    <input type="text" name="tw_consumer_secret"  value="<?php echo $settings->tw_consumer_secret;?>" />
    <label><?php echo ossn_print('social:login:twitter:callback');?></label>
    <input type="text" readonly value="<?php echo ossn_site_url('social_login/twitter');?>" />
    <input type="submit" value="<?php echo ossn_print('save');?>" class="btn btn-success"/>
</fieldset>