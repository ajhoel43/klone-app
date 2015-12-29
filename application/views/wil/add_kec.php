<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
			<h4 class="modal-title"><?php echo "New ".lang('label_kec') ?></h4>
		</div>
		<div class="modal-body">
			<?php echo validation_errors(); ?>
			<form class="form-horizontal" name="form_add">
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_kota') ?>*</label>
					<div class="col-sm-6">
						<div class="col-xs-1" style="position:relative;top:8px;">
							<a href="#" class="select_wil"><span class="glyphicon glyphicon-folder-open"></span></a>
						</div>
						<div class="col-xs-5">
							<input type="text" class="form-control" name="ID_kota" placeholder="<?php echo lang('label_wil_kode') ?>" readonly>
						</div>
						<div class="col-xs-6">
							<input type="text" class="form-control" name="nama_kota" placeholder="<?php echo lang('label_wil') ?>" disabled>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_kec_kode') ?>*</label>
					<div class="col-sm-6">
						<input type="number" class="form-control" name="kode_kec" value="<?php echo set_value('kode_kec') ?>">
					</div>
					<div class="col-sm-4"><p class="help-block info-id"></p></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo lang('label_kec') ?>*</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="nama_kec" value="<?php echo set_value('nama_kota') ?>">
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