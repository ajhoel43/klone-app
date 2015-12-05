<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
			<h4 class="modal-title"><?php echo "New ".lang('label_user') ?></h4>
		</div>
		<div class="modal-body">
			<?php echo validation_errors(); ?>
			<?php //echo form_open('user/add_user1', 'class="form-horizontal"') ?>
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_username') ?></label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="username" value="<?php echo $record->username ?>">
					</div>
					<div class="col-sm-4"><p class="help-block info-user"></p></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_password') ?></label>
					<div class="col-sm-6">				
						<input type="password" class="form-control" name="password">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_repassword') ?></label>
					<div class="col-sm-6">				
						<input type="password" class="form-control" name="repassword">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_email') ?></label>
					<div class="col-sm-6">				
						<input type="email" class="form-control" name="email" value="<?php echo $record->email ?>">
					</div>
					<div class="col-sm-4"><p class="help-block info-email"></p></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_phone') ?></label>
					<div class="col-sm-6">				
						<input type="text" class="form-control" name="phone_num" size="12" value="<?php echo $record->phone_num ?>">
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
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-6">
						<button type="submit" name="submit" class="btn btn-primary" data-dissmiss="modal" ><?php echo lang('button_update') ?></button>
					</div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
		</div>
	</div>
</div>