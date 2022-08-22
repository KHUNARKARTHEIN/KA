<?php
$guid = input('guid');
$object = get_business_page($guid);
if(!$object){
		echo 0;
		exit();
}
$cover = new \Ossn\Component\BusinessPage\Photo;
if($cover->addPhoto($guid)){
		echo 1;
} else {
		echo 0;	
}