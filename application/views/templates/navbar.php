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
				 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-gears"></span> <?php echo lang('label_master') ?><strong class="caret"></strong></a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo base_url('user/list_users') ?>"><i class="fa fa-user"></i> <?php echo lang('label_user') ?></a>
					</li>
					<li>
						<a href="<?php echo base_url('jenis_bkl/index') ?>"><i class="fa fa-flag"></i> <?php echo lang('label_jb') ?></a>
					</li>
					<li>
						<a href="<?php echo base_url('serv_bkl/index') ?>"><i class="fa fa-truck"></i> <?php echo lang('label_servb') ?></a>
					</li>
					<li>
						<a href="<?php echo base_url('jeken/index') ?>"><i class="fa fa-automobile"></i> <?php echo lang('label_jeken') ?></a>
					</li>
					<li>
						<a href="<?php echo base_url('bengkel/index') ?>"><i class="fa fa-wrench"></i> <?php echo lang('label_bengkel') ?></a>
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