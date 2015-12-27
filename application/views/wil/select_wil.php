<p class="text-success" style="text-align:right"><?php echo lang('label_found_rec').count($records) ?></p>
<table class="table table-condensed thead">
	<tr>
		<th style="width:3%;"><?php echo lang('label_no') ?></th>
		<th width="20%"><?php echo lang('label_wil_kode') ?></th>
		<th width="80%"><?php echo lang('label_wil') ?></th>
	</tr>
	<?php $no = 1; ?>
	<?php foreach ($records as $record) : ?>
		<?php $href = sprintf('%s@@%s@@', $record->kode_wil, $record->nama_wil) ?>
		<tr>
			<td style="text-align:center;"><?php echo $no ?>.</td>
			<td align="center"><?php echo $record->kode_wil ?></td>
			<td align="center">
				<a href="<?php echo $href ?>" data-dismiss="modal"><?php echo $record->nama_wil ?></a>
			</td>
		</tr>
	<?php $no++; endforeach; ?>
</table>