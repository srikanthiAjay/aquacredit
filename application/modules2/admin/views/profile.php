<?php $this->load->view('admin/header');?>
<link href="<?php echo base_url(); ?>assets/css/profile.css" type="text/css" rel="stylesheet">
<?php $this->load->view('admin/sidebar');?>	
<div class="right_blk"> 
	<div class="top_ttl_blk">
		<span class="padin_t_5">My Profile</span> 
		<span>   </span>
	 </div>
	<div class="padding_30">  
		<div class="row">
			<div class="col-md-12"> 		   
				<div class="card_view bg_gry over_flw">
					<div class="pro_l_blk">
						<form  action="<?php echo base_url();?>admin/uploadImage" method="post" id="uploadimg" enctype="multipart/form-data" >
							<img src="<?php echo base_url();?>assets/profile_images/profile-avatar.jpg" width="120" alt="" title="" />
						<!--	<div class="uplod_blk "> Change Logo <input type="file" id="image" name="image" class="btn btn-primary" /></div> -->
							
						</form>
					</div>
					<div class="pro_r_blk">
						<div class="hdg_bk"> Profile Information </div>
						<div class="form-group" id="flsh_msg"></div>
						<form class="mar_btm" id="frmupd" name="frmupd" method="post" >
							<div class="row">
								<div class="col-md-6"> 
									<div class="form-group">
										<label for="name">Name</label>
										<input type="name" class="form-control" id="name" name="name" placeholder="Name" value="" />   
									</div>
								</div>

								<div class="col-md-6"> 
									<div class="form-group">
									   <label for="name">Mobile</label>
										<input type="text" class="form-control allownumericwithoutdecimal" id="mobile" name="mobile" placeholder="Mobile" value="" />   
									</div>
								</div>

								<div class="col-md-6"> 
									<div class="form-group">
										<label for="name">Email</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Name" value="" disabled />   
									</div>
								</div>

								<div class="col-md-6"> 
									<div class="form-group">
										<label class="s_bt">&nbsp;</label> <input class="btn btn-primary" type="submit" name="update" value="Update" />
									</div>
								</div>

							</div>
						</form>

						<div class="hdg_bk"> Change Password </div>

						<form class="mar_btm" id="updpswd" name="updpswd">
							<div class="row">
								<div class="col-md-6"> 
									<div class="form-group">
										<input type="password" class="form-control" id="curpswd" name="curpswd" placeholder="Current Password" />   
									</div>
								</div>

								<div class="col-md-6"> 
									<div class="form-group">
										<input type="password" class="form-control" id="newpswd" name="newpswd" placeholder="New Password" />   
									</div>
								</div>

								<div class="col-md-6"> 
									<div class="form-group">
										<input type="password" class="form-control" id="cnfpswd" name="cnfpswd" placeholder="Confirm New Password" />   
									</div>
								</div>

								<div class="col-md-6"> 
									<div class="form-group">
										<input class="btn btn-primary" type="submit" name="submit" value="Change" />
									</div>
								</div>
							</div>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/common.js" type="javascript"></script>
<script type="text/javascript">
var url = '<?php echo base_url()?>';

$(document).ready(function(){
	
	$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
		  event.preventDefault();
		}
	});
	
	$.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Only alphabetical characters");
	
	$.validator.addMethod('email_regexp', function (value, element) 
    {
        if (value != element.defaultValue) { 
        return this.optional(element) ||  /^[0-9a-zA-Z_.-]+@[a-zA-Z]+[.][a-zA-Z]{2,5}$/.test(value);
		}
        return true;
    },'Please enter valid email');
	
	getprofile();
	function getprofile()
	{
		// Get Profile
		$.ajax({		
			url: url+"api/profile",
			data: {},
			type:'POST',		
			datatype:'json',
			success : function(response){
				
				//alert(response);
				res= JSON.parse(response);				
				//alert(res.data.name);
				if(res.data != "")
				{
					$("#name").val(res.data.name);					
					$("#mobile").val(res.data.mobile);					
					$("#email").val(res.data.email);					
				}				
			}
		});
	}
	
	$("#frmupd").validate({
         rules:{
                name:{
                    required:true,
					lettersonly:true,
                    minlength:3,
                },
                
                email:{
				  required: true,
                  email_regexp:true,
                 
                },
				mobile:{
					//required: true,
					minlength: 10,
					maxlength: 10
				}
            },
            messages: {
                name:
                {
                    required: "Please enter name",
                    minlength: "Minimum length at least 3 characters",
                },

                email:{
                  required:'Please enter email',
                  regex:'Please enter valid email',
                },
				mobile:{
					required: "Please enter mobile number",
					minlength: "Please enter 10 digits mobile number",
					maxlength: "Please enter 10 digits mobile number"
				}

            },
			submitHandler: function(form) 
            {
                //var d = document.getElementById('g-recaptcha-response').value;

                    $.ajax({
                        url: url+"api/profile/profileupdate",
                        data: {name:$('#name').val(),email:$('#email').val(),mobile: $('#mobile').val()},
                        type:'POST',
                        datatype:'json',
                        success : function(response)
                        {
							res= JSON.parse(response);
							
                            if(res.status == 'fail')
                            {
                                $('#flsh_msg').html(' <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Somthing error, try again!</div>');
                            }
                            else
                            {
                               
                                //window.location = url+"admin/profile";
								$('#flsh_msg').html(' <div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Updated successfully!</div>');
                               
                            }
                        }
                    })

            }
    });
	
	// Change password
	$("#updpswd").validate({
         rules:{
                curpswd:{
                    required:true,
                    minlength:3
                },
                
                newpswd:{
				  required: true,
				  minlength:3
                 
                },
				
				cnfpswd:{
				  required: true,
				  equalTo: "#newpswd"
                 
                }
            },
            messages: {
                curpswd:
                {
                    required: "Please enter current password",
                    minlength: "Minimum length at least 3 characters",
                },

                newpswd:{
                  required:'Please enter new password',
				  minlength: "Minimum length at least 3 characters",
                },
				
				cnfpswd:{
                  required:'Please enter confirm password',
				  equalTo: "Enter confirm password same as password"
                }

            },
			submitHandler: function(form) 
            {
                //var d = document.getElementById('g-recaptcha-response').value;

                    $.ajax({
                        url: url+"api/profile/passwordupdate",
                        data: {curpswd:$('#curpswd').val(),newpswd:$('#newpswd').val(),cnfpswd: $('#cnfpswd').val()},
                        type:'POST',
                        datatype:'json',
                        success : function(response)
                        {
							res= JSON.parse(response);
							
                            if(res.status == 'fail')
                            {
                                $('#flsh_msg').html(' <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Password not updated successfully!</div>');
                            }
							else if(res.status == 'curpswdfail')
							{
								$('#flsh_msg').html(' <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> You entered the current password wrong!</div>');
							}
							else if(res.status == 'pswdexists')
							{
								$('#flsh_msg').html(' <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> You have used new password previously, please enter another!</div>');
							}
                            else
                            {
                               
                                //window.location = url+"admin/profile";
								$('#flsh_msg').html(' <div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Password updated successfully!</div>');
                               
                            }
                        }
                    })

            }
    });
    
});


</script>
<?php require_once 'footer.php' ; ?>