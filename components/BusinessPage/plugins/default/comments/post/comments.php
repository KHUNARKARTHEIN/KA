<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 

$object = $params->guid;

$comments = new OssnComments;
$OssnLikes = new OssnLikes;

if($params->full_view !== true){
	$comments->limit = 5;
}
if($params->full_view == true){
	$comments->limit = false;
	$comments->page_limit = false;
}
$comments = $comments->GetComments($object);
if($params->type == 'businesspage'){
		$business = get_business_page($params->owner_guid);
}
echo "<div class='ossn-comments-list-p{$object}'>";
if ($comments) {
    foreach ($comments as $comment) {
			$data['businesspage'] = false;
			if($params->type == 'businesspage' && $comment->owner_guid == $business->owner_guid){
				$data['businesspage'] = $business;
			}
            $data['comment'] = get_object_vars($comment);
            echo ossn_comment_view($data);
    }
}
echo '</div>';
if (ossn_isLoggedIn()) {
	
	$user = ossn_loggedin_user();
	$iconurl = $user->iconURL()->smaller;
	if($params->type == 'businesspage' && ($business && $business->owner_guid == ossn_loggedin_user()->guid)){
		$iconurl = $business->photoURL('smaller');
	}	
    $inputs = ossn_view_form('post/comment_add', array(
        'action' => ossn_site_url() . 'action/post/comment',
        'component' => 'OssnComments',
        'id' => "comment-container-p{$object}",
        'class' => 'comment-container comment-container-p',
        'autocomplete' => 'off',
        'params' => array('object' => $object)
    ), false);

$form = <<<html
<div class="comments-item">
    <div class="row">
        <div class="col-md-1">
            <img class="comment-user-img" src="{$iconurl}" />
        </div>
        <div class="col-md-11">
            $inputs
        </div>
    </div>
</div>
html;

$form .= '<script>  Ossn.PostComment(' . $object . '); </script>';
$form .= '<div class="ossn-comment-attachment" id="comment-attachment-container-p' . $object . '">';
$form .= '<script>Ossn.CommentImage(' . $object . ',  "post");</script>';
$form .= ossn_view_form('comment_image', array(
        'id' => "ossn-comment-attachment-p{$object}",
        'component' => 'OssnComments',
        'params' => array(
			'object' => $object,
			'type' => 'p',
		)  
    ), false);
$form .= '</div>';
echo $form;
}
