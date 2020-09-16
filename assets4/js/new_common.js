var thisform = "#single";
$(document).ready(function(){
	$('.mnu_blk').click(function(){
		$(this).toggleClass('act_menu');
		$('.left_blk ul').toggleClass('dis_blk');
	});

	
	$('.ad_bnk').unbind().click(function(event){	
	var bank_cnt=$("#bank_cnt").attr("data-bank-cnt");
	var extra_id=(parseInt(bank_cnt)+1);
	var html = ['<div class="bank_dtl_blk" data-bank-id="bank_acc_'+extra_id+'" data-bid="'+extra_id+'"> <span class="remove" onclick="removeBankAcc('+extra_id+')"> <img src="'+url+'/assets/images/close_btn.png" alt="" title="" /> </span> <div class="row">', 
     '<div class="col-md-6">', 
   '<div class="form-group">',
    '<label for="name">Person Full Name</label>',
    '<input type="text" class="form-control" id="fname_'+extra_id+'" name="fname[]" placeholder="Person Full Name" />',
    '<label id="fname_'+extra_id+'-error" class="error" for="fname_'+extra_id+'"></label>',   
  '</div>',
  '</div>',
  '<div class="col-md-6">', 
   '<div class="form-group">',
    '<label for="name">Account Number</label>',
    '<input type="text" class="form-control allownumericwithoutdecimal" id="ac_number_'+extra_id+'" name="ac_number[]" placeholder="Account Number" />',
    '<label id="ac_number_'+extra_id+'-error" class="error" for="ac_number_'+extra_id+'"></label>',   
  '</div>',
  '</div>',
     '<div class="col-md-6">', 
    '<div class="form-group">',
       '<label for="name">Bank Name</label>',
    '<input type="text" class="form-control" id="bc_name_'+extra_id+'" name="bc_name[]" placeholder="Bank Name" />',
    '<label id="bc_name_'+extra_id+'-error" class="error" for="bc_name_'+extra_id+'"></label>',    
  '</div>',
  '</div>',
  '<div class="col-md-6">', 
    '<div class="form-group">',
       '<label for="name">IFSC</label>',
    '<input type="text" class="form-control" id="ifsc_'+extra_id+'" name="ifsc[]" placeholder="IFSC" />',
    '<label id="ifsc_'+extra_id+'-error" class="error" for="bc_name_'+extra_id+'"></label>',   
  '</div>',
  '</div>',
  
   '<div class="col-md-6">', 
    '<div class="form-group">',
       '<label for="name">Branch Name</label>',
   '<input type="text" class="form-control" id="branch_name" name="branch_name[]" placeholder="Branch Name" />',  
  '</div>',
  '</div></div> </div>'];
		$(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_list_pos').append(html.join("\n"));
		var k = $(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_list_pos').children('.bank_dtl_blk').length;
		var wth = $('.bank_dtl_blk').width()+32;
		var s = k*20;
		$(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_list_pos').css('width', k*wth+s);

		$('.remove').unbind().click(function(){
			var k = $(this).parent().parent().children('.bank_dtl_blk').length;
			var wth = $('.bank_dtl_blk').width()+32;
			var s = k*20;
			  if(k == 2){
				$('.bank_list_pos').css('width', k*wth+s - 300);
			  } else {
				$('.bank_list_pos').css('width', k*wth+s);
			  }			
		
				$(this).parent('.bank_dtl_blk').remove();
				// var wths = $('.bank_list_pos').width();
				$('.bank_list_pos').stop();
		});

		$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
		     $(this).val($(this).val().replace(/[^\d].+/, ""));
		      if ((event.which < 48 || event.which > 57)) {
		          event.preventDefault();
		      }
		});

		$("#bank_cnt").attr("data-bank-cnt",extra_id);
		$("#bd_cnt").text(extra_id);

		var ids=[];
		$('.bank_dtl_blk').each(function () {
		    //console.log($(this).attr('data-bank-id'));
		    ids.push($(this).attr('data-bid'));
		});
		if(ids.length>0){
			$("#bank_cnt").attr("data-bank-ids",ids.join(","));
		}
		
	});

	$('.ad_crp').unbind().click(function(){

	var crop_cnt=$("#crop_cnt").attr("data-crop-cnt");
	var crop_extra_id=(parseInt(crop_cnt)+1);
var html = ['<div class="crp_dtl_blk" data-crop-id="crop_details_'+crop_extra_id+'" data-cid="'+crop_extra_id+'"> <span class="crp_remove" onclick="removeCrop('+crop_extra_id+')"> <img src="'+url+'/assets/images/close_btn.png" alt="" title="" /> </span> <div class="row">', 
     		'<div class="col-md-6">', 
   '<div class="form-group">',
       '<label for="name">Crop Location</label>',
   '<input type="text" class="form-control" id="crop_loc_'+crop_extra_id+'" name="crop_loc[]" placeholder="Crop Location" />',
   '<label id="crop_loc_'+crop_extra_id+'-error" class="error" for="crop_loc_'+crop_extra_id+'"></label>',   
  '</div>',
  '</div>',
  '<div class="col-md-6">', 
   '<div class="form-group">',
    '<label for="name">Crop Type</label>',
    '<input type="text" class="form-control" id="crop_type_'+crop_extra_id+'" name="crop_type[]" placeholder="Crop Type" />',
    '<label id="crop_type_'+crop_extra_id+'-error" class="error" for="crop_type_'+crop_extra_id+'"></label>',   
  '</div>',
  '</div>',
  '<div class="col-md-6">', 
   '<div class="form-group">',
    '<label for="name">Number of Acres</label>',
    '<input type="text" class="form-control" id="acres_'+crop_extra_id+'" name="acres[]" placeholder="Number of Acres" onkeypress="return allowNumerORDecimal(event,this)"/>',
    '<label id="acres_'+crop_extra_id+'-error" class="error" for="acres_'+crop_extra_id+'"></label>',    
  '</div>',
  '</div>',
   '</div>'];
		//$('.crp_list_pos').append(html.join("\n"));
		$(this).parent('.hdg_bk').siblings('.crp_list').children('.crp_list_pos').append(html.join("\n"));
		var k = $(this).parent('.hdg_bk').siblings('.crp_list').children('.crp_list_pos').children('.crp_dtl_blk').length;		
		var wth = $('.crp_dtl_blk').width()+32;
		var s = k*20;
		//$('.crp_list_pos').css('width', k*wth+s);
		$(this).parent('.hdg_bk').siblings('.crp_list').children('.crp_list_pos').css('width', k*wth+s);

		$('.crp_remove').unbind().click(function(){			
			
			//var k = $('.crp_dtl_blk').length;
			var k = $(this).parent().parent().children('.crp_dtl_blk').length;
			var wth = $('.crp_dtl_blk').width()+32;
			var s = k*20;
			//$('.crp_list_pos').css('width', k*wth+s);
			if(k == 2){
				$('.crp_list_pos').css('width', k*wth+s - 300);
			  } else {
				$('.crp_list_pos').css('width', k*wth+s);
			  }	
			  $(this).parent('.crp_dtl_blk').remove();
		});

		$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
		     $(this).val($(this).val().replace(/[^\d].+/, ""));
		      if ((event.which < 48 || event.which > 57)) {
		          event.preventDefault();
		      }
		});
		$("#crop_cnt").attr("data-crop-cnt",crop_extra_id);
		$("#cd_cnt").text(crop_extra_id);

		var ids=[];
		$('.crp_dtl_blk').each(function () {
		    ids.push($(this).attr('data-cid'));
		});
		if(ids.length>0){
			$("#crop_cnt").attr("data-crop-ids",ids.join(","));
		}
	});


	//Medicine
	$('.ad_med').unbind().click(function(){
		var med_cnt=$("#med_block").attr("data-med-cnt");
		var med_extra_id=(parseInt(med_cnt)+1);
		var medicine=['<div class="col-md-4 med_details" id="mdiv_'+med_extra_id+'" data-med-id="med_details_'+med_extra_id+'" data-mid="'+med_extra_id+'">',
					  '<div class="form-group">',
					  '<label for="name">Medicines'+med_extra_id+' (%)<span class="deflt"> Default </span><a href="javascript:void(0)" title="" class="fr change_med" onclick="nchangemed('+med_extra_id+')"> Change </a><span class="med_remove" onclick="removeMed('+med_extra_id+')"> <img src="'+url+'/assets/images/close_btn.png" alt="" title="" /> </span></label>',
					  '<input type="text" class="form-control" id="medicines'+med_extra_id+'" name="medicines[]" placeholder="Medicines'+med_extra_id+'" onkeypress="return allowNumerORDecimal(event,this)">',
					  '<input type="hidden"  id="hidfm'+med_extra_id+'" name="hidfm'+med_extra_id+'"/>',
					  '<input type="hidden" id="hidm'+med_extra_id+'" name="hidm'+med_extra_id+'" value="" />',
					  '</div>',
					  '</div>'
					 ];
		$("#med_block .roi:last").before(medicine.join("\n"));

		$("#med_block").attr("data-med-cnt",med_extra_id);
		var ids=[];
		$('.med_details').each(function () {
		    ids.push($(this).attr('data-mid'));
		});
		if(ids.length>0){
			$("#med_block").attr("data-med-ids",ids.join(","));
		}

		$('.change_med').click(function(){		
				$('#flsh_msg_med').html('');		
				$('.alpha_blk').show();
				$('.side_popup').addClass('opn_slide');
				$('.alpha_blk, .cls_pp_sd').click(function(){
					$('.alpha_blk').hide();
					$('.side_popup').removeClass('opn_slide');
				});
		});
	});

	//New
	nchangemed=function(med_id){
		changemed('fm'+med_id+'');
	}
	//Remove Medicine
	removeMed=function(med_id){
		var brands=$("#hidm"+med_id).val().split(',');
		$.each(brands, function( index, value ) {
		  $('#'+value).show();
		  $('#brand'+value).prop("checked",false);
		});

		$('#mdiv_'+med_id).remove();
		var med_cnt=$("#med_block").attr("data-med-cnt");
		var new_med_cnt=(parseInt(med_cnt)-1);
		$("#med_block").attr("data-med-cnt",new_med_cnt);

		var rids=[];
		var med_ids=$("#med_block").attr("data-med-ids").split(',');
		for(var i=0;i<med_ids.length;i++){
			if(med_id!=med_ids[i]){
				rids.push(med_ids[i]);
			}
		}
		$("#med_block").attr("data-med-ids",rids.join(","));

	}

	//Upload Files
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

	//Upload Files End

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

	//Add Parterner
	$('.ad_part').click(function(){
	  var partner_cnt=$("#partner_cnt").attr("data-partner-cnt");
	  var partner_extra_id=(parseInt(partner_cnt)+1);

	  var part = [
			  '<div class="row dtl_par" data-bank-id="partner_acc_'+partner_extra_id+'" data-pid="'+partner_extra_id+'">', 
				  '<div class="col-md-4">', 
					'<div class="form-group">',
					   '<label >Partner Name </label>',  
					   '<input type="text" id="pname" name="pname[]" class="form-control" placeholder="Partner Name">',
					   '<label id="pname_'+partner_extra_id+'-error" class="error" for="pname_'+partner_extra_id+'"></label> ',
				  '</div>',
				  '</div>',
				  '<div class="col-md-4">', 
					'<div class="form-group">',
					   '<label for="name">Aadhar</label>',
					'<input type="text" id="paadhar" name="paadhar[]" class="form-control allownumericwithoutdecimal" placeholder="Aadhar" maxlength="12"> ',
					'<label id="paadhar_'+partner_extra_id+'-error" class="error" for="paadhar_'+partner_extra_id+'"></label> ',  
				 '</div>',
				  '</div>',

				  '<div class="col-md-4">', 
				   '<div class="form-group">',
					   '<label for="name">Phone Number </label>',
					'<input type="text" class="form-control" id="pmobile" name="pmobile[]" placeholder="Phone Number" style="width: calc(100% - 40px); float:left;">',
					'<label id="pmobile_'+partner_extra_id+'-error" class="error" for="pmobile_'+partner_extra_id+'"></label>',
					'<span class="cl_part" maxlength="10" onclick="removePartner('+partner_extra_id+')"><img src="'+url+'/assets/images/close_btn.png" width="17"/></span>',    
				  '</div>',
				  '</div>',
			  '</div>'
			  ];

	  $(this).parent().siblings('.new_part_lst').append(part.join("\n"));

	  $('.cl_part').click(function(){
		$(this).parent().parent().parent('.dtl_par').remove();
	  })
	  
	  	$("#partner_cnt").attr("data-partner-cnt",partner_extra_id);
		var ids=[];
		$('.dtl_par').each(function () {
		    ids.push($(this).attr('data-pid'));
		});
		if(ids.length>0){
			$("#partner_cnt").attr("data-partner-ids",ids.join(","));
		}

	});	
	//Add Parterner End	

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

	allowNumerORDecimal=function(evt, element) {
			  var charCode = (evt.which) ? evt.which : event.keyCode
			  if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
			    return false;
			  else {
			    var len = $(element).val().length;
			    var index = $(element).val().indexOf('.');
			    if (index > 0 && charCode == 46) {
			      return false;
			    }
			    if (index > 0) {
			      var CharAfterdot = (len + 1) - index;
			      if (CharAfterdot > 3) {
			        return false;
			      }
			    }

			  }
			  return true;
	    }

	    //Remove Bank Acc
	    removeBankAcc=function(bank_id){
	    	var bank_cnt=$("#bank_cnt").attr("data-bank-cnt");
			var new_bank_cnt=(parseInt(bank_cnt)-1);
			$("#bank_cnt").attr("data-bank-cnt",new_bank_cnt);
			$("#bd_cnt").text(new_bank_cnt);

			var rids=[];
			var bank_ids=$("#bank_cnt").attr("data-bank-ids").split(',');
			for(var i=0;i<bank_ids.length;i++){
				if(bank_id!=bank_ids[i]){
					rids.push(bank_ids[i]);
				}
			}
			$("#bank_cnt").attr("data-bank-ids",rids.join(","));
	    }

	    //Remove Crop
	    removeCrop=function(crop_id){
	    	var crop_cnt=$("#crop_cnt").attr("data-crop-cnt");
			var new_crop_cnt=(parseInt(crop_cnt)-1);
			$("#crop_cnt").attr("data-crop-cnt",new_crop_cnt);
			$("#cd_cnt").text(new_crop_cnt);

			var rids=[];
			var crop_ids=$("#crop_cnt").attr("data-crop-ids").split(',');
			for(var i=0;i<crop_ids.length;i++){
				if(crop_id!=crop_ids[i]){
					rids.push(crop_ids[i]);
				}
			}
			$("#crop_cnt").attr("data-crop-ids",rids.join(","));
	    }

	    //Partner
	    removePartner=function(partner_id){
	    	var partner_cnt=$("#partner_cnt").attr("data-partner-cnt");
			var new_partner_cnt=(parseInt(partner_cnt)-1);
			$("#partner_cnt").attr("data-partner-cnt",new_partner_cnt);

			var rids=[];
			var partner_ids=$("#partner_cnt").attr("data-partner-ids").split(',');
			for(var i=0;i<partner_ids.length;i++){
				if(partner_id!=partner_ids[i]){
					rids.push(partner_ids[i]);
				}
			}
			$("#partner_cnt").attr("data-partner-ids",rids.join(","));
	    }

	    //Assign to medicine
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

		//Add additional contacts
		$("#mobile, #email" ).focusout(function() {
				var hidmob = $('#hid_mob').val().trim().split(',');
				var hidmail= $('#hid_mail').val().trim().split(',');
				
				var email = $(this).parent().parent().parent().find('#email').val();
				var phone = $(this).parent().parent().parent().find('#mobile').val();
				
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
					$('#hid_mob').val(hidmob.join());
					$('#hid_mail').val(hidmail.join());
					
					
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

		$('.new_blk_add').click(function(){
			var input_id = $(this).siblings('.form-control').attr("id");
			var value = $(this).siblings('.form-control').val();

			var ext_cls='';
			if(input_id == "mob_numb_new")
			{
				ext_cls='mob_ext'; 
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
				ext_cls='email_ext';
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
			
			//var hidtype = $("#hid_type").val();
			
			if(input_id == "mob_numb_new")
			{	
				var new_cont = ['<li class="new_cont"> ',
					  value,
					   '<span class="cls_itm '+ext_cls+'">', 
					  '<img src="'+url+'/assets/images/close_btn.png" /> </span>',
					  '<input type="hidden" name="alert_mids[]" value="">',
					  '<input type="hidden" name="alert_m[]" value="'+value+'">',
				'</li>'
				];
			}else{
				var new_cont = ['<li class="new_cont"> ',
					  value,
					   '<span class="cls_itm '+ext_cls+'">', 
					  '<img src="'+url+'/assets/images/close_btn.png" /> </span>',
					  '<input type="hidden" name="alert_eids[]" value="">',
					  '<input type="hidden" name="alert_e[]" value="'+value+'">',
				'</li>'
				];
			}

			if($(this).siblings('.form-control').val() != '') {
				
				var exists = false;
				//var multi_val = $("#hid_mob_"+hidtype).val();
				
				var hidval = $(this).siblings('.multvals').val().trim();		
				
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
						$(this).siblings('.multvals').val(hidval+','+value);
					}else{
						$(this).siblings('.multvals').val(value);
					}
				}		
			}
			$(this).siblings('.form-control').val('');
			
			$('.cls_itm').click(function(){
				var remval = $(this).parent().text().trim();		
				var hidval = $(this).parent().parent().siblings('.multvals').val().trim();		
				var arry = hidval.split(',');
				
				r = $.grep(arry, function(rval) {
					
					  return rval != remval;			  
				});
				
				$(this).parent().parent().siblings('.multvals').val(r.toString());
				$(this).parent().remove();
				
			});
		});    

		//Side Popup
		$('.change_med').click(function(){		
			
				$('#flsh_msg_med').html('');		
				$('.alpha_blk').show();
				$('.side_popup').addClass('opn_slide');

				$('.alpha_blk, .cls_pp_sd').click(function(){
					$('.alpha_blk').hide();
					$('.side_popup').removeClass('opn_slide');
				});
		});

		
		$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
		     $(this).val($(this).val().replace(/[^\d].+/, ""));
		      if ((event.which < 48 || event.which > 57)) {
		          event.preventDefault();
		      }
		});

		removeEle=function(){
			console.log('###^^^');
			$('.remove_conf').click(function(){
				console.log('###');
				var k = $(this).parent().parent().children('.bank_dtl_blk').length;
				var wth = $('.bank_dtl_blk').width()+32;
				var s = k*20;
				  if(k == 2){
					$('.bank_list_pos').css('width', k*wth+s - 300);
				  } else {
					$('.bank_list_pos').css('width', k*wth+s);
				  }			
			
					$(this).parent('.bank_dtl_blk').remove();
					// var wths = $('.bank_list_pos').width();
					$('.bank_list_pos').stop();
			});
		}
		
		
		$('.crp_remove').unbind().click(function(){			
			//var k = $('.crp_dtl_blk').length;
			var k = $(this).parent().parent().children('.crp_dtl_blk').length;
			var wth = $('.crp_dtl_blk').width()+32;
			var s = k*20;
			//$('.crp_list_pos').css('width', k*wth+s);
			if(k == 2){
				$('.crp_list_pos').css('width', k*wth+s - 300);
			  } else {
				$('.crp_list_pos').css('width', k*wth+s);
			  }	
			  $(this).parent('.crp_dtl_blk').remove();
		});

});



