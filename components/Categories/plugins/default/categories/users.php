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
$users         = new OssnUser;
$data          = $users->searchUsers(array(
		'entities_pairs' => array(
				array(
						'name' => 'category',
						'value' => Categories::prepare($params['object']->title)
				)
		)
));
$count         = $users->searchUsers(array(
		'entities_pairs' => array(
				array(
						'name' => 'category',
						'value' => Categories::prepare($params['object']->title)
				)
		),
		'count' => true
		
));
$user['users'] = $data;
?>
<div class="row ossn-page-contents categories">
    <h3><?php echo $params['object']->title;?></h3>
    <p><?php echo $params['object']->description;?></p>
 	<?php
		echo ossn_plugin_view('output/users', $user);
		echo ossn_view_pagination($count);
		if(empty($data)) {
				echo ossn_print('ossn:search:no:result');
		}
	?>   
</div>