$(document).ready(function() {
		//Hide the partner fields
		$('.partner_r').hide();

		//Select Form Type
		getFarmerType=function(farmertype){
			if(farmertype=='par_far'){
				$('.partner_r').show();
				$('.single_r').hide();
				$('#user_name').val('');
				$('#aadhar_no').val('');
			}else{
				$('.partner_r').hide();
				$('.single_r').show();
				$('#firm_name').val('');
				$('#owner_name').val('');
				$('#gst').val('');
			}
		}

		//Farmer Form Validation
		$.validator.addMethod("aadhar_regexp", function(value, element)
	    {
	       return this.optional(element) || /^\d{4}\s\d{4}\s\d{4}$/.test(value.toUpperCase());
	    }, "Invalid Aadhar Number");
		
		$.validator.addMethod("pan_regexp", function(value, element)
	    {
	        //return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
	        return this.optional(element) || /([A-Z]){5}([0-9]){4}([A-Z]){1}$/.test(value.toUpperCase());
	    }, "Invalid Pan Number");

		validateFarmer=function(){
			//user_name,mobile,aadhar,pan,gst
			//firm_name,owner_name
			var fname_msg='Full Name is required';
			var ac_number_msg='Account No is required';
			var bc_name_msg='Bank Name is required';
			var ifsc_msg='IFSC is required';
			var crop_loc_msg='Location is required';
			var crop_type_msg='Crop type is required';
			var acres_msg='No of acres is required';
			var pname_msg='Name is required';
			var paadhar_msg='Aadhar no is required';
			var pmobile_msg='Mobile no is required';
			var bacc_valid=cdetails_valid=partner_valid=true;
			$('#farmer').submit(function(e) {
				e.preventDefault();
			}).validate({
				rules:{
					firm_name:{
						required: true,
						minlength: 3
					},
					user_name:{
						required: true,
						minlength: 4
					},
					owner_name:{
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
						minlength: "The name must be more than 4 characters",
					},
					owner_name:
					{
						required: "The owner name is required",
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
					var optradio=success_msg='';
					var user_id=$('#user_id').val();
					if(actiontype=='add'){
						var action_url=url+"admin/users/createUser";
						optradio=$('input[name="optradio"]:checked').val();
						success_msg=' Created Successfully';
					}else{
						var action_url=url+"admin/users/updateUser";
						var partnership=$('#partnership').val();
						if(partnership==1){
						 optradio='par_far';	
						}
						success_msg=' Updated Successfully';
					}
					
					var partner_skip=$('#partner_skip').prop('checked');
					var bank_skip=$('#bank_skip').prop('checked');
					var crop_skip=$('#crop_skip').prop('checked');
					
					if(optradio=='par_far'){
						if(partner_skip==false){
							var partner_cnt=$("#partner_cnt").attr("data-partner-cnt");
							if(partner_cnt>0){
								var partner_ids=$("#partner_cnt").attr("data-partner-ids").split(',');
								for(var i=0;i<partner_ids.length;i++){
									var pname_id=paadhar_id=pmobile_id="";
									var custom_id=partner_ids[i];
									pname_id="#pname_"+custom_id;
									paadhar_id="#paadhar_"+custom_id;
									pmobile_id="#pmobile_"+custom_id;
									if($(pname_id).val()==""){
										$(pname_id+"-error").css({'display':'block'}).text(pname_msg);
										partner_valid=false;
									}else{
										partner_valid=true;
									}

									if($(paadhar_id).val()==""){
										$(paadhar_id+"-error").css({'display':'block'}).text(paadhar_msg);
										partner_valid=false;
									}else{
										partner_valid=true;
									}

									if($(pmobile_id).val()==""){
										$(pmobile_id+"-error").css({'display':'block'}).text(pmobile_msg);
										partner_valid=false;
									}else{
										partner_valid=true;
									}
								}
							}

							if(partner_valid==false){
								new PNotify({
									title: 'Error',
									text: 'Partner details required!',
									type: 'failure',
									shadow: true
								});
								return false;
							}
						}
					}
					

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

					
					if(crop_skip==false){
						var crop_cnt=$("#crop_cnt").attr("data-crop-cnt");
						if(crop_cnt>0){
							var crop_ids=$("#crop_cnt").attr("data-crop-ids").split(',');
							for(var i=0;i<crop_ids.length;i++){
								var crop_loc_id=crop_type_id=acres_id="";
								var custom_id=crop_ids[i];
								crop_loc_id="#crop_loc_"+custom_id;
								crop_type_id="#crop_type_"+custom_id;
								acres_id="#acres_"+custom_id;
								if($(crop_loc_id).val()==""){
									$(crop_loc_id+"-error").css({'display':'block'}).text(crop_loc_msg);
									cdetails_valid=false;
								}else{
									cdetails_valid=true;
								}

								if($(crop_type_id).val()==""){
									$(crop_type_id+"-error").css({'display':'block'}).text(crop_type_msg);
									cdetails_valid=false;
								}else{
									cdetails_valid=true;
								}

								if($(acres_id).val()==""){
									$(acres_id+"-error").css({'display':'block'}).text(acres_msg);
									cdetails_valid=false;
								}else{
									cdetails_valid=true;
								}
							}

						}

						if(cdetails_valid==false){
								new PNotify({
									title: 'Error',
									text: 'Crop details required!',
									type: 'failure',
									shadow: true
								});
								return false;
						}
					}

					//Check Medicines
					var allmed=$('#allmed').val();
					var error="";
					if(allmed!=''){
						//console.log('All medicines :'+allmed);
						var n = allmed.search(/,/i);
						var is_multiple=true;
						if(n>0){
							var default_brands=allmed.split(',');
						}else{
							var default_brands=allmed;
							is_multiple=false;
						}
						
						var selected_brands=$(".al_brands input:checkbox:checked").map(function(){
						  return $(this).val();
						}).get();
						//console.log(selected_brands);
						if(is_multiple==true){
							if(selected_brands.length>0){
							  for(var i=0;i<default_brands.length;i++){
							  	var is_find=jQuery.inArray(default_brands[i],selected_brands);
							  	if(is_find<0){
							  		//console.log('Default :'+default_brands[i]);
							  		var brand_name=$('#'+default_brands[i]).attr('rel');
							  		error+='<b>'+brand_name+"</b>,";
							  		//console.log('Default :'+brand_name);
							  	}
							  }
							}else{
								for(var i=0;i<default_brands.length;i++){
									var brand_name=$('#'+default_brands[i]).attr('rel');
							  		error+='<b>'+brand_name+"</b>,";
								}
							}
						}else{
							var brand_name=$('#'+default_brands).attr('rel');
							error+='<b>'+brand_name+"</b>,";
						}
						//console.log(selected_brands);
					}

					if(error!=""){
						var new_err="Please assign these brands <br>"+error.slice(0,-1)+"<br> to Medicines1,Medicines2 OR Medicines3";
						new PNotify({
									title: 'Error',
									text: new_err,
									type: 'failure',
									shadow: true
								});
						return false;
					}

					//Form Submit
			
					//Submit form
					document.getElementById("sub_btn").disabled=true;
					$('#loader').html(loader_fa);
					var formData=new FormData(form);
					//$(form).serialize()
					$.ajax({
			            url:action_url, 
			            type: "POST",             
			            data:formData,
			            cache: false,
			            contentType: false,             
			            processData: false,      
			            success: function(data) {
			                //$('#loading').hide();
			                //$("#message").html(data);
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
					                document.getElementById("farmer").reset();
				                }else{
				                	setTimeout(function(){
				                		location.replace(url+"admin/users/edit/"+user_id);
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
			//return false;
		}
});

