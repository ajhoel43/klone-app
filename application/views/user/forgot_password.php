<style type="text/css">
	.pages {
		padding: 0em 2em 2em 2em;
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
			background: url('<?php echo base_url("assets/img/background/bg2hd.jpg") ?>') no-repeat fixed 50%;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			/*background: url('<?php echo base_url("assets/img/background/bg1hd.jpg") ?>') fixed 50% / cover;*/
		}
	}

	@media screen and (max-width: 1024px) { /* Specific to this particular image */
		.background {
			background: url('<?php echo base_url("assets/img/background/bg2.jpg") ?>') no-repeat fixed 50%;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
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
</div>
<div class="col-lg-2"></div>
<div class="col-lg-8 pages">
	<div class="row">
		<div class="page-header">
			<h2><?php echo lang('forgot_password') ?></h2>
		</div>
		<div class="col-lg-8">
			<?php echo form_open('front/forgot_password', 'class="form-horizontal"')?>
				<p class="col-sm-offset-1">
					Please insert your email and we will help you to reset your password :)
				</p>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_email') ?></label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="email" value="<?php echo set_value('email') ?>">
					</div>
					<div class="col-lg-4">
						<?php echo form_error('email', '<p class="help-block" style="color:red">','</p>'); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<a href="<?php echo base_url('front/login') ?>" class="btn btn-success"><span class="fa fa-chevron-left"></span> Back</a>
						<input type="submit" class="btn btn-primary" name="submit" value="<?php echo lang('button_submit') ?>">
					</div>
				</div>
			</form>
			<?php 	
				$temp = $this->session->tempdata(); 
				if(isset($temp['error']) && isset($temp['success'])):
			?>
				<input type="hidden" name="report" value="<?php echo $temp['error'] ?>">
				<input type="hidden" name="success" value="<?php echo $temp['success'] ?>">
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="col-lg-2"></div>
<div class="modal fade modal-report">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo "Report" ?></h4>
			</div>
			<div class="modal-body">
				<p>
					<?php if(isset($temp['msg']))echo $temp['msg']; ?>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary ok" data-dismiss="modal" ><?php echo lang('button_ok') ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-progress" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h2><?php echo lang('label_sendingmail') ?></h2>
			</div>
			<div class="modal-body">
				<div class="progress progress-striped active">
					<div class="progress-bar progress-success" style="width:100%;">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	if($("input[name='report']").val() == 1)
	{
		$(".modal-progress").modal('hide');
		$(".modal-report").modal('show');
	}

	$(".modal-report").on('hidden.bs.modal', function(){
		if($("input[name='success']").val() == 1)
		{
			window.location = "<?php echo base_url('') ?>";
		}
		else
		{	
			$("input[name='submit']").val('Resend');
			return false;
		}
	});

});

$("input[name='submit']").click(function(event){
	$(".modal-progress").modal('show');
});
</script>