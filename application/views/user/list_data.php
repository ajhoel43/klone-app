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
		<div class="col-md-12">
			<h3><?php echo lang('label_search') ?></h3>
			<form class="form-horizontal" role="form" name="search">
				<div class="form-group">
					<label class="col-sm-1 control-label"><?php echo lang('label_username') ?></label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="username" value="<?php echo set_value('username') ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label"><?php echo lang('label_user_prev') ?></label>
					<div class="col-sm-4">
						<?php echo form_dropdown('user_previleges', $usprev, $this->session->userdata('user_previleges'), 'class="form-control"') ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-6">
						<button class="btn btn-primary" name="search"><?php echo lang('button_search') ?> <i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>
		</div>
<!-- 		<div style="text-align:right;">
			<?php if(isset($links))echo $links?>
		</div>
 -->
 		<a href="#" class="btn btn-md btn-primary add-form"><?php echo lang('button_add') ?> <i class="fa fa-plus"></i></a>
		<div class="data-user-result">
			<table class="table table-bordered thead">
				<tr class="active">
					<th style="width:3%;"><?php echo lang('label_no') ?></th>
					<th style="width:5%; "><?php echo lang('label_action') ?></th>
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
									<li><a href="<?php echo $record->username ?>" class="editdata"><i class="fa fa-pencil"></i> Edit</a></li>
									<li><a href="<?php echo $record->username ?>" class="deletedata"><i class="fa fa-times"></i> Delete</a></li>
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
				<h4 class="modal-title"><?php echo "Confirm Delete ".lang('label_user') ?></h4>
			</div> <!-- END HEADER -->
			<div class="modal-body confirm-body"> <!-- BODY -->
			</div> <!-- END BODY -->
			<div class="modal-footer"> <!-- FOOTER -->
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('conf_no') ?></button>
				<button type="button" name="delete_user" class="btn btn-primary" data-dismiss="modal"><?php echo lang('conf_yes') ?></button>
			</div> <!-- END FOOTER -->
		</div> <!-- END CONTENT -->
	</div> <!-- END DIALOG -->
</div> <!-- END MODAL -->

<div class="modal errordialog fade" >
    <div class="modal-dialog modal-sm">
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
var data = "<?php echo $this->session->userdata('username') ?>";
$("#"+data).addClass('success');

$("button[name='search']").click(function(event){
	event.preventDefault();
	$.ajax({
		url : "<?php echo base_url('user/searchuser') ?>",
		type : "POST",
		data : $("form[name='search']").serialize(),
		success : function(data) {
			$(".data-user-result").html(data);
		}
	});
});

$(".add-form").click(function(event){
	event.preventDefault();
	$(".form-modal").load("<?php echo base_url('user/create_user') ?>");
	$(".form-modal").modal("show");
});

$("body").on("click", ".editdata",function(event){
	event.preventDefault();
	$(".form-modal").load("<?php echo base_url('user/edit_user') ?>/"+$(this).attr('href'));
	$(".form-modal").modal("show");
});

$("body").on("click", ".deletedata",function(event){
	event.preventDefault();
	var value = $(this).attr('href');
	$(".confirm-body").load("<?php echo base_url('user/delete_dialog') ?>/"+$(this).attr('href'));
	$(".confirm-modal").modal('show');
	$("button[name='delete_user']").click(function(event){
		$.ajax({
			url : "<?php echo base_url('user/delete_user') ?>/" + value,
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

$("body").on("click", ".activateuser",function(event){
	event.preventDefault();
	var value = $(this).attr('href');
	$(".confirm-modal .modal-title").html("Activate User");
	$(".confirm-body").html("Are you sure want to activate this user?");
	$(".confirm-modal").modal('show');
	$("button[name='delete_user']").click(function(event){
		$.ajax({
			url : "<?php echo base_url('user/activate_user') ?>",
			type : "POST",
			data : "term=" + value,
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

$("body").on("click",".giveaccess",function(event){
	event.preventDefault();
	var value = $(this).attr('href');
	$(".confirm-modal .modal-title").html("Add Administrator");
	$(".confirm-body").html("Are you sure want to give Admin access to this user?");
	$(".confirm-modal").modal('show');
	$("button[name='delete_user']").click(function(event){
		$.ajax({
			url : "<?php echo base_url('user/make_admin') ?>",
			type : "POST",
			data : "term=" + value,
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

$("body").on("click", "button[name='add_user_btn']", function(event){
	event.preventDefault();
	$.ajax({
		url : "<?php echo base_url('user/create_user') ?>",
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

$("body").on("click", "button[name='update_user_btn']", function(event){
	event.preventDefault();
	$.ajax({
		url : "<?php echo base_url('user/edit_user') ?>/" + $(this).val(),
		type : "POST",
		data : $("form[name='form_edit_user']").serialize() + "&submit=1",
		success : function(msg){
			var flag = 0,
				string = 1;

			msg = msg.split('@@');

			if(msg[flag] == 0)
			{
				$(".errorpan").html(msg[string]);
				$(".errordialog").modal('show');
			}
			else if(msg[flag] == 2)
			{
				$(".form-modal").modal('hide');
				$(".errordialog .modal-title").html("Success");
				$(".errorpan").html(msg[string]);
				$(".errordialog").modal('show');
				$(".errordialog").on('hidden.bs.modal', function(event){
					window.location = "<?php echo base_url('front/logout') ?>";
				});
			}
			else
			{
				window.location.reload();
			}
		}
	});
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
		var span = "<span class='glyphicon glyphicon-remove-circle' style='color:red;'></span>";
		$(".info-user").html(span + " <?php echo lang('messageUserNull') ?>");
		return false;
	}
	var btnupd = $("button[name='update_user_btn']");
	var btnadd = $("button[name='add_user_btn']");
	if(btnadd.val() == 'active')
	{
		var checkparams = {
				link:"<?php echo base_url('front/check_available') ?>",
				type:"POST",
				info:$(".info-user"),
				data:"user@@" + $("input[name='username']").val()
			};
	}
	else
	{
		var checkparams = {
				link:"<?php echo base_url('front/check_available') ?>/" + btnupd.val(),
				type:"POST",
				info:$(".info-user"),
				data:"user@@" + $("input[name='username']").val()
			};	
	}
	autoCheck(checkparams);
}

function doneTypingEmail()
{
	if($("input[name='email']").val() == '')
	{
		var span = "<span class='glyphicon glyphicon-remove-circle' style='color:red;'></span>";
		$(".info-email").html(span + " <?php echo lang('messageEmailNull') ?>");
		return false;
	}	
	var btnupd = $("button[name='update_user_btn']");
	var btnadd = $("button[name='add_user_btn']");
	if(btnadd.val() == 'active')
	{
		var checkparams = {
				link:"<?php echo base_url('front/check_available') ?>",
				type:"POST",
				info:$(".info-email"),
				data:"email@@" + $("input[name='email']").val()
			};
	}
	else
	{
		var checkparams = {
				link:"<?php echo base_url('front/check_available') ?>/" + btnupd.val(),
				type:"POST",
				info:$(".info-email"),
				data:"email@@" + $("input[name='email']").val()
			};
	}
	autoCheck(checkparams);
}

function doneTypingPass()
{
	if($("input[name='repassword']").val() == '')
	{
		var span = "<span class='glyphicon glyphicon-remove-circle' style='color:red;'></span>";
		$(".info-pass").html(span + " <?php echo lang('messagePasswNotMatch') ?>");
		return false;
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