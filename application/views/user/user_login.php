<style type="text/css">
    .login-form {
    	margin: auto;
    	display: flex;
    	justify-content:center;
    	align-items:center;
    	/*background-color: white;*/
    	background: rgb(255, 255, 255); 
    	/* Fall-back for browsers that don't support rgba */
	    background: rgba(255, 255, 255, .6);
    	border-radius: 5px;
    }

	.background {
	  /* Set rules to fill background */
	  min-height: 100%;
	  min-width: 100%;
		
	  /* Set up proportionate scaling */
	  width: 100%;
	  height: auto;
		
	  /* Set up positioning */
	  position: fixed;
	  top: 0;
	  left: 0;
	}

	@media screen and (max-width: 1920px) and (min-width: 1024px){
		.background {
			background: url('<?php echo base_url("assets/img/background/bg1hd.jpg") ?>') no-repeat fixed 50%;
			background-size: cover;

			/*background: url('<?php echo base_url("assets/img/background/bg1hd.jpg") ?>') fixed 50% / cover;*/
		}
	}

	@media screen and (max-width: 1024px) { /* Specific to this particular image */
		.background {
			background: url('<?php echo base_url("assets/img/background/bg1.jpg") ?>') no-repeat fixed 50%;
			background-size: cover;

			/*background: url('<?php echo base_url("assets/img/background/bg1.jpg") ?>') fixed 50% / cover;*/
		}
	}

	.logo{
		width:60%;
		height: auto;
		margin-bottom: 2em;
	}

	.logos {
		display: flex;
		justify-content:center;
		align-items: center;
	}
</style>
<div class="background"></div>
<div class="col-lg-12 logos">
	<center><a href="<?php echo base_url('main') ?>"><img src="<?php echo base_url('assets/img/logo/klonefont.png') ?>" class="logo"></a></center>
	<!-- <div class="background-image"><img src="<?php echo base_url('assets/img/background/bg1.jpg') ?>"></div> -->
</div>
<div class="col-md-4"></div>
<div class="col-md-4 login-form">
	<?php echo form_open('front/login', 'name="login-form"') ?>
	<h2><?php echo lang('label_login') ?></h2>
	<table class="table">
	<?php 
		$error = $this->session->flashdata('error');
		if($error):
	?>
		<tr>
			<div class="alert alert-danger"><?php echo $error ?></div>
		</tr>
	<?php endif; ?>
		<tr>
			<?php echo validation_errors('<div class="alert alert-warning">','</div>'); ?>
		</tr>
		<tr>
			<td colspan="2">
				<div class="input-group input-group-lg">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-user"></span>
				  	</span>
					<input size="30" class="form-control" type="text" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username">
				</div>
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
			</td>
		</tr>
		<tr>
			<td style="text-align:right" colspan="2">
				<a href="<?php echo base_url('front/forgot_password') ?>" class="btn btn-link btn-md"><?php echo lang('label_forgot') ?></a>
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