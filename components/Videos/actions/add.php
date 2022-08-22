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
set_time_limit(0);
session_write_close();	
 
$container_guid = input('container_guid');
$container_type = input('container_type'); 
 
$title = input('title');
$description = input('description');
 
$error_cnt = 0;
 
/* error simulation  if(($container_type == 'user' && $container_guid + 1 !== ossn_loggedin_user()->guid) || !in_array($container_type, videos_container_types())){ */
if(($container_type == 'user' && $container_guid != ossn_loggedin_user()->guid) || !in_array($container_type, videos_container_types())){
		$error_cnt++;
	 	ossn_trigger_message(ossn_print('video:com:upload:failed'), 'error');
		redirect(REF);
}
if($container_type == 'group' && function_exists('ossn_get_group_by_guid')){
		$group =  ossn_get_group_by_guid($conatiner_guid);
		if($group && !$group->isMember($group->guid, ossn_loggedin_user()->guid)){
				$error_cnt++;
	 			ossn_trigger_message(ossn_print('video:com:upload:failed'), 'error');
				redirect(REF);				
		}
} 

// as you'll see here, the XHR redirects won't really help here 
// so better rely on error count! 
//error_log('continue 39');

if(!$error_cnt) {
		$file = new OssnFile;
		$extension = $file->getFileExtension($_FILES['video']['name']);
		$tmp_path = $_FILES['video']['tmp_name'];
 
		$video = new Videos;
		$extensions = array('3gp', 'mov', 'avi', 'wmv', 'flv');
		if(in_array($extension, $extensions)){
				$hash = md5($_FILES['video']['tmp_name'] . time() . rand());
				$newfile_name = $hash . '.mp4';
				$dir = ossn_get_userdata("tmp/videos/");
				$newfile = $dir . $newfile_name;
				if(!is_dir($dir)){
						mkdir($dir, 0755, true); 
				}
	 	 
				$vtk = input('vtk');
				$progress_file = $dir . $vtk . '.progress.txt';
				/* error simulation if($video->convert($_FILES['video']['tmp_name']['arsalan'], $newfile, $progress_file)){ */
				if($video->convert($_FILES['video']['tmp_name'], $newfile, $progress_file)){
						$_FILES['video']['tmp_name'] = $newfile;
						$_FILES['video']['type'] = 'video/mp4';
						$_FILES['video']['name'] = $newfile_name;
						$_FILES['video']['size'] = filesize($newfile);
				} else {
						$error_cnt++;
						ossn_trigger_message(ossn_print('video:com:upload:conversion:failed'), 'error');
						redirect(REF);		 
				}
		}
} 
//error_log('continue 72');
if(!$error_cnt) {
		if($video->addVideo($title, $description,  $container_guid,  $container_type)){
				$guid = $video->getObjectId();
				$title = OssnTranslit::urlize($title);
				$url = "video/view/{$guid}/{$title}";
	 
				ossn_set_ajax_data(array(
						'url' => $url
				));	 
	 
				if(isset($newfile)){
						unlink($newfile);
						unlink($progress_file);		 
				}
				sleep(1); // allow a little pause to see the last (100% chunk) of progress bar before proceeding to view page
				ossn_trigger_message(ossn_print('video:com:uploaded'));	
				redirect($url);
		} else {
				if(isset($newfile)){
						unlink($newfile);
						unlink($progress_file);
				}
				ossn_trigger_message(ossn_print('video:com:upload:failed'), 'error');
				redirect(REF);
		}
}