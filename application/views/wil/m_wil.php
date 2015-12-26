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
		<div class="page-header">
			<h2><?php echo lang('admin_title') ?> <small>@<?php echo strtoupper(lang('label_wil')) ?></small></h2>		
		</div>
		<div class="col-md-12">
			<div class="tabbable" id="tab-wil">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#wil" data-toggle="tab"><?php echo lang('label_wil') ?></a>
					</li>
					<li>
						<a href="#kota" data-toggle="tab"><?php echo lang('label_kota') ?></a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="wil">
						<p>
							I'm in Section 1.
						</p>
					</div>
					<div class="tab-pane" id="kota">
						<p>
							Howdy, I'm in Section 2.
						</p>
					</div>
				</div>
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
				<h4 class="modal-title"><?php echo "Confirm Delete ".lang('label_wil') ?></h4>
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
		url : "<?php echo base_url('wil/search_wil') ?>",
		type : "POST",
		data : $("form[name='search']").serialize(),
		success : function(data) {
			$(".data-user-result").html(data);
		}
	});
});

$(".add-form").click(function(event){
	event.preventDefault();
	$(".form-modal").load("<?php echo base_url('wil/add_wil') ?>");
	$(".form-modal").modal("show");
});

$("body").on("click", ".editdata",function(event){
	event.preventDefault();
	$(".form-modal").load("<?php echo base_url('wil/upd_wil') ?>/"+$(this).attr('href'));
	$(".form-modal").modal("show");
});

$("body").on("click", ".deletedata",function(event){
	event.preventDefault();
	var value = $(this).attr('href');
	$(".confirm-body").html('<?php echo lang("delete_q1") ?> <br><strong>Kode wil => ' + value + '</strong>');
	$(".confirm-modal").modal('show');
	$("button[name='conf_yes']").click(function(event){
		$.ajax({
			url : "<?php echo base_url('wil/del_wil') ?>/" + value,
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
		url : "<?php echo base_url('wil/add_wil') ?>",
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
		url : "<?php echo base_url('wil/upd_wil') ?>/" + $(this).val(),
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