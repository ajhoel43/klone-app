<p class="text-success" style="text-align:right"><?php echo lang('label_found_rec').count($records) ?></p>
<table class="table table-condensed">
	<tr>
		<th style="width:3%;"><?php echo lang('label_no') ?></th>
		<th width="20%"><?php echo lang('label_kota_kode') ?></th>
		<th width="40%"><?php echo lang('label_wil') ?></th>
		<th width="40%"><?php echo lang('label_kota') ?></th>
	</tr>
	<?php $no = 1; ?>
	<?php foreach ($records as $record) : ?>
		<?php $href = sprintf('%s@@%s@@', $record->ID_kota, $record->nama_kota) ?>
		<tr>
			<td><?php echo $no ?>.</td>
			<td><?php echo $record->ID_kota ?></td>
			<td><?php echo $record->nama_wil ?></td>
			<td align="left">
				<a href="<?php echo $href ?>" data-dismiss="modal"><?php echo $record->nama_kota ?></a>
			</td>
		</tr>
	<?php $no++; endforeach; ?>
</table>