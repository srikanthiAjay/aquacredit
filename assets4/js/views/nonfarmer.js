$(document).ready(function() {
	//Dealer Form Validation
	$.validator.addMethod("aadhar_regexp", function(value, element)
    {
       return this.optional(element) || /^\d{4}\s\d{4}\s\d{4}$/.test(value.toUpperCase());
    }, "Invalid Aadhar Number");
	
	$.validator.addMethod("pan_regexp", function(value, element)
    {
        //return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
        return this.optional(element) || /([A-Z]){5}([0-9]){4}([A-Z]){1}$/.test(value.toUpperCase());
    }, "Invalid Pan Number");

    validateNonfarmer=function(){
		var fname_msg='Full Name is required';
		var ac_number_msg='Account No is required';
		var bc_name_msg='Bank Name is required';
		var ifsc_msg='IFSC is required';
		var bacc_valid=true;
		$('#non_farmer').submit(function(e) {
				e.preventDefault();
		}).validate({
			rules:{
					user_name:{
						required: true,
						minlength: 4
					},
					mobile:
					{
						required:true,
						minlength:10,
						maxlength:10
					},
					aadhar_no:{
						required:true,
						number:true,
						minlength:12,
						maxlength:12,
					},
					pan_no:{
						required:true,
						minlength:10,
						maxlength:10,
						pan_regexp:true
					}
			},
			messages: {
					user_name:
					{
						required: "The name is required",
						minlength: "The owner name must be more than 4 characters",
					},
					mobile:
					{
						required: "The mobile number is required"
					},
					aadhar_no:
					{
						required: "The aadhar number is required",
						minlength: "Please enter 12 digit valid aadhar number",
						maxlength: "Please enter 12 digit valid aadhar number"
					},
					pan_no:
					{
						required: "The pan number is required"
					}
			},
			submitHandler: function(form) 
			{
				var mobile_exist=$("#mobexists").val();
				if(mobile_exist==1){
					new PNotify({
						title: 'Error',
						text: 'Mobile number already exist!',
						type: 'failure',
						shadow: true
					});
					//scrollTop('basic');
					return false;
				}

				var actiontype=$('#actiontype').val();
				var user_id=$('#user_id').val();
				var success_msg='';
				if(actiontype=='add'){
					var action_url=url+"admin/users/createUser";
					success_msg=' Created Successfully';
				}else{
					var action_url=url+"admin/users/updateUser";
					success_msg=' Updated Successfully';
				}

				var bank_skip=$('#bank_skip').prop('checked');
				if(bank_skip==false){
					var bank_cnt=$("#bank_cnt").attr("data-bank-cnt");
					if(bank_cnt>0){
						var bank_ids=$("#bank_cnt").attr("data-bank-ids").split(',');

						for(var i=0;i<bank_ids.length;i++){
							var fname_id=ac_number_id=bc_name_id=ifsc_id="";
							var custom_id=bank_ids[i];
							fname_id="#fname_"+custom_id;
							ac_number_id="#ac_number_"+custom_id;
							bc_name_id="#bc_name_"+custom_id;
							ifsc_id="#ifsc_"+custom_id;
							if($(fname_id).val()==""){
								$(fname_id+"-error").css({'display':'block'}).text(fname_msg);
								bacc_valid=false;
							}else{
								bacc_valid=true;
							}

							if($(ac_number_id).val()==""){
								$(ac_number_id+"-error").css({'display':'block'}).text(ac_number_msg);
								bacc_valid=false;
							}else{
								bacc_valid=true;
							}

							if($(bc_name_id).val()==""){
								$(bc_name_id+"-error").css({'display':'block'}).text(bc_name_msg);
								bacc_valid=false;
							}else{
								bacc_valid=true;
							}

							if($(ifsc_id).val()==""){
								$(ifsc_id+"-error").css({'display':'block'}).text(ifsc_msg);
								bacc_valid=false;
							}else{
								bacc_valid=true;
							}

						}
					}

					if(bacc_valid==false){
						new PNotify({
							title: 'Error',
							text: 'Bank details required!',
							type: 'failure',
							shadow: true
						});
						return false;
					}
				}

				//Form Submit
				document.getElementById("sub_btn").disabled=true;
				$('#loader').html(loader_fa);
				var formData=new FormData(form);
				$.ajax({
		            url:action_url, 
		            type: "POST",             
		            data:formData,
		            cache: false,
		            contentType: false,             
		            processData: false,      
		            success: function(data) {
		            	document.getElementById("sub_btn").disabled=false;
		            	$('#loader').html('');
		            	var result=$.parseJSON(data);
		            	if(result.user_id>0){
			            	$('#success_msg,#sub_btn_msg').css({color:'green'}).html(success_msg);
			                setTimeout(function(){
			                	$('#success_msg,#sub_btn_msg').css({color:''}).html('');	
			                },3000);

			                if(actiontype=='add'){
				                $('.new_mob_em_blk').empty();
					            $('.multvals').val('');
				                document.getElementById("non_farmer").reset();
			                }else{
			                	setTimeout(function(){
			                		//location.replace(url+"admin/users/edit/"+user_id);
			                	},1000);
			                }
			                
		            	}else{
		            		$('#success_msg,#sub_btn_msg').css({color:'red'}).html(' Failed');
			                setTimeout(function(){
			                	$('#success_msg,#sub_btn_msg').css({color:''}).html('');	
			                },3000);
		            	}
		                
		             }
		        });
				return false;
			}
		});
    }
});