function checkmobile()
{
	var mobval = $('#mobile').val().trim();
	if(mobval!=""){
	   if(mobval.length==10){  
			$.ajax({		
				url: url+"admin/users/checkmobile_exists",
				data: {mobnum:mobval.trim()},
				type:'POST',		
				datatype:'json',
				success : function(response){
					if(response == 1)
					{
						
						$("#mobile-error").html('Mobile number already exists').show();
						/*new PNotify({
							title: 'Error',
							text: 'Mobile number already exists, try with another number!',
							type: 'failure',
							shadow: true
						});*/
						$("#mobexists").val(1);
						
					}else{  $("#mobexists").val(0); $("#mobile-error").html('');}			
				}
			});
		}
	}
}

function checkMobileEditMode()
{
	var mobval = $('#mobile').val().trim();
	var user_id = $('#user_id').val().trim();
	if(mobval!=""){
	   if(mobval.length==10){  
			$.ajax({		
				url: url+"admin/users/updatemobile",
				data: {mobnum:mobval.trim(),user_id:user_id},
				type:'POST',		
				datatype:'json',
				success : function(response){
					if(response == 1)
					{
						
						$("#mobile-error").html('Mobile number already exists').show();
						/*new PNotify({
							title: 'Error',
							text: 'Mobile number already exists, try with another number!',
							type: 'failure',
							shadow: true
						});*/
						$("#mobexists").val(1);
						
					}else{  $("#mobexists").val(0); $("#mobile-error").html('');}			
				}
			});
		}
	}
}

