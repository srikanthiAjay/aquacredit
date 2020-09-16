$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
     $(this).val($(this).val().replace(/[^\d].+/, ""));
      if ((event.which < 48 || event.which > 57)) {
          event.preventDefault();
      }
});

function checkmobile()
{
	var formval = $("#hid_type").val();
	if(formval == "fs"){ thisform = "#single";}else if(formval == "fm"){ thisform = "#multiple"; }
	else if(formval == "d"){ thisform = "#dealer"; }else if(formval == "nf"){ thisform = "#non_frm"; }
	
	var clikedForm = $(thisform);
	var mobval = clikedForm.find("[name='mob_numb']").val().trim();
	if(mobval !=""){ 
		$.ajax({		
			url: url+"admin/users/checkmobile_exists",
			data: {mobnum:mobval.trim()},
			type:'POST',		
			datatype:'json',
			success : function(response){
				if(response == 1)
				{
					new PNotify({
						title: 'Error',
						text: 'Mobile number already exists, try with another number!',
						type: 'failure',
						shadow: true
					});
					
					$("#mobexists").val(1);
					
				}else{  $("#mobexists").val(0); }			
			}
		});
	}
}

function changemed(mval)
{
	$("#hid_medval").val(mval);
	//alert(mval);
	var lastChar = mval[mval.length -1];
	var	hidmedval = $("#hidm"+lastChar).val();
	var	newhidmedval = "";
	$("#medsection").html("-"+lastChar);
	
	var allboxes = $(".al_brands input:checkbox").map(function(){
		  return $(this).val();
		}).get();
	
	var allchecks = $(".al_brands input:checkbox:checked").map(function(){
	  return $(this).val();
	}).get();
	
	var	newhidmedval = $("#hidm"+lastChar).val();
	
	var names_arr = newhidmedval.split(',');
	
	$.each(names_arr, function( index, value ) {
	  //alert( index + ": " + value );
	  //$('#'+value).fadeIn('slow');
	  $('#'+value).show();
	});
	
	difference = allchecks.filter(a => !names_arr.includes(a));
	//console.log(difference);
	$.each(difference, function( index, value ) {
	  //alert( index + ": " + value );
	  //$('#'+value).fadeOut('slow');
	  $('#'+value).hide();
	});
}

$('#docs_upld, #docs_upld2').on('change',function() {
  
	if($(this).val() == 'Aadhar'){
	  
	}else if($(this).val() == 'Pan'){
	 $('.slct_docs').append(pan.join("\n"));
	}else if($(this).val() == 'Check'){
	 $('.slct_docs').append(check.join("\n"));
	}
			  
});

$('.new_blk_add').click(function(){
	
	var input_id = $(this).siblings('.form-control').attr("id");
	
	var value = $(this).siblings('.form-control').val();

	if(input_id == "mob_numb_new")
	{
		if(value.length != 10){
			new PNotify({
				title: 'Error',
				text: 'Please enter 10 digits mobile number!',
				type: 'failure',
				shadow: true
			});
			return false;
		}
	}else if(input_id == "email_id_new")
	{
		//var email_check = "^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[A-Z0-9.-]+\.[A-Z]{2,}$";
		if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)){
			
		}else{
			new PNotify({
				title: 'Error',
				text: 'Please enter valid email address!',
				type: 'failure',
				shadow: true
			});
			return false;
		}
	}
	
	var hidtype = $("#hid_type").val();
	
		
	var new_cont = ['<li class="new_cont"> ',
		  value,
		   '<span class="cls_itm">', 
		  '<img src="../../assets/images/close_btn.png" /> </span>',
	'</li>'
	];
	if($(this).siblings('.form-control').val() != '') {
		
		var exists = false;
		//var multi_val = $("#hid_mob_"+hidtype).val();
		
		var hidval = $(this).siblings('.multvals_'+hidtype).val().trim();		
		
		$.map(hidval.split(','), function(elementOfArray, indexInArray) {
			 if (elementOfArray == value) {		   
			   exists = true;
			 }
		});	
		
		//alert(exists);
		
		if(!exists)
		{
			$(this).siblings('.new_mob_em_blk').append(new_cont.join("\n"));
			if(hidval != ""){
				$(this).siblings('.multvals_'+hidtype).val(hidval+','+value);
			}else{
				$(this).siblings('.multvals_'+hidtype).val(value);
			}
		}		
	}
	$(this).siblings('.form-control').val('');
	
	$('.cls_itm').click(function(){
		
		var remval = $(this).parent().text().trim();		
		var hidval = $(this).parent().parent().siblings('.multvals_'+hidtype).val().trim();		
		var arry = hidval.split(',');
		
		r = $.grep(arry, function(rval) {
			
			  return rval != remval;			  
		});
		
		$(this).parent().parent().siblings('.multvals_'+hidtype).val(r.toString());
		$(this).parent().remove();
	});
});

