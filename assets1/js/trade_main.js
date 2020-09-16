$(document).ready(function() {
			
			$.validator.setDefaults({ ignore: [] });

			$('#ukey').blur(function(){
				//var usercode = $(this).val();		
				
				var usercode1 = $("#usercode").val().trim();

				/*if(usercode1 != "")
				{
					alert(usercode1);
					getusercrops(usercode1,'add');
					//getuserbanks(usercode,'add');
				}else{
					var opt = '<option value="">-- Select uservnvbnvbn first --</option>';
					$("#crop_opt").html(opt); $("#crop_opt").val('');		
								
					
				}*/		
			});

			//Add Loan Form submit
	$("#loanfrm").submit(function(e) {			
		e.preventDefault();
		
	}).validate({
		rules:{
			
			skey:
			{
				required: true
			},
			crop_opt:
			{
				required: true
			},
			/* bank_opt:
			{
				required: true
			},	 */		
			loan_amt_commas:{
				required: true,
				maxlength:8	
			},
			/* loan_amt:{
				required: true,
				number: true,
				//decimal: true,
				min: 1,
				max: 999999,
				minlength:1,
				maxlength:6				
			}, */
			crop_opt:{
				required: true
			}
		},
		messages: {
			skey:
			{
				required: "Please select user"
			},
			crop_opt:
			{
				required: "Please select crop"
			},
			bank_opt:
			{
				required: "Please select bank"
			},
			loan_amt_commas:
			{
				required: "Please enter loan amount"
			}
		},
		/* errorElement : 'div',
		errorLabelContainer: '.errorTxt', */
		submitHandler: function(form) 
		{	
			formData = new FormData(form);		
			
			$.ajax({
				url: url+"api/loans/add",
				data: formData,
				type:'POST',
				contentType: false,
				processData: false,
				enctype: 'multipart/form-data',
				datatype:'json',
				success : function(response)
				{						
					res= JSON.parse(response);
					if(res.status == 'success')
					{	
						new PNotify({
							title: 'Success',
							text: "Loan created successfully!",
							type: 'success',
							shadow: true
						});
						
						setInterval('location.reload()', 2000);
													
					}
					else{
						new PNotify({
							title: 'Error',
							text: 'Something went wrong, try again!',
							type: 'failure',
							shadow: true
						});
					}					
				}
			});								
		}
	});
});
function edit_loan(lid)
{
	$("#hid_lid").val(lid);
	$.ajax({		
		//url: url+"api/loans/index/"+lid,
		url: url+"api/loans/loandetails/"+lid,
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			//alert(response);
			res= JSON.parse(response);
			//alert(res.data.transfer_type);
			if(res.data.transfer_type == "bank")
			{
				$('.lnk_typ.ban_trns').addClass('act_type');
				$('.lnk_typ.cash_trns').removeClass('act_type');
				$('#bank_opt_edit').addClass('required');
				$('.lon_typ').show();
				
			}else{
				$('.lnk_typ.ban_trns').removeClass('act_type');
				$('.lnk_typ.cash_trns').addClass('act_type');
				$('#bank_opt_edit').removeClass('required');
				$('.lon_typ').hide();				
			}
			
			$("input[name='act_types_edit']:checked").val(res.data.transfer_type);		
			$("#skey_edit").val(res.data.uname);
			$("#act_types_edit").val(res.data.transfer_type);
			$("#loan_amt_commas_edit").val(res.data.loan_amt);
			$("#loan_amt_edit").val(res.data.loan_amt);
			$("#hid_crop_id").val(res.data.crop_id);
			$("#hid_bank_id").val(res.data.user_bank_id);
			$("#selectuser_id_edit").val(res.data.user_id);
			$("#select_usercode_edit").val(res.data.usercode);
			
			$("#hid_acivity_id").val(res.data.la_id);			
			$("#start_date").val(res.data.start_date);			
			$("#end_date").val(res.data.end_date);			
			$("#roi").val(res.data.rate_of_interest);			
			$("#ref_no").val(res.data.ref_no);			
			$('#admin_bank option:eq('+res.data.admin_bank+')').attr('selected', true)
			$('#loan_type option:eq('+res.data.loan_type+')').attr('selected', true)
			$('#admin_bank').select2();
			$('#loan_type').select2();
			
			$(".crop.selectVal").html(res.data.crop_loc);
			getusercrops(res.data.usercode,"edit");			
			getuserbanks(res.data.usercode,"edit");	
			amount_with_commas("edit");
		}
	});
}
function loan_upd(lid)
{
	edit_loan(lid);
}
$( function() {
	
	$( "#ukey" ).autocomplete({
	  source: function( request, response ) {
			$('#userid').val('');
			$("#crop_opt").val('');
	   // Fetch data
	   $.ajax({
		url: url+"api/users/searchusers",
		type: 'post',
		dataType: "json",
		data: {
		 search: request.term
		},
		success: function( data ) {
			
			response(data);	
			alert(JSON.stringify(data));
		}
	   });
	  },
	  select: function (event, ui) {
	   // Set selection
	   $('#ukey').val(ui.item.label); // display the selected text
	   $('#userid').val(ui.item.value); // save selected id to input
	   $('#usercode').val(ui.item.usercode); // save selected id to input
	   return false;
	  }
	 });
	 
	 //Edit
	 $( "#skey_edit" ).autocomplete({
	  source: function( request, response ) {
			$('#selectuser_id_edit').val('');
			$('#select_usercode_edit').val('');
			$("#crop_opt_edit").val('');
	   // Fetch data
	   $.ajax({
		url: url+"api/users/searchusers",
		type: 'post',
		dataType: "json",
		data: {
		 search: request.term
		},
		success: function( data ) {
			
			response(data);	 
		}
	   });
	  },
	  select: function (event, ui) {
	   // Set selection
	   $('#skey_edit').val(ui.item.label); // display the selected text
	   $('#selectuser_id_edit').val(ui.item.value); // save selected id to input
	   $('#select_usercode_edit').val(ui.item.usercode); // save selected id to input
	   return false;
	  }
	 });
});

