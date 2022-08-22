<div class="topbar">
				<?php if(ossn_isLoggedin()){ ?>
				<div class="topbar-menu-left">
					<li id="sidebar-toggle" data-toggle='0'>
						<a role="button" data-target="#" style="padding: 15px 5px 5px 5px">
            			<img src="<?php echo ossn_theme_url(); ?>images/logo_animated.svg" style="width: 40px;height:40px;">
            		</a>
					</li>
				</div>
				<?php } ?>
	<div class="container-fluid">
  		<div class="col-md-2 col-sm-4 col-lg-3 site-name <?php echo $hide_loggedin;?>">
				<span><a href="<?php echo ossn_site_url();?>"><?php echo ossn_site_settings('site_name');?></a></span>
		</div>  	
        <?php if(ossn_isLoggedin()){ ?>
		<div class="col-md-5 hidden-xs hidden-sm">
        	<div class="topbar-search">
            	<form method="get" action="<?php echo ossn_site_url("search");?>">
                <input type="text" name="q" placeholder="<?php echo ossn_print('ossn:search');?>" onblur="if (this.value=='') { this.value=Ossn.Print('ossn:search'); }" onFocus="if (this.value==Ossn.Print('ossn:search')) { this.value='' };"/>
				</form>
            </div>
        </div>
        <?php } ?>
        
 			
				<div class="topbar-menu-right text-right right-side">
					<ul>
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
					<?php
						if(ossn_isLoggedin()){
							echo ossn_plugin_view('notifications/page/topbar');
						}
						?>
					</ul>
				</div>
			       
        
    </div>
</div>    
<?php
	if(ossn_isLoggedin()){		
		$hide_loggedin = "hidden-xs hidden-sm";
	}
	return;
?>
<!-- ossn topbar -->
<div class="topbar">
	<div class="container">
		<div class="row">
			<div class="col-md-2 left-side left">
				<?php if(ossn_isLoggedin()){ ?>
				<div class="topbar-menu-left">
					<li id="sidebar-toggle" data-toggle='0'>
						<a role="button" data-target="#"> <i class="fa fa-th-list"></i></a>
					</li>
					<div class="logo"></div>
				</div>
				<?php } ?>
			</div>
			<div class="col-md-7 site-name text-center <?php echo $hide_loggedin;?>">
				<span><a href="<?php echo ossn_site_url();?>"><?php echo ossn_site_settings('site_name');?></a></span>
			</div>
			<div class="col-md-3 text-right right-side">
				<div class="topbar-menu-right">
					<ul>
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
					<?php
						if(ossn_isLoggedin()){
							echo ossn_plugin_view('notifications/page/topbar');
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ./ ossn topbar -->
