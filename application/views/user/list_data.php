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
			<h2><?php echo lang('admin_title') ?> <small>@<?php echo strtoupper(lang('label_user')) ?></small></h2>		
		</div>
		<a href="<?php echo base_url('user/add_user') ?>" class="btn btn-md btn-primary glyphicon-plus"> <?php echo lang('button_new')." 2" ?></a>
		<!--<a href="#" class="btn btn-md btn-primary glyphicon-plus add-data" > <?php echo lang('button_new') ?></a> -->
		<a href="#" class="btn btn-md btn-primary glyphicon-plus add-form" > <?php echo lang('button_new') ?></a>
		<div class="table-responsive">
			<table class="table table-bordered thead">
				<tr class="active">
					<th style="width:5px;"><?php echo lang('label_no') ?></th>
					<th style="width:3.5em; ">Action</th>
					<th><?php echo lang('label_username') ?></th>
					<th><?php echo lang('label_email') ?></th>
					<th><?php echo lang('label_phone') ?></th>
					<th><?php echo lang('label_birth') ?></th>
					<th><?php echo lang('label_status') ?></th>
					<th style="width:10em;"><?php echo lang('label_user_prev') ?></th>
				</tr>
				<?php $no = 1; ?>
				<?php foreach ($records as $record) : ?>
					<tr>
						<td style="text-align:center;"><?php echo $no ?>.</td>
						<td style="text-align:center;">
							<a style="color:green;" href="<?php echo $record->username ?>" class="glyphicon glyphicon-pencil editdata"></a>
							<a style="color:red;" href="<?php echo base_url('user/delete_user/'.$record->username) ?>" class="glyphicon glyphicon-remove deletedata"></a>
						</td>
						<td><?php echo $record->username ?></td>
						<td><?php echo $record->email ?></td>
						<td><?php echo $record->phone_num ?></td>
						<td><?php echo datePrint($record->birth_date) ?></td>
						<td><?php echo userStatus($record->status) ?></td>
						<td><?php echo $record->user_previleges ?></td>
					</tr>
				<?php $no++; endforeach; ?>
			</table>	
		</div>
		<!--<h3>Testing Hash and Randomize</h3>
		Password Generate : <?php echo $random ?><br>
		Salt Generate : <?php echo $salt ?><br>
		Hash Generate : <?php echo $hash ?>
		-->
	</div>
</div>
<div class="modal fade form-modal" role="dialog">
	<p>Loading ...</p>
</div>

<div class="modal fade add-modal"> <!-- MODAL -->
	<div class="modal-dialog modal-lg"> <!-- DIALOG -->
		<div class="modal-content"> <!-- CONTENT -->
			<div class="modal-header"> <!-- HEADER -->
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
				<h4 class="modal-title"><?php echo "New User" ?></h4>
			</div> <!-- END HEADER -->
			<div class="modal-body add-body"> <!-- BODY -->
				<p>HELLO MODAL</p>
				<p><a href="" class="loop-modal">Second Modal</a></p>
			</div> <!-- END BODY -->
			<div class="modal-footer"> <!-- FOOTER -->
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
			</div> <!-- END FOOTER -->
		</div> <!-- END CONTENT -->
	</div> <!-- END DIALOG -->
</div> <!-- END MODAL -->

<div class="modal errordialog fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo "ERROR :" ?></h4>
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
$(document).ready(function(){

});
$(".add-data").click(function(event){
    event.preventDefault();
    // $(".add-body").load('<?php echo base_url("user/add_user") ?>');
	$(".add-modal").modal("show");
});

$(".add-form").click(function(event){
	event.preventDefault();
	$(".form-modal").load("<?php echo base_url('user/add_user1') ?>");
	$(".form-modal").modal("show");
});

$("body").on("click", ".loop-modal", function(event){
	event.preventDefault();
	$(".errordialog").modal("show");
});

$("body").on("click", "button[name='submit']", function(event){
	window.location.reload();
});

$(".editdata").click(function(event){
	event.preventDefault();
	$(".form-modal").load("<?php echo base_url('user/edit_user') ?>/"+$(this).attr('href'));
	$(".form-modal").modal("show");
});
</script>