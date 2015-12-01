<style type="text/css">
    .login-form {
    	margin: 4em auto;
    }
</style>
<div class="col-md-4"></div>
<div class="col-md-4 login-form" style="display:flex; justify-content:center; align-items:center;">
	<?php //echo validation_errors('<div class="alert alert-warning"><strong>','</strong></div>'); ?>
	<!--<form method="post" action="<?php echo base_url('user/login') ?>">-->
	
	<?php echo form_open('user/login') ?>
	<form name="login-form">
	<h1>Admin Login</h1>
	<table class="table table-responsive table-striped">
		<tr>
			<td colspan="2">
				<div class="input-group input-group-lg">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-user"></span>
				  	</span>
					<input size="30" class="form-control" type="text" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username">
				</div>
				<?php echo form_error('username','<div class="alert alert-warning">','</div>') ?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="input-group input-group-lg">
					<span class="input-group-addon">
				    	<span class="glyphicon glyphicon-lock"></span>
				  	</span>
				  	<input size="30" class="form-control" type="password" name="password" placeholder="Password">
				</div>
				<?php echo form_error('password','<div class="alert alert-warning">','</div>') ?>
			</td>
		</tr>
		<tr>
			<td style="text-align:right" colspan="2">
				<a href="<?php echo base_url('user/forgot') ?>" class="btn btn-link btn-md"><?php echo lang('label_forgot') ?></a>
				<button type="submit" name="submit" value="1" class="btn btn-primary btn-md">
					<span class="glyphicon glyphicon-log-in"></span>
					<?php echo lang('label_login') ?>
				</button>
			</td>
		</tr>
	</table>
	</form>
</div>	
<div class="col-md-4"></div>
<div class="modal errordialog fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo lang('Info') ?></h4>
            </div>
            <div class="modal-body">
                <p class="errorpan"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" ><?php echo lang('button_close') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>
$.ajaxSetup({cache:false, async:false});
$(document).ready(function(event){
	// $("[name='username']").on("change");
});
</script>