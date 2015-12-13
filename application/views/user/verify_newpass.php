<div class="col-lg-12">
	<div class="row">
		<div class="page-header">
			<h2><?php echo lang('forgot_password') ?></h2>
		</div>
		<div class="col-lg-8">
			Hello and welcome back <?php echo $name ?>, you have forgotten your password.<br>
			Input a new password and remember it :)
		</div>
		<div class="col-lg-12">&nbsp;</div>
		<div class="col-lg-8">
			<?php //echo form_open('', 'class="form-horizontal"')?>
			<form class="form-horizontal" name="password-reset">
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo "New ".lang('label_password') ?></label>
					<div class="col-sm-6">
						<input class="form-control" type="password" name="password" value="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('label_repassword') ?></label>
					<div class="col-sm-6">
						<input class="form-control" type="password" name="repassword" value="">
					</div>
					<div class="col-sm-3"><p class="help-block info-pass"></p></div>
				</div>
				<div class="form-group">
					<div class="col-sm-3"></div>
					<div class="col-sm-7">
						<button class="btn btn-primary" name="submit"><?php echo lang('button_submit') ?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade modal-report">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo "Report" ?></h4>
			</div>
			<div class="modal-body"><p class="report-msg"></p></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" ><?php echo lang('button_close') ?></button>
				<button type="button" class="btn btn-primary ok" data-dismiss="modal" ><?php echo lang('button_ok') ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-progress" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Your password has been changed!</h4>
				<p>Redirecting, please wait...</p>
			</div>
			<div class="modal-body">
				<div class="progress progress-striped active">
					<div class="progress-bar progress-success" style="width:100%;">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){

});

//Set timer variable
var timer,
	typingInterval = 2000; // 2 Second

$("button[name='submit']").click(function(event){
	event.preventDefault();
	$(this).html("<?php echo lang('button_process') ?> <i class='fa fa-spinner fa-spin'></i>").attr('disabled', 'disabled');
	$.ajax({
		url : "<?php echo base_url('front/verify_conf') ?>",
		type : "POST",
		data : $("form[name='password-reset']").serialize() + "&id=<?php echo $id ?>",
		success : function(msg){
			var flag = 0,
				str = 1;

			msg = msg.split('@@');
			if(msg[flag] == 0)
			{
				$(".report-msg").html(msg[str]);
				$(".modal-report").modal('show');
				$(".modal-report").on("hidden.bs.modal", function(){
					$("button[name='submit']").html("Submit");
				});
			}
			else
			{
				var timer2, timeout2 = 3000;
				$("button[name='submit']").html("Password has changed").attr('disabled', 'disabled');
				$(".modal-progress").modal('show');
				clearTimeout(timer2);
				timer2 = setTimeout(function(){
					window.location = "<?php echo base_url('') ?>";
				}, timeout2);
			}
		}
	});
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