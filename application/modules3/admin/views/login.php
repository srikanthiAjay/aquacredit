<?php
if($this->session->userdata('adminid') != "")
{ 
	redirect('admin/profile');	
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>AquaCredit - <?php echo $page_title;?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>/assets/pnotify/pnotify.custom.css" />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/pnotify/pnotify.custom.js"></script>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

		<link href="<?php echo base_url();?>assets/css/login.css" type="text/css" rel="stylesheet">
	</head>
	<body class="">
		<div class="main_cnt_blk full-page">
		<div class="container-fluid">
			<div class="log_blk">
				<div class="log_logo"> <img src="<?php echo base_url().'assets/images/logo.png'; ?>" alt="" title=""> <br/>
					<div class="sign_txt"> Sign in your account </div>
					<div class="mal_addr"> <img src="<?php echo base_url().'assets/images/back.svg'; ?>" alt="" title=""></div>
				</div>
				<form autocomplete="off">
				<div class="log_mn_blk">
				
					<ul class="inps_blkslog">
						<li>
							<div class="log_inp_blk">
								<input type="email" name="email" class="input_control" id="email" autocomplete="nope">
								<label class="log_lbl"> Enter email </label>
							</div>
						</li>
						<li>
							<div class="log_inp_blk">
								<input type="password" name="password" id="password" class="input_control" autocomplete="new-password">
								<label class="log_lbl"> Enter password </label>
							</div>
							<!-- <div class="cptcha"> <img width="250" src="<?php echo base_url().'assets/images/cptcha.png'; ?>" alt="" title=""> </div> -->
						</li>
					</ul>
				
				</div>
				</form>
				<!-- <div id="message" class="message"> </div> -->
				<div class="btm_log_blk"> <button class="btn btn-primary nxt_blk" id="next_btn"> Next </button> 
				</div>
				<p class="qtyt"> <span> "</span> Greate things in business are never done by one person, they're done by a team of people <span> " </span> </p>
			</div>

		</div>

	</body>
</html>
<script type="text/javascript">
	$(document).ready(function() {
		var url = '<?php echo base_url()?>';

		$("#email").on('keyup change blur',function(){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			email = $(this).val();
			if(email.length > 3)
			{
				if(email.includes(".com"))
				{
					checkEmail();
				}
				else if(keycode == '13'){
					checkEmail();
				}
			}	
		});
		/* $("#email").change(function(){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			email = $(this).val();
			$("#email").parent('.log_inp_blk').addClass('val_tr');
			if(email.length > 3)
			{
				if(email.includes(".com"))
				{
					console.log('valid');
					checkEmail();
				}
				else if(keycode == '13'){
					checkEmail();
				}
			}
			
			
		}); */
		$("#password").on('keyup',function(){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			password = $(this).val();
			if(keycode == '13'){
				checkPassword();
			}
		});
	
		$('.nxt_blk').click(function() {
			id=$(this).attr('id');
			if(id == "next_btn")
			{
				checkEmail();
			}
			else if(id == "sub_btn")
			{
				checkPassword();
			}
			return false;			
		});

		$('.mal_addr').click(function() {
			$('.inps_blkslog').css('left', 0);
			$('.mal_addr').hide();
			$(".nxt_blk").attr('id','next_btn');
		});
		$(".input_control").keyup(function() {
			var k = $(this).val();
			if (k != '') {
				$(this).parent('.log_inp_blk').addClass('val_tr');
			} else {
				$(this).parent('.log_inp_blk').removeClass('val_tr');
			}
		});
	});

	function checkEmail()
	{
		var url = '<?php echo base_url()?>';
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;  
		var email = $("#email").val();
		if(!email)
		{
			new PNotify({
				title: 'Login',
				text:'Please Enter Your Registered Email',
				type: 'warning',
				shadow: true
			});
			$("#email").val('');
			return false;
		}
		else if(!emailReg.test(email)) { 
			new PNotify({
				title: 'Login',
				text: '"'+email+'" is not Valid Email',
				type: 'warning',
				shadow: true
			});
			$("#email").val('');
			return false;
		} 
		else
		{
			$.ajax({
				method: "POST",
				url: url+"admin/login/checkEmail",
				data: { email: email },
				success : function(response)
				{
					if(response == "1")
					{
						$(".nxt_blk").attr('id','sub_btn');
						if($("#password").val() != ''){
							$("#password").parent('.log_inp_blk').addClass('val_tr');
						}
						var w = $('.inps_blkslog li').width();
						$('.inps_blkslog').css('left', -w-20);
						$('.mal_addr').css('display', 'inline-block');
						$("#password").focus();
						return false;
					}
					else
					{
						new PNotify({
							title: 'Login',
							text: '"'+email+'"is not registered Email',
							type: 'warning',
							shadow: true
						});
						$("#email").val('');
						return false;
					}
				}
			});
		}
	}

	function checkPassword()
	{
		var url = '<?php echo base_url()?>';
		password = $("#password").val();
		if(password == "")
		{
			new PNotify({
				title: 'Login',
				text: 'Please Enter Password',
				type: 'warning',
				shadow: true
			});
		}
		else
		{
			$.ajax({
				method: "POST",
				url: url+"admin/login/userAuth",
				data: {email:$("#email").val(),password:password,captcha: $('#captcha').val()},
				success : function(response)
				{
					res= JSON.parse(response);
					if(res.status == 'error')
					{
						new PNotify({
							title: 'Login',
							text: 'Authentication Failed',
							type: 'warning',
							shadow: true
						});
						return false;
					}
					else
					{
						window.location = url+"admin/profile/check_last_url";
					}
				}
			});
		}
	}
</script>