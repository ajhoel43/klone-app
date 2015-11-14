<style type="text/css">
	.thead th{
		text-align: center;
	}
	.thead {
		margin-top: 5px;
	}
</style>
<div class="col-md-12">
	<div class="row">
		<h2><?php echo strtoupper(lang('label_user')) ?></h2>
		<a href="<?php echo base_url('user/add_user') ?>" class="btn btn-md btn-primary glyphicon-plus"> <?php echo lang('new_input') ?></a>		
		<table class="table table-bordered thead">
			<tr class="active">
				<th style="width:5px;"><?php echo lang('label_no') ?></th>
				<th style="width:3.5em; ">Action</th>
				<th><?php echo lang('label_username') ?></th>
				<th><?php echo lang('label_password') ?></th>
				<th><?php echo lang('label_salt') ?></th>
				<th><?php echo lang('label_hash') ?></th>
				<th style="width:10em;"><?php echo lang('label_jenis_user') ?></th>
			</tr>
			<?php $no = 1; ?>
			<?php foreach ($records as $record) : ?>
				<tr>
					<td style="text-align:center;"><?php echo $no ?>.</td>
					<td style="text-align:center;">
						<a style="color:green;" href="<?php echo base_url('user/edit_user/'.$record->ID_User) ?>" class="glyphicon glyphicon-pencil"></a>
						<a style="color:red;" href="<?php echo base_url('user/delete_user/'.$record->ID_User) ?>" class="glyphicon glyphicon-remove"></a>
					</td>
					<td><?php echo $record->Username ?></td>	
					<td><?php echo $record->Password ?></td>
					<td><?php echo $record->Salt ?></td>
					<td><?php echo $record->Hash ?></td>
					<td><?php echo $record->Jenis_User ?></td>
				</tr>
			<?php $no++; endforeach; ?>
		</table>
		<!--<h3>Testing Hash and Randomize</h3>
		Password Generate : <?php echo $random ?><br>
		Salt Generate : <?php echo $salt ?><br>
		Hash Generate : <?php echo $hash ?>
		-->
	</div>
	
</div>