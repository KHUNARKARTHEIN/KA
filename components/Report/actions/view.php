<?php
$guid   = input('guid');
$object = ossn_get_object($guid);

switch($object->container_type){
	case 'post':
		$url = "post/view/{$object->container_guid}";
	break;
	case 'comment':
		$annotation = ossn_get_annotation($object->container_guid);
		switch($annotation->type){
			case 'comments:post':
				$url = "post/view/{$annotation->subject_guid}#comments-item-{$annotation->id}";
			break;
		}
	break;
}

$object->data->is_read = true;
$object->save();

redirect($url);