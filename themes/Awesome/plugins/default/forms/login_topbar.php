<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<input type="text" name="username" class="form-control" placeholder="<?php echo ossn_print('username'); ?>" />
<input type="password" name="password" class="form-control" placeholder="<?php echo ossn_print('password'); ?>" />
<input type="submit" value="Login" class="btn <?php echo oa_theme_get_settings('btnoutline');?>" />    
<a class="reset-login-topbar hidden" href="<?php echo ossn_site_url('resetlogin'); ?>"><?php echo ossn_print('reset:password'); ?></a>
