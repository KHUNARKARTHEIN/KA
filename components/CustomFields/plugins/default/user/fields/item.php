<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
echo "<div class='custom-field-items'>";
if(isset($params['items'])) {
		foreach($params['items'] as $fields) {
					foreach($fields as $type => $items){
							foreach($items as $itema){
									$itema['__field_type'] = $type;
									$list[] = $itema;	
							}
					}
		}
		foreach($list as $item){
						$type = $item['__field_type'];
						$guid = $item['data-guid'];
						unset($item['__field_type']);
						unset($item['data-guid']);
						switch($type){
									case 'text':
								if(!isset($item['params'])){
									$item['params'] = array();
								}
								$args                = array();
								$args['name']        = $item['name'];
								$args['value']		 = $item['value'];
								$args['label']       = $item['label'];
								$args['placeholder'] = (empty($item['placeholder'])) ? ossn_print($item['name']) : $item['placeholder'];
								if(isset($item['class'])){
										$args['class']  = 'form-control '.$item['class'];	
								} else {
										$args['class']  = 'form-control ';											
								}	
								$vars                = array_merge($args, $item['params']);
								echo '<div class="row customfield-item" data-guid="'.$guid.'"><div class="col-md-12">';
								echo "<div class='text'>";
								if($args['label'] === true){
									echo "<label>".$args['placeholder'] ."</label>";
								}
								echo ossn_plugin_view('input/text', $vars);
								echo "</div></div></div>";
							break;
							case 'textarea':
								if(!isset($item['params'])){
									$item['params'] = array();
								}
								$args                = array();
								$args['name']        = $item['name'];
								$args['value']		 = $item['value'];
								$args['label']       = $item['label'];
								$args['placeholder'] = (empty($item['placeholder']))? ossn_print($item['name']) : $item['placeholder'];
								if(isset($item['class'])){
										$args['class']  = 'form-control '.$item['class'];	
								} else {
										$args['class']  = 'form-control ';											
								}	
								$vars                = array_merge($args, $item['params']);
								echo '<div class="row customfield-item" data-guid="'.$guid.'"><div class="col-md-12">';
								echo "<div class='text'>";
								if($args['label'] === true){
									echo "<label>".$args['placeholder']."</label>";
								}
								echo ossn_plugin_view('input/textarea', $vars);
								echo "</div></div></div>";
							break;
							case 'dropdown':
								$vars         = array();
								$vars['name'] = $item['name'];
								$args         = array_merge($vars, $item);
								echo '<div class="row customfield-item" data-guid="'.$guid.'"><div class="col-md-12">';
								echo "<div class='dropdown-block'>";
								if($args['label'] === true){
									echo "<label>".$args['placeholder']."</label>";
								}								
								echo ossn_plugin_view('input/dropdown', $args);
								echo "</div></div></div>";
							break;
							case 'radio':
								$vars         = array();
								$vars['name'] = $item['name'];								
								$args         = array_merge($vars, $item);
								echo '<div class="row customfield-item" data-guid="'.$guid.'"><div class="col-md-12">';
								echo "<div class='radio-block'>";
								if($args['label'] === true){
									echo "<label>".$args['placeholder']."</label>";
								}								
								echo ossn_plugin_view('input/radio', $args);
								echo "</div></div></div>";
							break;
				}
			
		}
}
echo "</div>";