//Select Medicine
function changemed(mval)
{
	$("#hid_medval").val(mval);
	//alert(mval);return;
	var lastChar = mval[mval.length -1];
	var	hidmedval = $("#hidm"+lastChar).val();
	
	//console.log(mval+'--'+lastChar+'==='+hidmedval);return;
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
	  $('#'+value).show();
	});
	
	difference = allchecks.filter(a => !names_arr.includes(a));
	$.each(difference, function( index, value ) {
	  $('#'+value).hide();
	});
}

//Collect brands
function barndcheck(bval)
{
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

//Search Brands
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

function scrollTop(target_id){
	var target = $('#'+target_id);

	target = target.length ? target : $('[name=' +target_id+']');
	if (target.length) {
		console.log(target.length);
		$('html,body').animate({
		  scrollTop: 200
		}, 1000);
		return false;
    }
}

var ele_info={'attr_id':'','ele_id':'','ele_summary':'','action':''};
function removeElement(attr_id,ele_id,ele_summary,action){
	ele_info.attr_id=attr_id;
	ele_info.ele_id=ele_id;
	ele_info.ele_summary=ele_summary;
	ele_info.action=action;
 	//console.log('ele id'+ele_id+' action:'+action);
 	$('#ele_msg').html('');
 	if(action=='bank'){
 	 //removeBankAcc(attr_id);
 	 $('#ele_msg').html('You want Delete <b>'+ele_summary+'</b> account details');	
 	}else if(action=='crop'){
 	 //removeCrop(attr_id);
 	 $('#ele_msg').html('You want Delete <b>'+ele_summary+'</b> crop details');
 	}else if(action=='partner'){
 	 //removePartner(attr_id);
 	 $('#ele_msg').html('You want Delete <b>'+ele_summary+'</b> partner details');	
 	}

 	$('#delete_user').modal('show');
}

function removeElementAlert(attr_id,ele_id,ele_summary,action){
	ele_info.attr_id=attr_id;
	ele_info.ele_id=ele_id;
	ele_info.ele_summary=ele_summary;
	ele_info.action=action;
	delConfirm();
	$('#'+ele_info.attr_id).remove();
}

function delConfirm(){
	//console.log('ele id'+ele_info.attr_id);
	var msg='';
	if(ele_info.action=='bank'){
		$('#bank_acc_'+ele_info.attr_id).remove();
 	 	removeBankAcc(ele_info.attr_id);
 	 	msg='<b>'+ele_info.ele_summary+'</b> account details deleted successfully';
 	}else if(ele_info.action=='crop'){
 		$('#crop_details_'+ele_info.attr_id).remove();
 	 	removeCrop(ele_info.attr_id);
 	 	msg='<b>'+ele_info.ele_summary+'</b> crop details deleted successfully';
 	}else if(ele_info.action=='partner'){
 		$('#partner_acc_'+ele_info.attr_id).remove();
 	    removePartner(ele_info.attr_id);
 	    msg='<b>'+ele_info.ele_summary+'</b> partner details deleted successfully';
 	}else if(ele_info.action=='alerts'){
 		msg='<b>'+ele_info.ele_summary+'</b> deleted successfully';
 	}

	$.ajax({		
		url: url+"admin/users/delelement",
		data: {'action':ele_info.action,'ele_id':ele_info.ele_id},
		type:'POST',		
		datatype:'json',
		success : function(response){
			var res=$.parseJSON(response);
			if(res.result){
				new PNotify({
					title: 'Success',
					text: msg,
					type: 'success',
					shadow: true
				});
			}	
		}
	});
}

function changeForm(action){
	if(action=='Edit'){
		$('.input_disable').prop("disabled", false);
		$('#editID').hide();
		$('.hide_action_btn,#cancelID').show();
		$('#act_text').text('Edit');
		$('#docs_upld2').multiselect('enable');
		$('#docs_upld2').multiselect('refresh');
	}else{
		$('.input_disable').prop("disabled", true);
		$('#editID').show();
		$('.hide_action_btn,#cancelID').hide();
		$('#act_text').text('View');
		var user_id=$('#user_id').val();
		location.replace(url+"admin/users/edit/"+user_id);
	}
}

function viewDoc(doc_id){
	var resource=jQuery.parseJSON($('#doc_'+doc_id).attr("data-resource"));
	//console.log(resource);

	$('#doc_type').html(resource.doc_type);
    $('#IMGSRC').attr("src",'');
    $('#IMGSRC').attr("src",resource.image);
	$("#PDFModal").modal({
          backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
    });
}

var docfile={};
function delDoc(doc_id){
	$('#ele_msg').html('');
	docfile=jQuery.parseJSON($('#doc_'+doc_id).attr("data-resource"));
	$('#ele_doc_msg').html('You want Delete '+docfile.doc_type);
}

function delDocConfirm(){
	//console.log(docfile);
	var ele_msg=docfile.doc_type+' deleted successfully';
	$.ajax({		
		url: url+"admin/users/delelement",
		data: {'action':'deldoc','ele_id':docfile.doc_id,'doc_file':docfile.doc_file,'user_code':docfile.user_code},
		type:'POST',		
		datatype:'json',
		success : function(response){
			var res=$.parseJSON(response);
			if(res.result){
				new PNotify({
					title: 'Success',
					text: ele_msg,
					type: 'success',
					shadow: true
				});

				var user_id=$('#user_id').val();
				location.replace(url+"admin/users/edit/"+user_id);
			}	
		}
	});
}
/*$('.new_blk_add').click(function(){
	
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
});*/
// $('.remove').unbind().click(function(){

// 		var k = $(this).parent().parent().children('.bank_dtl_blk').length;
// 		var wth = $('.bank_dtl_blk').width()+32;
// 		var s = k*20;
// 		  if(k == 2){
// 			$('.bank_list_pos').css('width', k*wth+s - 300);
// 		  } else {
// 			$('.bank_list_pos').css('width', k*wth+s);
// 		  }			
	
// 			$(this).parent('.bank_dtl_blk').remove();
// 	// var wths = $('.bank_list_pos').width();
// 	$('.bank_list_pos').stop();
// 	});
