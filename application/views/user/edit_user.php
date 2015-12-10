<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
			<h4 class="modal-title"><?php echo "Edit ".lang('label_user') ?></h4>
		</div>
		<div class="modal-body">
			<?php echo validation_errors(); ?>
			<form class="form-horizontal" name="form_edit_user">
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_username') ?></label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="username" value="<?php echo $record->username ?>" placeholder="<?php echo lang('info_user') ?>">
					</div>
					<div class="col-sm-4"><p class="help-block info-user"></p></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('info_first_name') ?></label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="first_name" value="<?php echo $record->first_name ?>" placeholder="<?php echo lang('info_first_name') ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('info_last_name') ?></label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="last_name" value="<?php echo $record->last_name ?>" placeholder="<?php echo lang('info_last_name') ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_password') ?></label>
					<div class="col-sm-6">				
						<input type="password" class="form-control" name="password" placeholder="<?php echo "Current ".lang('info_pass') ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_repassword') ?></label>
					<div class="col-sm-6">				
						<input type="password" class="form-control" name="repassword" placeholder="<?php echo lang('info_repass') ?>">
					</div>
					<div class="col-sm-4"><p class="help-block info-pass"></p></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_email') ?></label>
					<div class="col-sm-6">				
						<input type="email" class="form-control" name="email" value="<?php echo $record->email ?>" placeholder="<?php echo lang('info_email') ?>">
					</div>
					<div class="col-sm-4"><p class="help-block info-email"></p></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_phone') ?></label>
					<div class="col-sm-6">				
						<input type="text" class="form-control" name="phone_num" maxlength="14" value="<?php echo $record->phone_num ?>" placeholder="<?php echo lang('info_phone') ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_birth') ?></label>
					<div class="col-sm-2">
						<?php 
						echo form_dropdown('date', date_list(), $date0, 'class="form-control"') ?>
					</div>
					<div class="col-sm-2">
						<?php 
						echo form_dropdown('month', month_list(), $date1, 'class="form-control"') ?>
					</div>
					<div class="col-sm-2">
						<?php 
						echo form_dropdown('year', year_list(), $date2, 'class="form-control"');
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_user_prev') ?></label>
					<div class="col-sm-6">
						<?php 
						echo form_dropdown('user_previleges', $usprev, $record->user_previleges, 'class="form-control"')
						 ?>
					</div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="submit" name="update_user_btn" class="btn btn-primary" data-dissmiss="modal" value="<?php echo $record->username ?>"><?php echo lang('button_update')." ".lang('label_user') ?></button>
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
		</div>
	</div>
</div>