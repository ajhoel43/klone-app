<p class="text-success" style="text-align:right"><?php echo lang('label_found_rec').count($records) ?></p>
<table class="table table-bordered thead">
	<tr class="active">
		<th style="width:3%;"><?php echo lang('label_no') ?></th>
		<th style="width:5%; ">Action</th>
		<th width="12%"><?php echo lang('label_username') ?></th>
		<th><?php echo lang('label_name') ?></th>
		<th><?php echo lang('label_email') ?></th>
		<th style="width:10%;text-align:center;"><?php echo lang('label_phone') ?></th>
		<th width="8%"><?php echo lang('label_birth') ?></th>
		<th width="5%"><?php echo lang('label_status') ?></th>
		<th style="width:12%;"><?php echo lang('label_user_prev') ?></th>
	</tr>
	<?php $no = 1; ?>
	<?php foreach ($records as $record) : ?>
		<tr id="<?php echo $record->username ?>">
			<td style="text-align:center;"><?php echo $no ?>.</td>
			<td style="text-align:center;">
				<div class="btn-group">
					<a class="btn btn-danger btn-sm dropdown-toggle" href="#" data-toggle="dropdown">
						<strong class="fa fa-pencil-square-o"></strong>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $record->username ?>" class="editdata"><i class="fa fa-pencil" style="color:green;"></i> Edit</a></li>
						<li><a href="<?php echo $record->username ?>" class="deletedata"><i class="fa fa-times" style="color:red;"></i> Delete</a></li>
						<?php $level = $this->session->userdata('level'); $level = (int)$level; ?>
						<?php if($level == 4 && $record->status != 1): ?>
						<li><a href="<?php echo $record->username ?>" class="activateuser"><i class="fa fa-check"></i> Activate</a></li>
						<?php endif; ?>
						<?php $level = $this->session->userdata('level'); $level = (int)$level; ?>
						<?php if($level == 4 && $record->level < 3): ?>
						<li class="divider"></li>
						<li><a href="<?php echo $record->username ?>" class="giveaccess"><i class="fa fa-unlock"></i> Make as Admin</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</td>
			<td><?php echo $record->username ?></td>
			<td><?php echo join(' ', array($record->first_name, $record->last_name)); ?></td>
			<td><?php echo $record->email ?></td>
			<td><?php echo $record->phone_num ?></td>
			<td><?php echo datePrint($record->birth_date) ?></td>
			<td><?php echo userStatus($record->status) ?></td>
			<td><?php echo $record->user_type ?></td>
		</tr>
	<?php $no++; endforeach; ?>
</table>