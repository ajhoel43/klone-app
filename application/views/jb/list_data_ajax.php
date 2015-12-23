<div class="col-md-12 text-success" style="text-align:right;">
	<?php echo lang('label_found_rec').count($records) ?>
</div>
<table class="table table-bordered thead">
	<tr class="active">
		<th style="width:3%;"><?php echo lang('label_no') ?></th>
		<th style="width:5%; "><?php echo lang('label_action') ?></th>
		<th width="12%"><?php echo lang('label_jb') ?></th>
		<th><?php echo lang('label_desc') ?></th>
	</tr>
	<?php $no = 1; ?>
	<?php foreach ($records as $record) : ?>
		<tr>
			<td style="text-align:center;"><?php echo $no ?>.</td>
			<td style="text-align:center;">
				<div class="btn-group">
					<a class="btn btn-danger btn-sm dropdown-toggle" href="#" data-toggle="dropdown">
						<strong class="fa fa-pencil-square-o"></strong>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $record->kode_jb ?>" class="editdata"><i class="fa fa-pencil"></i> Edit</a></li>
						<li><a href="<?php echo $record->kode_jb ?>" class="deletedata"><i class="fa fa-times"></i> Delete</a></li>
					</ul>
				</div>
			</td>
			<td><?php echo $record->nama_jb ?></td>
			<td><?php echo $record->deskripsi ?></td>
		</tr>
	<?php $no++; endforeach; ?>
</table>