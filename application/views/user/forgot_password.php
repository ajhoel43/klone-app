<div class="col-lg-12">
	<div class="row">
		<div class="page-header">
			<h2><?php echo lang('forgot_password') ?></h2>
		</div>
		<div class="col-lg-8">
			<?php echo form_open('front/forgot_password', 'class="form-horizontal"')?>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_username') ?></label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="username" value="<?php echo set_value('username') ?>">
					</div>
					<div class="col-lg-4">
						<?php echo form_error('username', '<p class="help-block">','</p>'); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_email') ?></label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="email" value="<?php echo set_value('email') ?>">
					</div>
					<div class="col-lg-4">
						<?php echo form_error('email', '<p class="help-block">','</p>'); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<input type="submit" class="btn btn-primary" name="submit" value="<?php echo lang('button_submit') ?>">
						<a href="<?php echo base_url('front/login') ?>" class="btn btn-primary"><?php echo lang('label_login') ?></a>
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
				<button type="button" class="btn btn-default" data-dismiss="modal" ><?php echo lang('button_close') ?></button>
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