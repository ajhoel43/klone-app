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
		<!-- <a href="<?php echo base_url('user/add_user') ?>" class="btn btn-md btn-primary glyphicon-plus"> <?php echo lang('new_input') ?></a> -->
		<a href="#" class="btn btn-md btn-primary glyphicon-plus add-data" > <?php echo lang('button_new') ?></a>
		<a href="#" class="btn btn-md btn-primary glyphicon-plus add-form" > <?php echo lang('button_new')." 1" ?></a>
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
<div class="modal fade form-modal">
	<p>Loading ...</p>
</div>

<div class="modal fade add-modal"> <!-- MODAL -->
	<div class="modal-dialog"> <!-- DIALOG -->
		<div class="modal-content"> <!-- CONTENT -->
			<div class="modal-header"> <!-- HEADER -->
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
				<h4 class="modal-title"><?php echo "New User" ?></h4>
			</div> <!-- END HEADER -->
			<div class="modal-body add-body"> <!-- BODY -->
				<p>HELLO MODAL</p>
				<p><a href="" class="loop-modal" data-dismiss="modal">Second Modal</a></p>
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
                <h4 class="modal-title"><?php echo lang('Info') ?></h4>
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
<link href="<?php echo base_url('assets/resources/jquery-ui.min.css') ?>" rel="stylesheet"/>
<script src="<?php echo base_url('assets/resources/jquery-ui.min.js') ?>"></script>
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

</script>