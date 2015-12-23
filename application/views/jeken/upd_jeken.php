<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
			<h4 class="modal-title"><?php echo "New ".lang('label_jeken') ?></h4>
		</div>
		<div class="modal-body">
			<?php echo validation_errors(); ?>
			<form class="form-horizontal" name="form_edit">
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_jeken_code') ?>*</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="kode_jeken" value="<?php echo $record->kode_jeken ?>" readonly>
					</div>
					<div class="col-sm-4"><p class="help-block info-id"></p></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_jeken') ?>*</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="nama_jeken" value="<?php echo $record->nama_jeken ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_desc') ?></label>
					<div class="col-sm-9">
						<textarea class="form-control" name="deskripsi" placeholder="About <?php echo lang('label_jeken') ?>" rows="4"><?php echo $record->deskripsi ?></textarea>
					</div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
			<button type="submit" name="update_data_btn" value="<?php echo $record->kode_jeken ?>" class="btn btn-primary" ><?php echo lang('button_update') ?></button>
		</div>
	</div>
</div>