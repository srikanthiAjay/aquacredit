<?php require_once 'header.php' ; 
if($this->session->userdata('adminid') != "")
{ 
	redirect('admin/profile');
	
}
		?>
<link href="<?php echo base_url();?>assets/css/login.css" type="text/css" rel="stylesheet">
		 <div class="lgoin_main"> 
			<div class="login_blk"> 
				<h1> Login </h1>
				 

				<form method="post" name="admin-login" id="admin-login" class="form-horizontal">

				  
				  <div class="form-group">
		
					 <input id="inputName" name="email" type="email" placeholder="Email" class="form-control" />
					 
				  </div>

				  <div class="form-group">
					<input id="inputPassword" name="password" type="password" placeholder="Password" class="form-control" />
				  </div>
				  
				 <div class="form-group"><p id="image_captcha"><?php echo $captchaImg; ?><a href="javascript:void(0);" class="captcha-refresh" ></p><img src="<?php echo base_url().'assets/images/refresh.png'; ?>" width="30" /></a><input type="text" id="captcha" name="captcha" value=""  /></div>				
				
				  <div class="form-group" id="flsh_msg"></div>
				

				  <button type="submit" class="btn submit_btn">Login</button>
				  <!-- <div class="ch_pw" data-toggle="modal" data-target="#change_pop"> Change Password </div> -->
				</form>

		<!--	<div id="change_pop" class="modal fade" role="dialog">
				  <div class="modal-dialog">
					   <div class="modal-content">
						  <div class="modal-header">
							<h4 class="modal-title">Change Password</h4>
					<button type="button" class="close" data-dismiss="modal"><img width="20" src="../images/close_btn.png" alt="" title=""></button>
					
				  </div>

					<div class="modal-body">
						<div class="form-group">
				<input type="password" class="form-control" id="old_password" placeholder="Old Password">
			  </div>
				<div class="form-group">
				<input type="password" class="form-control" id="new_password" placeholder="New Password">
			  </div>

				<button type="submit" class="btn submit_btn">Sumbit</button>
				  </div>


					   </div>
				  </div>
			  </div> -->
        </div>

  </div>

<script type="text/javascript">
var url = '<?php echo base_url()?>';

$(document).ready(function()
{
    $.validator.addMethod('email_regexp', function (value, element) 
    {
        if (value != element.defaultValue) { 
        return this.optional(element) ||  /^[0-9a-zA-Z_.-]+@[a-zA-Z]+[.][a-zA-Z]{2,5}$/.test(value);
    }
        return true;
    },'Please enter valid email');
});
    $("#admin-login").validate({
         rules:{
                password:{
                    required:true,
                    minlength:3,
                },
                
                email:{
				  required: true,
                  email_regexp:true,
                 
                }
            },
            messages: {
                password:
                {
                    required: "Please enter password",
                    minlength: "Minimum length at least 3 characters",
                },

                email:{
                  required:'Please enter email',
                  regex:'Please enter valid email',
                }

            },
            submitHandler: function(form) 
            {
                //var d = document.getElementById('g-recaptcha-response').value;

                    $.ajax({
                        url: url+"admin/login/userAuth",
                        data: {email:$('#inputName').val(),password:$('#inputPassword').val(),captcha: $('#captcha').val()},
                        type:'POST',
                        datatype:'json',
                        success : function(response)
                        {
							//alert(response);
                            res= JSON.parse(response);
                            window.test = res;
                            if(res.status == 'error')
                            {
                                $('#flsh_msg').html(' <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '+res.message+'</div>')
                            }
                            else
                            {
                               
                                window.location = url+"admin/profile";
                               
                            }
                        }
                    })

            }
    });
	
	    $('.captcha-refresh').on('click', function(){
               $.get('<?php echo base_url().'admin/captcha/refresh'; ?>', function(data){
                   $('#image_captcha').html(data);
               });
           });
</script>
<?php require_once 'footer.php' ; ?>