<div class="col-md-12">
	<div class="row">
		<div class="col-sm-6">
			<?php echo validation_errors(); ?>
			<h1><?php echo lang('label_user') ?></h1>
			<?php echo form_open('user/add_user', 'class="form-horizontal"') ?>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_id') ?></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="ID_User">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_username') ?></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="username">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_password') ?></label>
					<div class="col-sm-10">				
						<input type="password" class="form-control" name="password">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_jenis_user') ?></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="jenis_user">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo "Tanggal" ?></label>
					<div class="col-sm-10">
						<input type="text" class="form-control date" name="tgl">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo "Date From" ?></label>
					<div class="col-sm-4">
						<input type="text" class="form-control datefrom" name="tgldr">
					</div>
					<label class="col-sm-2 control-label"><?php echo "Date To" ?></label>
					<div class="col-sm-4">
						<input type="text" class="form-control dateto" name="tglke">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="submit" value="1" class="btn btn-primary" ><?php echo lang('button_add') ?></button>						
					</div>
				</div>
			</form>	
		</div>
	</div>
</div>
<script>
$(document).ready(function(){

});
</script>