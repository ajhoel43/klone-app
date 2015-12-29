<p class="text-success" style="text-align:right"><?php echo lang('label_found_rec').count($records) ?></p>
<table class="table table-bordered table-condensed thead">
	<tr class="active">
		<th style="width:3%;"><?php echo lang('label_no') ?></th>
		<th style="width:5%; "><?php echo lang('label_action') ?></th>
		<th width="10%"><?php echo lang('label_kec_kode') ?></th>
		<th width="20%"><?php echo lang('label_wil') ?></th>
		<th width="20%"><?php echo lang('label_kota') ?></th>
		<th width="40%"><?php echo lang('label_kec') ?></th>
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
						<li><a href="<?php echo $record->ID_kec ?>" class="editdata"><i class="fa fa-pencil" style="color:green;"></i> Edit</a></li>
						<li><a href="<?php echo $record->ID_kec ?>" class="deletedata"><i class="fa fa-trash-o" style="color:red;"></i> Delete</a></li>
					</ul>
				</div>
			</td>
			<td align="center"><?php echo $record->ID_kec ?></td>
			<td><?php echo $record->nama_wil ?></td>
			<td><?php echo $record->nama_kota ?></td>
			<td><?php echo $record->nama_kec ?></td>
		</tr>
	<?php $no++; endforeach; ?>
</table>