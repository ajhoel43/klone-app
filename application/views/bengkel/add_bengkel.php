<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
			<h4 class="modal-title"><?php echo "New ".lang('label_bengkel') ?></h4>
		</div>
		<div class="modal-body">
			<?php echo validation_errors(); ?>
			<form class="form-horizontal" name="form_add">
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_bengkel') ?>*</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="nama_bengkel" value="<?php echo set_value('nama_bengkel') ?>" placeholder="<?php echo lang('label_bengkel_name') ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_jb') ?>*</label>
					<div class="col-sm-6">
						<?php echo form_dropdown('jenis_bengkel', $jb_dd, null, 'class="form-control"') ?>
					</div>
					<div><button class="btn btn-link info"><?php echo lang('info') ?></button></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('address') ?>*</label>
					<div class="col-sm-9">
						<textarea class="form-control" name="alamat" placeholder="<?php echo lang('address')." ".lang('label_bengkel') ?>" rows="2"><?php echo set_value('alamat') ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_notes') ?></label>
					<div class="col-sm-9">
						<textarea class="form-control" name="notes" placeholder="<?php echo lang('label_notes') ?>" rows="4"><?php echo set_value('notes') ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_desc') ?></label>
					<div class="col-sm-9">
						<textarea class="form-control" name="deskripsi" placeholder="About <?php echo lang('label_bengkel') ?>" rows="4"><?php echo set_value('deskripsi') ?></textarea>
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