<div class="col-md-12">
	<div class="row">
		<?php echo validation_errors(); ?>
		<h1><?php echo lang('label_user') ?></h1>
		<?php echo form_open('user/edit_user/'.$record->ID_User) ?>
		<table>
			<input type="hidden" name="ID_User" value="<?php echo $record->ID_User ?>">
			<tr>
				<td><label><?php echo lang('label_username') ?></label></td>
				<td><input class="form-control" type="text" name="username" value="<?php echo $record->Username ?>"></td>
			</tr>
			<tr>
				<td><label><?php echo lang('label_password') ?></label></td>
				<td><input class="form-control" type="text" name="password" value="<?php echo $record->Password ?>"></td>
			</tr>
			<tr>
				<td><label><?php echo lang('label_salt') ?></label></td>
				<td><input class="form-control" type="text" name="salt" value="<?php echo $Salt ?>"></td>
			</tr>
			<tr>
				<td><label><?php echo lang('label_hash') ?></label></td>
				<td><input class="form-control" type="text" name="hash" value="<?php echo $Hash ?>"></td>
			</tr>
			<tr>
				<td><label><?php echo lang('label_jenis_user') ?></label></td>
				<td><input class="form-control" type="text" name="jenis_user" value="<?php echo $record->Jenis_User ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><button type="submit" name="submit" value="1" class="btn btn-primary" ><?php echo lang('label_update') ?></button></td>
			</tr>
		</table>
		</form>
	</div>
</div>