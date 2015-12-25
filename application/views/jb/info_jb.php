<div class="modal-dialog modal-md">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
			<h4 class="modal-title"><?php echo "Info: ".lang('label_jb') ?></h4>
		</div>
		<div class="modal-body">
		<?php foreach ($recordsjb as $record): ?>
			<h4><strong><?php echo $record->nama_jb ?></strong></h4>
			<p style="text-align:justify;"><?php echo $record->deskripsi ?></p>
		<?php endforeach; ?>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
		</div>
	</div>
</div>