//Form submit with validation 
$(document).ready(function(){
	
	$.validator.addMethod("aadhar_regexp", function(value, element)
    {
       return this.optional(element) || /^\d{4}\s\d{4}\s\d{4}$/.test(value.toUpperCase());
    }, "Invalid Aadhar Number");
	
	$.validator.addMethod("pan_regexp", function(value, element)
    {
        //return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
        return this.optional(element) || /([A-Z]){5}([0-9]){4}([A-Z]){1}$/.test(value.toUpperCase());
    }, "Invalid Pan Number");
	
	
	/* $('#recdate').datepicker({
		format: "yy-mm-dd",
		startDate: new Date('2019-12-5'),
		endDate: new Date('2020-7-12')
	  }); */
	/* $('#recdate').datepicker({
		format: "dd/mm/yyyy",
	  }); */
	$('#docs_upld1').multiselect();
	$('#docs_upld2').multiselect();
	$('#docs_upld3').multiselect();
	$('#docs_upld4').multiselect();
	
	var aadar = ['<div class="col-md-4 aad_blk"> ',
				'<div class="form-group">',
				'<label> Upload Your Aadhar</label>',
				'<input type="file" id="aadhar_upload" name="aadhar_upload[]" required multiple />',
				'</div>',
				'</div>'
			];
	var pan = ['<div class="col-md-4 pan_blk"> ',
				'<div class="form-group">',
				'<label> Upload Your PAN</label>',
				'<input type="file" id="pan_upload" name="pan_upload[]" required multiple />',
				'</div>',
				'</div>'
			];

	var check = ['<div class="col-md-4 check_blk"> ',
				'<div class="form-group">',
				'<label> Upload Your Cheque</label>',
				'<input type="file" id="check_upload" name="check_upload[]" required multiple />',
				'</div>',
				'</div>'
			];

	var gst = ['<div class="col-md-4 gst"> ',
				'<div class="form-group">',
				'<label> Upload Your GST</label>',
				'<input type="file" id="gst_upload" name="gst_upload[]" required multiple />',
				'</div>',
				'</div>'
			];
	var partner_s  = ['<div class="col-md-4 partner_s"> ',
				'<div class="form-group">',
				'<label> Upload Your Partnership deed</label>',
				'<input type="file" id="partner_s" name="partner_s[]" required multiple />',
				'</div>',
				'</div>'
			];
			
	var promissory  = ['<div class="col-md-4 promissory"> ',
				'<div class="form-group">',
				'<label> Upload Your Promissory note</label>',
				'<input type="file" id="promissory" name="promissory[]" required multiple />',
				'</div>',
				'</div>'
			];
				
	var gp_doc  = ['<div class="col-md-4 check_blk gp_doc"> ',
				'<div class="form-group">',
				'<label> Upload Your GP document</label>',
				'<input type="file" id="gp_doc" name="gp_doc[]" required multiple />',
				'</div>',
				'</div>'
			];
	var stamp  = ['<div class="col-md-4 stamp"> ',
				'<div class="form-group">',
				'<label> Upload Your Stamp document </label>',
				'<input type="file" id="stamp" name="stamp[]" required multiple />',
				'</div>',
				'</div>'
			];
	$('.aadhar1, .aa_up').click(function(){
		
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(aadar.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.aad_blk').remove();
		}
		
	});

	$('.gst1').click(function(){
		if($(this).find('input').is(":checked")){
		   // alert('65');
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(gst.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
		 
			$('.gst').remove();
		}        
	});

	$('.promissory1').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(promissory.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.promissory').remove();
		}        
	});

	$('.gp1').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(gp_doc.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.gp_doc').remove();
		}        
	});

	$('.stamp1').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(stamp.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.stamp').remove();
		}        
	});

	 $('.partnerdeed1').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(partner_s.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.partner_s').remove();
		}        
	});

	$('.pan1, .pan_up').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(pan.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.pan_blk').remove();
		}        
	});

	$('.cheque1, .chc_up').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(check.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.check_blk').remove();
		}        
	});
	
	$('.medsub').click(function(){
		sval= $("#medsection").html();
		var lastChar = sval[sval.length -1];
		if($("#hidm"+lastChar).val() == ""){
			
			//$('.side_popup').addClass('opn_slide');
			$('#flsh_msg_med').html(' <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Please select atleast one brand!</div>');
		}else{
			$('.alpha_blk').hide();
			$('.side_popup').removeClass('opn_slide');
			$('#flsh_msg_med').html('');
		}
	});

	var part = [

			  '<div class="row dtl_par">', 
				  '<div class="col-md-4">', 
					'<div class="form-group">',
					   '<label >Partner Name </label>',  
					   '<input type="text" id="pname" name="pname[]" class="form-control" placeholder="Partner Name">',
				  '</div>',
				  '</div>',
				  '<div class="col-md-4">', 
					'<div class="form-group">',
					   '<label for="name">Aadhar</label>',
					'<input type="text" id="paadhar" name="paadhar[]" class="form-control allownumericwithoutdecimal" placeholder="Aadhar"> ',  
				 '</div>',
				  '</div>',

				  '<div class="col-md-4">', 
				   '<div class="form-group">',
					   '<label for="name">Phone Number </label>',
					'<input type="text" class="form-control" id="pmobile" name="pmobile[]" placeholder="Phone Number" style="width: calc(100% - 40px); float:left;"> <span class="cl_part"><img src="../../assets/images/close_btn.png" width="17"/></span>',   
				  '</div>',
				  '</div>',
			  '</div>'
			  ];
	$('.ad_part').click(function(){

	  $(this).parent().siblings('.new_part_lst').append(part.join("\n"));
	  $('.cl_part').click(function(){
		$(this).parent().parent().parent('.dtl_par').remove();
	  })
			  
	});

	$('.frmr_type .form-check').click(function(){

		if($(this).find('input').val() == 'sing_far' ){
			$('#multiple').hide();
			 $('#single').show();
			 $('#par_far').parent().parent().parent().removeClass('slc_far');
			 $('#sing_far').parent().parent().parent().addClass('slc_far');
			 $('#hid_type').val('fs');
			
		} else {
		  $('#multiple').show();
			 $('#single').hide();
			$('#sing_far').parent().parent().parent().removeClass('slc_far');
			 $('#par_far').parent().parent().parent().addClass('slc_far');
			 $('#hid_type').val('fm');
		}
	});

	$( "#mob_numb, #email_id" ).focusout(function() {

		var hidtype = $("#hid_type").val();
		var hidmob = $('#hid_mob_'+hidtype).val().trim().split(',');
		var hidmail= $('#hid_mail_'+hidtype).val().trim().split(',');
		
		var email = $(this).parent().parent().parent().find('#email_id').val();
		var phone = $(this).parent().parent().parent().find('#mob_numb').val();
		
		if(email && phone != ''){

			$('.dft_mob_blk').empty();
			$('.aler_lnks').removeAttr('style');
			var new_email = ['<li class="new_cont defa_c"> ',
							  email, ',',
						'</li>'
					  ];
			var new_phone = ['<li class="new_cont defa_c"> ',
							  phone, ',',
						'</li>'
					  ];
			/* $(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_m').append(new_email.join("\n"));			$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_p').append(new_phone.join("\n")); */
					
			if(hidmob.length > 1)
			{
				$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_m li.defa_c').html(new_email.join("\n"));
			}else{
				$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_m').html(new_email.join("\n"));
			}
			if(hidmail.length > 1)
			{
				$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_p li.defa_c').html(new_phone.join("\n"));
			}else{
				$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_p').html(new_phone.join("\n"));
			}
			
			$(this).parent().parent().parent().siblings('.aler_lnks').find('.form-control').removeAttr('disabled', 'true');
			
			hidmob[0] = phone; hidmail[0] = email;
			$('#hid_mob_'+hidtype).val(hidmob.join());
			$('#hid_mail_'+hidtype).val(hidmail.join());
			
			
		}else {
			
			$(this).parent().parent().parent().siblings('.aler_lnks').find('.form-control').prop("disabled", true);
			$('.dft_mob_blk').empty();  

			$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_m li').remove();
			$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_p li').remove();

			$('.aler_lnks').removeAttr('style');
			var empt_txt = [ '<div style="color: red; font-size: 14px;"> Please Fill Above Email and Phone Number </div>']
			$(this).parent().parent().parent().siblings('.dft_mob_blk').append(empt_txt.join("\n"));
		}  
	});

	$('.alert_check').click(function(){
		
	  $(this).toggleClass('check_ale');
	  
		if($(this).find('input').is(":not(:checked)")){
			
			$(this).find('input').val(0);
			
			$(this).parent().siblings('.aler_lnks').hide();            
			$(this).children('.trun_txt').text("Turn Off");		 
			$(this).parent().siblings('.dft_mob_blk').text('Your alerts are turned off');               
		}
		else if($(this).find('input').is(":checked")){
			
			$(this).find('input').val(1);
			
		  $(this).parent().siblings('.aler_lnks').show();
		  $(this).children('.trun_txt').text("Turn On");
		  $(this).parent().siblings('.dft_mob_blk').empty();
		} 
		
	});

	$('.change_med').click(function(){		
	
		$('#flsh_msg_med').html('');		
		$('.alpha_blk').show();
		$('.side_popup').addClass('opn_slide');

		$('.alpha_blk, .cls_pp_sd').click(function(){
			 $('.alpha_blk').hide();
			$('.side_popup').removeClass('opn_slide');
		});
	});

	$('.prod_bl').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).addClass('slc_prdt');
		}
		else if($(this).find('input').is(":not(:checked)")){
			$(this).removeClass('slc_prdt');
		}        
	});
	
	/* $('.sub_btn').click(function(){
		$('.alpha_blk2, .full_wth_popup').show();
		$('.edt_user').click(function(){
			$('.alpha_blk2, .full_wth_popup').hide();
		});
	}); */
	
	/* $('.edt_user').click(function(e){
		
		e.preventDefault();
		$('.alpha_blk2, .full_wth_popup').hide();
	}); */
	
	$('.edt_user').click(function(){					
						
		$('.alpha_blk2, .full_wth_popup').hide();
		
	});
	
	
	$('#cnf_sbmt').click(function(){
		var formval = $("#hid_type").val(); var myForm = upload_doctype = "";
		
		if(formval == "fs"){ myForm = document.getElementById('single'); upload_doctype = $("#docs_upld3").val(); }
		else if(formval == "fm"){ myForm = document.getElementById('multiple'); upload_doctype = $("#docs_upld2").val(); }
		else if(formval == "d"){ myForm = document.getElementById('dealer'); upload_doctype = $("#docs_upld1").val(); }
		else if(formval == "nf"){ myForm = document.getElementById('non_frm'); upload_doctype = $("#docs_upld4").val(); }	
		
		var hidm1 = $("#hidm1").val(); var hidm2 = $("#hidm2").val(); var hidm3 = $("#hidm3").val();
					
		formData = new FormData(myForm);
		formData.append('hidm1', hidm1);
		formData.append('hidm2', hidm2);
		formData.append('hidm3', hidm3);
		formData.append('utype', formval);
		formData.append('upload_doc', upload_doctype);

		$('.alpha_blk2, .full_wth_popup').hide();
		cnfsbmt = 1;	
		if(cnfsbmt == 1){
			
			$.ajax({
				url: url+"admin/users/adduser",
				data: formData,
				type:'POST',
				contentType: false,
				processData: false,
				enctype: 'multipart/form-data',
				datatype:'json',
				success : function(response)
				{
					//alert(response);
					res= JSON.parse(response);
					//window.test = res;
					if(res.status == 'error')
					{
						$("#hid_cnfsbmt").val(0);
						//$('#flsh_msg').html(' <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '+res.message+'</div>');
						new PNotify({
							title: 'Error',
							text: 'Something went wrong, try again!',
							type: 'failure',
							shadow: true
						});
					}
					else
					{
						$("#hid_cnfsbmt").val(0);
						//window.location = url+"admin/users";
						//$('#flsh_msg').html(' <div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> User created successfully!</div>');
						setTimeout(function(){
							location = url+"admin/users/create"
						  },5000);
						new PNotify({
						  title: 'Success',
						  text: 'User created successfully!',
						  type: 'success',
						  shadow: true
						});								
						$("#single")[0].reset();
					}
				}
			});
			return false;
		}
	});

});
//Form submit with validation

