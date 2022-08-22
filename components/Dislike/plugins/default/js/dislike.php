Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
        $('body').delegate('.post-control-dislike, .entity-menu-extra-dislike', 'click', function() {
            var $guid = $(this).attr('data-guid');
            var $type = $(this).attr('data-type');
            if($type == 'post'){
	            var $params = '&post=' + $guid;
            }
            if($type == 'entity'){
 	            var $params = '&entity=' + $guid;           
            }
            if ($guid) {
                Ossn.PostRequest({
                    url: Ossn.site_url + 'action/post/dislike',
                    beforeSend: function() {
                        $('#ossn-dislike-' + $guid).html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" />');
                    },
                    params: $params,
                    callback: function(callback) {
                        if (callback['done'] !== 0) {
                            $('#ossn-dislike-' + $guid).html(Ossn.Print('ossn:undislike'));
                            $('#ossn-dislike-' + $guid).removeClass('post-control-dislike');
                            $('#ossn-dislike-' + $guid).addClass('post-control-undislike');
                        } else {
                            $('#ossn-dislike-' + $guid).html(Ossn.Print('ossn:dislike'));
                        }
                    },
                });
            }
        });
		$('body').delegate('.post-control-undislike, .entity-menu-extra-undislike', 'click', function() {
            var $guid = $(this).attr('data-guid');
            var $type = $(this).attr('data-type');    
            if($type == 'post'){
	            var $params = '&post=' + $guid;
            }
            if($type == 'entity'){
 	            var $params = '&entity=' + $guid;           
            }                 
            if ($guid) {
                Ossn.PostRequest({
                    url: Ossn.site_url + 'action/post/undislike',
                    beforeSend: function() {
                        $('#ossn-dislike-' + $guid).html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" />');
                    },
                    params: $params,
                    callback: function(callback) {
                        if (callback['done'] !== 0) {
                            $('#ossn-dislike-' + $guid).html(Ossn.Print('ossn:dislike'));
                            $('#ossn-dislike-' + $guid).addClass('post-control-dislike');
                            $('#ossn-dislike-' + $guid).removeClass('post-control-undislike');
                        } else {
                            $('#ossn-dislike-' + $guid).html(Ossn.Print('ossn:undislike'));
                        }
                    },
                });
            }
        });        
    });
});
Ossn.ViewDisLikes = function($post, $type) {
    if (!$type) {
        $type = 'post';
    }
    Ossn.MessageBox('dislikes/view?guid=' + $post + '&type=' + $type);
};