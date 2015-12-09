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
					<tr>
						<td style="text-align:center;"><?php echo $no ?>.</td>
						<td style="text-align:center;">
							<a style="color:green;" href="<?php echo $record->username ?>" class="glyphicon glyphicon-pencil editdata"></a>
							<a style="color:red;" href="<?php echo base_url('user/delete_user/'.$record->username) ?>" class="glyphicon glyphicon-remove deletedata"></a>
						</td>
						<td><?php echo $record->username ?></td>
						<td><?php echo $record->first_name." ".$record->last_name ?></td>
						<td><?php echo $record->email ?></td>
						<td><?php echo $record->phone_num ?></td>
						<td><?php echo datePrint($record->birth_date) ?></td>
						<td><?php echo userStatus($record->status) ?></td>
						<td><?php echo $record->user_type ?></td>
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
	$(".form-modal").load("<?php echo base_url('user/create_user') ?>");
	$(".form-modal").modal("show");
});

$("body").on("click", "button[name='add_user_btn']", function(event){
	event.preventDefault();
	$.ajax({
		url : "<?php echo base_url('front/create_user') ?>",
		type : "POST",
		data : $("form[name='form_add_user']").serialize() + "&submit=1",
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

//Username info Function with Javascript and ajax
//Set timer variable
var timer,
	typingInterval = 2000; //3 Second
	
$("body").on("keyup", "input[name='username']", function(event){
	event.preventDefault();
	clearTimeout(timer);
	timer = setTimeout(doneTypingUser, typingInterval);
});

$("body").on("blur", "input[name='username']", function(event){
	clearTimeout(timer);
	doneTypingUser();
});

$("body").on("keydown", "input[name='username']", function(event){
	clearTimeout(timer);
});

$("body").on("keyup", "input[name='email']", function(event){
	event.preventDefault();
	clearTimeout(timer);
	timer = setTimeout(doneTypingEmail, typingInterval);
});

$("body").on("blur", "input[name='email']", function(event){
	clearTimeout(timer);
	doneTypingEmail();
});

$("body").on("keydown", "input[name='email']", function(event){
	clearTimeout(timer);
});

$("body").on("keyup", "input[name='repassword']", function(event){
	event.preventDefault();
	clearTimeout(timer);
	timer = setTimeout(doneTypingPass, typingInterval);
});

$("body").on("blur", "input[name='repassword']", function(event){
	clearTimeout(timer);
	doneTypingPass();
});

$("body").on("keydown", "input[name='repassword']", function(event){
	clearTimeout(timer);
});

function doneTypingUser()
{
	if($("input[name='username']").val() == '')
	{
		var span = "<span class='glyphicon glyphicon-remove-sign' style='color:red;'></span>";
		$(".info-user").html(span + " <?php echo lang('messageUserNull') ?>");
		return false;
	}

	var checkparams = {
			link:"<?php echo base_url('front/check_available') ?>",
			type:"POST",
			info:$(".info-user"),
			data:"user@@" + $("input[name='username']").val()
		};
	autoCheck(checkparams);
}

function doneTypingEmail()
{
	if($("input[name='email']").val() == '')
	{
		var span = "<span class='glyphicon glyphicon-remove-sign' style='color:red;'></span>";
		$(".info-email").html(span + " <?php echo lang('messageEmailNull') ?>");
		return false;
	}	

	var checkparams = {
			link:"<?php echo base_url('front/check_available') ?>",
			type:"POST",
			info:$(".info-email"),
			data:"email@@" + $("input[name='email']").val()
		};
	autoCheck(checkparams);
}

function doneTypingPass()
{
	if($("input[name='repassword']").val() == '')
	{
		var span = "<span class='glyphicon glyphicon-remove-sign' style='color:red;'></span>";
		$(".info-pass").html(span + " <?php echo lang('messagePasswNotMatch') ?>");
		return false;
	}	
	
	hashCode = function(s){
	  return s.split("").reduce(function(a,b){a=((a<<5)-a)+b.charCodeAt(0);return a&a},0);              
	}

	var checkparams = {
			link:"<?php echo base_url('front/check_available') ?>",
			type:"POST",
			info:$(".info-pass"),
			data:"pass@@" + $("input[name='password']").val() + "@@" + $("input[name='repassword']").val()
		};
	autoCheck(checkparams);
}
</script>