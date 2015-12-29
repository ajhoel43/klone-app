<style type="text/css">
	.thead th{
		text-align: center;
	}
	.thead {
		margin-top: 5px;
	}
	.searchform tr td {
		padding-bottom: 1em;
	}
</style>
<div class="col-md-12">
	<div class="row">
		<div class="page-header">
			<h2><?php echo lang('admin_title') ?> <small>@<?php echo strtoupper(lang('label_kec')) ?></small></h2>		
		</div>
		<div class="col-md-12">
			<h3><?php echo lang('label_search') ?></h3>
			<form class="form-horizontal" role="form" name="search">
				<table class="searchform">
					<tr>
						<td width="120px">
							<label class="control-label"><?php echo lang('label_wil') ?></label>
						</td>
						<td width="400px">
							<input type="text" class="form-control" name="nama_wil" value="<?php echo set_value('nama_wil') ?>" placeholder="<?php echo lang('info_s_by').' '.lang('label_wil') ?>">
						</td>
					</tr>
					<tr>
						<td width="120px">
							<label class="control-label"><?php echo lang('label_kota') ?></label>
						</td>
						<td width="400px">
							<input type="text" class="form-control" name="nama_kota" value="<?php echo set_value('nama_kota') ?>" placeholder="<?php echo lang('info_s_by').' '.lang('label_kota') ?>">
						</td>
					</tr>
					<tr>
						<td width="120px">
							<label class="control-label"><?php echo lang('label_kec') ?></label>
						</td>
						<td width="400px">
							<input type="text" class="form-control" name="nama_kec" value="<?php echo set_value('nama_kec') ?>" placeholder="<?php echo lang('info_s_by').' '.lang('label_kec') ?>">
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
				<h4 class="modal-title"><?php echo "Confirm Delete ".lang('label_kec') ?></h4>
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

<div class="modal fade select_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo "Search ".lang('label_kota') ?></h4>
            </div>
            <div class="modal-body">
            	<table width="100%">
            		<tr>
            			<td colspan="2">
			            	<label class="control-label"><?php echo lang('label_kota') ?></label>
            			</td>
            		</tr>
            		<tr>
            		<?php $opt = array('kota' => 'Kota','wil' => 'Wilayah'); ?>

            			<td width="20%">
            			<?php echo form_dropdown('s_by', $opt, null, 'class="form-control"'); ?>
            			</td>
            			<td width="80%">
			            	<input type="text" name="keyword" class="form-control" style="padding-right:1em;">
            			</td>
            		</tr>
            		<tr>
            			<td>
			            	<input type="submit" class="btn btn-primary submitselect" style="margin-top:1em;">
            			</td>
            		</tr>
            	</table>
                <div id="select_result"></div>
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
		url : "<?php echo base_url('wil/search_kec') ?>",
		type : "POST",
		data : $("form[name='search']").serialize(),
		success : function(data) {
			$(".data-user-result").html(data);
		}
	});
});

$(".add-form").click(function(event){
	event.preventDefault();
	$(".form-modal").load("<?php echo base_url('wil/add_kec') ?>");
	$(".form-modal").modal("show");
});

$("body").on("click", ".editdata",function(event){
	event.preventDefault();
	$(".form-modal").load("<?php echo base_url('wil/upd_kec') ?>/"+$(this).attr('href'));
	$(".form-modal").modal("show");
});

$("body").on("click", ".deletedata",function(event){
	event.preventDefault();
	var value = $(this).attr('href');
	$(".confirm-body").html('<?php echo lang("delete_q1") ?> <br><strong><?php echo lang("label_kec_kode") ?> => ' + value + '</strong>');
	$(".confirm-modal").modal('show');
	$("button[name='conf_yes']").click(function(event){
		$.ajax({
			url : "<?php echo base_url('wil/del_kec') ?>/" + value,
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
		url : "<?php echo base_url('wil/add_kec') ?>",
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
		url : "<?php echo base_url('wil/upd_kec') ?>/" + $(this).val(),
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

$("body").on("click",".select_wil",function(event){
	event.preventDefault();
	$(".select_modal").modal('show');
});

$("#select_result").on("click", "a", function(event){
	event.preventDefault();
	var code = 0,
		wil = 1;

	var msg = $(this).attr('href').split('@@');

	$("[name='ID_kota']").val(msg[code]);
	$("[name='nama_kota']").val(msg[wil]);
});

$(".submitselect").click(function(){
	$("#select_result").load("<?php echo base_url('wil/select_kota/') ?>",{keyword:$("input[name='keyword']").val(), s_by: $("[name='s_by']").val()});
});
</script>