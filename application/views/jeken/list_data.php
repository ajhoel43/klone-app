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
			<h2><?php echo lang('admin_title') ?> <small>@<?php echo strtoupper(lang('label_jeken')) ?></small></h2>		
		</div>
		<div class="col-md-12">
			<h3><?php echo lang('label_search') ?></h3>
			<form class="form-horizontal" role="form" name="search">
				<table class="searchform">
					<tr>
						<td width="120px">
							<label class="control-label"><?php echo lang('label_jeken') ?></label>
						</td>
						<td width="400px">
							<input type="text" class="form-control" name="nama_jeken" value="<?php echo set_value('nama_jeken') ?>">
						</td>
					</tr>
					<tr>
						<td width="120px">
							<label class="control-label"><?php echo "Type" ?></label>
						</td>
						<td width="400px">
							<?php echo form_dropdown('type_kend', $type_kend, null, 'class="form-control"') ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
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
				<tr class="active">
					<th style="width:3%;"><?php echo lang('label_no') ?></th>
					<th style="width:5%; "><?php echo lang('label_action') ?></th>
					<th width="12%"><?php echo lang('label_jeken') ?></th>
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
									<li><a href="<?php echo $record->kode_jeken ?>" class="editdata"><i class="fa fa-pencil" style="color:green;"></i> Edit</a></li>
									<li><a href="<?php echo $record->kode_jeken ?>" class="deletedata"><i class="fa fa-times" style="color:red;"></i> Delete</a></li>
								</ul>
							</div>
						</td>
						<td><?php echo $record->nama_jeken ?></td>
						<td><?php echo $record->deskripsi ?></td>
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

<div class="modal fade confirm-modal"> <!-- MODAL -->
	<div class="modal-dialog modal-md"> <!-- DIALOG -->
		<div class="modal-content"> <!-- CONTENT -->
			<div class="modal-header"> <!-- HEADER -->
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
				<h4 class="modal-title"><?php echo "Confirm Delete ".lang('label_jeken') ?></h4>
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
		url : "<?php echo base_url('jeken/search_data') ?>",
		type : "POST",
		data : $("form[name='search']").serialize(),
		success : function(data) {
			$(".data-user-result").html(data);
		}
	});
});

$(".add-form").click(function(event){
	event.preventDefault();
	$(".form-modal").load("<?php echo base_url('jeken/add_jeken') ?>");
	$(".form-modal").modal("show");
});

$("body").on("click", ".editdata",function(event){
	event.preventDefault();
	$(".form-modal").load("<?php echo base_url('jeken/upd_jeken') ?>/"+$(this).attr('href'));
	$(".form-modal").modal("show");
});

$("body").on("click", ".deletedata",function(event){
	event.preventDefault();
	var value = $(this).attr('href');
	$(".confirm-body").html('<?php echo lang("delete_q1") ?> <br><strong>Kode => ' + value + '</strong>');
	$(".confirm-modal").modal('show');
	$("button[name='conf_yes']").click(function(event){
		$.ajax({
			url : "<?php echo base_url('jeken/del_jeken') ?>/" + value,
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
		url : "<?php echo base_url('jeken/add_jeken') ?>",
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
		url : "<?php echo base_url('jeken/upd_jeken') ?>/" + $(this).val(),
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
</script>