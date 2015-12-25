<style type="text/css">
	.thead th{
		text-align: center;
	}
	.thead {
		margin-top: 5px;
	}
	.searchform tr td{
		padding-bottom: 1em;
	}
</style>
<div class="col-md-12">
	<div class="row">
		<div class="page-header">
			<h2><?php echo lang('admin_title') ?> <small>@<?php echo strtoupper(lang('label_bengkel')) ?></small></h2>		
		</div>
		<div class="col-md-12">
			<h3><?php echo lang('label_search') ?></h3>
			<form class="form-horizontal" role="form" name="search">
				<table class="searchform">
					<tr>
						<td width="120px">
							<label class="control-label"><?php echo lang('label_bengkel') ?></label>
						</td>
						<td width="400px">
							<input type="text" class="form-control" name="nama_bengkel" value="<?php echo set_value('nama_bengkel') ?>">
						</td>
					</tr>
					<tr>
						<td width="120px">
							<label class="control-label"><?php echo lang('label_jb') ?></label>
						</td>
						<td width="400px">
							<?php echo form_dropdown('jenis_bengkel', $jb_dd, null, 'class="form-control"') ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td style="padding-top:1em;">
							<button class="btn btn-success" name="search"><?php echo lang('button_search') ?> <i class="fa fa-search"></i></button>
						</td>
					</tr>
				</table>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-6">
					</div>
				</div>
			</form>
		</div>
 		<a href="#" class="btn btn-md btn-primary add-form"><?php echo lang('button_add') ?> <i class="fa fa-plus"></i></a>		
		<div class="data-user-result">
			<table class="table table-bordered thead">
				<tr>
					<th style="width:3%;"><?php echo lang('label_no') ?></th>
					<th style="width:5%; "><?php echo lang('label_action') ?></th>
					<th width="15%"><?php echo lang('label_bengkel') ?></th>
					<th width="7%"><?php echo lang('label_jb') ?></th>
					<th width="30%"><?php echo lang('address') ?></th>
					<th width="8%"><?php echo lang('apprv_by') ?></th>
					<th width="8%"><?php echo lang('register_by') ?></th>
					<th width="10%"><?php echo "Add-ons" ?></th>
				</tr>
				<?php $no = 1; ?>
				<?php foreach ($records as $record) : ?>
					<?php if($record->apprv_by == null): ?>
					<tr class="success">
					<?php else: ?>
					<tr>
					<?php endif; ?>
						<td style="text-align:center;"><?php echo $no ?>.</td>
						<td style="text-align:center;">
							<div class="btn-group">
								<a class="btn btn-danger btn-sm dropdown-toggle" href="#" data-toggle="dropdown">
									<strong class="fa fa-pencil-square-o"></strong>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo $record->ID_bengkel ?>" class="editdata"><i class="fa fa-pencil" style="color:green;"></i> Edit</a></li>
									<li><a href="<?php echo $record->ID_bengkel ?>" class="deletedata"><i class="fa fa-times" style="color:red;"></i> Delete</a></li>
								</ul>
							</div>
						</td>
						<td><?php echo $record->nama_bengkel ?></td>
						<td><?php echo $record->nama_jb ?></td>
						<td><?php echo $record->alamat ?></td>
						<td><?php echo $record->apprv_by ?></td>
						<td><?php echo $record->register_by ?></td>
						<td style="text-align:center;">
							<a class="btn btn-info view-info" href="<?php echo $record->ID_bengkel ?>"><i class="fa fa-info"></i></a>
							<button class="btn btn-info view-map" value="<?php $record->ID_bengkel ?>"><i class="fa fa-map-marker"></i></button>
						</td>
						<!-- <td><?php echo $record->deskripsi ?></td> -->
					</tr>
				<?php $no++; endforeach; ?>
			</table>	
			<div style="text-align:right;">
				<?php if(isset($links))echo $links?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade form-modal" role="dialog">
	<p>Loading ...</p>
