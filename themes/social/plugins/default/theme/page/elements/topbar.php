<?php
	$center_name = 'col-md-12 col-xs-12 text-center site-name';
	if(ossn_isLoggedin()){		
		$hide_loggedin = "hidden-xs hidden-sm";
		$center_name = 'col-md-4 site-name left-side left';
	}
?>
<!-- ossn topbar -->
<div class="topbar">
	<div class="container">
		<div class="row">
			<div class="<?php echo $center_name;?> <?php echo $hide_loggedin;?>">
				<span><a href="<?php echo ossn_site_url();?>"><?php echo ossn_site_settings('site_name');?></a></span>
			</div>
			<div class="col-md-4 col-xs-7 topbar-menu-right text-center">
				
                <?php
						if(ossn_isLoggedin()){
							echo ossn_plugin_view('notifications/page/topbar');
						}
						?>
			</div>
			<div class="col-md-4 text-right right-side">
				<div class="topbar-menu-right">
					<li class="ossn-topbar-dropdown-menu">
						<div class="dropdown">
						<?php
							if(ossn_isLoggedin()){						
								echo ossn_plugin_view('output/url', array(
									'role' => 'button',
									'data-toggle' => 'dropdown',
									'data-target' => '#',
									'text' => '<i class="fa fa-sort-desc"></i>',
								));									
								echo ossn_view_menu('topbar_dropdown'); 
							}
							?>
						</div>
					</li>       
                    <?php if(ossn_isLoggedin()){ ?>
                    	<div class="userdetails-topbar hidden-xs">
	                    	<div class="topbar-username"><a href="<?php echo ossn_loggedin_user()->profileURL();?>"><?php echo ossn_loggedin_user()->fullname;?></a></div>
    	                    <div class="topbar-subtitle"><?php echo ossn_print('site:index');?>!</div>
                        </div>
                        <div class="userimage-topbar">
                        	<a href="<?php echo ossn_loggedin_user()->profileURL();?>"><img src="<?php echo ossn_loggedin_user()->iconURL()->small;?>" /></a>
                        </div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ./ ossn topbar -->