var hidtype = hidfrm = hidm1 = hidm2 = hidm3 = multi_mobiles = multi_emails = upload_doctype = "";
var pname = paadhar = pmobile = [];
var postdata = "";	
var bank_fname = bank_acnum = bank_bcname = bank_ifsc = bank_branch = [];
var crop_loc = crop_type = crop_acres = [];	
var thisform = "";

function frmsbmt(formval){
		
	if(formval == "fs"){ thisform = "#single";}else if(formval == "fm"){ thisform = "#multiple"; }
	else if(formval == "d"){ thisform = "#dealer"; }else if(formval == "nf"){ thisform = "#non_frm"; }
		
	$(thisform).click(function() {		

		hidtype = $("#hid_type").val();
		 
		var clikedForm = $(this);
		
		//alert($("#single").find("[name='uname']").val());

		var uname = clikedForm.find("[name='uname']").val();
		var firm_name = clikedForm.find("[name='firm_name']").val();
		var guaran = clikedForm.find("[name='guaran']").val();
		var mobile = clikedForm.find("[name='mob_numb']").val();
		var email_id = clikedForm.find("[name='email_id']").val();		
		var uaddr = clikedForm.find("[name='uaddr']").val();	
		
		var aadhar = clikedForm.find("[name='aadhar']").val();
		var pan = clikedForm.find("[name='pan']").val();
		var gst = clikedForm.find("[name='gst']").val();
		
		var feed = clikedForm.find("[name='feed']").val();
		var med1 = clikedForm.find("[name='med1']").val();
		var med2 = clikedForm.find("[name='med2']").val();
		var med3 = clikedForm.find("[name='med3']").val();
		var roi = clikedForm.find("[name='rate_of_int']").val();
		
		var os_type = clikedForm.find("[name='os_opt']").val();
		var os_amt = clikedForm.find("[name='os_amt']").val();
		var os_rem = clikedForm.find("[name='os_rem']").val();
		
		//if brands select
		hidm1 = $("#hidm1").val();
		hidm2 = $("#hidm2").val();
		hidm3 = $("#hidm3").val();
		
		//Documents			
		
		var turnchk = clikedForm.find("[name='turnchk']").val();
		if(turnchk == 1){
			multi_mobiles = $("#hid_mob_"+hidtype).val();
			multi_emails = $("#hid_mail_"+hidtype).val();
		}else{
			/* multi_mobiles = $("#hid_mob_"+hidtype).val('');
			multi_emails = $("#hid_mail_"+hidtype).val(''); */			
			multi_mobiles = '';
			multi_emails = '';
		}
		
		pname = clikedForm.find("[id='pname']").map(function(){return $(this).val();}).get();
		paadhar = clikedForm.find("[id='paadhar']").map(function(){return $(this).val();}).get();
		pmobile = clikedForm.find("[id='pmobile']").map(function(){return $(this).val();}).get();
		
		// Bank and Crop Details
		
		bank_fname = clikedForm.find("[id='fname']").map(function(){return $(this).val();}).get();
		bank_acnum = clikedForm.find("[id='ac_number']").map(function(){return $(this).val();}).get();
		bank_bcname = clikedForm.find("[id='bc_name']").map(function(){return $(this).val();}).get();
		bank_ifsc = clikedForm.find("[id='ifsc']").map(function(){return $(this).val();}).get();
		bank_branch = clikedForm.find("[id='branch_name']").map(function(){return $(this).val();}).get();			
		
		crop_loc = clikedForm.find("[id='crop_loc']").map(function(){return $(this).val();}).get();
		crop_type = clikedForm.find("[id='crop_type']").map(function(){return $(this).val();}).get();
		crop_acres = clikedForm.find("[id='acres']").map(function(){return $(this).val();}).get();				
		
		if(hidtype == 'nf'){			
			
			hidfrm = "#non_frm";
			upload_doctype = $("#docs_upld4").val();
			$('.head_title').html('User Details (Non-Farmer)');
			$('.vaadhar_block').show(); $('.vpan_block').show(); $('.vgst_block').show();
			$('.vpartner_block').hide(); $('.view_partners_labels').hide(); $('.view_partners').hide();
		}
		else if(hidtype == 'd'){
			
			hidfrm = "#dealer";
			upload_doctype = $("#docs_upld1").val();
			$('.head_title').html('User Details (Dealer)');
			$('.vaadhar_block').show(); $('.vpan_block').show(); $('.vgst_block').show();
			$('.vpartner_block').hide(); $('.view_partners_labels').hide(); $('.view_partners').hide();
		}
		else if(hidtype == 'fs'){ 
		
			hidfrm = "#single";
			upload_doctype = $("#docs_upld3").val();
			$('.head_title').html('User Details (Farmer - Single)');
			$('.vaadhar_block').show(); $('.vpan_block').show(); $('.vgst_block').hide();
			$('.vpartner_block').hide(); $('.view_partners_labels').hide(); $('.view_partners').hide();
			
		}else if(hidtype == 'fm'){ 
		
			hidfrm = "#multiple";
			upload_doctype = $("#docs_upld2").val();
			$('.head_title').html('User Details (Farmer - Multiple)');
			$('.vaadhar_block').hide(); $('.vpan_block').show(); $('.vgst_block').show();
			$('.vpartner_block').show(); $('.view_partners_labels').show(); $('.view_partners').show();
		}

		var receive_dt = clikedForm.find("[name='recdate']").val();
		var return_dt = clikedForm.find("[name='retdate']").val();		
		var doc_rem = clikedForm.find("[name='doc_rem']").val();		
		
		//postdata = {utype:hidtype, uname:uname, email_id:email_id, firm_name:firm_name, guaran:guaran, mobile:mobile, notifychk:turnchk, alert_mobile:multi_mobiles, alert_email:multi_emails, uaddr:uaddr, aadhar:aadhar, pan:pan, gst:gst, pname: pname, paadhar:paadhar, pmobile:pmobile, fname:bank_fname, bank_acnum:bank_acnum, bank_name:bank_bcname, bank_ifsc:bank_ifsc, bank_branch:bank_branch, crop_loc:crop_loc, crop_type:crop_type, crop_acres:crop_acres, feed:feed, med1:med1, med2:med2, med3:med3, roi:roi, upload_doc:upload_doctype, receive_dt:receive_dt, return_dt:return_dt, doc_rem:doc_rem, os_type: os_type, os_amt:os_amt, os_rem:os_rem, hidm1:hidm1, hidm2:hidm2, hidm3:hidm3};	
		
		// view data in popup before submit
		
		if(turnchk == 1){ var alerchk = "Yes"; $(".view_alerts").show();}else{ var alerchk = "No"; $(".view_alerts").hide();}
		if(os_type == 'p'){ var vosamt = "+"+os_amt;}else{ var vosamt = "-"+os_amt;}
		$("#vuname").text(uname); $("#vgname").text(guaran); $("#vmobile").text(mobile); $("#vemailid").text(email_id);
		$("#vaddr").text(uaddr); $("#valert").text(alerchk); $("#valertmob").text(multi_mobiles); $("#valertmail").text(multi_emails); $("#vaadhar").text(aadhar); $("#vpan").text(pan); $("#vfeed").text(feed); $("#vmed1").text(med1); $("#vmed2").text(med2); $("#vmed3").text(med3); $("#vroi").text(roi); $("#vrcdate").text(receive_dt); $("#vrtdate").text(return_dt); $("#vdocrem").text(doc_rem);$(".vosamt").text(vosamt); $("#vosrem").text(os_rem);$("#vgst").text(gst);
		var bankcount = cropcount = partnercount = false;
		if(bank_fname[0] == ""){ $("#bankcount").text('(0)');}else{ $("#bankcount").text('('+bank_fname.length+')');bankcount = true; }
		if(crop_loc[0] == ""){ $("#cropcount").text('(0)');}else{ $("#cropcount").text('('+crop_loc.length+')'); cropcount = true; }
		if(pname[0] == ""){ $("#partnercount").text('(0)');}else{ $("#partnercount").text('('+pname.length+')'); partnercount = true; }
		var bankstr = cropstr = partnerstr = vdocs = "";
		var upldocs = [];
		if(bankcount == true){ 
			for(b = 0; b < bank_fname.length; b++)
			{
				bankstr += '<div class="col-md-3"><div class="form-group"><span id="vperson">'+bank_fname[b]+'</span></div></div><div class="col-md-3"><div class="form-group"><span id="vacnum">'+bank_acnum[b]+'</span></div></div><div class="col-md-2"><div class="form-group"><span id="vbname">'+bank_bcname[b]+'</span></div></div><div class="col-md-2"><div class="form-group"><span id="vifsc">'+bank_ifsc[b]+'</span></div></div><div class="col-md-2"><div class="form-group"><span id="vbranch">'+bank_branch[b]+'</span></div></div>';
			}
			$(".view_banks").html(bankstr);
		}else{
			$(".view_banks").html('');
		}
		//console.log(upload_doctype);
		if(upload_doctype != null)
		{
			for(d =0; d < upload_doctype.length; d++){
				
				vdocs +='<li> '+upload_doctype[d]+' - <span class="grn_clr">Uploaded </span></li>';
			}			
			$("#vdocs").html(vdocs);
		}else{
			vdocs ='<li><span style="color:red;">No documents uploaded </span></li>';
			$("#vdocs").html(vdocs);
		}
			
		if(cropcount == true){
			for(c = 0; c < crop_loc.length; c++)
			{
				cropstr += '<div class="col-md-4"><div class="form-group"><span id="vcroploc">'+crop_loc[c]+'</span></div></div><div class="col-md-4"><div class="form-group"><span id="vcroptype">'+crop_type[c]+'</span></div></div><div class="col-md-4"><div class="form-group"><span id="vacres">'+crop_acres[c]+'</span></div></div>';
			}
			$(".view_crops").html(cropstr);
		}else{
			$(".view_crops").html('');
		}
		
		if(partnercount == true){
			for(p = 0; p < pname.length; p++)
			{
				partnerstr += '<div class="col-md-4"><div class="form-group"><span id="vcroploc">'+pname[p]+'</span></div></div><div class="col-md-4"><div class="form-group"><span id="vcroptype">'+paadhar[p]+'</span></div></div><div class="col-md-4"><div class="form-group"><span id="vacres">'+pmobile[p]+'</span></div></div>';
			}
			$(".view_partners").html(partnerstr);
		}else{
			$(".view_partners").html('');
		}
		// End view Data
	
	});
	
	var mobexists = $("#mobexists").val();
	
	if(mobexists == 0)
	{
		$(thisform).submit(function(e) {
			
			e.preventDefault();
		}).validate({
			rules:{
				
				firm_name:
				{
					required: true,
					minlength: 3
				},				
				uname:{
					required:true,
					minlength:3
				},				
				mob_numb:{
					required:true,
					number:true,
					minlength:10,
					maxlength:10
				},
				aadhar:{
					number:true,
					number:"Please eneter 12 digits Aadhar number",
					minlength:12,
					maxlength:12,
					//aadhar_regexp:true
				},
				pan:{
					minlength:10,
					maxlength:10,
					pan_regexp:true
				},
				"pname[]":{
					required:true,
					minlength:3
				},
				"paadhar[]":{
					required:true,
					number:true,
					minlength:12,
					maxlength:12
				},
				"pmobile[]":{
					required:true,
					minlength:10,
					maxlength:10
				},					
				mob_numb_new:{
					//required:true,
					number:true,
					minlength:10,
					maxlength:10
				},			
				
				/* email:{
				  required: true,
				  email_regexp:true,
				 
				} */
			},
			messages: {
				firm_name:
				{
					required: "Please enter firm name",
					minlength: "Minimum length at least 3 characters",
				},
				uname:
				{
					required: "Please enter name",
					minlength: "Minimum length at least 3 characters",
				},				
				mob_numb:
				{
					required: "Please enter mobile number"
				},
				"pname[]":{
					required:"Please enter partner name",
					minlength:3
				},
				"paadhar[]":{
					required:"Please enter aadhar number",
					number:"Please eneter 12 digits Aadhar number",
					minlength:12,
					maxlength:12
				},
				"pmobile[]":{
					required:"Please enter contact number",
					minlength:10,
					maxlength:10
				},		
				
				/* email:{
				  required:'Please enter email',
				  regex:'Please enter valid email',
				} */

			},
			submitHandler: function(form) 
			{			
				var cnfsbmt = 0;
				if($("#mobexists").val() == 0)
				{
					$('.alpha_blk2, .full_wth_popup').show();
				}					
			}
			
		});
		
	
	}
}


