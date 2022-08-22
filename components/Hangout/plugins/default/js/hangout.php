<?php
if(ossn_isLoggedin()){ ?>
<script>
$(document).ready(function() {
		$code = '<div class="ossn-widget "> <div class="widget-heading">'+Ossn.Print("hangout")+'</div><div class="widget-contents"> <div class="ossn-profile-module-friends"><h3><div class="g-hangout" data-render="createhangout"></div></div></h3></div>';
		$('.ossn-profile-sidebar .ossn-profile-modules').prepend($code);
});
</script>
<?Php } ?>