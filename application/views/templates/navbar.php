<style type="text/css">
.nav-margin {
	margin-right: 1em;
}
.navbar-brand {
  padding: 0px;
}
.navbar-brand > img {
  max-height: 100%;
  height: 100%;
  padding: 5px 15px;
  width:auto;
  /*-o-object-fit: contain;
  object-fit: contain;*/
}
.dropdown-menu {right:0;min-width:230px;}
.dropdown-submenu{position:relative;}
.dropdown-submenu>.dropdown-menu{top:0;right:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;}
.dropdown-submenu:hover>.dropdown-menu{display:block;}
.dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#cccccc;margin-top:5px;margin-right:-10px;}
.dropdown-submenu:hover>a:after{border-left-color:#ffffff;}
.dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/navbar.css') ?>">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo base_url('') ?>"><img src="<?php echo base_url('assets/img/logo/klonefont.png') ?>" class="nav-logo"></a>
	</div>

	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-gears fa-fw fa-lg"></span> <?php echo lang('label_master') ?><strong class="caret"></strong></a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo base_url('user/list_users') ?>"><i class="fa fa-user fa-fw"></i> <?php echo lang('label_user') ?></a>
					</li>
					<li>
						<a href="<?php echo base_url('jenis_bkl/index') ?>"><i class="fa fa-flag fa-fw"></i> <?php echo lang('label_jb') ?></a>
					</li>
					<li>
						<a href="<?php echo base_url('serv_bkl/index') ?>"><i class="fa fa-truck fa-fw"></i> <?php echo lang('label_servb') ?></a>
					</li>
					<li>
						<a href="<?php echo base_url('jeken/index') ?>"><i class="fa fa-automobile fa-fw"></i> <?php echo lang('label_jeken') ?></a>
					</li>
					<li>
						<a href="<?php echo base_url('bengkel/index') ?>"><i class="fa fa-wrench fa-fw"></i> <?php echo lang('label_bengkel') ?></a>
					</li>
					<li class="menu-item dropdown dropdown-submenu">
						<a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-globe fa-fw"></i> <?php echo lang('label_wil') ?></a>
						<ul class="dropdown-menu">
				            <li class="menu-item ">
				            	<a href="<?php echo base_url('wil/index') ?>"><i class="fa fa-globe fa-fw"></i> <?php echo lang('label_wil') ?></a>
			            	</li>
				            <li class="menu-item ">
					            <a href="<?php echo base_url('wil/index_kota') ?>"><i class="fa fa-building fa-fw"></i> <?php echo lang('label_kota') ?></a>
				            </li>
				            <li class="menu-item ">
					            <a href="<?php echo base_url('wil/index_kec') ?>"><i class="fa fa-home fa-fw"></i> <?php echo lang('label_kec') ?></a>
				            </li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="dropdown nav-margin">
				 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $userdata['first_name'] ?><strong class="caret"></strong></a>
				<ul class="dropdown-menu">
					<li>
						<a href="#">Action</a>
					</li>
					<li>
						<a href="#">Another action</a>
					</li>
					<li>
						<a href="#">Something else here</a>
					</li>
					<li class="divider">
					</li>
					<li>
						<a href="<?php echo base_url('front/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> <?php echo lang('label_logout') ?></a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>