function getusercrops(usercode,addoredit)
{
	alert(usercode);
	var aeval = hidcrop = "";
	if(addoredit == "edit"){ aeval = "_edit"; hidcrop = $("#hid_crop_id").val();}
	$.ajax({		
		url: url+"api/UserCrops/index/"+usercode,
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			alert(response);
			res= JSON.parse(response);				
			//alert(res.data.length);
			
			var usercode = $('#usercode'+aeval).val();
			var sel = "";
			if(usercode != "")
			{
				var opt = '<option value="">-- Select Crop --</option>';
				if(res.data.length > 0)
				{
					$.each(res.data, function(index, crop) {
						if(crop.id == hidcrop){ sel = "selected"; }else{ sel = "";}
						opt += '<option value="'+crop.id+'" '+sel+' >'+crop.crop_loc+'</option>';
					});
				}
			}else{
				var opt = '<option value="">-- Select user first --</option>';
			}
			$("#crop_opt"+aeval).html(opt);
			//$("#crop_opt"+aeval).select2('refresh');
			//document.getElementById("crop_opt"+aeval).fstdropdown.rebind();
		}
	});
}


function gettraders()
{

  // Get Profile
  $.ajax({    
    //url: url+"admin/brands/list",
    url: url+"api/trades",
    data: {},
    type:'POST',    
    datatype:'json',
    success : function(response){     
      
      res= JSON.parse(response);
      
      var opt = '<option value="">-- Select Trader --</option>';
			if(res.data.length > 0)
			{
				$.each(res.data, function(index, trader) {
					
					opt += '<option value="'+trader.td_id+'">'+trader.firm_name+'</option>';
				});
			}
			
			$("#sel_trader").html(opt);		
    }
  });

	
}


function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}