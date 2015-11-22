<style type="text/css">
.formuser input, button {
	margin-top: 2px;
	margin-left: 10px;
}
</style>
<div class="col-md-6">
	<div class="row">
		<?php echo validation_errors(); ?>
		<h1><?php echo lang('label_user') ?></h1>
		<?php echo form_open('user/add_user') ?>
		<table class="formuser">
			<tr>
				<td><label>ID</label></td>
				<td><input type="text" name="ID_User" class="form-control" value="<?php echo set_value('ID_User') ?>"></td>
			</tr>
			<tr>
				<td><label><?php echo lang('label_username') ?></label></td>
				<td><input class="form-control" type="text" name="username" value="<?php echo set_value('username') ?>"></td>
			</tr>
			<tr>
				<td><label><?php echo lang('label_password') ?></label></td>
				<td><input class="form-control" type="text" name="password" value="<?php echo set_value('password') ?>"></td>
			</tr>
			<tr>
				<td><label><?php echo lang('label_jenis_user') ?></label></td>
				<td><input class="form-control" type="text" name="jenis_user" value="<?php echo set_value('jenis_user') ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><button style="width:100%;" type="submit" name="submit" value="1" class="btn btn-primary" ><?php echo lang('button_add') ?></button></td>
			</tr>
		</table>
		</form>
	</div>
</div>