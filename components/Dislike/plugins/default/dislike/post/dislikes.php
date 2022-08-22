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

$dislikes = new Dislike;

$object = $params->guid;
$count = $dislikes->CountDisLikes($object);

$user_liked = '';
if (ossn_isLoggedIn()) { 
            if ($dislikes->isDisliked($object, ossn_loggedin_user()->guid)) {
                $user_disliked = true;
            }
}
/* Likes and comments don't show for nonlogged in users */ 
if ($count) { ?>
    <div class="like-share dislike-share">
       <i class="fa fa-thumbs-up"></i>
        <?php if ($user_disliked == true && $count == 1) { ?>
            <?php echo ossn_print("ossn:disliked:you"); ?>
        <?php
        } elseif ($user_disliked == true && $count > 1) {
            $count = $count - 1;
            $total = 'person';
            if ($count > 1) {
                $total = 'people';
            }
            $link['onclick'] = "Ossn.ViewDisLikes({$object});";
            $link['href'] = '#';
            $link['text'] = ossn_print("ossn:dislike:{$total}", array($count));
            $link = ossn_plugin_view('output/url', $link);
            echo ossn_print("ossn:dislike:you:and:this", array($link));
        } elseif (!$user_liked) {
            $total = 'person';
            if ($count > 1) {
                $total = 'people';
            }
            $link['onclick'] = "Ossn.ViewDisLikes({$object});";
            $link['href'] = '#';
            $link['text'] = ossn_print("ossn:dislike:{$total}", array($count));
            $link = ossn_plugin_view('output/url', $link);
            echo ossn_print("ossn:dislike:this", array($link));
        }?>
    </div>
<?php } ?>
