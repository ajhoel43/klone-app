<style type="text/css">
.alg a {
	text-align: left;
}
</style>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="navbar-header">
		 
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
		</button><a class="navbar-brand" href="<?php echo base_url('') ?>"><span class="glyphicon glyphicon-home"></span> <?php echo lang('window_title') ?></a>
	</div>

	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-hdd"></span> <?php echo lang('label_master') ?><strong class="caret"></strong></a>
				<ul class="dropdown-menu alg">
					<li>
						<a href="<?php echo base_url('user/list_user') ?>" class="btn btn-link btn-md"><?php echo lang('label_user') ?></a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $userdata['nama_user'] ?><strong class="caret"></strong></a>
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
						<a href="<?php echo base_url('user/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> <?php echo lang('label_logout') ?></a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>
