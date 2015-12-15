<h4><?php echo lang('delete_q') ?></h4>
<p><?php echo lang('account_detail') ?>:</p>
<table class="table table-default">
<?php foreach($record as $record): ?>
	<tr>
		<td><?php echo lang('label_username') ?></td>
		<td>=></td>
		<td><?php echo $record->username ?></td>
	</tr>
	<tr>
		<td><?php echo lang('label_name') ?></td>
		<td>=></td>
		<td><?php echo join(" ", array($record->first_name, $record->last_name)) ?></td>
	</tr>
	<tr>
		<td><?php echo lang('label_email') ?></td>
		<td>=></td>
		<td><?php echo $record->email ?></td>
	</tr>
	<tr>
		<td><?php echo lang('label_phone') ?></td>
		<td>=></td>
		<td><?php echo $record->phone_num ?></td>
	</tr>
	<tr>
		<td><?php echo lang('label_user_prev') ?></td>
		<td>=></td>
		<td><?php echo $record->user_type ?></td>
	</tr>
	<tr>
		<td><?php echo lang('label_status') ?></td>
		<td>=></td>
		<td><?php echo userStatus($record->status) ?></td>
	</tr>
<?php endforeach; ?>
</table>