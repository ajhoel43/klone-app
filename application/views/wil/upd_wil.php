<div class="modal-dialog modal-md">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
			<h4 class="modal-title"><?php echo "Edit ".lang('label_wil') ?></h4>
		</div>
		<div class="modal-body">
			<?php echo validation_errors(); ?>
			<form class="form-horizontal" name="form_edit">
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('label_wil_kode') ?>*</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="kode_wil" value="<?php echo $record->kode_wil ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('label_wil') ?>*</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="nama_wil" value="<?php echo $record->nama_wil ?>">
					</div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
			<button type="submit" name="update_data_btn" value="<?php echo $record->kode_wil ?>" class="btn btn-primary" ><?php echo lang('button_update') ?></button>
		</div>
	</div>
</div>