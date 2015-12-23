<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
			<h4 class="modal-title"><?php echo "New ".lang('label_jeken') ?></h4>
		</div>
		<div class="modal-body">
			<?php echo validation_errors(); ?>
			<form class="form-horizontal" name="form_add">
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo "Type" ?>*</label>
					<div class="col-sm-6">
						<?php echo form_dropdown('kode_jeken', $jeken_dd, null, 'class="form-control"') ?>
					</div>
					<div class="col-sm-4"><p class="help-block info-id"></p></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_jeken') ?>*</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="nama_jeken" value="<?php echo set_value('nama_jeken') ?>" placeholder="SUV, Sedan, MPV etc.">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_desc') ?></label>
					<div class="col-sm-9">
						<textarea class="form-control" name="deskripsi" placeholder="About <?php echo lang('label_jeken') ?>" rows="4"><?php echo set_value('deskripsi') ?></textarea>
					</div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
			<button type="submit" name="add_data_btn" value="active" class="btn btn-primary" ><?php echo lang('button_add') ?></button>
		</div>
	</div>
</div>