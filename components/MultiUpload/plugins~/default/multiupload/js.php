<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
if(empty($params['album'])){
	return;
}
?>
<script>
	$(document).ready(function() {
	    $("#multi-upload").dropzone({
	        url: "<?php echo ossn_site_url() . 'action/ossn/photos/add?album=' . $params['album']; ?>",
	        paramName: "ossnphoto",
	        uploadMultiple: false,
	        init: function() {
	            this.on("queuecomplete", function(file) {
	                location.reload();
	            });
	        }
	    });
	});
</script>