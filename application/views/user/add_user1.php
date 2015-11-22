<style type="text/css">
/*.formuser input, button {
	margin-top: 2px;
	margin-left: 10px;
}*/
</style>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
			<h4 class="modal-title"><?php echo "New User" ?></h4>
		</div>
		<div class="modal-body">
			<?php echo validation_errors(); ?>
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
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
		</div>
	</div>
</div>