</div>
<div class="modal fade modal-info" role="dialog">
</div>
<div class="modal fade confirm-modal"> <!-- MODAL -->
	<div class="modal-dialog modal-md"> <!-- DIALOG -->
		<div class="modal-content"> <!-- CONTENT -->
			<div class="modal-header"> <!-- HEADER -->
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
				<h4 class="modal-title"><?php echo "Confirm Delete ".lang('label_bengkel') ?></h4>
			</div> <!-- END HEADER -->
			<div class="modal-body confirm-body"> <!-- BODY -->
			</div> <!-- END BODY -->
			<div class="modal-footer"> <!-- FOOTER -->
				<button type="button" name="conf_no" class="btn btn-default" data-dismiss="modal"><?php echo lang('conf_no') ?></button>
				<button type="button" name="conf_yes" class="btn btn-primary" data-dismiss="modal"><?php echo lang('conf_yes') ?></button>
			</div> <!-- END FOOTER -->
		</div> <!-- END CONTENT -->
	</div> <!-- END DIALOG -->
</div> <!-- END MODAL -->

<div class="modal errordialog fade" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo lang('error_header') ?></h4>
            </div>
            <div class="modal-body">
                <p class="errorpan">ERROR MODAL</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" ><?php echo lang('button_close') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>
$.ajaxSetup({cache:false, async: false});
$("button[name='search']").click(function(event){
	event.preventDefault();
	$.ajax({
		url : "<?php echo base_url('bengkel/search_bengkel') ?>",
		type : "POST",
		data : $("form[name='search']").serialize(),
		success : function(data) {
			$(".data-user-result").html(data);
		}
	});
});

$(".add-form").click(function(event){
	event.preventDefault();
	$(".form-modal").load("<?php echo base_url('bengkel/add_bengkel') ?>");
	$(".form-modal").modal("show");
});

$("body").on("click", ".editdata",function(event){
	event.preventDefault();
	$(".form-modal").load("<?php echo base_url('bengkel/upd_bengkel') ?>/"+$(this).attr('href'));
	$(".form-modal").modal("show");
});

$("body").on("click", ".deletedata",function(event){
	event.preventDefault();
	var value = $(this).attr('href');
	$(".confirm-body").html('<?php echo lang("delete_q1") ?> <br><strong>ID => ' + value + '</strong>');
	$(".confirm-modal").modal('show');
	$("button[name='conf_yes']").click(function(event){
		$.ajax({
			url : "<?php echo base_url('bengkel/del_bengkel') ?>/" + value,
			type : "POST",
			success : function(msg){
				var flag = 0,
					string = 1;

				msg = msg.split('@@');

				if(msg[flag] == 0)
				{
					$(".errorpan").html(msg[string]);
					$(".errordialog").modal('show');
				}
				else
				{
					window.location.reload();
				}
			}
		});
	});
});

$("body").on("click", "button[name='add_data_btn']", function(event){
	event.preventDefault();
	$.ajax({
		url : "<?php echo base_url('bengkel/add_bengkel') ?>",
		type : "POST",
		data : $("form[name='form_add']").serialize() + "&submit=1",
		success : function(msg){
			var flag = 0,
				string = 1;

			msg = msg.split('@@');

			if(msg[flag] == 0)
			{
				$(".errorpan").html(msg[string]);
				$(".errordialog").modal('show');
			}
			else
			{
				window.location.reload();
			}
		}
	});
});

$("body").on("click", "button[name='update_data_btn']", function(event){
	event.preventDefault();
	$.ajax({
		url : "<?php echo base_url('bengkel/upd_bengkel') ?>/" + $(this).val(),
		type : "POST",
		data : $("form[name='form_edit']").serialize() + "&submit=1",
		success : function(msg){
			var flag = 0,
				string = 1;

			msg = msg.split('@@');

			if(msg[flag] == 0)
			{
				$(".errorpan").html(msg[string]);
				$(".errordialog").modal('show');
			}
			else
			{
				window.location.reload();
			}
		}
	});
});

$("body").on("click", ".info", function(event){
	event.preventDefault();
	$(".modal-info").load("<?php echo base_url('jenis_bkl/info_jb') ?>");
	$(".modal-info").modal('show');
});

$("body").on("click", ".view-info", function(event){
	event.preventDefault();
	$(".modal-info").load("<?php echo base_url('bengkel/info_bkl_dtl') ?>/"+ $(this).attr('href'));
	$(".modal-info").modal('show');
});

$("body").on("click", ".view-map", function(event){
	event.preventDefault();
	$(".modal-info").load("<?php echo base_url('bengkel/info_bkl_dtl') ?>/"+ $(this).attr('href'));
	$(".modal-info").modal('show');
});
</script>