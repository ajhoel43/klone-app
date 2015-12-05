<div class="col-md-12">
	<div class="row">
		<div class="col-md-6">
			<?php echo validation_errors(); ?>
			<h1><?php echo lang('label_user') ?></h1>
			<?php echo form_open('user/edit_user/'.$record->username, 'class="form-horizontal"') ?>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_username') ?></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="username" value="<?php echo $record->username ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_password') ?></label>
					<div class="col-sm-10">				
						<input type="password" class="form-control" name="password">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_email') ?></label>
					<div class="col-sm-10">				
						<input type="email" class="form-control" name="email" value="<?php echo $record->email ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_phone') ?></label>
					<div class="col-sm-10">				
						<input type="text" class="form-control" name="phone_num" size="12" value="<?php echo $record->phone_num ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_birth') ?></label>
					<div class="col-sm-2">
						<?php 
						echo form_dropdown('date', date_list(), $date0, 'class="form-control"') ?>
					</div>
					<div class="col-sm-4">
						<?php 
						echo form_dropdown('month', month_list(), $date1, 'class="form-control"') ?>
					</div>
					<div class="col-sm-4">
						<?php 
						echo form_dropdown('year', year_list(), $date2, 'class="form-control"');
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_user_prev') ?></label>
					<div class="col-sm-10">
						<?php 
						echo form_dropdown('user_previleges', $usprev, $record->user_previleges, 'class="form-control"')
						 ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="submit"  value="1" class="btn btn-primary" data-dissmiss="modal" ><?php echo lang('button_update')." ".lang('label_user') ?></button>						
					</div>
				</div>
			</form>
		</div>
	</div>
</div>