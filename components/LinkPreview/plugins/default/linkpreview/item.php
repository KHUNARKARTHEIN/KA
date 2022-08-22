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
if(empty($params['post']->linkPreview) || !isset($params['post']->linkPreview)){
		return;
}
$item = ossn_get_object($params['post']->linkPreview);
$json = json_encode(array(
			'contents' => ossn_plugin_view('linkpreview/item_inner', array(
					'item' => $item,
					'guid' => $params['post']->guid,
			)),						  
));
?>
<script>
		$(document).ready(function(){
					var $code = <?php echo $json;?>;
					$('#activity-item-<?php echo $params['post']->guid;?>').find('.post-contents').append($code['contents']);
		});
</script>