function barndcheck_old(bval)
{
	//console.log(bval);
	var difference = [];
	var mval = $("#hid_medval").val();
	var	hidmedval = $("#hid"+mval).val();
	var cnf = document.getElementById("brand"+bval);
	if( cnf.checked ==  true){		
		
		//$('#autoUpdate').fadeIn('slow');
		//$('#'+bval).fadeOut('slow');
		if(hidmedval == "") $("#hid"+mval).val(bval);
		else $("#hid"+mval).val(hidmedval +','+bval);	
	}
	
	//var final_arr = $.merge([], oldArray);
	
	
	/* if(mval == "m1")
	{
		//eval('var ' + k + i + '= ' + i + ';'); 
		var  m1Ids = $(".al_brands input:checkbox:checked").map(function(){
		  return $(this).val();
		}).get();
		console.log(m1Ids);
	} */
	
}
function barndcheck(bval)
{
	//console.log(bval);
	$('#flsh_msg_med').html('');
	var difference = [];
	var mval = $("#hid_medval").val();
	var lastChar = mval[mval.length -1];
	//alert(lastChar);
	$("#hid"+mval).val($("#hidm"+lastChar).val());
	var	hidmedval = $("#hid"+mval).val();
	
	var cnf = document.getElementById("brand"+bval);
	if( cnf.checked ==  true){
		if(hidmedval == "") $("#hid"+mval).val(bval);
		else $("#hid"+mval).val(hidmedval +','+bval);
		$("#hidm"+lastChar).val($("#hid"+mval).val());
	}else{
		
		var arry = $("#hidm"+lastChar).val().split(',');
			y = $.grep(arry, function(value) {
			  return value != bval;
		});	
		//alert(y);
		$("#hid"+mval).val(y.toString());
		$("#hidm"+lastChar).val(y.toString());
	}		
}

function myFunction() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('ato_serc');
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    //a = li[i].getElementsByTagName("a")[0];
    a = li[i].getElementsByTagName("div")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}  